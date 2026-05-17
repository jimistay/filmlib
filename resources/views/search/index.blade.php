<x-app-layout>
    <style>
        body { background: #05070d !important; }

        nav.bg-white,
        header.bg-white {
            background: #080b14 !important;
            border-color: rgba(255,255,255,.10) !important;
        }

        nav a, nav button, nav div {
            color: white !important;
        }

        .explore-page {
            min-height: calc(100vh - 64px);
            background:
                radial-gradient(circle at 12% 8%, rgba(229,9,20,.28), transparent 26%),
                radial-gradient(circle at 92% 18%, rgba(124,58,237,.18), transparent 28%),
                linear-gradient(180deg, #080b14 0%, #05070d 100%);
            padding: 56px 24px 80px;
        }

        .explore-container {
            max-width: 1320px;
            margin: 0 auto;
        }

        .hero-explore {
            position: relative;
            overflow: hidden;
            border-radius: 32px;
            padding: 46px;
            margin-bottom: 32px;
            border: 1px solid rgba(255,255,255,.12);
            background: linear-gradient(135deg, rgba(255,255,255,.11), rgba(255,255,255,.035));
            box-shadow: 0 40px 120px rgba(0,0,0,.45);
        }

        .hero-explore::after {
            content: "EXPLORE";
            position: absolute;
            right: 30px;
            bottom: -18px;
            color: rgba(255,255,255,.035);
            font-size: 112px;
            font-weight: 950;
            letter-spacing: -6px;
        }

        .eyebrow {
            margin: 0 0 10px;
            color: #ff2935;
            font-size: 13px;
            font-weight: 900;
            letter-spacing: 5px;
            text-transform: uppercase;
        }

        .hero-explore h1 {
            position: relative;
            z-index: 2;
            margin: 0;
            color: white;
            font-size: clamp(42px, 6vw, 76px);
            line-height: .95;
            font-weight: 950;
            letter-spacing: -3px;
        }

        .hero-explore h1 span { color: #ff2935; }

        .hero-explore p {
            position: relative;
            z-index: 2;
            margin: 24px 0 0;
            max-width: 720px;
            color: rgba(255,255,255,.68);
            font-size: 19px;
            line-height: 1.65;
        }

        .alert {
            border-radius: 16px;
            padding: 16px 18px;
            margin-bottom: 18px;
            font-weight: 800;
        }

        .alert-success {
            background: rgba(34,197,94,.13);
            color: #86efac;
            border: 1px solid rgba(34,197,94,.30);
        }

        .alert-error {
            background: rgba(239,68,68,.13);
            color: #fca5a5;
            border: 1px solid rgba(239,68,68,.30);
        }

        .filter-panel {
            border-radius: 28px;
            padding: 28px;
            margin-bottom: 42px;
            border: 1px solid rgba(255,255,255,.12);
            background:
                radial-gradient(circle at 15% 0%, rgba(229,9,20,.16), transparent 34%),
                linear-gradient(180deg, rgba(255,255,255,.08), rgba(255,255,255,.025));
            box-shadow: 0 30px 90px rgba(0,0,0,.34);
        }

        .filters-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 16px;
        }

        .field label {
            display: block;
            margin-bottom: 8px;
            color: rgba(255,255,255,.76);
            font-size: 13px;
            font-weight: 900;
        }

        .form-control {
            width: 100%;
            height: 52px;
            padding: 0 14px;
            border-radius: 14px;
            border: 1px solid rgba(255,255,255,.13);
            background: rgba(255,255,255,.06);
            color: white;
            outline: none;
            transition: .18s ease;
        }

        .form-control:focus {
            border-color: #ff2935;
            box-shadow: 0 0 0 4px rgba(229,9,20,.16);
        }

        .form-control::placeholder {
            color: rgba(255,255,255,.35);
        }

        select.form-control option {
            color: #111;
        }

        .filter-actions {
            grid-column: 1 / -1;
            display: flex;
            gap: 12px;
            margin-top: 6px;
        }

        .btn {
            height: 52px;
            padding: 0 24px;
            border: 0;
            border-radius: 14px;
            cursor: pointer;
            color: white;
            font-weight: 950;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: .2s ease;
        }

        .btn:hover { transform: translateY(-2px); }

        .btn-red {
            background: linear-gradient(135deg, #e50914, #ff2935);
            box-shadow: 0 20px 52px rgba(229,9,20,.34);
        }

        .btn-ghost {
            background: rgba(255,255,255,.07);
            border: 1px solid rgba(255,255,255,.12);
        }

        .section-title {
            margin: 44px 0 22px;
        }

        .section-title h2 {
            margin: 0;
            color: white;
            font-size: 34px;
            font-weight: 950;
            letter-spacing: -1px;
        }

        .catalog-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 26px;
        }

        .media-card {
            overflow: hidden;
            border-radius: 28px;
            border: 1px solid rgba(255,255,255,.12);
            background:
                radial-gradient(circle at 20% 0%, rgba(229,9,20,.16), transparent 30%),
                linear-gradient(180deg, rgba(255,255,255,.075), rgba(255,255,255,.025));
            box-shadow: 0 30px 90px rgba(0,0,0,.36);
            transition: .25s ease;
        }

        .media-card:hover {
            transform: translateY(-8px);
            border-color: rgba(229,9,20,.52);
            box-shadow: 0 45px 130px rgba(0,0,0,.58);
        }

        .poster-wrap {
            position: relative;
            overflow: hidden;
            height: 380px;
            background: rgba(255,255,255,.06);
        }

        .poster {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: .35s ease;
        }

        .media-card:hover .poster {
            transform: scale(1.06);
        }

        .poster-empty {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255,255,255,.45);
            background: linear-gradient(135deg, rgba(229,9,20,.18), rgba(255,255,255,.04));
        }

        .poster-gradient {
            position: absolute;
            inset: auto 0 0 0;
            height: 55%;
            background: linear-gradient(180deg, transparent, rgba(5,7,13,.96));
        }

        .badges {
            position: absolute;
            top: 14px;
            left: 14px;
            right: 14px;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            z-index: 2;
        }

        .badge {
            padding: 7px 11px;
            border-radius: 999px;
            color: white;
            background: rgba(229,9,20,.86);
            font-size: 12px;
            font-weight: 950;
            backdrop-filter: blur(10px);
        }

        .badge-green {
            background: rgba(34,197,94,.88);
        }

        .media-content {
            padding: 22px;
        }

        .media-title {
            margin: 0 0 10px;
            color: white;
            font-size: 22px;
            font-weight: 950;
            line-height: 1.15;
        }

        .details-link {
            display: inline-flex;
            margin-bottom: 14px;
            color: #ff2935;
            font-weight: 900;
            text-decoration: none;
        }

        .meta {
            margin: 0 0 8px;
            color: rgba(255,255,255,.55);
            font-size: 14px;
            font-weight: 700;
        }

        .overview {
            margin: 12px 0 18px;
            color: rgba(255,255,255,.66);
            font-size: 14px;
            line-height: 1.6;
        }

        .watched-box {
            padding: 15px;
            border-radius: 16px;
            text-align: center;
            margin-bottom: 14px;
            background: rgba(255,255,255,.07);
            border: 1px solid rgba(255,255,255,.10);
            color: white;
            font-weight: 900;
        }

        .stars-read {
            margin-top: 6px;
            color: #facc15;
            font-size: 22px;
            letter-spacing: 1px;
        }

        .rating-stars {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
            gap: 4px;
            margin: 8px 0 14px;
        }

        .rating-stars input {
            display: none;
        }

        .rating-stars label {
            color: rgba(255,255,255,.24);
            font-size: 28px;
            cursor: pointer;
            transition: .15s ease;
        }

        .rating-stars input:checked ~ label,
        .rating-stars label:hover,
        .rating-stars label:hover ~ label {
            color: #facc15;
        }

        .form-label {
            display: block;
            color: rgba(255,255,255,.72);
            font-size: 13px;
            font-weight: 900;
        }

        .btn-add,
        .btn-update {
            width: 100%;
            height: 46px;
            border-radius: 14px;
            border: 0;
            color: white;
            font-weight: 950;
            cursor: pointer;
            transition: .2s ease;
        }

        .btn-add {
            background: linear-gradient(135deg, #16a34a, #22c55e);
        }

        .btn-update {
            background: linear-gradient(135deg, #ca8a04, #facc15);
            color: #1a1200;
        }

        .btn-add:hover,
        .btn-update:hover {
            transform: translateY(-2px);
        }

        .empty-state {
            border-radius: 28px;
            padding: 42px;
            color: rgba(255,255,255,.72);
            border: 1px solid rgba(255,255,255,.12);
            background: rgba(255,255,255,.05);
            text-align: center;
            font-size: 18px;
        }

        @media (max-width: 1180px) {
            .filters-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .catalog-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 820px) {
            .filters-grid,
            .catalog-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .hero-explore {
                padding: 30px;
            }
        }

        @media (max-width: 560px) {
            .filters-grid,
            .catalog-grid {
                grid-template-columns: 1fr;
            }

            .filter-actions {
                flex-direction: column;
            }

            .hero-explore h1 {
                font-size: 42px;
            }
        }
    </style>

    <div class="explore-page">
        <div class="explore-container">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif

            <section class="hero-explore">
                <p class="eyebrow">Catalogue TMDB</p>
                <h1>Explore les <span>films et séries</span>.</h1>
                <p>
                    Recherche, filtre et ajoute directement tes découvertes à ton historique pour améliorer tes recommandations.
                </p>
            </section>

            <section class="filter-panel">
                <form method="GET" action="{{ route('search.index') }}" class="filters-grid">
                    <div class="field">
                        <label>Titre</label>
                        <input type="text" name="q" value="{{ $query }}" placeholder="Ex : Inception..." class="form-control">
                    </div>

                    <div class="field">
                        <label>Humeur</label>
                        <select name="mood" class="form-control">
                            @foreach($moods as $value => $label)
                                <option value="{{ $value }}" {{ $mood == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="field">
                        <label>Catégorie</label>
                        <select name="genre_id" class="form-control">
                            @foreach($genres as $value => $label)
                                <option value="{{ $value }}" {{ (string) $genreId === (string) $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="field">
                        <label>Note min</label>
                        <select name="min_rating" class="form-control">
                            @foreach($ratings as $value => $label)
                                <option value="{{ $value }}" {{ (string) $minRating === (string) $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="field">
                        <label>Année</label>
                        <input type="number" name="year" value="{{ $year }}" placeholder="2024" class="form-control">
                    </div>

                    <div class="field">
                        <label>Type</label>
                        <select name="type" class="form-control">
                            @foreach($types as $value => $label)
                                <option value="{{ $value }}" {{ $type == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-actions">
                        <button type="submit" class="btn btn-red">
                            Rechercher
                        </button>

                        <a href="{{ route('search.index') }}" class="btn btn-ghost">
                            Réinitialiser
                        </a>
                    </div>
                </form>
            </section>

            @php
                $renderCard = function ($item, $type, $watchedItems) {
                    return null;
                };
            @endphp

            @if($query !== '')
                <section>
                    <div class="section-title">
                        <p class="eyebrow">Recherche</p>
                        <h2>Résultats de recherche</h2>
                    </div>

                    @if(count($searchResults))
                        <div class="catalog-grid">
                            @foreach($searchResults as $item)
                                @php
                                    $key = $item['type'] . '-' . $item['id'];
                                    $watchedItem = $watchedItems->get($key);
                                    $isWatched = $watchedItem !== null;
                                @endphp

                                <article class="media-card">
                                    <div class="poster-wrap">
                                        @if($item['poster_url'])
                                            <img src="{{ $item['poster_url'] }}" alt="{{ $item['title'] }}" class="poster">
                                        @else
                                            <div class="poster-empty">Aucune affiche</div>
                                        @endif

                                        <div class="poster-gradient"></div>

                                        <div class="badges">
                                            <span class="badge">{{ $item['type'] === 'movie' ? 'Film' : 'Série' }}</span>
                                            @if($isWatched)
                                                <span class="badge badge-green">Déjà vu</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="media-content">
                                        <h3 class="media-title">{{ $item['title'] }}</h3>

                                        <a href="{{ route('search.show', [$item['type'], $item['id']]) }}" class="details-link">
                                            Voir détails →
                                        </a>

                                        @if($item['release_date'])
                                            <p class="meta">Date : {{ $item['release_date'] }}</p>
                                        @endif

                                        @if($item['vote_average'])
                                            <p class="meta">Note TMDB : {{ number_format($item['vote_average'], 1) }}/10</p>
                                        @endif

                                        <p class="overview">
                                            {{ \Illuminate\Support\Str::limit($item['overview'], 120) }}
                                        </p>

                                        @if($isWatched)
                                            <div class="watched-box">
                                                <div>Déjà vu</div>
                                                <div class="stars-read">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        {{ $i <= $watchedItem->rating ? '★' : '☆' }}
                                                    @endfor
                                                </div>
                                                <div>Ta note : {{ $watchedItem->rating }}/5</div>
                                            </div>

                                            <form method="POST" action="{{ route('watched-movies.update', $watchedItem) }}">
                                                @csrf
                                                @method('PUT')

                                                <label class="form-label">Modifier ma note</label>

                                                <div class="rating-stars">
                                                    @for($i = 5; $i >= 1; $i--)
                                                        <input type="radio" id="edit-star-search-{{ $watchedItem->id }}-{{ $i }}" name="rating" value="{{ $i }}" {{ $watchedItem->rating == $i ? 'checked' : '' }} required>
                                                        <label for="edit-star-search-{{ $watchedItem->id }}-{{ $i }}">★</label>
                                                    @endfor
                                                </div>

                                                <button type="submit" class="btn-update">Mettre à jour</button>
                                            </form>
                                        @else
                                            <form method="POST" action="{{ route('watched-movies.store') }}">
                                                @csrf

                                                <input type="hidden" name="tmdb_id" value="{{ $item['id'] }}">
                                                <input type="hidden" name="title" value="{{ $item['title'] }}">
                                                <input type="hidden" name="poster_url" value="{{ $item['poster_url'] }}">
                                                <input type="hidden" name="media_type" value="{{ $item['type'] }}">

                                                <label class="form-label">Ma note</label>

                                                <div class="rating-stars">
                                                    @for($i = 5; $i >= 1; $i--)
                                                        <input type="radio" id="star-search-{{ $item['type'] }}-{{ $item['id'] }}-{{ $i }}" name="rating" value="{{ $i }}" required>
                                                        <label for="star-search-{{ $item['type'] }}-{{ $item['id'] }}-{{ $i }}">★</label>
                                                    @endfor
                                                </div>

                                                <button type="submit" class="btn-add">Ajouter à mes films vus</button>
                                            </form>
                                        @endif
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">Aucun résultat trouvé.</div>
                    @endif
                </section>
            @endif

            <section>
                <div class="section-title">
                    <p class="eyebrow">Films</p>
                    <h2>{{ $mood || $genreId || $year || $minRating || $type ? 'Films correspondant aux filtres' : 'Films populaires' }}</h2>
                </div>

                <div class="catalog-grid">
                    @foreach($popularMovies as $movie)
                        @php
                            $key = 'movie-' . $movie['id'];
                            $watchedItem = $watchedItems->get($key);
                            $isWatched = $watchedItem !== null;
                        @endphp

                        <article class="media-card">
                            <div class="poster-wrap">
                                @if($movie['poster_url'])
                                    <img src="{{ $movie['poster_url'] }}" alt="{{ $movie['title'] }}" class="poster">
                                @else
                                    <div class="poster-empty">Aucune affiche</div>
                                @endif

                                <div class="poster-gradient"></div>

                                <div class="badges">
                                    <span class="badge">Film</span>
                                    @if($isWatched)
                                        <span class="badge badge-green">Déjà vu</span>
                                    @endif
                                </div>
                            </div>

                            <div class="media-content">
                                <h3 class="media-title">{{ $movie['title'] }}</h3>

                                <a href="{{ route('search.show', ['movie', $movie['id']]) }}" class="details-link">
                                    Voir détails →
                                </a>

                                @if($movie['release_date'])
                                    <p class="meta">Sortie : {{ $movie['release_date'] }}</p>
                                @endif

                                @if($movie['vote_average'])
                                    <p class="meta">Note TMDB : {{ number_format($movie['vote_average'], 1) }}/10</p>
                                @endif

                                <p class="overview">
                                    {{ \Illuminate\Support\Str::limit($movie['overview'], 120) }}
                                </p>

                                @if($isWatched)
                                    <div class="watched-box">
                                        <div>Déjà vu</div>
                                        <div class="stars-read">
                                            @for($i = 1; $i <= 5; $i++)
                                                {{ $i <= $watchedItem->rating ? '★' : '☆' }}
                                            @endfor
                                        </div>
                                        <div>Ta note : {{ $watchedItem->rating }}/5</div>
                                    </div>

                                    <form method="POST" action="{{ route('watched-movies.update', $watchedItem) }}">
                                        @csrf
                                        @method('PUT')

                                        <label class="form-label">Modifier ma note</label>

                                        <div class="rating-stars">
                                            @for($i = 5; $i >= 1; $i--)
                                                <input type="radio" id="edit-star-movie-{{ $watchedItem->id }}-{{ $i }}" name="rating" value="{{ $i }}" {{ $watchedItem->rating == $i ? 'checked' : '' }} required>
                                                <label for="edit-star-movie-{{ $watchedItem->id }}-{{ $i }}">★</label>
                                            @endfor
                                        </div>

                                        <button type="submit" class="btn-update">Mettre à jour</button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('watched-movies.store') }}">
                                        @csrf

                                        <input type="hidden" name="tmdb_id" value="{{ $movie['id'] }}">
                                        <input type="hidden" name="title" value="{{ $movie['title'] }}">
                                        <input type="hidden" name="poster_url" value="{{ $movie['poster_url'] }}">
                                        <input type="hidden" name="media_type" value="movie">

                                        <label class="form-label">Ma note</label>

                                        <div class="rating-stars">
                                            @for($i = 5; $i >= 1; $i--)
                                                <input type="radio" id="star-movie-{{ $movie['id'] }}-{{ $i }}" name="rating" value="{{ $i }}" required>
                                                <label for="star-movie-{{ $movie['id'] }}-{{ $i }}">★</label>
                                            @endfor
                                        </div>

                                        <button type="submit" class="btn-add">Ajouter à mes films vus</button>
                                    </form>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>

            <section>
                <div class="section-title">
                    <p class="eyebrow">Séries</p>
                    <h2>{{ $mood || $genreId || $year || $minRating || $type ? 'Séries correspondant aux filtres' : 'Séries populaires' }}</h2>
                </div>

                <div class="catalog-grid">
                    @foreach($popularSeries as $serie)
                        @php
                            $key = 'tv-' . $serie['id'];
                            $watchedItem = $watchedItems->get($key);
                            $isWatched = $watchedItem !== null;
                        @endphp

                        <article class="media-card">
                            <div class="poster-wrap">
                                @if($serie['poster_url'])
                                    <img src="{{ $serie['poster_url'] }}" alt="{{ $serie['title'] }}" class="poster">
                                @else
                                    <div class="poster-empty">Aucune affiche</div>
                                @endif

                                <div class="poster-gradient"></div>

                                <div class="badges">
                                    <span class="badge">Série</span>
                                    @if($isWatched)
                                        <span class="badge badge-green">Déjà vu</span>
                                    @endif
                                </div>
                            </div>

                            <div class="media-content">
                                <h3 class="media-title">{{ $serie['title'] }}</h3>

                                <a href="{{ route('search.show', ['tv', $serie['id']]) }}" class="details-link">
                                    Voir détails →
                                </a>

                                @if($serie['release_date'])
                                    <p class="meta">Première diffusion : {{ $serie['release_date'] }}</p>
                                @endif

                                @if($serie['vote_average'])
                                    <p class="meta">Note TMDB : {{ number_format($serie['vote_average'], 1) }}/10</p>
                                @endif

                                <p class="overview">
                                    {{ \Illuminate\Support\Str::limit($serie['overview'], 120) }}
                                </p>

                                @if($isWatched)
                                    <div class="watched-box">
                                        <div>Déjà vu</div>
                                        <div class="stars-read">
                                            @for($i = 1; $i <= 5; $i++)
                                                {{ $i <= $watchedItem->rating ? '★' : '☆' }}
                                            @endfor
                                        </div>
                                        <div>Ta note : {{ $watchedItem->rating }}/5</div>
                                    </div>

                                    <form method="POST" action="{{ route('watched-movies.update', $watchedItem) }}">
                                        @csrf
                                        @method('PUT')

                                        <label class="form-label">Modifier ma note</label>

                                        <div class="rating-stars">
                                            @for($i = 5; $i >= 1; $i--)
                                                <input type="radio" id="edit-star-serie-{{ $watchedItem->id }}-{{ $i }}" name="rating" value="{{ $i }}" {{ $watchedItem->rating == $i ? 'checked' : '' }} required>
                                                <label for="edit-star-serie-{{ $watchedItem->id }}-{{ $i }}">★</label>
                                            @endfor
                                        </div>

                                        <button type="submit" class="btn-update">Mettre à jour</button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('watched-movies.store') }}">
                                        @csrf

                                        <input type="hidden" name="tmdb_id" value="{{ $serie['id'] }}">
                                        <input type="hidden" name="title" value="{{ $serie['title'] }}">
                                        <input type="hidden" name="poster_url" value="{{ $serie['poster_url'] }}">
                                        <input type="hidden" name="media_type" value="tv">

                                        <label class="form-label">Ma note</label>

                                        <div class="rating-stars">
                                            @for($i = 5; $i >= 1; $i--)
                                                <input type="radio" id="star-tv-{{ $serie['id'] }}-{{ $i }}" name="rating" value="{{ $i }}" required>
                                                <label for="star-tv-{{ $serie['id'] }}-{{ $i }}">★</label>
                                            @endfor
                                        </div>

                                        <button type="submit" class="btn-add">Ajouter à mes films vus</button>
                                    </form>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
</x-app-layout>