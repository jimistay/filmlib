<?php

namespace App\Http\Controllers;

use App\Models\Recommendation;
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

        return view('recommendations.index', compact('recommendations'));
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

        $rawRecommendations = $geminiRecommendationService->generateRecommendations($profile);

        $user->recommendations()->delete();

        foreach ($rawRecommendations as $rec) {
            $key = strtolower(trim(($rec['title'] ?? '') . '|' . ($rec['media_type'] ?? 'movie')));

            if (in_array($key, $alreadySeen, true)) {
                continue;
            }

            $tmdbData = null;

            if (($rec['media_type'] ?? 'movie') === 'tv') {
                $tmdbData = $tmdbService->searchTvByTitle($rec['title']);
            } else {
                $tmdbData = $tmdbService->searchMovieByTitle($rec['title']);
            }

            if (!$tmdbData) {
                continue;
            }

            Recommendation::create([
                'user_id' => $user->id,
                'tmdb_id' => $tmdbData['id'],
                'media_type' => $rec['media_type'],
                'title' => $tmdbData['title'],
                'poster_url' => $tmdbData['poster_url'] ?? null,
                'reason' => $rec['reason'],
                'generated_at' => now(),
            ]);
        }

        return redirect()
            ->route('recommendations.index')
            ->with('success', 'Recommandations générées avec succès.');
    }
}