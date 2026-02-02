<?php

namespace Modules\Adminmodules\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AdminLoginLog;
use App\Models\AdminTask;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdminStatisticsController extends Controller
{
    public function index(): View
    {
        $usersCount = User::query()->count();
        $adminsCount = User::query()
            ->where(function ($q) {
                $q->where('role', 'module')->orWhere('is_admin', true);
            })
            ->count();

        $completedTasksCount = AdminTask::query()->where('status', 'completed')->count();
        $pendingTasksCount = AdminTask::query()->where('status', 'pending')->count();

        $last7Days = collect(range(6, 0))
            ->map(fn ($i) => now()->subDays($i)->toDateString());

        $loginsGrouped = AdminLoginLog::query()
            ->select(DB::raw('DATE(logged_in_at) as day'), DB::raw('COUNT(*) as total'))
            ->where('logged_in_at', '>=', now()->subDays(6)->startOfDay())
            ->groupBy(DB::raw('DATE(logged_in_at)'))
            ->pluck('total', 'day');

        $loginsSeries = $last7Days
            ->map(fn (string $d) => (int) ($loginsGrouped[$d] ?? 0))
            ->values();

        $reportRows = $last7Days->map(function (string $d) use ($loginsGrouped) {
            return [
                'day' => Carbon::parse($d)->format('D, M d'),
                'logins' => (int) ($loginsGrouped[$d] ?? 0),
            ];
        });

        return view('adminmodules::statistics', [
            'usersCount' => $usersCount,
            'adminsCount' => $adminsCount,
            'completedTasksCount' => $completedTasksCount,
            'pendingTasksCount' => $pendingTasksCount,
            'loginLabels' => $last7Days->map(fn ($d) => Carbon::parse($d)->format('D'))->values(),
            'loginSeries' => $loginsSeries,
            'reportRows' => $reportRows,
        ]);
    }
}
