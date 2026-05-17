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
            ->map(fn ($serie) => $this->mapTv($serie))
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

    public function discoverMovies(?int $genreId = null, ?string $mood = null, ?int $year = null, ?float $minRating = null): array
    {
        $params = [
            'api_key' => $this->apiKey,
            'language' => 'fr-FR',
            'page' => 1,
            'sort_by' => 'popularity.desc',
        ];

        $genreFilter = $this->buildGenreFilter($genreId, $mood);

        if ($genreFilter) {
            $params['with_genres'] = $genreFilter;
        }

        if ($year) {
            $params['primary_release_year'] = $year;
        }

        if ($minRating) {
            $params['vote_average.gte'] = $minRating;
        }

        $response = $this->client()->get("{$this->baseUrl}/discover/movie", $params);

        if ($response->failed()) {
            return [];
        }

        return collect($response->json('results', []))
            ->map(fn ($movie) => $this->mapMovie($movie))
            ->toArray();
    }

    public function discoverSeries(?int $genreId = null, ?string $mood = null, ?int $year = null, ?float $minRating = null): array
    {
        $params = [
            'api_key' => $this->apiKey,
            'language' => 'fr-FR',
            'page' => 1,
            'sort_by' => 'popularity.desc',
        ];

        $genreFilter = $this->buildGenreFilter($genreId, $mood);

        if ($genreFilter) {
            $params['with_genres'] = $genreFilter;
        }

        if ($year) {
            $params['first_air_date_year'] = $year;
        }

        if ($minRating) {
            $params['vote_average.gte'] = $minRating;
        }

        $response = $this->client()->get("{$this->baseUrl}/discover/tv", $params);

        if ($response->failed()) {
            return [];
        }

        return collect($response->json('results', []))
            ->map(fn ($serie) => $this->mapTv($serie))
            ->toArray();
    }

    private function moodGenreIds(string $mood): array
    {
        return match ($mood) {
            'joyeuse' => [35, 10751, 16],
            'triste' => [18, 10749],
            'stressee' => [35, 10751, 12],
            'romantique' => [10749],
            'frisson' => [27, 53, 9648],
            default => [],
        };
    }

    private function buildGenreFilter(?int $genreId = null, ?string $mood = null): ?string
    {
        $genres = [];

        if ($genreId) {
            $genres[] = $genreId;
        }

        if ($mood) {
            $genres = array_merge($genres, $this->moodGenreIds($mood));
        }

        $genres = array_unique($genres);

        return count($genres) ? implode('|', $genres) : null;
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

    public function getMovieDetails(int $id): ?array
    {
        $response = $this->client()->get("{$this->baseUrl}/movie/{$id}", [
            'api_key' => $this->apiKey,
            'language' => 'fr-FR',
            'append_to_response' => 'credits,videos',
        ]);

        if ($response->failed()) {
            return null;
        }

        $movie = $response->json();

        return [
            'id' => $movie['id'],
            'type' => 'movie',
            'title' => $movie['title'] ?? 'Titre inconnu',
            'overview' => $movie['overview'] ?? '',
            'poster_url' => !empty($movie['poster_path'])
                ? $this->imageBaseUrl . $movie['poster_path']
                : null,
            'backdrop_url' => !empty($movie['backdrop_path'])
                ? 'https://image.tmdb.org/t/p/w1280' . $movie['backdrop_path']
                : null,
            'release_date' => $movie['release_date'] ?? null,
            'vote_average' => $movie['vote_average'] ?? null,
            'runtime' => $movie['runtime'] ?? null,
            'genres' => collect($movie['genres'] ?? [])->pluck('name')->toArray(),
            'cast' => collect(data_get($movie, 'credits.cast', []))->take(6)->pluck('name')->toArray(),
        ];
    }

    public function getTvDetails(int $id): ?array
    {
        $response = $this->client()->get("{$this->baseUrl}/tv/{$id}", [
            'api_key' => $this->apiKey,
            'language' => 'fr-FR',
            'append_to_response' => 'credits,videos',
        ]);

        if ($response->failed()) {
            return null;
        }

        $tv = $response->json();

        return [
            'id' => $tv['id'],
            'type' => 'tv',
            'title' => $tv['name'] ?? 'Titre inconnu',
            'overview' => $tv['overview'] ?? '',
            'poster_url' => !empty($tv['poster_path'])
                ? $this->imageBaseUrl . $tv['poster_path']
                : null,
            'backdrop_url' => !empty($tv['backdrop_path'])
                ? 'https://image.tmdb.org/t/p/w1280' . $tv['backdrop_path']
                : null,
            'release_date' => $tv['first_air_date'] ?? null,
            'vote_average' => $tv['vote_average'] ?? null,
            'runtime' => $tv['episode_run_time'][0] ?? null,
            'genres' => collect($tv['genres'] ?? [])->pluck('name')->toArray(),
            'cast' => collect(data_get($tv, 'credits.cast', []))->take(6)->pluck('name')->toArray(),
            'seasons' => $tv['number_of_seasons'] ?? null,
            'episodes' => $tv['number_of_episodes'] ?? null,
        ];
    }
    public function getWatchProviders(int $id, string $type = 'movie', string $country = 'FR'): array
{
    $endpoint = $type === 'tv'
        ? "{$this->baseUrl}/tv/{$id}/watch/providers"
        : "{$this->baseUrl}/movie/{$id}/watch/providers";

    $response = $this->client()->get($endpoint, [
        'api_key' => $this->apiKey,
    ]);

    if ($response->failed()) {
        return [];
    }

    $countryData = data_get($response->json(), "results.$country", []);

    $providers = collect([
        ...($countryData['flatrate'] ?? []),
        ...($countryData['rent'] ?? []),
        ...($countryData['buy'] ?? []),
    ])
        ->unique('provider_id')
        ->map(function ($provider) {
            return [
                'name' => $provider['provider_name'] ?? '',
                'logo_url' => !empty($provider['logo_path'])
                    ? 'https://image.tmdb.org/t/p/w92' . $provider['logo_path']
                    : null,
            ];
        })
        ->values()
        ->toArray();

    return [
        'link' => $countryData['link'] ?? null,
        'providers' => $providers,
    ];
}
}