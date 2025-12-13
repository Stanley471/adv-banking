<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<?php $__env->startSection('content'); ?>
<div class="toolbar" id="kt_toolbar">
  <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
    <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
      <h1 class="text-dark fw-bolder my-1 fs-2 mb-6"><?php echo e(__('Settings')); ?></h1>
      <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-5 border-gray-300" id="tabs-icons-text" role="tablist">
        <li class="nav-item">
          <a class="nav-link text-dark <?php if(route('user.profile', ['type' => 'profile'])==url()->current()): ?> active <?php endif; ?>" id="tabs-icons-text-1-tab" href="<?php echo e(route('user.profile', ['type' => 'profile'])); ?>" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><?php echo e(__('Profile')); ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark <?php if(route('user.profile', ['type' => 'bank'])==url()->current()): ?> active <?php endif; ?>" id="tabs-icons-text-2-tab" href="<?php echo e(route('user.profile', ['type' => 'bank'])); ?>" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><?php echo e(__('Bank accounts')); ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark <?php if(route('user.profile', ['type' => 'beneficiary'])==url()->current()): ?> active <?php endif; ?>" id="tabs-icons-text-2-tab" href="<?php echo e(route('user.profile', ['type' => 'beneficiary'])); ?>" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><?php echo e(__('Beneficiary')); ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark <?php if(route('user.profile', ['type' => 'security'])==url()->current()): ?> active <?php endif; ?>" id="tabs-icons-text-2-tab" href="<?php echo e(route('user.profile', ['type' => 'security'])); ?>" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><?php echo e(__('Security')); ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark <?php if(route('user.profile', ['type' => 'notifications'])==url()->current()): ?> active <?php endif; ?>" id="tabs-icons-text-2-tab" href="<?php echo e(route('user.profile', ['type' => 'notifications'])); ?>" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><?php echo e(__('Notifications')); ?></a>
        </li>
      </ul>
    </div>
  </div>
  <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('settings.options', ['user' => $user, 'set' => $set, 'secret' => $secret, 'image' => $image])->html();
} elseif ($_instance->childHasBeenRendered('Qr3XY7J')) {
    $componentId = $_instance->getRenderedChildComponentId('Qr3XY7J');
    $componentTag = $_instance->getRenderedChildComponentTagName('Qr3XY7J');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('Qr3XY7J');
} else {
    $response = \Livewire\Livewire::mount('settings.options', ['user' => $user, 'set' => $set, 'secret' => $secret, 'image' => $image]);
    $html = $response->html();
    $_instance->logRenderedChild('Qr3XY7J', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
  <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
    <div class="container">
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade <?php if(route('user.profile', ['type' => 'profile'])==url()->current()): ?>show active <?php endif; ?>" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
          <div class="row">
            <div class="col-md-8">
              <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('settings.kin', ['user' => $user, 'type' => 'profile'])->html();
} elseif ($_instance->childHasBeenRendered('kZFyvlb')) {
    $componentId = $_instance->getRenderedChildComponentId('kZFyvlb');
    $componentTag = $_instance->getRenderedChildComponentTagName('kZFyvlb');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('kZFyvlb');
} else {
    $response = \Livewire\Livewire::mount('settings.kin', ['user' => $user, 'type' => 'profile']);
    $html = $response->html();
    $_instance->logRenderedChild('kZFyvlb', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
            <div class="col-md-4">
              <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('settings.avatar', ['user' => $user])->html();
} elseif ($_instance->childHasBeenRendered('njufTzy')) {
    $componentId = $_instance->getRenderedChildComponentId('njufTzy');
    $componentTag = $_instance->getRenderedChildComponentTagName('njufTzy');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('njufTzy');
} else {
    $response = \Livewire\Livewire::mount('settings.avatar', ['user' => $user]);
    $html = $response->html();
    $_instance->logRenderedChild('njufTzy', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
            <div class="col-md-12">
              <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('settings.kin', ['user' => $user, 'type' => 'kin'])->html();
} elseif ($_instance->childHasBeenRendered('uIhd5ad')) {
    $componentId = $_instance->getRenderedChildComponentId('uIhd5ad');
    $componentTag = $_instance->getRenderedChildComponentTagName('uIhd5ad');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('uIhd5ad');
} else {
    $response = \Livewire\Livewire::mount('settings.kin', ['user' => $user, 'type' => 'kin']);
    $html = $response->html();
    $_instance->logRenderedChild('uIhd5ad', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
          </div>
        </div>
        <div class="tab-pane fade <?php if(route('user.profile', ['type' => 'security'])==url()->current()): ?>show active <?php endif; ?>" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
          <?php if($user->social == 0): ?>
          <div class="d-flex flex-stack cursor-pointer mt-6" data-bs-toggle="modal" data-bs-target="#resetpassword">
            <div class="d-flex align-items-center">
              <div class="symbol symbol-45px symbol-circle me-4">
                <div class="symbol-label fs-2 fw-bolder bg-light-info">
                  <i class="fal fa-lock text-info"></i>
                </div>
              </div>
              <div class="ps-1">
                <p href="#" class="fs-6 text-gray-800 text-hover-primary fw-bolder mb-0"><?php echo e(__('Reset Password')); ?></p>
              </div>
            </div>
          </div>
          <?php endif; ?>
          <hr class="bg-light-border">
          <div class="d-flex flex-stack cursor-pointer" data-bs-toggle="modal" data-bs-target="#resetpin">
            <div class="d-flex align-items-center">
              <div class="symbol symbol-45px symbol-circle me-4">
                <div class="symbol-label fs-2 fw-bolder bg-light-info">
                  <i class="fal fa-arrow-up-from-bracket text-info"></i>
                </div>
              </div>
              <div class="ps-1">
                <p href="#" class="fs-6 text-gray-800 text-hover-primary fw-bolder mb-0"><?php echo e(__('Change your PIN')); ?></p>
              </div>
            </div>
          </div>
          <hr class="bg-light-border">
          <div class="d-flex flex-stack cursor-pointer" id="kt_fasecurity_button">
            <div class="d-flex align-items-center">
              <div class="symbol symbol-45px symbol-circle me-4">
                <div class="symbol-label fs-2 fw-bolder bg-light-info">
                  <i class="fal fa-shield text-info"></i>
                </div>
              </div>
              <div class="ps-1">
                <p href="#" class="fs-6 text-gray-800 text-hover-primary fw-bolder mb-0"><?php echo e(__('Two Factor Authentication')); ?></p>
              </div>
            </div>
          </div>
          <hr class="bg-light-border">
          <div class="d-flex flex-stack cursor-pointer" id="kt_devices_button">
            <div class="d-flex align-items-center">
              <div class="symbol symbol-45px symbol-circle me-4">
                <div class="symbol-label fs-2 fw-bolder bg-light-info">
                  <i class="fal fa-laptop text-info"></i>
                </div>
              </div>
              <div class="ps-1">
                <p href="#" class="fs-6 text-gray-800 text-hover-primary fw-bolder mb-0"><?php echo e(__('Devices & Sessions')); ?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade <?php if(route('user.profile', ['type' => 'notifications'])==url()->current()): ?>show active <?php endif; ?>" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
          <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('settings.notifications', ['user' => $user])->html();
} elseif ($_instance->childHasBeenRendered('4mWUiLw')) {
    $componentId = $_instance->getRenderedChildComponentId('4mWUiLw');
    $componentTag = $_instance->getRenderedChildComponentTagName('4mWUiLw');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('4mWUiLw');
} else {
    $response = \Livewire\Livewire::mount('settings.notifications', ['user' => $user]);
    $html = $response->html();
    $_instance->logRenderedChild('4mWUiLw', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        </div>
        <div class="tab-pane fade <?php if(route('user.profile', ['type' => 'bank'])==url()->current()): ?>show active <?php endif; ?>" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
          <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('bank.index', ['user' => $user, 'settings' => $set])->html();
} elseif ($_instance->childHasBeenRendered('ciDkXdL')) {
    $componentId = $_instance->getRenderedChildComponentId('ciDkXdL');
    $componentTag = $_instance->getRenderedChildComponentTagName('ciDkXdL');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('ciDkXdL');
} else {
    $response = \Livewire\Livewire::mount('bank.index', ['user' => $user, 'settings' => $set]);
    $html = $response->html();
    $_instance->logRenderedChild('ciDkXdL', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        </div>
        <div class="tab-pane fade <?php if(route('user.profile', ['type' => 'beneficiary'])==url()->current()): ?>show active <?php endif; ?>" id="tabs-icons-text-4" role="tabpanel" aria-labelledby="tabs-icons-text-4-tab">
          <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('beneficiary.index', ['user' => $user])->html();
} elseif ($_instance->childHasBeenRendered('r1brFCx')) {
    $componentId = $_instance->getRenderedChildComponentId('r1brFCx');
    $componentTag = $_instance->getRenderedChildComponentTagName('r1brFCx');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('r1brFCx');
} else {
    $response = \Livewire\Livewire::mount('beneficiary.index', ['user' => $user]);
    $html = $response->html();
    $_instance->logRenderedChild('r1brFCx', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/soccrquq/clovergatebank.com/resources/views/user/profile/index.blade.php ENDPATH**/ ?>