<?php $__env->startSection('content'); ?>
<div class="py-10">
    <div class="p-10 p-lg-15 mx-auto">
        <div class="text-center">
            <a href="<?php echo e(route('home')); ?>" class="navbar-brand pe-3">
                <img class="mb-6 text-center" src="<?php echo e(asset('asset/images/logo.png')); ?>" width="200" alt="<?php echo e($set->site_name); ?>" loading="lazy">
            </a>
        </div>
        <div class="card rounded-5">
            <div class="card-body m-5">
                <form class="form w-100" action="<?php echo e(route('confirm.otp')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="text-start mb-10">
                        <h1 class="text-dark mb-3 fs-2"><?php echo e(__('Enter your One Time Password')); ?></h1>
                        <div class="text-dark fw-bold fs-5"><?php echo e(__('Input the OTP we sent to')); ?> <?php echo e($user->email); ?></div>
                        <p class="text-muted"><?php echo e(__('You can')); ?> <a href="<?php echo e(route('resend.otp')); ?>" class="resend-sms text-info"><u><?php echo e(__('resend')); ?></u></a> <?php echo e(__('Email after')); ?> <span id="timer" class="font-weight-bold text-indigo text-lg"></span></p>
                    </div>
                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Code')); ?></label>
                        <input class="form-control form-control-lg form-control-solid border-light" name="code" type="tel" minlength="4" maxlength="6" pattern="[0-9]+" autocomplete="one-time-code" value="<?php echo e(old('code')); ?>" required placeholder="XXXXXX" autofocus onkeyup="this.value=removeSpacesPin(this.value);" onmouseout="this.value=removeSpacesPin(this.value);" />
                        <?php $__errorArgs = ['code'];
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
                    <?php if($set->recaptcha==1): ?>
                    <?php echo RecaptchaV3::field('otp'); ?>

                    <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="form-text"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <?php endif; ?>
                    <div class="text-center">
                        <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                            <span class="indicator-label"><?php echo e(__('Verify OTP')); ?></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php echo $__env->make('partials.external', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
    var countDownDate = moment("<?php echo e(Carbon\Carbon::create($user->email_time)->addMinutes(5)->toDateTimeString()); ?>").valueOf();

    var x = setInterval(function() {
        var now = moment.utc().valueOf();
        var distance = countDownDate - now + (1 * 60 * 60 * 1000);
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)).toString().padStart(2, '0');
        var seconds = Math.floor((distance % (1000 * 60)) / 1000).toString().padStart(2, '0');
        document.getElementById("timer").innerHTML = minutes + ":" + seconds;
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("timer").innerHTML = "0:00";
            $('.resend-sms').attr('disabled', false);
        }
    }, 1);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('auth.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\adv-banking\resources\views/auth/otp.blade.php ENDPATH**/ ?>