<?php

namespace App\Http\Controllers;

use App\Services\TmdbService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function index(Request $request, TmdbService $tmdbService)
    {
        $query = trim((string) $request->get('q', ''));
        $mood = $request->get('mood');
        $genreId = $request->get('genre_id') ? (int) $request->get('genre_id') : null;
        $year = $request->get('year') ? (int) $request->get('year') : null;
        $minRating = $request->get('min_rating') ? (float) $request->get('min_rating') : null;
        $type = $request->get('type');

        $searchResults = [];

        if ($query !== '') {
            $searchResults = $tmdbService->searchMulti($query);
        }

        if ($type === 'movie') {
            $popularMovies = $tmdbService->discoverMovies($genreId, $mood, $year, $minRating);
            $popularSeries = [];
        } elseif ($type === 'tv') {
            $popularMovies = [];
            $popularSeries = $tmdbService->discoverSeries($genreId, $mood, $year, $minRating);
        } elseif ($genreId || $mood || $year || $minRating) {
            $popularMovies = $tmdbService->discoverMovies($genreId, $mood, $year, $minRating);
            $popularSeries = $tmdbService->discoverSeries($genreId, $mood, $year, $minRating);
        } else {
            $popularMovies = $tmdbService->getPopularMovies();
            $popularSeries = $tmdbService->getPopularSeries();
        }

        $watchedItems = Auth::user()
            ->watchedMovies()
            ->get()
            ->keyBy(function ($item) {
                return $item->media_type . '-' . $item->tmdb_id;
            });

        $genres = [
            '' => 'Toutes les catégories',
            28 => 'Action',
            12 => 'Aventure',
            16 => 'Animation',
            35 => 'Comédie',
            80 => 'Crime',
            18 => 'Drame',
            10751 => 'Famille',
            14 => 'Fantastique',
            27 => 'Horreur',
            9648 => 'Mystère',
            10749 => 'Romance',
            878 => 'Science-fiction',
            53 => 'Thriller',
        ];

        $moods = [
            '' => 'Toutes les humeurs',
            'joyeuse' => 'Joyeuse',
            'triste' => 'Triste',
            'stressee' => 'Stressée',
            'romantique' => 'Romantique',
            'frisson' => 'Envie de frisson',
        ];

        $ratings = [
            '' => 'Toutes les notes',
            5 => '5+',
            6 => '6+',
            7 => '7+',
            8 => '8+',
        ];

        $types = [
            '' => 'Films et séries',
            'movie' => 'Films uniquement',
            'tv' => 'Séries uniquement',
        ];

        return view('search.index', compact(
    'query',
    'mood',
    'genreId',
    'year',
    'minRating',
    'type',
    'genres',
    'moods',
    'ratings',
    'types',
    'popularMovies',
    'popularSeries',
    'searchResults',
    'watchedItems'
));
    }

    public function show(string $type, int $id, TmdbService $tmdbService)
    {
        if (!in_array($type, ['movie', 'tv'])) {
            abort(404);
        }

        $item = $type === 'movie'
            ? $tmdbService->getMovieDetails($id)
            : $tmdbService->getTvDetails($id);

        abort_if(!$item, 404);

        $watchedItem = Auth::user()
            ->watchedMovies()
            ->where('tmdb_id', $id)
            ->where('media_type', $type)
            ->first();

        $alreadyWatched = $watchedItem !== null;

        return view('search.show', compact('item', 'alreadyWatched', 'watchedItem'));
    }
}