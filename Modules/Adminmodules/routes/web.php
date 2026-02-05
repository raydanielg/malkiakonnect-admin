<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use App\Models\MotherIntake;
use App\Services\MkNumberGenerator;
use Modules\Adminmodules\Http\Controllers\AdminDashboardController;
use Modules\Adminmodules\Http\Controllers\AdminOverviewController;
use Modules\Adminmodules\Http\Controllers\AdminStatisticsController;
use Modules\Adminmodules\Http\Controllers\AdminmodulesController;

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/overview', [AdminOverviewController::class, 'index'])->name('admin.overview');

    Route::get('/admin/statistics', [AdminStatisticsController::class, 'index'])->name('admin.statistics');

    Route::prefix('/admin')->name('admin.')->group(function () {
        Route::get('/users/register', fn () => view('adminmodules::users.register-user'))->name('users.register');
        Route::get('/admins', fn () => view('adminmodules::users.all-admin'))->name('admins.index');

        Route::get('/forms', fn () => view('adminmodules::forms.all-forms'))->name('forms.index');
        Route::get('/forms/intakes/{id}', function (int $id) {
            return view('adminmodules::forms.intake-details', ['intakeId' => $id]);
        })->name('forms.intakes.show');
        Route::get('/forms/membership', fn () => view('adminmodules::forms.membership'))->name('forms.membership');
        Route::get('/forms/active-members', fn () => view('adminmodules::forms.active-members'))->name('forms.active_members');

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

            $record = MotherIntake::query()->firstOrCreate(
                ['source_id' => $sourceId],
                [
                    'full_name' => $validated['full_name'] ?? null,
                    'phone' => $validated['phone'] ?? null,
                    'status' => 'pending',
                    'priority' => 'medium',
                ]
            );

            $mkNumber = 'MK-'.$validated['mk_digits'];

            $duplicate = MotherIntake::query()
                ->where('mk_number', $mkNumber)
                ->where('id', '!=', $record->id)
                ->exists();

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

            $record = MotherIntake::query()->firstOrCreate(
                ['source_id' => $sourceId],
                [
                    'full_name' => $validated['full_name'] ?? null,
                    'phone' => $validated['phone'] ?? null,
                    'status' => 'pending',
                    'priority' => 'medium',
                ]
            );

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
