<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstallController;

Route::prefix('install')->name('install.')->group(function () {
    Route::get('/', [InstallController::class, 'welcome'])->name('welcome');

    Route::get('/requirements', [InstallController::class, 'requirements'])->name('requirements');

    Route::get('/database', [InstallController::class, 'database'])->name('database');
    Route::post('/database/test', [InstallController::class, 'databaseTest'])->name('database.test');

    Route::get('/settings', [InstallController::class, 'settings'])->name('settings');
    Route::post('/settings', [InstallController::class, 'settingsSave'])->name('settings.save');

    Route::get('/admin', [InstallController::class, 'admin'])->name('admin');
    Route::post('/admin', [InstallController::class, 'adminSave'])->name('admin.save');

    Route::get('/finish', [InstallController::class, 'finish'])->name('finish');
    Route::post('/finish', [InstallController::class, 'finishSave'])->name('finish.save');
});

Route::get('/', function () {
    return view('welcome');
});
