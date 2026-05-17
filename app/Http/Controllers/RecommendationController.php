<?php

namespace App\Http\Controllers;

use App\Models\Recommendation;
use Illuminate\Http\Request;
use App\Services\GeminiRecommendationService;
use App\Services\TmdbService;
use Illuminate\Support\Facades\Auth;

class RecommendationController extends Controller
{
    public function index()
    {
        $recommendations = Auth::user()
            ->recommendations()
            ->latest()
            ->get();

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

        return view('recommendations.index', compact(
            'recommendations',
            'genres',
            'moods'
        ));
    }

    public function generate(
        GeminiRecommendationService $geminiRecommendationService,
        TmdbService $tmdbService
    ) {
        $user = Auth::user();

        $watchedMovies = $user->watchedMovies()->get();

        if ($watchedMovies->count() < 5) {
            return redirect()
                ->route('recommendations.index')
                ->with('error', 'Notez au moins 5 films ou séries pour générer des recommandations.');
        }

        $profile = $watchedMovies->map(function ($item) {
            return [
                'title' => $item->title,
                'media_type' => $item->media_type,
                'rating' => $item->rating,
            ];
        })->values()->toArray();

        $alreadySeen = $watchedMovies->map(function ($item) {
            return strtolower(trim($item->title . '|' . $item->media_type));
        })->toArray();

        try {
            $rawRecommendations = $geminiRecommendationService->generateRecommendations($profile);
        } catch (\Throwable $e) {
            return redirect()
                ->route('recommendations.index')
                ->with('error', 'Gemini est temporairement indisponible. Réessaie dans quelques minutes.');
        }

        $user->recommendations()->delete();

        foreach ($rawRecommendations as $rec) {
            if (!isset($rec['title'], $rec['media_type'], $rec['reason'])) {
                continue;
            }

            if (!in_array($rec['media_type'], ['movie', 'tv'])) {
                continue;
            }

            $key = strtolower(trim($rec['title'] . '|' . $rec['media_type']));

            if (in_array($key, $alreadySeen, true)) {
                continue;
            }

            $tmdbData = $rec['media_type'] === 'tv'
                ? $tmdbService->searchTvByTitle($rec['title'])
                : $tmdbService->searchMovieByTitle($rec['title']);

            if (!$tmdbData) {
                continue;
            }

            $watchProviders = $tmdbService->getWatchProviders(
    $tmdbData['id'],
    $rec['media_type'],
    'FR'
);


            Recommendation::create([
                'user_id' => $user->id,
                'tmdb_id' => $tmdbData['id'],
                'media_type' => $rec['media_type'],
                'title' => $tmdbData['title'],
                'poster_url' => $tmdbData['poster_url'] ?? null,
                'watch_providers' => $watchProviders['providers'] ?? [],
                'watch_link' => $watchProviders['link'] ?? null,
                'reason' => $rec['reason'],
                'generated_at' => now(),
            ]);
        }

        return redirect()
            ->route('recommendations.index')
            ->with('success', 'Recommandations générées avec succès.');
    }

    public function generateWithFilters(
        Request $request,
        GeminiRecommendationService $geminiRecommendationService,
        TmdbService $tmdbService
    ) {
        $user = Auth::user();

        $watchedMovies = $user->watchedMovies()->get();

        if ($watchedMovies->count() < 5) {
            return redirect()
                ->route('recommendations.index')
                ->with('error', 'Notez au moins 5 films ou séries pour générer des recommandations.');
        }

        $filters = [
    'humeur' => $request->input('mood') ?: null,
    'categorie' => $request->input('genre_label') ?: null,
    'note_minimale_tmdb' => $request->input('min_rating') ?: null,
    'annee' => $request->input('year') ?: null,
    'type' => $request->input('type') ?: null,
    'plateformes' => $request->input('platforms', []),
];

        $profile = $watchedMovies->map(function ($item) {
            return [
                'title' => $item->title,
                'media_type' => $item->media_type,
                'rating' => $item->rating,
            ];
        })->values()->toArray();

        $alreadySeen = $watchedMovies->map(function ($item) {
            return strtolower(trim($item->title . '|' . $item->media_type));
        })->toArray();

        try {
            $rawRecommendations = $geminiRecommendationService->generateRecommendations($profile, $filters);
        } catch (\Throwable $e) {
            return redirect()
                ->route('recommendations.index')
                ->with('error', 'Gemini est temporairement indisponible. Réessaie dans quelques minutes.');
        }

        $user->recommendations()->delete();

        foreach ($rawRecommendations as $rec) {
            if (!isset($rec['title'], $rec['media_type'], $rec['reason'])) {
                continue;
            }

            if (!in_array($rec['media_type'], ['movie', 'tv'])) {
                continue;
            }

            if ($request->input('type') && $rec['media_type'] !== $request->input('type')) {
                continue;
            }

            $key = strtolower(trim($rec['title'] . '|' . $rec['media_type']));

            if (in_array($key, $alreadySeen, true)) {
                continue;
            }

            $tmdbData = $rec['media_type'] === 'tv'
                ? $tmdbService->searchTvByTitle($rec['title'])
                : $tmdbService->searchMovieByTitle($rec['title']);

            if (!$tmdbData) {
                continue;
            }

            $watchProviders = $tmdbService->getWatchProviders(
                $tmdbData['id'],
                $rec['media_type'],
                'FR'
            );

            Recommendation::create([
                'user_id' => $user->id,
                'tmdb_id' => $tmdbData['id'],
                'media_type' => $rec['media_type'],
                'title' => $tmdbData['title'],
                'poster_url' => $tmdbData['poster_url'] ?? null,
                'watch_providers' => $watchProviders['providers'] ?? [],
                'watch_link' => $watchProviders['link'] ?? null,
                'reason' => $rec['reason'],
                'generated_at' => now(),
            ]);
        }

        return redirect()
            ->route('recommendations.index')
            ->with('success', 'Recommandations filtrées générées avec succès.');
    }
    
}