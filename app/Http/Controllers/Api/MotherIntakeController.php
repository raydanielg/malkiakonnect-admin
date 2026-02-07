<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MotherIntake;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class MotherIntakeController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $perPage = (int) $request->query('per_page', 25);
        if ($perPage < 1) {
            $perPage = 25;
        }
        if ($perPage > 100) {
            $perPage = 100;
        }

        $phone = trim((string) $request->query('phone', ''));
        $fullName = trim((string) $request->query('full_name', ''));
        $status = trim((string) $request->query('status', ''));

        $query = MotherIntake::query();

        if ($phone !== '') {
            $query->where('phone', 'like', "%{$phone}%");
        }

        if ($fullName !== '') {
            $query->where('full_name', 'like', "%{$fullName}%");
        }

        if ($status !== '') {
            $query->where('status', $status);
        }

        $phoneColumn = Schema::hasColumn('mother_intakes', 'phone') ? 'phone' : null;
        if ($phoneColumn) {
            $base = (clone $query);

            $idsWithPhone = (clone $base)
                ->whereNotNull($phoneColumn)
                ->where($phoneColumn, '!=', '')
                ->select(DB::raw('MAX(id) as id'))
                ->groupBy($phoneColumn);

            $idsWithoutPhone = (clone $base)
                ->where(function ($q) use ($phoneColumn) {
                    $q->whereNull($phoneColumn)->orWhere($phoneColumn, '=', '');
                })
                ->select('id');

            $idUnion = $idsWithPhone->union($idsWithoutPhone);
            $ids = DB::query()->fromSub($idUnion, 'dedup_ids')->pluck('id')->filter()->values();

            if ($ids->isNotEmpty()) {
                $query->whereIn('id', $ids->all());
            }
        }

        $paginator = $query
            ->orderByDesc('id')
            ->paginate($perPage)
            ->withQueryString();

        return response()->json([
            'success' => true,
            'data' => $paginator->items(),
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
                'last_page' => $paginator->lastPage(),
            ],
        ]);
    }

    public function members(Request $request): JsonResponse
    {
        $perPage = (int) $request->query('per_page', 25);
        if ($perPage < 1) {
            $perPage = 25;
        }
        if ($perPage > 100) {
            $perPage = 100;
        }

        $phone = trim((string) $request->query('phone', ''));
        $fullName = trim((string) $request->query('full_name', ''));
        $status = trim((string) $request->query('status', ''));

        $query = MotherIntake::query()->whereNotNull('mk_number');

        if (Schema::hasColumn('mother_intakes', 'approved_at')) {
            $query->whereNotNull('approved_at');
        }

        if ($phone !== '') {
            $query->where('phone', 'like', "%{$phone}%");
        }

        if ($fullName !== '') {
            $query->where('full_name', 'like', "%{$fullName}%");
        }

        if ($status !== '') {
            $query->where('status', $status);
        }

        $paginator = $query
            ->orderByDesc('id')
            ->paginate($perPage)
            ->withQueryString();

        return response()->json([
            'success' => true,
            'data' => $paginator->items(),
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
                'last_page' => $paginator->lastPage(),
            ],
        ]);
    }

    public function show(MotherIntake $motherIntake): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $motherIntake,
        ]);
    }
}
