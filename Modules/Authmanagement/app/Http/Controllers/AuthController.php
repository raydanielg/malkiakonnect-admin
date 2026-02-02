<?php

namespace Modules\Authmanagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(Request $request): View
    {
        return view('authmanagement::login');
    }

    public function login(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $throttleKey = strtolower($validated['email']).'|'.$request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->withInput()->withErrors([
                'email' => "Too many attempts. Try again in {$seconds} seconds.",
            ]);
        }

        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']], $request->boolean('remember'))) {
            RateLimiter::clear($throttleKey);
            $request->session()->regenerate();

            return redirect()->route('auth.dashboard');
        }

        RateLimiter::hit($throttleKey, 60);

        return back()->withInput()->withErrors([
            'email' => 'Invalid credentials.',
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
