<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WatchedMovieController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('watched-movies', WatchedMovieController::class);

    Route::get('/recommendations', function () {
        return view('recommendations.index');
    })->name('recommendations.index');

    Route::get('/favorites', function () {
        return view('favorites.index');
    })->name('favorites.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/search', [SearchController::class, 'index'])->name('search.index');
});

require __DIR__.'/auth.php';