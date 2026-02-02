<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Modules\Authmanagement\Http\Controllers\AuthController;

View::addNamespace('authmanagement', base_path('Modules/Authmanagement/resources/views'));

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login.submit');
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('auth.forgot');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('auth.dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});
