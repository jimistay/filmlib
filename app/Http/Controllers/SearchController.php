<?php

namespace App\Http\Controllers;

use App\Services\TmdbService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request, TmdbService $tmdbService)
    {
        $query = trim((string) $request->get('q', ''));

        $popularMovies = $tmdbService->getPopularMovies();
        $popularSeries = $tmdbService->getPopularSeries();
        $searchResults = [];

        if ($query !== '') {
            $searchResults = $tmdbService->searchMulti($query);
        }

        return view('search.index', compact(
            'query',
            'popularMovies',
            'popularSeries',
            'searchResults'
        ));
    }
}