<?php

namespace Modules\Adminmodules\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AdminActivityLog;
use App\Models\AdminLoginLog;
use App\Models\AdminTask;
use App\Models\User;
use Illuminate\View\View;

class AdminOverviewController extends Controller
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

        $upcomingTasks = AdminTask::query()
            ->where('status', 'pending')
            ->orderByRaw('CASE WHEN due_at IS NULL THEN 1 ELSE 0 END')
            ->orderBy('due_at')
            ->limit(6)
            ->get();

        $recentActivities = AdminActivityLog::query()
            ->with('user')
            ->orderByDesc('created_at')
            ->limit(6)
            ->get();

        $lastLogins = AdminLoginLog::query()
            ->with('user')
            ->orderByDesc('logged_in_at')
            ->limit(6)
            ->get();

        return view('adminmodules::overview', [
            'usersCount' => $usersCount,
            'adminsCount' => $adminsCount,
            'completedTasksCount' => $completedTasksCount,
            'pendingTasksCount' => $pendingTasksCount,
            'upcomingTasks' => $upcomingTasks,
            'recentActivities' => $recentActivities,
            'lastLogins' => $lastLogins,
        ]);
    }
}
