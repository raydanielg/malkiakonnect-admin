<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use App\Models\MotherIntake;
use App\Services\MkNumberGenerator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Modules\Adminmodules\Http\Controllers\AdminDashboardController;
use Modules\Adminmodules\Http\Controllers\AdminOverviewController;
use Modules\Adminmodules\Http\Controllers\AdminStatisticsController;
use Modules\Adminmodules\Http\Controllers\AdminmodulesController;
use Modules\Adminmodules\Http\Controllers\MotherIntakeProgressController;
use Modules\Adminmodules\Http\Controllers\MotherIntakeApprovalController;

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/overview', [AdminOverviewController::class, 'index'])->name('admin.overview');

    Route::get('/admin/statistics', [AdminStatisticsController::class, 'index'])->name('admin.statistics');

    Route::prefix('/admin')->name('admin.')->group(function () {
        Route::get('/users/register', fn () => view('adminmodules::users.register-user'))->name('users.register');
        Route::get('/admins', fn () => view('adminmodules::users.all-admin'))->name('admins.index');

        Route::get('/forms', fn () => view('adminmodules::forms.all-forms'))->name('forms.index');
        Route::get('/forms/pregnant', fn () => view('adminmodules::forms.journey-forms', [
            'pageTitle' => 'Pregnant',
            'defaultJourneyStage' => 'pregnant',
        ]))->name('forms.pregnant');
        Route::get('/forms/ttc', fn () => view('adminmodules::forms.journey-forms', [
            'pageTitle' => 'TTC',
            'defaultJourneyStage' => 'ttc',
        ]))->name('forms.ttc');
        Route::get('/forms/intakes/{id}', function (int $id) {
            return view('adminmodules::forms.intake-details', ['intakeId' => $id]);
        })->name('forms.intakes.show');
        Route::get('/forms/intakes/{id}/edit', function (int $id) {
            return view('adminmodules::forms.intake-edit', ['intakeId' => $id]);
        })->name('forms.intakes.edit');
        Route::get('/forms/membership', fn () => view('adminmodules::forms.membership'))->name('forms.membership');
        Route::get('/forms/members/{id}/progress', function (int $id) {
            return view('adminmodules::forms.member-progress', ['intakeId' => $id]);
        })->name('forms.members.progress');
        Route::post('/forms/members/{id}/progress', [MotherIntakeProgressController::class, 'update'])
            ->name('forms.members.progress.update');
        Route::get('/forms/active-members', fn () => view('adminmodules::forms.active-members'))->name('forms.active_members');

        Route::get('/forms/mother-intakes/{sourceId}/local', function (int $sourceId) {
            $record = MotherIntake::query()->where('source_id', $sourceId)->first();

            return response()->json([
                'success' => true,
                'data' => $record ? $record->toArray() : null,
            ]);
        })->name('forms.mother_intakes.local.show');

        Route::get('/forms/mother-intakes/local/batch', function (Request $request) {
            $raw = (string) $request->query('source_ids', '');
            $ids = collect(explode(',', $raw))
                ->map(fn ($v) => trim((string) $v))
                ->filter(fn ($v) => $v !== '' && preg_match('/^[0-9]+$/', $v))
                ->map(fn ($v) => (int) $v)
                ->unique()
                ->take(200)
                ->values()
                ->all();

            if (empty($ids)) {
                return response()->json([
                    'success' => true,
                    'data' => [],
                ]);
            }

            $rows = MotherIntake::query()
                ->whereIn('source_id', $ids)
                ->get(['source_id', 'mk_number', 'approved_at']);

            $map = $rows->mapWithKeys(function (MotherIntake $r) {
                return [
                    (string) $r->source_id => [
                        'mk_number' => $r->mk_number,
                        'approved_at' => $r->approved_at?->toISOString(),
                    ],
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $map,
            ]);
        })->name('forms.mother_intakes.local.batch');

        Route::get('/forms/mother-intakes/{sourceId}/mk', function (int $sourceId) {
            $record = MotherIntake::query()->where('source_id', $sourceId)->first();

            return response()->json([
                'success' => true,
                'data' => [
                    'source_id' => $sourceId,
                    'mk_number' => $record?->mk_number,
                    'full_name' => $record?->full_name,
                    'phone' => $record?->phone,
                ],
            ]);
        })->name('forms.mother_intakes.mk.show');

        Route::post('/forms/mother-intakes/{sourceId}/mk', function (Request $request, int $sourceId) {
            $validated = $request->validate([
                'mk_digits' => ['required', 'regex:/^[0-9]{1,10}$/'],
                'full_name' => ['nullable', 'string', 'max:255'],
                'phone' => ['nullable', 'string', 'max:50'],
            ]);

            $record = MotherIntake::query()->where('source_id', $sourceId)->first();
            $isNew = false;
            if (! $record) {
                $baseUrl = rtrim((string) config('services.malkia_api.base_url', ''), '/');
                if ($baseUrl === '') {
                    return response()->json(['message' => 'Missing services.malkia_api.base_url'], 500);
                }

                $res = Http::acceptJson()->timeout(20)->get($baseUrl.'/api/mother-intakes/'.urlencode((string) $sourceId));
                if (! $res->ok()) {
                    return response()->json(['message' => 'Imeshindikana kuvuta taarifa za intake kutoka API.'], 422);
                }

                $json = $res->json();
                $data = Arr::get($json, 'data', []);
                if (! is_array($data) || empty($data)) {
                    return response()->json(['message' => 'Hakuna taarifa za intake zilizopatikana kutoka API.'], 422);
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

                $isNew = true;
            }

            $mkNumber = 'MK-'.$validated['mk_digits'];

            $dupQuery = MotherIntake::query()->where('mk_number', $mkNumber);
            if (! $isNew) {
                $dupQuery->where('id', '!=', $record->id);
            }
            $duplicate = $dupQuery->exists();

            if ($duplicate) {
                return response()->json([
                    'message' => 'MK Number tayari ipo. Tumia namba nyingine.',
                    'errors' => [
                        'mk_digits' => ['MK Number tayari ipo.'],
                    ],
                ], 422);
            }

            $record->mk_number = $mkNumber;
            if (! empty($validated['full_name'])) {
                $record->full_name = $validated['full_name'];
            }
            if (! empty($validated['phone'])) {
                $record->phone = $validated['phone'];
            }
            $record->save();

            return response()->json([
                'success' => true,
                'data' => [
                    'source_id' => $sourceId,
                    'mk_number' => $record->mk_number,
                ],
            ]);
        })->name('forms.mother_intakes.mk.update');

        Route::post('/forms/mother-intakes/{sourceId}/mk/generate', function (Request $request, int $sourceId, MkNumberGenerator $generator) {
            $validated = $request->validate([
                'full_name' => ['nullable', 'string', 'max:255'],
                'phone' => ['nullable', 'string', 'max:50'],
            ]);

            $record = MotherIntake::query()->where('source_id', $sourceId)->first();
            if (! $record) {
                $baseUrl = rtrim((string) config('services.malkia_api.base_url', ''), '/');
                if ($baseUrl === '') {
                    return response()->json(['message' => 'Missing services.malkia_api.base_url'], 500);
                }

                $res = Http::acceptJson()->timeout(20)->get($baseUrl.'/api/mother-intakes/'.urlencode((string) $sourceId));
                if (! $res->ok()) {
                    return response()->json(['message' => 'Imeshindikana kuvuta taarifa za intake kutoka API.'], 422);
                }

                $json = $res->json();
                $data = Arr::get($json, 'data', []);
                if (! is_array($data) || empty($data)) {
                    return response()->json(['message' => 'Hakuna taarifa za intake zilizopatikana kutoka API.'], 422);
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
                $record->mk_number = $generator->next();
                $record->save();
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'source_id' => $sourceId,
                    'mk_number' => $record->mk_number,
                ],
            ]);
        })->name('forms.mother_intakes.mk.generate');

        Route::post('/forms/mother-intakes/{sourceId}/approve', [MotherIntakeApprovalController::class, 'approve'])
            ->name('forms.mother_intakes.approve');

        Route::post('/forms/mother-intakes/{sourceId}/details', function (Request $request, int $sourceId) {
            $record = MotherIntake::query()->where('source_id', $sourceId)->first();
            if (! $record || ! $record->mk_number) {
                return response()->json([
                    'message' => 'Huwezi kuhifadhi taarifa mpaka MK Number iwepo.',
                ], 422);
            }

            $validated = $request->validate([
                'data' => ['required', 'array'],
            ]);

            $allowed = collect($record->getFillable())
                ->reject(fn ($k) => in_array($k, ['id', 'source_id', 'mk_number', 'created_at', 'updated_at'], true))
                ->values()
                ->all();

            $incoming = Arr::only($validated['data'], $allowed);
            $record->fill($incoming);
            $record->save();

            return response()->json([
                'success' => true,
                'data' => [
                    'source_id' => $record->source_id,
                    'mk_number' => $record->mk_number,
                ],
            ]);
        })->name('forms.mother_intakes.details.update');

        Route::post('/forms/members/sync', function () {
            Artisan::call('mother-intakes:sync', ['--per-page' => 25]);

            return response()->json([
                'success' => true,
                'message' => 'Sync imekamilika.',
                'output' => Artisan::output(),
            ]);
        })->name('forms.members.sync');

        Route::get('/communication', fn () => view('adminmodules::chat.communication'))->name('communication');
        Route::get('/chat-setup', fn () => view('adminmodules::chat.chat-setup'))->name('chat.setup');
    });

    Route::resource('adminmodules', AdminmodulesController::class)->names('adminmodules');
});
