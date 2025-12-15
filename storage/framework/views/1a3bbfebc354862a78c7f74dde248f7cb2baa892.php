<div>
    <!-- Styles scoped to this login component: card size, background, and underline inputs -->
    <style>
        .login-card { width: 75%; min-width: 0;  border: 3px solid grey; }
        .login-card .card-body { padding: 1.5rem; }
        .underline-input { border: 0; border-bottom: 1px solid #d1d5db; border-radius: 0; box-shadow: none; background-color: transparent; } !important;
        .underline-input:focus { box-shadow: none; border-bottom-color: #0d6efd; outline: none; }
        @media (max-width: 576px) { .login-card { width: 92%; } }

        .card {
    background: rgba(92, 78, 78, 0.15) !important;
    backdrop-filter: blur(12px) !important;
    -webkit-backdrop-filter: blur(12px) !important;
        text-shadow: 1px 1px #ffffff;
        color: #27173E !important;
    border-radius: 24px !important;
    box-shadow: 0 20px 50px rgba(0,0,0,0.35) !important;
    border: 1px solid rgba(255,255,255,0.25) !important;
}

    </style>
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
    <!--<div class="text-center">
        <a href="" class="navbar-brand pe-3">
            <img class="mb-6 text-center" src="}" width="200" alt="<?php echo e($set->site_name); ?>" loading="lazy">
        </a>
    </div>-->
   
    <div class="section mt-2 text-center">
		    <a href="<?php echo e(route('home')); ?>" >
			<img src="<?php echo e(asset('asset/images/logo.png')); ?>" width="150px">
			</a>
		</div>
    <div class="card rounded-5 login-card mx-auto">
        <div class="card-body p-4">
            <form class="form" wire:submit.prevent="submitLogin" method="post">
                <?php echo csrf_field(); ?>
                
                <div class="fv-row mb-10">
                    <label class="form-label fs-6 fw-bolder "><?php echo e(__('Account ID')); ?></label>
                    <input class="form-control form-control-lg underline-input" type="email" wire:model.defer="email" autocomplete="email" value="<?php echo e(old('email')); ?>"  />
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
                        <label class="form-label fw-bolder text-d fs-6 mb-0"><?php echo e(__('Password')); ?></label>
                    </div>
                    <div class="position-relative" wire:ignore.self>
                        <input class="form-control form-control-lg underline-input" type="password" wire:model.defer="password" autocomplete="off" required data-toggle="password" id="password" />
                       
                                                <a href="<?php echo e(route('user.password.request')); ?>" style="text-decoration: none; color: #27173E" ><?php echo e(__('Forgot Password?')); ?></a>

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
                
                <div class="text-center">
                    <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                        <span wire:loading.remove wire:target="submitLogin"><?php echo e(__('Sign In')); ?></span>
                        <span wire:loading wire:target="submitLogin"><?php echo e(__('Signing In...')); ?></span>
                    </button>
                   
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
<?php $__env->stopPush(); ?>

<?php /**PATH C:\xampp\htdocs\adv-banking\resources\views/livewire/auth/login.blade.php ENDPATH**/ ?>