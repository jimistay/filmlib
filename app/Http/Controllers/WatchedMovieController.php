<?php

namespace App\Http\Controllers;

use App\Models\WatchedMovie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WatchedMovieController extends Controller
{
    public function index()
    {
        $movies = Auth::user()
            ->watchedMovies()
            ->latest()
            ->get();

        return view('watched-movies.index', compact('movies'));
    }

    public function create()
    {
        return view('watched-movies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tmdb_id' => ['required', 'integer'],
            'media_type' => ['nullable', 'in:movie,tv'],
            'title' => ['required', 'string', 'max:255'],
            'poster_url' => ['nullable', 'url'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'watched_at' => ['nullable', 'date'],
        ]);

        $mediaType = $validated['media_type'] ?? 'movie';

        $alreadyExists = WatchedMovie::where('user_id', Auth::id())
            ->where('tmdb_id', $validated['tmdb_id'])
            ->where('media_type', $mediaType)
            ->exists();

        if ($alreadyExists) {
            return redirect()
                ->back()
                ->with('error', 'Ce film ou cette série est déjà dans vos films vus.');
        }

        $validated['user_id'] = Auth::id();
        $validated['media_type'] = $mediaType;

        WatchedMovie::create($validated);

        return redirect()
            ->back()
            ->with('success', 'Film ou série ajouté avec succès.');
    }

    public function edit(WatchedMovie $watchedMovie)
    {
        abort_if($watchedMovie->user_id !== Auth::id(), 403);

        return view('watched-movies.edit', compact('watchedMovie'));
    }

    public function update(Request $request, WatchedMovie $watchedMovie)
{
    abort_if($watchedMovie->user_id !== Auth::id(), 403);

    $validated = $request->validate([
        'rating' => ['required', 'integer', 'min:1', 'max:5'],
        'watched_at' => ['nullable', 'date'],
    ]);

    $watchedMovie->update($validated);

    return redirect()
        ->back()
        ->with('success', 'Note mise à jour avec succès.');
}

    public function destroy(WatchedMovie $watchedMovie)
    {
        abort_if($watchedMovie->user_id !== Auth::id(), 403);

        $watchedMovie->delete();

        return redirect()
            ->route('watched-movies.index')
            ->with('success', 'Film ou série supprimé.');
    }
}