<?php

use Illuminate\Support\Facades\Route;
use Modules\Adminmodules\Http\Controllers\AdminmodulesController;

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', function () {
        return view('adminmodules::dashboard');
    })->name('admin.dashboard');

    Route::resource('adminmodules', AdminmodulesController::class)->names('adminmodules');
});
