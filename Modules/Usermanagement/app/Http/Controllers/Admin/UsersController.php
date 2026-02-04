<?php

namespace Modules\Usermanagement\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminActivityLog;
use App\Models\AdminLoginLog;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UsersController extends Controller
{
    public function index(Request $request): View
    {
        $q = trim((string) $request->get('q', ''));

        $users = User::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($inner) use ($q) {
                    $inner
                        ->where('email', 'like', "%{$q}%")
                        ->orWhere('name', 'like', "%{$q}%")
                        ->orWhere('username', 'like', "%{$q}%");
                });
            })
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('usermanagement::admin.users.index', [
            'users' => $users,
            'q' => $q,
        ]);
    }

    public function show(User $user): View
    {
        return view('usermanagement::admin.users.show', [
            'user' => $user,
        ]);
    }

    public function logs(User $user): View
    {
        $loginLogs = AdminLoginLog::query()
            ->where('user_id', $user->id)
            ->orderByDesc('logged_in_at')
            ->paginate(15);

        $activityLogs = AdminActivityLog::query()
            ->where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('usermanagement::admin.users.logs', [
            'user' => $user,
            'loginLogs' => $loginLogs,
            'activityLogs' => $activityLogs,
        ]);
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('admin.users.index');
    }
}
