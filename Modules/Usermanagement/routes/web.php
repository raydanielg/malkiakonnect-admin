<?php

use Illuminate\Support\Facades\Route;
use Modules\Usermanagement\Http\Controllers\Admin\EmployeesController;
use Modules\Usermanagement\Http\Controllers\Admin\UsersController;

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UsersController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/logs', [UsersController::class, 'logs'])->name('users.logs');
    Route::delete('/users/{user}', [UsersController::class, 'destroy'])->name('users.destroy');

    Route::get('/employees', [EmployeesController::class, 'index'])->name('employees.index');
    Route::get('/employees/register', [EmployeesController::class, 'create'])->name('employees.create');
    Route::post('/employees/register', [EmployeesController::class, 'store'])->name('employees.store');
    Route::get('/employees/{employee}', [EmployeesController::class, 'show'])->name('employees.show');
    Route::get('/employees/{employee}/logs', [EmployeesController::class, 'logs'])->name('employees.logs');
    Route::delete('/employees/{employee}', [EmployeesController::class, 'destroy'])->name('employees.destroy');
});
