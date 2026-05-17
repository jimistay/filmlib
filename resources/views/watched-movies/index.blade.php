<x-app-layout>
    <style>
        body {
            background: #05070d !important;
        }

        nav.bg-white,
        header.bg-white {
            background: #080b14 !important;
            border-color: rgba(255,255,255,.10) !important;
        }

        nav a,
        nav button,
        nav div {
            color: white !important;
        }

        .movies-page {
            min-height: calc(100vh - 64px);
            background:
                radial-gradient(circle at 20% 10%, rgba(229, 9, 20, .22), transparent 28%),
                radial-gradient(circle at 90% 20%, rgba(229, 9, 20, .14), transparent 24%),
                linear-gradient(180deg, #080b14 0%, #05070d 100%);
            padding: 56px 24px;
        }

        .movies-container {
            max-width: 1280px;
            margin: 0 auto;
        }

        .page-top {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 34px;
        }

        .page-title p {
            margin: 0 0 8px;
            color: #ff2935;
            font-size: 13px;
            font-weight: 900;
            letter-spacing: 4px;
            text-transform: uppercase;
        }

        .page-title h1 {
            margin: 0;
            color: white;
            font-size: 42px;
            font-weight: 900;
        }

        .btn-red {
            height: 50px;
            padding: 0 24px;
            border-radius: 12px;
            background: #e50914;
            color: white;
            font-weight: 900;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 18px 45px rgba(229,9,20,.30);
            transition: .2s ease;
        }

        .btn-red:hover {
            background: #ff2935;
            transform: translateY(-2px);
        }

        .alert {
            border-radius: 14px;
            padding: 16px 18px;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .alert-success {
            background: rgba(34,197,94,.13);
            color: #86efac;
            border: 1px solid rgba(34,197,94,.28);
        }

        .alert-error {
            background: rgba(239,68,68,.13);
            color: #fca5a5;
            border: 1px solid rgba(239,68,68,.28);
        }

        .movies-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 26px;
        }

        .movie-card {
            overflow: hidden;
            border-radius: 22px;
            border: 1px solid rgba(255,255,255,.12);
            background:
                radial-gradient(circle at 20% 10%, rgba(229,9,20,.16), transparent 34%),
                linear-gradient(180deg, rgba(255,255,255,.075), rgba(255,255,255,.025));
            box-shadow: 0 28px 80px rgba(0,0,0,.35);
            transition: .25s ease;
        }

        .movie-card:hover {
            transform: translateY(-6px);
            border-color: rgba(229,9,20,.45);
            box-shadow: 0 36px 110px rgba(0,0,0,.55);
        }

        .poster {
            width: 100%;
            height: 380px;
            object-fit: cover;
            background: rgba(255,255,255,.06);
        }

        .poster-empty {
            height: 380px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255,255,255,.45);
            background: linear-gradient(135deg, rgba(229,9,20,.18), rgba(255,255,255,.04));
        }

        .movie-content {
            padding: 20px;
        }

        .badge {
            display: inline-flex;
            margin-bottom: 12px;
            padding: 6px 10px;
            border-radius: 999px;
            background: rgba(229,9,20,.16);
            color: #ff2935;
            font-size: 12px;
            font-weight: 900;
        }

        .movie-title {
            margin: 0 0 16px;
            color: white;
            font-size: 20px;
            font-weight: 900;
        }

        .rating-box {
            margin-bottom: 18px;
            padding: 14px;
            border-radius: 14px;
            text-align: center;
            color: white;
            background: rgba(255,255,255,.055);
            border: 1px solid rgba(255,255,255,.09);
        }

        .rating-label {
            color: rgba(255,255,255,.62);
            font-size: 13px;
            font-weight: 800;
        }

        .stars-read {
            margin-top: 6px;
            color: #facc15;
            font-size: 22px;
            letter-spacing: 1px;
        }

        .rating-value {
            margin-top: 4px;
            color: rgba(255,255,255,.55);
            font-size: 13px;
        }

        .form-label {
            display: block;
            color: rgba(255,255,255,.70);
            font-size: 13px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .rating-stars {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
            gap: 4px;
            margin-bottom: 14px;
        }

        .rating-stars input {
            display: none;
        }

        .rating-stars label {
            color: rgba(255,255,255,.22);
            font-size: 28px;
            cursor: pointer;
            transition: .15s ease;
        }

        .rating-stars input:checked ~ label,
        .rating-stars label:hover,
        .rating-stars label:hover ~ label {
            color: #facc15;
        }

        .card-actions {
            display: grid;
            gap: 10px;
            margin-top: 12px;
        }

        .btn-update,
        .btn-delete {
            width: 100%;
            height: 44px;
            border: 0;
            border-radius: 12px;
            color: white;
            font-weight: 900;
            cursor: pointer;
            transition: .2s ease;
        }

        .btn-update {
            background: #ca8a04;
        }

        .btn-update:hover {
            background: #eab308;
            transform: translateY(-1px);
        }

        .btn-delete {
            background: #dc2626;
        }

        .btn-delete:hover {
            background: #ef4444;
            transform: translateY(-1px);
        }

        .empty-state {
            border-radius: 22px;
            padding: 42px;
            color: rgba(255,255,255,.70);
            border: 1px solid rgba(255,255,255,.12);
            background: rgba(255,255,255,.05);
            text-align: center;
            font-size: 18px;
        }

        @media (max-width: 1100px) {
            .movies-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 800px) {
            .movies-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .page-top {
                align-items: flex-start;
                flex-direction: column;
            }
        }

        @media (max-width: 560px) {
            .movies-grid {
                grid-template-columns: 1fr;
            }

            .page-title h1 {
                font-size: 34px;
            }
        }
    </style>

    <div class="movies-page">
        <div class="movies-container">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            <div class="page-top">
                <div class="page-title">
                    <p>Historique</p>
                    <h1>Mes films et séries vus</h1>
                </div>

                <a href="{{ route('search.index') }}" class="btn-red">
                    + Ajouter depuis Explorer
                </a>
            </div>

            @if($movies->count())
                <div class="movies-grid">
                    @foreach($movies as $movie)
                        <article class="movie-card">
                            @if($movie->poster_url)
                                <img
                                    src="{{ $movie->poster_url }}"
                                    alt="{{ $movie->title }}"
                                    class="poster"
                                >
                            @else
                                <div class="poster-empty">
                                    Aucune affiche
                                </div>
                            @endif

                            <div class="movie-content">
                                <span class="badge">
                                    {{ $movie->media_type === 'tv' ? 'Série' : 'Film' }}
                                </span>

                                <h2 class="movie-title">
                                    {{ $movie->title }}
                                </h2>

                                <div class="rating-box">
                                    <div class="rating-label">Ta note</div>

                                    <div class="stars-read">
                                        @for($i = 1; $i <= 5; $i++)
                                            {{ $i <= $movie->rating ? '★' : '☆' }}
                                        @endfor
                                    </div>

                                    <div class="rating-value">
                                        {{ $movie->rating }}/5
                                    </div>
                                </div>

                                <form method="POST" action="{{ route('watched-movies.update', $movie) }}">
                                    @csrf
                                    @method('PUT')

                                    <label class="form-label">
                                        Modifier ma note
                                    </label>

                                    <div class="rating-stars">
                                        @for($i = 5; $i >= 1; $i--)
                                            <input
                                                type="radio"
                                                id="watched-star-{{ $movie->id }}-{{ $i }}"
                                                name="rating"
                                                value="{{ $i }}"
                                                {{ $movie->rating == $i ? 'checked' : '' }}
                                                required
                                            >

                                            <label for="watched-star-{{ $movie->id }}-{{ $i }}">
                                                ★
                                            </label>
                                        @endfor
                                    </div>

                                    <div class="card-actions">
                                        <button type="submit" class="btn-update">
                                            Mettre à jour
                                        </button>
                                    </div>
                                </form>

                                <form action="{{ route('watched-movies.destroy', $movie) }}" method="POST" class="card-actions">
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        onclick="return confirm('Supprimer ce film ou cette série de ton historique ?')"
                                        class="btn-delete"
                                    >
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    Aucun film ou série ajouté pour le moment.
                </div>
            @endif
        </div>
    </div>
</x-app-layout>