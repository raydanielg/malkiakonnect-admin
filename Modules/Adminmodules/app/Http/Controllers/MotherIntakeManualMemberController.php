<?php

namespace Modules\Adminmodules\Http\Controllers;

use App\Models\MotherIntake;
use App\Services\MkNumberGenerator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MotherIntakeManualMemberController
{
    public function store(Request $request, MkNumberGenerator $generator): JsonResponse
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'email' => ['nullable', 'string', 'max:255'],
            'age' => ['nullable', 'integer', 'min:0', 'max:120'],
            'location' => ['nullable', 'string', 'max:255'],
            'journey_stage' => ['nullable', 'string', 'max:50'],
            'pregnancy_weeks' => ['nullable', 'integer', 'min:0', 'max:60'],
            'baby_weeks_old' => ['nullable', 'integer', 'min:0', 'max:260'],
            'due_date' => ['nullable', 'date'],
            'hospital_planned' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ]);

        $result = DB::transaction(function () use ($validated, $request, $generator) {
            $phone = trim((string) ($validated['phone'] ?? ''));

            $dup = MotherIntake::query()
                ->where('phone', $phone)
                ->whereNotNull('mk_number');

            if (Schema::hasColumn('mother_intakes', 'approved_at')) {
                $dup->whereNotNull('approved_at');
            }

            $existing = $dup->lockForUpdate()->first();
            if ($existing) {
                return ['error' => 'Namba ya simu tayari ime-approve (MK: '.$existing->mk_number.').', 'status' => 422];
            }

            $mk = null;
            $attempts = 0;
            while ($attempts < 5) {
                $attempts++;
                $candidate = $generator->next();
                $exists = MotherIntake::query()->where('mk_number', $candidate)->exists();
                if ($exists) {
                    continue;
                }
                $mk = $candidate;
                break;
            }

            if (! $mk) {
                return ['error' => 'Imeshindikana kutengeneza MK Number.', 'status' => 500];
            }

            $record = new MotherIntake();
            $record->mk_number = $mk;
            $record->full_name = $validated['full_name'];
            $record->phone = $phone;
            $record->email = $validated['email'] ?? null;
            $record->age = $validated['age'] ?? null;
            $record->location = $validated['location'] ?? null;
            $record->journey_stage = $validated['journey_stage'] ?? null;
            $record->pregnancy_weeks = $validated['pregnancy_weeks'] ?? null;
            $record->baby_weeks_old = $validated['baby_weeks_old'] ?? null;
            $record->due_date = $validated['due_date'] ?? null;
            $record->hospital_planned = $validated['hospital_planned'] ?? null;
            $record->notes = $validated['notes'] ?? null;

            if (Schema::hasColumn('mother_intakes', 'approved_at')) {
                $record->approved_at = now();
            }
            if (Schema::hasColumn('mother_intakes', 'approved_by')) {
                $record->approved_by = $request->user()?->id;
            }

            $record->save();

            return ['record' => $record];
        });

        if (isset($result['error'])) {
            return response()->json([
                'success' => false,
                'message' => $result['error'],
            ], $result['status'] ?? 500);
        }

        /** @var MotherIntake $record */
        $record = $result['record'];

        return response()->json([
            'success' => true,
            'data' => $record,
        ]);
    }
}
