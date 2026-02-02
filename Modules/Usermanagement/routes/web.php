<?php

use Illuminate\Support\Facades\Route;
use Modules\Usermanagement\Http\Controllers\Admin\EmployeesController;
use Modules\Usermanagement\Http\Controllers\Admin\UsersController;

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::get('/employees', [EmployeesController::class, 'index'])->name('employees.index');
});
