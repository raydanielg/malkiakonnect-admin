<?php

use Illuminate\Support\Facades\Route;

Route::prefix('mother-intakes')->group(function () {
    Route::get('/', [\App\Http\Controllers\Api\MotherIntakeController::class, 'index']);
    Route::get('/{motherIntake}', [\App\Http\Controllers\Api\MotherIntakeController::class, 'show']);
});

Route::get('members', [\App\Http\Controllers\Api\MotherIntakeController::class, 'members']);
