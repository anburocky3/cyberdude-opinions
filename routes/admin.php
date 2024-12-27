<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware(['auth'])->group(function () {
    Route::middleware(['admin'])->name('admin.')->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('index');
    });

    // Route::get('/learner', [LearnerController::class, 'index'])->name('learner.index');
});
