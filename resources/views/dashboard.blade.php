<x-app-layout>
    <style>
        nav.bg-white,
        header.bg-white {
            background: #080b14 !important;
            border-color: rgba(255,255,255,.10) !important;
        }

        nav a,
        nav button,
        nav div,
        header h2 {
            color: white !important;
        }

        body {
            background: #05070d !important;
        }

        .dashboard-page {
            min-height: calc(100vh - 64px);
            background:
                radial-gradient(circle at 20% 10%, rgba(229, 9, 20, .22), transparent 28%),
                radial-gradient(circle at 90% 20%, rgba(229, 9, 20, .14), transparent 24%),
                linear-gradient(180deg, #080b14 0%, #05070d 100%);
            padding: 56px 24px;
        }

        .dashboard-container {
            max-width: 1120px;
            margin: 0 auto;
        }

        .dashboard-title {
            margin-bottom: 34px;
        }

        .dashboard-title p {
            margin: 0 0 8px;
            color: #ff2935;
            font-size: 13px;
            font-weight: 900;
            letter-spacing: 4px;
            text-transform: uppercase;
        }

        .dashboard-title h1 {
            margin: 0;
            color: white;
            font-size: 42px;
            font-weight: 900;
        }

        .hero-panel {
            border-radius: 24px;
            padding: 44px;
            margin-bottom: 32px;
            color: white;
            border: 1px solid rgba(255,255,255,.12);
            background: linear-gradient(135deg, rgba(255,255,255,.08), rgba(255,255,255,.03));
            box-shadow: 0 30px 90px rgba(0,0,0,.35);
        }

        .hero-panel h2 {
            margin: 0 0 14px;
            font-size: clamp(34px, 5vw, 58px);
            line-height: 1;
            font-weight: 900;
        }

        .hero-panel h2 span {
            color: #ff2935;
        }

        .hero-panel p {
            max-width: 620px;
            margin: 0;
            color: rgba(255,255,255,.68);
            font-size: 18px;
            line-height: 1.6;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .dash-card {
            min-height: 260px;
            padding: 32px;
            border-radius: 20px;
            color: white;
            text-decoration: none;
            border: 1px solid rgba(255,255,255,.12);
            background: linear-gradient(180deg, rgba(255,255,255,.07), rgba(255,255,255,.025));
            box-shadow: 0 24px 70px rgba(0,0,0,.28);
            transition: .25s ease;
        }

        .dash-card:hover {
            transform: translateY(-6px);
            border-color: rgba(255,255,255,.32);
        }

        .dash-icon {
            width: 64px;
            height: 64px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 28px;
            color: #ff2935;
            background: rgba(229,9,20,.14);
            font-size: 30px;
        }

        .dash-card h3 {
            margin: 0 0 14px;
            font-size: 24px;
            font-weight: 900;
        }

        .dash-card p {
            margin: 0;
            color: rgba(255,255,255,.64);
            font-size: 16px;
            line-height: 1.55;
        }

        @media (max-width: 900px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }

        
    </style>

    <div class="dashboard-page">
        <div class="dashboard-container">
            <div class="dashboard-title">
                <p>Bienvenue sur</p>
                <h1>Tableau de bord FILM LIB</h1>
            </div>

            <section class="hero-panel">
                <h2>Votre espace <span>cinéma</span></h2>
                <p>
                    Gérez vos films vus, explorez le catalogue et découvrez des recommandations personnalisées.
                </p>
            </section>

            <section class="dashboard-grid">
                <a href="{{ route('watched-movies.index') }}" class="dash-card">
                    <div class="dash-icon">★</div>
                    <h3>Mes films vus</h3>
                    <p>Ajoutez, notez et retrouvez les films que vous avez déjà regardés.</p>
                </a>

                <a href="{{ route('recommendations.index') }}" class="dash-card">
                    <div class="dash-icon">✦</div>
                    <h3>Mes recommandations</h3>
                    <p>Recevez des suggestions adaptées à vos goûts grâce à l’intelligence artificielle.</p>
                </a>

                <a href="{{ route('search.index') }}" class="dash-card">
                    <div class="dash-icon">▶</div>
                    <h3>Explorer</h3>
                    <p>Parcourez les films et séries récupérés depuis TMDB et trouvez quoi regarder.</p>
                </a>
            </section>
        </div>
    </div>
</x-app-layout>