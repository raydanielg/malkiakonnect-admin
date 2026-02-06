<?php

namespace App\Console\Commands;

use App\Models\MotherIntake;
use App\Services\MkNumberGenerator;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class SyncMotherIntakes extends Command
{
    protected $signature = 'mother-intakes:sync {--per-page=25} {--max-pages=0}';

    protected $description = 'Sync Mother Intake submissions from remote API into local database and assign MK numbers.';

    public function handle(MkNumberGenerator $mk): int
    {
        $baseUrl = rtrim((string) config('services.malkia_api.base_url', ''), '/');
        if ($baseUrl === '') {
            $this->error('Missing services.malkia_api.base_url');
            return self::FAILURE;
        }

        $perPage = (int) $this->option('per-page');
        if ($perPage < 1) $perPage = 25;
        if ($perPage > 100) $perPage = 100;

        $maxPages = (int) $this->option('max-pages');

        $page = 1;
        $imported = 0;
        $updated = 0;

        while (true) {
            if ($maxPages > 0 && $page > $maxPages) {
                break;
            }

            $url = $baseUrl.'/api/mother-intakes';
            $this->info("Fetching page {$page}...");

            $res = Http::acceptJson()
                ->timeout(20)
                ->get($url, [
                    'per_page' => $perPage,
                    'page' => $page,
                ]);

            if (! $res->ok()) {
                $this->error('Remote API error: '.$res->status());
                return self::FAILURE;
            }

            $json = $res->json();
            $data = Arr::get($json, 'data', []);
            $meta = Arr::get($json, 'meta', []);

            if (! is_array($data) || count($data) === 0) {
                break;
            }

            DB::transaction(function () use ($data, $mk, &$imported, &$updated) {
                foreach ($data as $row) {
                    if (! is_array($row)) {
                        continue;
                    }

                    $sourceId = Arr::get($row, 'id');
                    if (! $sourceId) {
                        continue;
                    }

                    $existing = MotherIntake::query()->where('source_id', $sourceId)->first();

                    if (! $existing || ! $existing->mk_number) {
                        continue;
                    }

                    $payload = [
                        'source_id' => $sourceId,
                        'user_id' => Arr::get($row, 'user_id'),
                        'full_name' => Arr::get($row, 'full_name'),
                        'phone' => Arr::get($row, 'phone'),
                        'journey_stage' => Arr::get($row, 'journey_stage'),
                        'pregnancy_weeks' => Arr::get($row, 'pregnancy_weeks'),
                        'baby_weeks_old' => Arr::get($row, 'baby_weeks_old'),
                        'hospital_planned' => Arr::get($row, 'hospital_planned'),
                        'hospital_alternative' => Arr::get($row, 'hospital_alternative'),
                        'delivery_hospital' => Arr::get($row, 'delivery_hospital'),
                        'birth_hospital' => Arr::get($row, 'birth_hospital'),
                        'ttc_duration' => Arr::get($row, 'ttc_duration'),
                        'agree_comms' => Arr::get($row, 'agree_comms'),
                        'disclaimer_ack' => Arr::get($row, 'disclaimer_ack'),
                        'email' => Arr::get($row, 'email'),
                        'age' => Arr::get($row, 'age'),
                        'pregnancy_stage' => Arr::get($row, 'pregnancy_stage'),
                        'due_date' => Arr::get($row, 'due_date'),
                        'location' => Arr::get($row, 'location'),
                        'previous_pregnancies' => Arr::get($row, 'previous_pregnancies'),
                        'concerns' => Arr::get($row, 'concerns'),
                        'interests' => Arr::get($row, 'interests'),
                        'status' => Arr::get($row, 'status'),
                        'reviewed_by' => Arr::get($row, 'reviewed_by'),
                        'reviewed_at' => Arr::get($row, 'reviewed_at'),
                        'completed_at' => Arr::get($row, 'completed_at'),
                        'notes' => Arr::get($row, 'notes'),
                        'priority' => Arr::get($row, 'priority'),
                        'created_at' => Arr::get($row, 'created_at'),
                        'updated_at' => Arr::get($row, 'updated_at'),
                    ];

                    $existing->fill($payload);
                    $existing->save();
                    $updated++;
                }
            });

            $lastPage = (int) Arr::get($meta, 'last_page', $page);
            if ($page >= $lastPage) {
                break;
            }

            $page++;
        }

        $this->info("Done. Imported: {$imported}, Updated: {$updated}");

        return self::SUCCESS;
    }
}
