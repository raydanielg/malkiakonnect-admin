<?php

namespace Modules\Adminmodules\Http\Controllers;

use App\Models\MotherIntake;
use App\Services\MkNumberGenerator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;

class MotherIntakeApprovalController
{
    public function approve(Request $request, int $sourceId, MkNumberGenerator $generator): JsonResponse
    {
        $validated = $request->validate([
            'full_name' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
        ]);

        $baseUrl = rtrim((string) config('services.malkia_api.base_url', ''), '/');
        if ($baseUrl === '') {
            return response()->json(['message' => 'Missing services.malkia_api.base_url'], 500);
        }

        try {
            $result = DB::transaction(function () use ($request, $sourceId, $validated, $baseUrl, $generator) {
                $record = MotherIntake::query()->where('source_id', $sourceId)->lockForUpdate()->first();

                if (! $record) {
                    $res = Http::acceptJson()->timeout(20)->get($baseUrl.'/api/mother-intakes/'.urlencode((string) $sourceId));
                    if (! $res->ok()) {
                        return ['error' => 'Imeshindikana kuvuta taarifa za intake kutoka API.', 'status' => 422];
                    }

                    $json = $res->json();
                    $data = Arr::get($json, 'data', []);
                    if (! is_array($data) || empty($data)) {
                        return ['error' => 'Hakuna taarifa za intake zilizopatikana kutoka API.', 'status' => 422];
                    }

                    $record = new MotherIntake([
                        'source_id' => $sourceId,
                        'user_id' => Arr::get($data, 'user_id'),
                        'full_name' => Arr::get($data, 'full_name') ?? ($validated['full_name'] ?? null),
                        'phone' => Arr::get($data, 'phone') ?? ($validated['phone'] ?? null),
                        'journey_stage' => Arr::get($data, 'journey_stage'),
                        'pregnancy_weeks' => Arr::get($data, 'pregnancy_weeks'),
                        'baby_weeks_old' => Arr::get($data, 'baby_weeks_old'),
                        'hospital_planned' => Arr::get($data, 'hospital_planned'),
                        'hospital_alternative' => Arr::get($data, 'hospital_alternative'),
                        'delivery_hospital' => Arr::get($data, 'delivery_hospital'),
                        'birth_hospital' => Arr::get($data, 'birth_hospital'),
                        'ttc_duration' => Arr::get($data, 'ttc_duration'),
                        'agree_comms' => Arr::get($data, 'agree_comms', false),
                        'disclaimer_ack' => Arr::get($data, 'disclaimer_ack', false),
                        'email' => Arr::get($data, 'email'),
                        'age' => Arr::get($data, 'age'),
                        'pregnancy_stage' => Arr::get($data, 'pregnancy_stage'),
                        'due_date' => Arr::get($data, 'due_date'),
                        'location' => Arr::get($data, 'location'),
                        'previous_pregnancies' => Arr::get($data, 'previous_pregnancies'),
                        'concerns' => Arr::get($data, 'concerns'),
                        'interests' => Arr::get($data, 'interests'),
                        'status' => Arr::get($data, 'status', 'pending'),
                        'reviewed_by' => Arr::get($data, 'reviewed_by'),
                        'reviewed_at' => Arr::get($data, 'reviewed_at'),
                        'completed_at' => Arr::get($data, 'completed_at'),
                        'notes' => Arr::get($data, 'notes'),
                        'priority' => Arr::get($data, 'priority', 'medium'),
                        'created_at' => Arr::get($data, 'created_at'),
                        'updated_at' => Arr::get($data, 'updated_at'),
                    ]);
                }

                if (! $record->mk_number) {
                    $attempts = 0;
                    while ($attempts < 5) {
                        $attempts++;
                        $mk = $generator->next();
                        $exists = MotherIntake::query()->where('mk_number', $mk)->exists();
                        if ($exists) {
                            continue;
                        }
                        $record->mk_number = $mk;
                        break;
                    }
                }

                if (! $record->mk_number) {
                    return ['error' => 'Imeshindikana kutengeneza MK Number.', 'status' => 500];
                }

                if (Schema::hasColumn('mother_intakes', 'approved_at') && ! $record->approved_at) {
                    $record->approved_at = now();
                }
                if (Schema::hasColumn('mother_intakes', 'approved_by') && ! $record->approved_by) {
                    $record->approved_by = $request->user()?->id;
                }

                $record->save();

                return ['record' => $record];
            });

            if (isset($result['error'])) {
                return response()->json(['message' => $result['error']], $result['status'] ?? 500);
            }

            /** @var MotherIntake $record */
            $record = $result['record'];

            return response()->json([
                'success' => true,
                'data' => [
                    'source_id' => $record->source_id,
                    'mk_number' => $record->mk_number,
                ],
            ]);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Imeshindikana ku-approve intake.'], 500);
        }
    }
}
