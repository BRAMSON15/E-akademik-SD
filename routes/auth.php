<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // Parent Login Route
    Route::post('parent/login', [\App\Http\Controllers\Auth\ParentLoginController::class, 'store'])
        ->name('parent.login');

    // Debug route
    Route::get('debug/students', function () {
        $students = \App\Models\Student::all(['id', 'name', 'nis', 'parent_id']);
        return response()->json($students);
    });

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
