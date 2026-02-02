<?php

use Illuminate\Support\Facades\Route;
use Modules\Usermanagement\Http\Controllers\UsermanagementController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('usermanagements', UsermanagementController::class)->names('usermanagement');
});
