<div>
    <?php $__errorArgs = ['added'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <div class="alert alert-danger">
        <div class="d-flex flex-column">
            <span><?php echo e($message); ?></span>
        </div>
    </div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <div class="text-center">
        <a href="<?php echo e(route('home')); ?>" class="navbar-brand pe-3">
            <img class="mb-6 text-center" src="<?php echo e(asset('asset/images/logo.png')); ?>" width="200" alt="<?php echo e($set->site_name); ?>" loading="lazy">
        </a>
    </div>
    <div class="card rounded-5">
        <div class="card-body m-5">
            <form class="form" wire:submit.prevent="submitLogin" method="post">
                <?php echo csrf_field(); ?>
                <div class="text-start mb-10">
                    <h1 class="text-dark mb-3 fs-2"><?php echo e(__('Jump right back in')); ?></h1>
                    <div class="text-dark fw-bold fs-5"><?php echo e(__('New Here?')); ?>

                        <a href="<?php echo e(route('register')); ?>" class="link-info fw-bolder"><?php echo e(__('Create an Account')); ?></a>
                    </div>
                </div>
                <div class="fv-row mb-10">
                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Email')); ?></label>
                    <input class="form-control form-control-lg form-control-solid border-light" type="email" wire:model.defer="email" autocomplete="email" value="<?php echo e(old('email')); ?>" required placeholder="name@email.com" />
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="form-text"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="fv-row mb-10">
                    <div class="d-flex flex-stack mb-2">
                        <label class="form-label fw-bolder text-dark fs-6 mb-0"><?php echo e(__('Password')); ?></label>
                        <a href="<?php echo e(route('user.password.request')); ?>" class="link-info fs-6 fw-bolder"><?php echo e(__('Forgot Password ?')); ?></a>
                    </div>
                    <div class="position-relative" wire:ignore.self>
                        <input class="form-control form-control-lg form-control-solid border-light" type="password" wire:model.defer="password" autocomplete="off" required data-toggle="password" id="password" placeholder="XXXXXXXXX" />
                        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2 input-password" data-kt-password-meter-control="visibility">
                            <i class="bi bi-eye fs-2 text-dark"></i>
                        </span>
                    </div>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="form-text"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="form-check form-check-custom form-check-solid mb-6">
                    <input class="form-check-input" type="checkbox" id="flexCheckDefault" wire:model.defer="remember_me" checked />
                    <label class="form-check-label" for="flexCheckDefault"><?php echo e(__('Stayed signed in for 30 days')); ?></label>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                        <span wire:loading.remove wire:target="submitLogin"><?php echo e(__('Sign In')); ?></span>
                        <span wire:loading wire:target="submitLogin"><?php echo e(__('Signing In...')); ?></span>
                    </button>
                    <?php if($set->google_sl == 1): ?>
                    <a href="<?php echo e(route('redirect.login', ['type' => 'google'])); ?>" class="btn btn-secondary btn-block btn-lg fw-bolder my-2">
                        <img alt="Logo" src="<?php echo e(asset('dashboard/media/svg/brand-logos/google-icon.svg')); ?>" class="h-20px me-3">Sign in with Google
                    </a>
                    <?php endif; ?>
                    <?php if($set->facebook_sl == 1): ?>
                    <a href="<?php echo e(route('redirect.login', ['type' => 'facebook'])); ?>" class="btn btn-secondary btn-block btn-lg fw-bolder my-2">
                        <img alt="Logo" src="<?php echo e(asset('dashboard/media/svg/brand-logos/facebook-icon.svg')); ?>" class="h-20px me-3">Sign in with Facebook
                    </a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->startPush('scripts'); ?>
<script>
    function initPasswordToggle() {
        $('[data-toggle="password"]').each(function() {
            var input = $(this);
            var eye_btn = $(this).parent().find('.input-password');
            eye_btn.css('cursor', 'pointer').addClass('input-password-hide');
            eye_btn.on('click', function() {
                if (eye_btn.hasClass('input-password-hide')) {
                    eye_btn.removeClass('input-password-hide').addClass('input-password-show');
                    eye_btn.find('.bi').removeClass('bi-eye').addClass('bi-eye-slash')
                    input.attr('type', 'text');
                } else {
                    eye_btn.removeClass('input-password-show').addClass('input-password-hide');
                    eye_btn.find('.bi').removeClass('bi-eye-slash').addClass('bi-eye')
                    input.attr('type', 'password');
                }
            });
        });
    }
    window.livewire.on('wrongPassword', function() {
        initPasswordToggle();
    });
    document.addEventListener('livewire:load', function() {
        initPasswordToggle();
    });
    $(document).ready(function() {
        initPasswordToggle();
    });
</script>
<?php $__env->stopPush(); ?><?php /**PATH /home/soccrquq/clovergatebank.com/resources/views/livewire/auth/login.blade.php ENDPATH**/ ?>