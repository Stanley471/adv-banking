<?php $__env->startSection('content'); ?>
<div class="py-10">
  <div class="p-10 p-lg-15 mx-auto">
    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('auth.login', ['set' => $set])->html();
} elseif ($_instance->childHasBeenRendered('zp3SvaJ')) {
    $componentId = $_instance->getRenderedChildComponentId('zp3SvaJ');
    $componentTag = $_instance->getRenderedChildComponentTagName('zp3SvaJ');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('zp3SvaJ');
} else {
    $response = \Livewire\Livewire::mount('auth.login', ['set' => $set]);
    $html = $response->html();
    $_instance->logRenderedChild('zp3SvaJ', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
  </div>
</div>
<?php echo $__env->make('partials.external', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('auth.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\adv-banking\resources\views/auth/login.blade.php ENDPATH**/ ?>