<?php

namespace Modules\Authmanagement\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AdminActivityLog;
use App\Models\AdminLoginLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(Request $request): View
    {
        return view('authmanagement::login');
    }

    public function showForgotPassword(Request $request): View
    {
        return view('authmanagement::forgot-password');
    }

    public function login(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $loginValue = trim($validated['login']);
        $throttleKey = strtolower($loginValue).'|'.$request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->withInput()->withErrors([
                'login' => "Too many attempts. Try again in {$seconds} seconds.",
            ]);
        }

        $attempted = Auth::attempt(['email' => $loginValue, 'password' => $validated['password']], $request->boolean('remember'));

        if (! $attempted && Schema::hasColumn('users', 'username')) {
            $attempted = Auth::attempt(['username' => $loginValue, 'password' => $validated['password']], $request->boolean('remember'));
        }

        if ($attempted) {
            RateLimiter::clear($throttleKey);
            $request->session()->regenerate();

            $user = $request->user();
            if ($user && (($user->role ?? 'user') === 'module' || (bool) ($user->is_admin ?? false))) {
                if (Schema::hasTable('admin_login_logs')) {
                    AdminLoginLog::query()->create([
                        'user_id' => $user->id,
                        'ip_address' => $request->ip(),
                        'user_agent' => (string) $request->userAgent(),
                        'logged_in_at' => now(),
                    ]);
                }

                if (Schema::hasTable('admin_activity_logs')) {
                    AdminActivityLog::query()->create([
                        'user_id' => $user->id,
                        'action' => 'login',
                        'meta' => [
                            'ip' => $request->ip(),
                        ],
                        'created_at' => now(),
                    ]);
                }

                return redirect()->to(rtrim(config('app.url'), '/').'/admin');
            }

            return redirect()->route('auth.dashboard');
        }

        RateLimiter::hit($throttleKey, 60);

        return back()->withInput()->withErrors([
            'login' => 'Invalid credentials.',
        ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login');
    }

    public function dashboard(Request $request): View
    {
        return view('authmanagement::dashboard');
    }
}
