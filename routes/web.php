<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WatchedMovieController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\RecommendationController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('watched-movies', WatchedMovieController::class);
    

    /*Route::get('/recommendations', function () {
        return view('recommendations.index');
    })->name('recommendations.index');*/
    Route::get('/recommendations', [RecommendationController::class, 'index'])
    ->name('recommendations.index');

Route::post('/recommendations/generate', [RecommendationController::class, 'generate'])
    ->name('recommendations.generate');

    Route::get('/favorites', function () {
        return view('favorites.index');
    })->name('favorites.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/search', [SearchController::class, 'index'])->name('search.index');
    
Route::post('/recommendations/generate-with-filters', [RecommendationController::class, 'generateWithFilters'])
    ->name('recommendations.generateWithFilters');


    Route::get('/explore/{type}/{id}', [SearchController::class, 'show'])
    ->name('search.show');

    Route::middleware(['auth'])->get('/security', function () {
    return view('profile.security');
    })->name('security');
});

require __DIR__.'/auth.php';

