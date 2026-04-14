<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Explorer les films et séries
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div class="bg-white shadow sm:rounded-lg p-6">
                <form method="GET" action="{{ route('search.index') }}" class="flex gap-3">
                    <input
                        type="text"
                        name="q"
                        value="{{ $query }}"
                        placeholder="Rechercher un film ou une série..."
                        class="w-full rounded border-gray-300"
                    >
                    <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-white">
                        Rechercher
                    </button>
                </form>
            </div>

            @if($query !== '')
                <div>
                    <h3 class="text-2xl font-bold mb-4">Résultats de recherche</h3>

                    @if(count($searchResults))
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            @foreach($searchResults as $item)
                                <div class="bg-white shadow rounded-lg p-4">
                                    @if($item['poster_url'])
                                        <img
                                            src="{{ $item['poster_url'] }}"
                                            alt="{{ $item['title'] }}"
                                            class="w-full h-80 object-cover rounded mb-4"
                                        >
                                    @endif

                                    <div class="mb-2">
                                        <span class="inline-block rounded bg-gray-100 px-2 py-1 text-xs text-gray-700">
                                            {{ $item['type'] === 'movie' ? 'Film' : 'Série' }}
                                        </span>
                                    </div>

                                    <h4 class="text-lg font-bold">{{ $item['title'] }}</h4>

                                    @if($item['release_date'])
                                        <p class="text-sm text-gray-500 mb-2">
                                            Date : {{ $item['release_date'] }}
                                        </p>
                                    @endif

                                    @if($item['vote_average'])
                                        <p class="text-sm text-gray-600 mb-2">
                                            Note TMDB : {{ number_format($item['vote_average'], 1) }}/10
                                        </p>
                                    @endif

                                    <p class="text-sm text-gray-700 mb-4">
                                        {{ \Illuminate\Support\Str::limit($item['overview'], 120) }}
                                    </p>

                                    <form method="POST" action="{{ route('watched-movies.store') }}" class="space-y-3">
                                        @csrf
                                        <input type="hidden" name="tmdb_id" value="{{ $item['id'] }}">
                                        <input type="hidden" name="title" value="{{ $item['title'] }}">
                                        <input type="hidden" name="poster_url" value="{{ $item['poster_url'] }}">
                                        <input type="hidden" name="media_type" value="{{ $item['type'] }}">

                                        <div>
                                            <label class="block text-sm font-medium">Ma note</label>
                                            <select name="rating" class="w-full rounded border-gray-300" required>
                                                <option value="">Choisir</option>
                                                <option value="1">1/5</option>
                                                <option value="2">2/5</option>
                                                <option value="3">3/5</option>
                                                <option value="4">4/5</option>
                                                <option value="5">5/5</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="w-full rounded bg-green-600 px-4 py-2 text-white">
                                            Ajouter à mes films vus
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-white shadow rounded-lg p-6">
                            Aucun résultat trouvé.
                        </div>
                    @endif
                </div>
            @endif

            <div>
                <h3 class="text-2xl font-bold mb-4">Films populaires</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($popularMovies as $movie)
                        <div class="bg-white shadow rounded-lg p-4">
                            @if($movie['poster_url'])
                                <img
                                    src="{{ $movie['poster_url'] }}"
                                    alt="{{ $movie['title'] }}"
                                    class="w-full h-80 object-cover rounded mb-4"
                                >
                            @endif

                            <h4 class="text-lg font-bold">{{ $movie['title'] }}</h4>

                            @if($movie['release_date'])
                                <p class="text-sm text-gray-500 mb-2">
                                    Sortie : {{ $movie['release_date'] }}
                                </p>
                            @endif

                            @if($movie['vote_average'])
                                <p class="text-sm text-gray-600 mb-2">
                                    Note TMDB : {{ number_format($movie['vote_average'], 1) }}/10
                                </p>
                            @endif

                            <p class="text-sm text-gray-700 mb-4">
                                {{ \Illuminate\Support\Str::limit($movie['overview'], 120) }}
                            </p>

                            <form method="POST" action="{{ route('watched-movies.store') }}" class="space-y-3">
                                @csrf
                                <input type="hidden" name="tmdb_id" value="{{ $movie['id'] }}">
                                <input type="hidden" name="title" value="{{ $movie['title'] }}">
                                <input type="hidden" name="poster_url" value="{{ $movie['poster_url'] }}">
                                <input type="hidden" name="media_type" value="movie">

                                <div>
                                    <label class="block text-sm font-medium">Ma note</label>
                                    <select name="rating" class="w-full rounded border-gray-300" required>
                                        <option value="">Choisir</option>
                                        <option value="1">1/5</option>
                                        <option value="2">2/5</option>
                                        <option value="3">3/5</option>
                                        <option value="4">4/5</option>
                                        <option value="5">5/5</option>
                                    </select>
                                </div>

                                <button type="submit" class="w-full rounded bg-green-600 px-4 py-2 text-white">
                                    Ajouter à mes films vus
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>

            <div>
                <h3 class="text-2xl font-bold mb-4">Séries populaires</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($popularSeries as $serie)
                        <div class="bg-white shadow rounded-lg p-4">
                            @if($serie['poster_url'])
                                <img
                                    src="{{ $serie['poster_url'] }}"
                                    alt="{{ $serie['title'] }}"
                                    class="w-full h-80 object-cover rounded mb-4"
                                >
                            @endif

                            <h4 class="text-lg font-bold">{{ $serie['title'] }}</h4>

                            @if($serie['release_date'])
                                <p class="text-sm text-gray-500 mb-2">
                                    Première diffusion : {{ $serie['release_date'] }}
                                </p>
                            @endif

                            @if($serie['vote_average'])
                                <p class="text-sm text-gray-600 mb-2">
                                    Note TMDB : {{ number_format($serie['vote_average'], 1) }}/10
                                </p>
                            @endif

                            <p class="text-sm text-gray-700 mb-4">
                                {{ \Illuminate\Support\Str::limit($serie['overview'], 120) }}
                            </p>

                            <form method="POST" action="{{ route('watched-movies.store') }}" class="space-y-3">
                                @csrf
                                <input type="hidden" name="tmdb_id" value="{{ $serie['id'] }}">
                                <input type="hidden" name="title" value="{{ $serie['title'] }}">
                                <input type="hidden" name="poster_url" value="{{ $serie['poster_url'] }}">
                                <input type="hidden" name="media_type" value="tv">

                                <div>
                                    <label class="block text-sm font-medium">Ma note</label>
                                    <select name="rating" class="w-full rounded border-gray-300" required>
                                        <option value="">Choisir</option>
                                        <option value="1">1/5</option>
                                        <option value="2">2/5</option>
                                        <option value="3">3/5</option>
                                        <option value="4">4/5</option>
                                        <option value="5">5/5</option>
                                    </select>
                                </div>

                                <button type="submit" class="w-full rounded bg-green-600 px-4 py-2 text-white">
                                    Ajouter à mes films vus
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-app-layout>