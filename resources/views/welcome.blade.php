<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film Lib</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            background:
                radial-gradient(circle at 15% 35%, rgba(229, 9, 20, .22), transparent 28%),
                radial-gradient(circle at 85% 35%, rgba(229, 9, 20, .18), transparent 26%),
                linear-gradient(180deg, #080b14 0%, #05070d 100%);
            color: #fff;
            font-family: Arial, Helvetica, sans-serif;
        }

        a { color: inherit; text-decoration: none; }

        .page {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 56px 70px;
        }

        .header {
            height: 88px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(255,255,255,.10);
        }

        .logo {
            color: #ff1f2d;
            font-size: 25px;
            font-weight: 900;
            letter-spacing: 6px;
        }

        .nav {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .nav form { margin: 0; }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 52px;
            padding: 0 30px;
            border-radius: 8px;
            border: 1px solid rgba(255,255,255,.22);
            background: rgba(255,255,255,.04);
            color: #fff;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            border-color: rgba(255,255,255,.45);
            background: rgba(255,255,255,.08);
        }

        .btn-red {
            background: #e50914;
            border-color: #e50914;
            box-shadow: 0 18px 45px rgba(229,9,20,.35);
        }

        .btn-red:hover {
            background: #ff1f2d;
            border-color: #ff1f2d;
        }

        .hero {
            position: relative;
            text-align: center;
            padding: 130px 0 80px;
        }

        .hero::before,
        .hero::after {
            content: "";
            position: absolute;
            top: 55px;
            width: 210px;
            height: 360px;
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 10px;
            opacity: .25;
            background: linear-gradient(145deg, rgba(255,255,255,.08), rgba(229,9,20,.15));
        }

        .hero::before {
            left: -20px;
            transform: rotate(-10deg);
        }

        .hero::after {
            right: -20px;
            transform: rotate(10deg);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 760px;
            margin: 0 auto;
        }

        .hero h1 {
            margin: 0;
            font-size: clamp(48px, 7vw, 82px);
            line-height: .98;
            font-weight: 900;
            letter-spacing: -2px;
            text-shadow: 0 15px 45px rgba(0,0,0,.55);
        }

        .hero h1 span { color: #ff2935; }

        .hero p {
            margin: 28px auto 44px;
            max-width: 680px;
            color: rgba(255,255,255,.72);
            font-size: 22px;
            line-height: 1.45;
        }

        .actions {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .social-proof {
            margin-top: 44px;
            color: rgba(255,255,255,.72);
            font-size: 15px;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 26px;
            margin-top: 70px;
        }

        .card {
            position: relative;
            overflow: hidden;
            min-height: 330px;
            padding: 40px;
            border-radius: 16px;
            border: 1px solid rgba(255,255,255,.12);
            background: linear-gradient(180deg, rgba(255,255,255,.055), rgba(255,255,255,.025));
            box-shadow: 0 30px 80px rgba(0,0,0,.35);
        }

        .card::before {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 30% 15%, rgba(229,9,20,.20), transparent 35%);
        }

        .card > * {
            position: relative;
            z-index: 2;
        }

        .icon {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: rgba(229,9,20,.16);
            color: #ff2935;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
            margin-bottom: 34px;
        }

        .card h2 {
            margin: 0 0 22px;
            font-size: 26px;
        }

        .card p {
            margin: 0;
            color: rgba(255,255,255,.68);
            font-size: 18px;
            line-height: 1.7;
        }

        .card-number {
            position: absolute;
            right: 34px;
            bottom: 30px;
            color: #ff2935;
            font-weight: 800;
        }

        .stats {
            margin-top: 80px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            text-align: center;
        }

        .stat strong {
            display: block;
            font-size: 34px;
            margin-bottom: 8px;
        }

        .stat span {
            color: rgba(255,255,255,.55);
        }

        @media (max-width: 900px) {
            .page { padding: 0 22px 50px; }

            .header {
                height: auto;
                padding: 24px 0;
                gap: 20px;
                flex-direction: column;
            }

            .hero { padding: 80px 0 50px; }

            .hero::before,
            .hero::after { display: none; }

            .features,
            .stats { grid-template-columns: 1fr; }
        }
    </style>
</head>

<body>
    <div class="page">
        <header class="header">
            <a href="{{ url('/') }}" class="logo">FILM LIB</a>

            <nav class="nav">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn">Dashboard</a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-red">
                            Se déconnecter
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn">Se connecter</a>
                    <a href="{{ route('register') }}" class="btn btn-red">Créer un compte</a>
                @endauth
            </nav>
        </header>

        <main>
            <section class="hero">
                <div class="hero-content">
                    <h1>
                        Le bon film,<br>
                        <span>au bon moment.</span>
                    </h1>

                    <p>
                        Des recommandations intelligentes basées sur vos goûts,
                        générées par l’IA.
                    </p>

                    <div class="actions">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-red">
                                ✦ Accéder à mon espace
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-red">
                                ✦ Commencer gratuitement
                            </a>
                        @endauth

                        <a href="#features" class="btn">› En savoir plus</a>
                    </div>

                    <div class="social-proof">
                        Rejoignez des passionnés qui trouvent déjà le bon film.
                    </div>
                </div>
            </section>

           <section id="features" class="features">

    <!-- NOTEZ VOS FILMS -->
    <a href="{{ route('watched-movies.index') }}" class="card">
        <div class="icon">★</div>
        <h2>Notez vos films</h2>
        <p>
            Gardez une trace des films que vous avez vus et notez-les
            pour affiner vos goûts.
        </p>
        <div class="card-number">01</div>
    </a>

    <!-- IA -->
    <a href="{{ route('recommendations.index') }}" class="card">
        <div class="icon">✦</div>
        <h2>IA personnalisée</h2>
        <p>
            Notre moteur analyse vos préférences pour suggérer
            des films qui vous plairont.
        </p>
        <div class="card-number">02</div>
    </a>

    <!-- STREAMING / SEARCH -->
    <a href="{{ route('search.index') }}" class="card">
        <div class="icon">▶</div>
        <h2>Où regarder</h2>
        <p>
            Découvrez immédiatement sur quelles plateformes
            regarder chaque film.
        </p>
        <div class="card-number">03</div>
    </a>

</section>
        </main>
    </div>
</body>
</html>