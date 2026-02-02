<?php

namespace Modules\Adminmodules\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AdminActivityLog;
use App\Models\AdminLoginLog;
use App\Models\AdminTask;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(Request $request): View
    {
        $usersCount = User::query()->count();
        $adminsCount = User::query()
            ->where(function ($q) {
                $q->where('role', 'module')->orWhere('is_admin', true);
            })
            ->count();

        $completedTasksCount = AdminTask::query()->where('status', 'completed')->count();
        $pendingTasksCount = AdminTask::query()->where('status', 'pending')->count();
        $totalTasks = $completedTasksCount + $pendingTasksCount;

        $systemHealth = $totalTasks > 0
            ? (int) round(($completedTasksCount / $totalTasks) * 100)
            : 100;

        $recentActivities = AdminActivityLog::query()
            ->with('user')
            ->orderByDesc('created_at')
            ->limit(8)
            ->get();

        $lastLogins = AdminLoginLog::query()
            ->with('user')
            ->orderByDesc('logged_in_at')
            ->limit(8)
            ->get();

        $taskEvents = AdminTask::query()
            ->whereNotNull('due_at')
            ->orderBy('due_at')
            ->limit(20)
            ->get()
            ->map(function (AdminTask $task) {
                return [
                    'title' => $task->title,
                    'start' => $task->due_at?->toDateString(),
                ];
            })
            ->values();

        return view('adminmodules::dashboard', [
            'usersCount' => $usersCount,
            'adminsCount' => $adminsCount,
            'completedTasksCount' => $completedTasksCount,
            'pendingTasksCount' => $pendingTasksCount,
            'systemHealth' => $systemHealth,
            'recentActivities' => $recentActivities,
            'lastLogins' => $lastLogins,
            'taskEvents' => $taskEvents,
        ]);
    }
}
