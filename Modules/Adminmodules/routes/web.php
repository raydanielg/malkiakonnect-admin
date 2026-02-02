<?php

use Illuminate\Support\Facades\Route;
use Modules\Adminmodules\Http\Controllers\AdminmodulesController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('adminmodules', AdminmodulesController::class)->names('adminmodules');
});
