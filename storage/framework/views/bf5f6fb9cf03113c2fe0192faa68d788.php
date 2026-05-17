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

        .detail-page {
            min-height: calc(100vh - 64px);
            background:
                radial-gradient(circle at 12% 8%, rgba(229,9,20,.28), transparent 26%),
                radial-gradient(circle at 92% 18%, rgba(124,58,237,.18), transparent 28%),
                linear-gradient(180deg, #080b14 0%, #05070d 100%);
            padding: 56px 24px 80px;
        }

        .detail-container {
            max-width: 1180px;
            margin: 0 auto;
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

        .detail-card {
            overflow: hidden;
            border-radius: 32px;
            border: 1px solid rgba(255,255,255,.12);
            background:
                radial-gradient(circle at 20% 0%, rgba(229,9,20,.16), transparent 32%),
                linear-gradient(180deg, rgba(255,255,255,.08), rgba(255,255,255,.025));
            box-shadow: 0 40px 120px rgba(0,0,0,.45);
        }

        .backdrop {
            position: relative;
            height: 380px;
            overflow: hidden;
            background: rgba(255,255,255,.05);
        }

        .backdrop img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: .72;
        }

        .backdrop::after {
            content: "";
            position: absolute;
            inset: 0;
            background:
                linear-gradient(180deg, transparent 10%, rgba(5,7,13,.95) 100%),
                linear-gradient(90deg, rgba(5,7,13,.85), transparent);
        }

        .content-grid {
            display: grid;
            grid-template-columns: 310px 1fr;
            gap: 34px;
            padding: 0 42px 42px;
            margin-top: -150px;
            position: relative;
            z-index: 2;
        }

        .poster {
            width: 100%;
            border-radius: 26px;
            box-shadow: 0 35px 90px rgba(0,0,0,.55);
            border: 1px solid rgba(255,255,255,.14);
        }

        .poster-empty {
            height: 460px;
            border-radius: 26px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255,255,255,.45);
            background: linear-gradient(135deg, rgba(229,9,20,.18), rgba(255,255,255,.04));
            border: 1px solid rgba(255,255,255,.12);
        }

        .info {
            padding-top: 130px;
        }

        .badges {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 18px;
        }

        .badge {
            padding: 8px 13px;
            border-radius: 999px;
            color: white;
            background: rgba(229,9,20,.86);
            font-size: 12px;
            font-weight: 950;
        }

        .badge-green {
            background: rgba(34,197,94,.88);
        }

        .title {
            margin: 0 0 18px;
            color: white;
            font-size: clamp(38px, 6vw, 72px);
            line-height: .95;
            font-weight: 950;
            letter-spacing: -3px;
        }

        .overview {
            max-width: 760px;
            margin: 0 0 26px;
            color: rgba(255,255,255,.70);
            font-size: 18px;
            line-height: 1.7;
        }

        .meta-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
            margin-bottom: 22px;
        }

        .meta {
            padding: 16px;
            border-radius: 16px;
            background: rgba(255,255,255,.06);
            border: 1px solid rgba(255,255,255,.09);
            color: rgba(255,255,255,.70);
        }

        .meta strong {
            display: block;
            color: white;
            margin-bottom: 4px;
        }

        .text-block {
            margin-bottom: 16px;
            color: rgba(255,255,255,.70);
            line-height: 1.6;
        }

        .text-block strong {
            color: white;
        }

        .rating-panel {
            margin: 28px 0 22px;
            padding: 22px;
            border-radius: 22px;
            background: rgba(255,255,255,.06);
            border: 1px solid rgba(255,255,255,.10);
        }

        .watched-box {
            padding: 16px;
            border-radius: 16px;
            text-align: center;
            margin-bottom: 18px;
            background: rgba(255,255,255,.07);
            color: white;
            font-weight: 900;
        }

        .stars-read {
            margin-top: 8px;
            color: #facc15;
            font-size: 28px;
            letter-spacing: 2px;
        }

        .form-label {
            display: block;
            color: rgba(255,255,255,.78);
            font-size: 14px;
            font-weight: 900;
            margin-bottom: 8px;
        }

        .rating-stars {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
            gap: 5px;
            margin-bottom: 18px;
        }

        .rating-stars input {
            display: none;
        }

        .rating-stars label {
            color: rgba(255,255,255,.24);
            font-size: 36px;
            cursor: pointer;
            transition: .15s ease;
        }

        .rating-stars input:checked ~ label,
        .rating-stars label:hover,
        .rating-stars label:hover ~ label {
            color: #facc15;
        }

        .btn {
            height: 52px;
            padding: 0 24px;
            border-radius: 14px;
            border: 0;
            cursor: pointer;
            color: white;
            font-weight: 950;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: .2s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn-green {
            background: linear-gradient(135deg, #16a34a, #22c55e);
        }

        .btn-yellow {
            background: linear-gradient(135deg, #ca8a04, #facc15);
            color: #1a1200;
        }

        .back-link {
            color: #ff2935;
            font-weight: 900;
            text-decoration: none;
        }

        @media (max-width: 900px) {
            .backdrop {
                height: 300px;
            }

            .content-grid {
                grid-template-columns: 1fr;
                padding: 0 24px 32px;
                margin-top: -100px;
            }

            .poster,
            .poster-empty {
                max-width: 280px;
            }

            .info {
                padding-top: 0;
            }

            .meta-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="detail-page">
        <div class="detail-container">
            <?php if(session('success')): ?>
                <div class="alert alert-success"><?php echo e(session('success')); ?></div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="alert alert-error"><?php echo e(session('error')); ?></div>
            <?php endif; ?>

            <article class="detail-card">
                <div class="backdrop">
                    <?php if($item['backdrop_url']): ?>
                        <img src="<?php echo e($item['backdrop_url']); ?>" alt="<?php echo e($item['title']); ?>">
                    <?php endif; ?>
                </div>

                <div class="content-grid">
                    <div>
                        <?php if($item['poster_url']): ?>
                            <img src="<?php echo e($item['poster_url']); ?>" alt="<?php echo e($item['title']); ?>" class="poster">
                        <?php else: ?>
                            <div class="poster-empty">Aucune affiche</div>
                        <?php endif; ?>
                    </div>

                    <div class="info">
                        <div class="badges">
                            <span class="badge"><?php echo e($item['type'] === 'movie' ? 'Film' : 'Série'); ?></span>

                            <?php if($alreadyWatched): ?>
                                <span class="badge badge-green">Déjà vu</span>
                            <?php endif; ?>
                        </div>

                        <h1 class="title"><?php echo e($item['title']); ?></h1>

                        <p class="overview">
                            <?php echo e($item['overview'] ?: 'Aucun résumé disponible.'); ?>

                        </p>

                        <div class="meta-grid">
                            <div class="meta">
                                <strong>Date</strong>
                                <?php echo e($item['release_date'] ?: 'Non renseignée'); ?>

                            </div>

                            <div class="meta">
                                <strong>Note TMDB</strong>
                                <?php echo e($item['vote_average'] ? number_format($item['vote_average'], 1) . '/10' : 'Non renseignée'); ?>

                            </div>

                            <div class="meta">
                                <strong>Durée</strong>
                                <?php echo e($item['runtime'] ? $item['runtime'] . ' min' : 'Non renseignée'); ?>

                            </div>

                            <?php if($item['type'] === 'tv'): ?>
                                <div class="meta">
                                    <strong>Saisons</strong>
                                    <?php echo e($item['seasons'] ?? 'Non renseigné'); ?>

                                </div>

                                <div class="meta">
                                    <strong>Épisodes</strong>
                                    <?php echo e($item['episodes'] ?? 'Non renseigné'); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if(!empty($item['genres']) && count($item['genres'])): ?>
                            <p class="text-block">
                                <strong>Genres :</strong> <?php echo e(implode(', ', $item['genres'])); ?>

                            </p>
                        <?php endif; ?>

                        <?php if(!empty($item['cast']) && count($item['cast'])): ?>
                            <p class="text-block">
                                <strong>Acteurs :</strong> <?php echo e(implode(', ', $item['cast'])); ?>

                            </p>
                        <?php endif; ?>

                        <div class="rating-panel">
                            <?php if($alreadyWatched && $watchedItem): ?>
                                <div class="watched-box">
                                    <div>Déjà vu</div>

                                    <div class="stars-read">
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <?php echo e($i <= $watchedItem->rating ? '★' : '☆'); ?>

                                        <?php endfor; ?>
                                    </div>

                                    <div>Ta note : <?php echo e($watchedItem->rating); ?>/5</div>
                                </div>

                                <form method="POST" action="<?php echo e(route('watched-movies.update', $watchedItem)); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>

                                    <label class="form-label">Modifier ma note</label>

                                    <div class="rating-stars">
                                        <?php for($i = 5; $i >= 1; $i--): ?>
                                            <input
                                                type="radio"
                                                id="edit-detail-star-<?php echo e($i); ?>"
                                                name="rating"
                                                value="<?php echo e($i); ?>"
                                                <?php echo e($watchedItem->rating == $i ? 'checked' : ''); ?>

                                                required
                                            >
                                            <label for="edit-detail-star-<?php echo e($i); ?>">★</label>
                                        <?php endfor; ?>
                                    </div>

                                    <button type="submit" class="btn btn-yellow">
                                        Mettre à jour ma note
                                    </button>
                                </form>
                            <?php else: ?>
                                <form method="POST" action="<?php echo e(route('watched-movies.store')); ?>">
                                    <?php echo csrf_field(); ?>

                                    <input type="hidden" name="tmdb_id" value="<?php echo e($item['id']); ?>">
                                    <input type="hidden" name="title" value="<?php echo e($item['title']); ?>">
                                    <input type="hidden" name="poster_url" value="<?php echo e($item['poster_url']); ?>">
                                    <input type="hidden" name="media_type" value="<?php echo e($item['type']); ?>">

                                    <label class="form-label">Ma note</label>

                                    <div class="rating-stars">
                                        <?php for($i = 5; $i >= 1; $i--): ?>
                                            <input
                                                type="radio"
                                                id="star-detail-<?php echo e($i); ?>"
                                                name="rating"
                                                value="<?php echo e($i); ?>"
                                                required
                                            >
                                            <label for="star-detail-<?php echo e($i); ?>">★</label>
                                        <?php endfor; ?>
                                    </div>

                                    <button type="submit" class="btn btn-green">
                                        Ajouter à mes films vus
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>

                        <a href="<?php echo e(route('search.index')); ?>" class="back-link">
                            ← Retour à l’exploration
                        </a>
                    </div>
                </div>
            </article>
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
<?php endif; ?><?php /**PATH C:\laragon\www\filmlib\resources\views/search/show.blade.php ENDPATH**/ ?>