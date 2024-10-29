<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::name('site')->group(function () {
    Route::get('/', [SiteController::class, 'index'])->name('index');
});

Route::view('/roadmap', 'roadmap');

Route::middleware(['auth'])->group(function () {
    Route::view('dashboard', 'dashboard')
        ->middleware(['auth', 'verified'])
        ->name('dashboard');


    Route::view('profile', 'profile')
        ->middleware(['auth'])
        ->name('profile');
});

require __DIR__ . '/auth.php';
