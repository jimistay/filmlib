<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TmdbService
{
    protected string $baseUrl;
    protected string $apiKey;
    protected string $imageBaseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.tmdb.base_url');
        $this->apiKey = config('services.tmdb.api_key');
        $this->imageBaseUrl = config('services.tmdb.image_base_url');
    }

    protected function client()
    {
        return Http::withoutVerifying()->acceptJson();
    }

    protected function mapMovie(array $item): array
    {
        return [
            'id' => $item['id'] ?? null,
            'type' => 'movie',
            'title' => $item['title'] ?? 'Titre inconnu',
            'overview' => $item['overview'] ?? '',
            'poster_url' => !empty($item['poster_path'])
                ? $this->imageBaseUrl . $item['poster_path']
                : null,
            'release_date' => $item['release_date'] ?? null,
            'vote_average' => $item['vote_average'] ?? null,
        ];
    }

    protected function mapTv(array $item): array
    {
        return [
            'id' => $item['id'] ?? null,
            'type' => 'tv',
            'title' => $item['name'] ?? 'Titre inconnu',
            'overview' => $item['overview'] ?? '',
            'poster_url' => !empty($item['poster_path'])
                ? $this->imageBaseUrl . $item['poster_path']
                : null,
            'release_date' => $item['first_air_date'] ?? null,
            'vote_average' => $item['vote_average'] ?? null,
        ];
    }

    public function getPopularMovies(): array
    {
        $response = $this->client()->get("{$this->baseUrl}/movie/popular", [
            'api_key' => $this->apiKey,
            'language' => 'fr-FR',
            'page' => 1,
        ]);

        if ($response->failed()) {
            return [];
        }

        return collect($response->json('results', []))
            ->map(fn ($movie) => $this->mapMovie($movie))
            ->toArray();
    }

    public function getPopularSeries(): array
    {
        $response = $this->client()->get("{$this->baseUrl}/tv/popular", [
            'api_key' => $this->apiKey,
            'language' => 'fr-FR',
            'page' => 1,
        ]);

        if ($response->failed()) {
            return [];
        }

        return collect($response->json('results', []))
            ->map(fn ($tv) => $this->mapTv($tv))
            ->toArray();
    }

    public function searchMulti(string $query): array
    {
        $response = $this->client()->get("{$this->baseUrl}/search/multi", [
            'api_key' => $this->apiKey,
            'query' => $query,
            'language' => 'fr-FR',
            'page' => 1,
        ]);

        if ($response->failed()) {
            return [];
        }

        return collect($response->json('results', []))
            ->filter(fn ($item) => in_array($item['media_type'] ?? '', ['movie', 'tv']))
            ->map(function ($item) {
                return ($item['media_type'] ?? '') === 'tv'
                    ? $this->mapTv($item)
                    : $this->mapMovie($item);
            })
            ->toArray();
    }

    public function searchMovieByTitle(string $title): ?array
    {
        $response = $this->client()->get("{$this->baseUrl}/search/movie", [
            'api_key' => $this->apiKey,
            'query' => $title,
            'language' => 'fr-FR',
            'page' => 1,
        ]);

        if ($response->failed()) {
            return null;
        }

        $first = collect($response->json('results', []))->first();

        return $first ? $this->mapMovie($first) : null;
    }

    public function searchTvByTitle(string $title): ?array
    {
        $response = $this->client()->get("{$this->baseUrl}/search/tv", [
            'api_key' => $this->apiKey,
            'query' => $title,
            'language' => 'fr-FR',
            'page' => 1,
        ]);

        if ($response->failed()) {
            return null;
        }

        $first = collect($response->json('results', []))->first();

        return $first ? $this->mapTv($first) : null;
    }
}