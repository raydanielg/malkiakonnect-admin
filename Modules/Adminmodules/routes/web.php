<?php

use Illuminate\Support\Facades\Route;
use Modules\Adminmodules\Http\Controllers\AdminDashboardController;
use Modules\Adminmodules\Http\Controllers\AdminOverviewController;
use Modules\Adminmodules\Http\Controllers\AdminStatisticsController;
use Modules\Adminmodules\Http\Controllers\AdminmodulesController;

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/overview', [AdminOverviewController::class, 'index'])->name('admin.overview');

    Route::get('/admin/statistics', [AdminStatisticsController::class, 'index'])->name('admin.statistics');

    Route::prefix('/admin')->name('admin.')->group(function () {
        Route::get('/users/register', fn () => view('adminmodules::users.register-user'))->name('users.register');
        Route::get('/admins', fn () => view('adminmodules::users.all-admin'))->name('admins.index');

        Route::get('/forms', fn () => view('adminmodules::forms.all-forms'))->name('forms.index');
        Route::get('/forms/membership', fn () => view('adminmodules::forms.membership'))->name('forms.membership');
        Route::get('/forms/active-members', fn () => view('adminmodules::forms.active-members'))->name('forms.active_members');

        Route::get('/communication', fn () => view('adminmodules::chat.communication'))->name('communication');
        Route::get('/chat-setup', fn () => view('adminmodules::chat.chat-setup'))->name('chat.setup');
    });

    Route::resource('adminmodules', AdminmodulesController::class)->names('adminmodules');
});
