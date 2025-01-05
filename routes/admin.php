<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware(['auth'])->group(function () {
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('index');

        Route::resource('course', CourseController::class);
        Route::resource('category', CategoryController::class);

    });

    // Route::get('/learner', [LearnerController::class, 'index'])->name('learner.index');
});
