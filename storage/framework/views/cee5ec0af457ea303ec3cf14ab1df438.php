<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
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

        .rec-page {
            min-height: calc(100vh - 64px);
            background:
                radial-gradient(circle at 12% 10%, rgba(229,9,20,.28), transparent 26%),
                radial-gradient(circle at 92% 18%, rgba(124,58,237,.20), transparent 28%),
                radial-gradient(circle at 50% 90%, rgba(229,9,20,.12), transparent 35%),
                linear-gradient(180deg, #080b14 0%, #05070d 100%);
            padding: 56px 24px 80px;
        }

        .rec-container {
            max-width: 1280px;
            margin: 0 auto;
        }

        .hero-rec {
            position: relative;
            overflow: hidden;
            border-radius: 32px;
            padding: 46px;
            margin-bottom: 32px;
            border: 1px solid rgba(255,255,255,.12);
            background:
                linear-gradient(135deg, rgba(255,255,255,.11), rgba(255,255,255,.035));
            box-shadow: 0 40px 120px rgba(0,0,0,.45);
        }

        .hero-rec::before {
            content: "";
            position: absolute;
            width: 340px;
            height: 340px;
            right: -90px;
            top: -120px;
            border-radius: 999px;
            background: rgba(229,9,20,.32);
            filter: blur(18px);
        }

        .hero-rec::after {
            content: "AI";
            position: absolute;
            right: 42px;
            bottom: -20px;
            color: rgba(255,255,255,.035);
            font-size: 180px;
            font-weight: 900;
            letter-spacing: -12px;
        }

        .eyebrow {
            margin: 0 0 10px;
            color: #ff2935;
            font-size: 13px;
            font-weight: 900;
            letter-spacing: 5px;
            text-transform: uppercase;
        }

        .hero-rec h1 {
            position: relative;
            z-index: 2;
            margin: 0;
            max-width: 820px;
            color: white;
            font-size: clamp(42px, 6vw, 76px);
            line-height: .95;
            font-weight: 950;
            letter-spacing: -3px;
        }

        .hero-rec h1 span { color: #ff2935; }

        .hero-rec p {
            position: relative;
            z-index: 2;
            margin: 24px 0 0;
            max-width: 690px;
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

        .generator-grid {
            display: grid;
            grid-template-columns: .85fr 1.15fr;
            gap: 24px;
            margin-bottom: 36px;
        }

        .panel {
            position: relative;
            overflow: hidden;
            border-radius: 28px;
            padding: 30px;
            border: 1px solid rgba(255,255,255,.12);
            background:
                radial-gradient(circle at 15% 0%, rgba(229,9,20,.18), transparent 34%),
                linear-gradient(180deg, rgba(255,255,255,.08), rgba(255,255,255,.025));
            box-shadow: 0 30px 90px rgba(0,0,0,.34);
        }

        .panel h2 {
            margin: 0 0 10px;
            color: white;
            font-size: 24px;
            font-weight: 950;
        }

        .panel p {
            margin: 0 0 24px;
            color: rgba(255,255,255,.62);
            line-height: 1.55;
        }

        .panel-icon {
            width: 68px;
            height: 68px;
            border-radius: 22px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ff2935;
            font-size: 32px;
            background: rgba(229,9,20,.14);
            border: 1px solid rgba(229,9,20,.24);
            box-shadow: 0 18px 45px rgba(229,9,20,.16);
        }

        .filters {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
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

        select.form-control option {
            color: #111;
        }

        .btn {
            height: 54px;
            padding: 0 24px;
            border: 0;
            border-radius: 15px;
            cursor: pointer;
            color: white;
            font-weight: 950;
            transition: .2s ease;
        }

        .btn:hover { transform: translateY(-2px); }

        .btn-red {
            width: 100%;
            background: linear-gradient(135deg, #e50914, #ff2935);
            box-shadow: 0 20px 52px rgba(229,9,20,.34);
        }

        .btn-purple {
            background: linear-gradient(135deg, #7c3aed, #e50914);
            box-shadow: 0 20px 52px rgba(124,58,237,.26);
        }

        .section-title {
            display: flex;
            justify-content: space-between;
            align-items: end;
            gap: 20px;
            margin: 38px 0 22px;
        }

        .section-title h2 {
            margin: 0;
            color: white;
            font-size: 32px;
            font-weight: 950;
        }

        .section-title span {
            color: rgba(255,255,255,.48);
            font-weight: 700;
        }

        .recommendations-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 26px;
        }

        .rec-card {
            overflow: hidden;
            border-radius: 28px;
            border: 1px solid rgba(255,255,255,.12);
            background:
                radial-gradient(circle at 20% 0%, rgba(229,9,20,.16), transparent 30%),
                linear-gradient(180deg, rgba(255,255,255,.075), rgba(255,255,255,.025));
            box-shadow: 0 30px 90px rgba(0,0,0,.36);
            transition: .25s ease;
        }

        .rec-card:hover {
            transform: translateY(-8px);
            border-color: rgba(229,9,20,.52);
            box-shadow: 0 45px 130px rgba(0,0,0,.58);
        }

        .poster-wrap {
            position: relative;
            overflow: hidden;
            height: 430px;
            background: rgba(255,255,255,.06);
        }

        .poster {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: .35s ease;
        }

        .rec-card:hover .poster {
            transform: scale(1.06);
        }

        .poster-gradient {
            position: absolute;
            inset: auto 0 0 0;
            height: 55%;
            background: linear-gradient(180deg, transparent, rgba(5,7,13,.95));
        }

        .type-badge {
            position: absolute;
            top: 16px;
            left: 16px;
            padding: 7px 12px;
            border-radius: 999px;
            color: white;
            background: rgba(229,9,20,.86);
            font-size: 12px;
            font-weight: 950;
            backdrop-filter: blur(10px);
        }

        .rec-content {
            padding: 22px;
        }

        .rec-content h3 {
            margin: 0 0 12px;
            color: white;
            font-size: 23px;
            font-weight: 950;
            line-height: 1.15;
        }

        .reason {
            margin: 0;
            color: rgba(255,255,255,.66);
            font-size: 15px;
            line-height: 1.6;
        }

        .providers-title {
            margin: 20px 0 10px;
            color: rgba(255,255,255,.82);
            font-size: 13px;
            font-weight: 950;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .providers {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .provider {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            max-width: 100%;
            padding: 7px 10px;
            border-radius: 12px;
            background: rgba(255,255,255,.07);
            border: 1px solid rgba(255,255,255,.08);
            color: rgba(255,255,255,.84);
            font-size: 12px;
            font-weight: 800;
        }

        .provider img {
            width: 22px;
            height: 22px;
            border-radius: 5px;
            object-fit: cover;
        }

        .watch-link {
            display: inline-flex;
            margin-top: 14px;
            color: #ff2935;
            font-weight: 900;
            text-decoration: none;
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

        @media (max-width: 1100px) {
            .generator-grid,
            .recommendations-grid {
                grid-template-columns: 1fr;
            }

            .filters {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .hero-rec,
            .panel {
                padding: 26px;
            }

            .filters {
                grid-template-columns: 1fr;
            }

            .poster-wrap {
                height: 380px;
            }

            .section-title {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>

    <div class="rec-page">
        <div class="rec-container">
            <?php if(session('success')): ?>
                <div class="alert alert-success"><?php echo e(session('success')); ?></div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="alert alert-error"><?php echo e(session('error')); ?></div>
            <?php endif; ?>

            <section class="hero-rec">
                <p class="eyebrow">Recommandations IA</p>
                <h1>
                    Trouve ton prochain <span>coup de cœur</span>.
                </h1>
                <p>
                    Film Lib analyse ton historique, ton humeur et tes préférences pour te proposer des films et séries vraiment adaptés à toi.
                </p>
            </section>

            <section class="generator-grid">
                <div class="panel">
                    <div class="panel-icon">✦</div>
                    <h2>Mode rapide</h2>
                    <p>
                        Génère des recommandations directement à partir de tes films et séries déjà vus.
                    </p>

                    <form method="POST" action="<?php echo e(route('recommendations.generate')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-red">
                            Générer mes recommandations
                        </button>
                    </form>
                </div>

                <div class="panel">
                    <div class="panel-icon">⚙</div>
                    <h2>Mode avancé</h2>
                    <p>
                        Ajuste l’humeur, le genre, la note, l’année, le type et la plateforme.
                    </p>

                    <form method="POST" action="<?php echo e(route('recommendations.generateWithFilters')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="filters">
                            <div class="field">
                                <label>Humeur</label>
                                <select name="mood" class="form-control">
                                    <?php $__currentLoopData = $moods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($value); ?>"><?php echo e($label); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="field">
                                <label>Catégorie</label>
                                <select name="genre_label" class="form-control">
                                    <?php $__currentLoopData = $genres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($label); ?>"><?php echo e($label); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="field">
                                <label>Note TMDB minimale</label>
                                <select name="min_rating" class="form-control">
                                    <option value="">Toutes</option>
                                    <option value="5">5+</option>
                                    <option value="6">6+</option>
                                    <option value="7">7+</option>
                                    <option value="8">8+</option>
                                </select>
                            </div>

                            <div class="field">
                                <label>Année</label>
                                <input type="number" name="year" placeholder="2024" class="form-control">
                            </div>

                            <div class="field">
                                <label>Type</label>
                                <select name="type" class="form-control">
                                    <option value="">Films et séries</option>
                                    <option value="movie">Films uniquement</option>
                                    <option value="tv">Séries uniquement</option>
                                </select>
                            </div>

                            <div class="field">
                                <label>Plateforme</label>
                                <select name="platform" class="form-control">
                                    <option value="">Toutes</option>
                                    <option value="Netflix">Netflix</option>
                                    <option value="Disney Plus">Disney+</option>
                                    <option value="Amazon Prime Video">Prime Video</option>
                                    <option value="Apple TV Plus">Apple TV+</option>
                                    <option value="OCS">OCS</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-purple" style="margin-top:18px; width:100%;">
                            Générer avec filtres
                        </button>
                    </form>
                </div>
            </section>

            <div class="section-title">
                <div>
                    <p class="eyebrow">Résultats</p>
                    <h2>Suggestions personnalisées</h2>
                </div>

                <?php if($recommendations->count()): ?>
                    <span><?php echo e($recommendations->count()); ?> recommandation(s)</span>
                <?php endif; ?>
            </div>

            <?php if($recommendations->count()): ?>
                <section class="recommendations-grid">
                    <?php $__currentLoopData = $recommendations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recommendation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <article class="rec-card">
                            <div class="poster-wrap">
                                <?php if($recommendation->poster_url): ?>
                                    <img
                                        src="<?php echo e($recommendation->poster_url); ?>"
                                        alt="<?php echo e($recommendation->title); ?>"
                                        class="poster"
                                    >
                                <?php endif; ?>

                                <div class="poster-gradient"></div>

                                <span class="type-badge">
                                    <?php echo e($recommendation->media_type === 'movie' ? 'Film' : 'Série'); ?>

                                </span>
                            </div>

                            <div class="rec-content">
                                <h3><?php echo e($recommendation->title); ?></h3>

                                <p class="reason">
                                    <?php echo e($recommendation->reason); ?>

                                </p>

                                <div class="providers-title">Disponible sur</div>

                                <?php if(is_array($recommendation->watch_providers) && count($recommendation->watch_providers)): ?>
                                    <div class="providers">
                                        <?php $__currentLoopData = $recommendation->watch_providers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $provider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="provider">
                                                <?php if(!empty($provider['logo_url'])): ?>
                                                    <img src="<?php echo e($provider['logo_url']); ?>" alt="<?php echo e($provider['name']); ?>">
                                                <?php endif; ?>
                                                <span><?php echo e($provider['name']); ?></span>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>

                                    <?php if($recommendation->watch_link): ?>
                                        <a href="<?php echo e($recommendation->watch_link); ?>" target="_blank" class="watch-link">
                                            Voir les plateformes →
                                        </a>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <p class="reason">Aucune plateforme trouvée en France.</p>
                                <?php endif; ?>
                            </div>
                        </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </section>
            <?php else: ?>
                <div class="empty-state">
                    Aucune recommandation pour le moment. Lance une génération pour découvrir tes prochains films.
                </div>
            <?php endif; ?>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\laragon\www\filmlib\resources\views/recommendations/index.blade.php ENDPATH**/ ?>