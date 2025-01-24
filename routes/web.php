<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SuggestionController;
use App\Livewire\SuggestionCreate;
use Illuminate\Support\Facades\Route;

Route::name('site.')->group(function () {
    Route::get('/', [SiteController::class, 'index'])->name('index');

    Route::middleware(['auth'])->group(function () {
        Route::get('/suggestion/create', SuggestionCreate::class)->name('suggestion.create');
    });

    Route::get('/suggestion/{suggestion:slug}', [SuggestionController::class, 'show'])->name('suggestion.show');
});

Route::view('/roadmap', 'roadmap');
//
// Route::get('roadmaps', RoadmapIndex::class)->name('roadmaps.index');
// Route::get('roadmaps/create', RoadmapCreate::class)->name('roadmaps.create');
// Route::get('roadmaps/{roadmap}', RoadmapShow::class)->name('roadmaps.show');
// Route::get('roadmaps/{roadmap}/edit', RoadmapEdit::class)->name('roadmaps.edit');

Route::middleware(['auth'])->group(function () {
    Route::view('dashboard', 'dashboard')
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

    Route::post('/suggestion/{suggestion}/comments', [CommentController::class, 'store'])->name('comments.store');

    Route::view('profile', 'profile')->name('profile');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
