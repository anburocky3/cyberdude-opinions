<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Livewire\Admin\CourseCreate;
use App\Livewire\Admin\CourseShow;
use App\Livewire\UserManagement;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('index');

    Route::get('courses', [CourseController::class, 'index'])->name('courses.index');
    // Route::get('courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::get('courses/create', CourseCreate::class)->name('courses.create');
    Route::get('courses/{course:slug}', CourseShow::class)->name('courses.show');

    // Route::resource('course', CourseController::class);
    Route::resource('category', CategoryController::class);

    // Volt::route('/users', 'user-management')->name('users');
    Volt::route('/users', UserManagement::class)->name('users');
    // Route::get('/learner', [LearnerController::class, 'index'])->name('learner.index');
});
