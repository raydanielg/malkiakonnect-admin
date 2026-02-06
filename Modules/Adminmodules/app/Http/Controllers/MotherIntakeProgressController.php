<?php

namespace Modules\Adminmodules\Http\Controllers;

use App\Models\MotherIntake;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MotherIntakeProgressController
{
    public function update(Request $request, int $id): JsonResponse
    {
        $action = trim((string) $request->input('action', ''));
        $comment = $request->input('comment');

        if (!in_array($action, ['reviewed', 'completed', 'comment'], true)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid action.',
            ], 422);
        }

        $intake = MotherIntake::query()->findOrFail($id);

        DB::transaction(function () use ($action, $comment, $intake, $request) {
            if ($action === 'reviewed') {
                if (Schema::hasColumn('mother_intakes', 'reviewed_at')) {
                    $intake->reviewed_at = now();
                }
                if (Schema::hasColumn('mother_intakes', 'reviewed_by')) {
                    $intake->reviewed_by = $request->user()?->id;
                }
                if (Schema::hasColumn('mother_intakes', 'status')) {
                    $intake->status = 'reviewed';
                }
            }

            if ($action === 'completed') {
                if (Schema::hasColumn('mother_intakes', 'completed_at')) {
                    $intake->completed_at = now();
                }
                if (Schema::hasColumn('mother_intakes', 'completed_by')) {
                    $intake->completed_by = $request->user()?->id;
                }
                if (Schema::hasColumn('mother_intakes', 'status')) {
                    $intake->status = 'completed';
                }
            }

            if ($comment !== null) {
                if (Schema::hasColumn('mother_intakes', 'progress_comment')) {
                    $intake->progress_comment = $comment;
                } elseif (Schema::hasColumn('mother_intakes', 'notes')) {
                    $intake->notes = $comment;
                }
            }

            $intake->save();
        });

        $intake->refresh();

        return response()->json([
            'success' => true,
            'data' => $intake,
        ]);
    }
}
