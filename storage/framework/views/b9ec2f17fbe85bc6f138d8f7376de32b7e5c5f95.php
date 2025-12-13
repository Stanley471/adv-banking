<!doctype html>
<html class="no-js" lang="en">

<head>
  <title><?php echo e($title); ?> - <?php echo e($set->site_name); ?></title>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="robots" content="index, follow">
  <meta name="apple-mobile-web-app-title" content="<?php echo e($set->site_name); ?>" />
  <meta name="application-name" content="<?php echo e($set->site_name); ?>" />
  <meta name="description" content="<?php echo e($set->site_desc); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="shortcut icon" href="<?php echo e(asset('asset/images/favicon.png')); ?>" />
  <link href="<?php echo e(asset('asset/fonts/fontawesome/css/all.css')); ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo e(asset('dashboard/plugins/global/plugins.bundle.css')); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo e(asset('dashboard/css/style.bundle.css')); ?>" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css" />
  <?php echo \Livewire\Livewire::styles(); ?>

  <?php echo $__env->yieldContent('css'); ?>
  <?php echo $__env->make('partials.font', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>

<body id="kt_body" class="bg-light auth-bg header-fixed header-tablet-and-mobile-fixed toolbar-enabled aside-fixed aside-default-enabled">
  <div class="page-loading active text-indigo">
    <div class="page-loading-inner">
      <div class="page-spinner"></div><span></span>
    </div>
  </div>
  <!--begin::Main-->
  <div class="row justify-content-center">
    <div class="col-md-6">
      <?php echo $__env->yieldContent('content'); ?>
    </div>
  </div>
  <?php echo $set->livechat; ?>

  <?php echo $set->analytic_snippet; ?>

  <script src="<?php echo e(asset('dashboard/plugins/global/plugins.bundle.js')); ?>"></script>
  <script src="<?php echo e(asset('dashboard/js/scripts.bundle.js')); ?>"></script>
  <script src="<?php echo e(asset('asset/fonts/fontawesome/js/all.js')); ?>"></script>
  <script src="<?php echo e(asset('dashboard/js/custom/general.js')); ?>"></script>
</body>

</html>
<?php echo \Livewire\Livewire::scripts(); ?>

<?php echo $__env->yieldPushContent('scripts'); ?>
<?php echo $__env->yieldContent('script'); ?>
<?php if(session('success')): ?>
<script>
  "use strict";
  toastr.options.positionClass = 'toast-bottom-right';
  toastr.options.closeButton = true;
  toastr.success("<?php echo session('success'); ?>");
</script>
<?php endif; ?>

<?php if(session('alert')): ?>
<script>
  "use strict";
  toastr.options.positionClass = 'toast-bottom-right';
  toastr.options.closeButton = true;
  toastr.warning("<?php echo session('alert'); ?>");
</script>
<?php endif; ?>

<?php if($set->recaptcha==1): ?>
<?php echo RecaptchaV3::initJs(); ?>

<?php endif; ?>

<script>
  (function() {
    window.onload = function() {
      const preloader = document.querySelector('.page-loading');
      preloader.classList.remove('active');
      setTimeout(function() {
        preloader.remove();
      }, 1000);
    };
  })();
</script><?php /**PATH /home/soccrquq/clovergatebank.com/resources/views/auth/menu.blade.php ENDPATH**/ ?>