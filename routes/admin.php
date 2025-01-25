<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Livewire\UserManagement;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('index');

    Route::resource('course', CourseController::class);
    Route::resource('category', CategoryController::class);

    // Volt::route('/users', 'user-management')->name('users');
    Volt::route('/users', UserManagement::class)->name('users');
    // Route::get('/learner', [LearnerController::class, 'index'])->name('learner.index');
});
