<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();
        if ($user->isAdmin()) return redirect()->route('admin.dashboard');
        if ($user->isGuru()) return redirect()->route('guru.dashboard');
        if ($user->isOrangTua()) return redirect()->route('parent.dashboard');
        return view('dashboard');
    })->name('dashboard');

    // Admin Routes 
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('dashboard');
        Route::resource('users', App\Http\Controllers\Admin\AdminController::class);
        Route::resource('students', App\Http\Controllers\Admin\StudentController::class);
        
        Route::get('/settings', [App\Http\Controllers\SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [App\Http\Controllers\SettingController::class, 'update'])->name('settings.update');
    });

    // Guru Routes
    Route::prefix('guru')->name('guru.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Guru\GuruController::class, 'index'])->name('dashboard');
        
        // Kelola Siswa for Guru
        Route::resource('students', App\Http\Controllers\Guru\StudentController::class);
        
        // Kelola Mata Pelajaran for Guru
        Route::resource('subjects', App\Http\Controllers\Guru\SubjectController::class);
        
        Route::get('/grades', [App\Http\Controllers\Guru\GuruController::class, 'grades'])->name('grades');
        Route::post('/grades', [App\Http\Controllers\Guru\GuruController::class, 'storeGrade'])->name('grades.store');
        Route::get('/attendance', [App\Http\Controllers\Guru\GuruController::class, 'attendance'])->name('attendance');
        Route::post('/attendance', [App\Http\Controllers\Guru\GuruController::class, 'storeAttendance'])->name('attendance.store');
    });

    // Parent Routes
    Route::prefix('parent')->name('parent.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Parent\ParentController::class, 'index'])->name('dashboard');
        Route::get('/attendance', [App\Http\Controllers\Parent\ParentController::class, 'attendance'])->name('attendance');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
