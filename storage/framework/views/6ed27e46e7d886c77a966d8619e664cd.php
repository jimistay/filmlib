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
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Sécurité du compte
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                <h3 class="text-lg font-semibold mb-4">
                    Double authentification
                </h3>

                <?php if(session('status') == 'two-factor-authentication-enabled'): ?>
                    <div class="mb-4 text-green-600">
                        Double authentification activée. Scanne le QR code.
                    </div>
                <?php endif; ?>

                <?php if(session('status') == 'two-factor-authentication-confirmed'): ?>
                    <div class="mb-4 text-green-600">
                        Double authentification confirmée.
                    </div>
                <?php endif; ?>

                <?php if(is_null(auth()->user()->two_factor_secret)): ?>
                    <form method="POST" action="<?php echo e(url('/user/two-factor-authentication')); ?>">
                        <?php echo csrf_field(); ?>
                        <button class="px-4 py-2 bg-blue-600 text-white rounded">
                            Activer Microsoft Authenticator
                        </button>
                    </form>
                <?php else: ?>
                    <div class="mb-6">
                        <p class="mb-2">Scanne ce QR code :</p>

                        <div class="bg-white p-4 inline-block border rounded">
                            <?php echo auth()->user()->twoFactorQrCodeSvg(); ?>

                        </div>
                    </div>

                    <?php if(is_null(auth()->user()->two_factor_confirmed_at)): ?>
                        <form method="POST" action="<?php echo e(url('/user/confirmed-two-factor-authentication')); ?>">
                            <?php echo csrf_field(); ?>

                            <input
                                type="text"
                                name="code"
                                placeholder="Code à 6 chiffres"
                                class="border p-2 w-full rounded"
                            >

                            <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-red-600 mt-2"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            <button class="mt-4 px-4 py-2 bg-green-600 text-white rounded">
                                Confirmer
                            </button>
                        </form>
                    <?php else: ?>
                        <div class="mt-6">
                            <h4 class="font-semibold">Codes de secours :</h4>

                            <div class="bg-gray-100 p-4 mt-2 rounded">
                                <?php $__currentLoopData = auth()->user()->recoveryCodes(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div><?php echo e($code); ?></div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                        <div class="mt-6 flex gap-3">
                            <form method="POST" action="<?php echo e(url('/user/two-factor-recovery-codes')); ?>">
                                <?php echo csrf_field(); ?>
                                <button class="px-4 py-2 bg-gray-600 text-white rounded">
                                    Régénérer
                                </button>
                            </form>

                            <form method="POST" action="<?php echo e(url('/user/two-factor-authentication')); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>

                                <button class="px-4 py-2 bg-red-600 text-white rounded">
                                    Désactiver
                                </button>
                            </form>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

            </div>
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
<?php endif; ?><?php /**PATH C:\laragon\www\filmlib\resources\views/profile/security.blade.php ENDPATH**/ ?>