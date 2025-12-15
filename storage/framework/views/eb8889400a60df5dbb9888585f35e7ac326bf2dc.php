<?php $__env->startSection('content'); ?>
<div class="py-10">
  <div class="p-10 p-lg-15 mx-auto">
    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('auth.login', ['set' => $set])->html();
} elseif ($_instance->childHasBeenRendered('VBSv9WR')) {
    $componentId = $_instance->getRenderedChildComponentId('VBSv9WR');
    $componentTag = $_instance->getRenderedChildComponentTagName('VBSv9WR');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('VBSv9WR');
} else {
    $response = \Livewire\Livewire::mount('auth.login', ['set' => $set]);
    $html = $response->html();
    $_instance->logRenderedChild('VBSv9WR', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
  </div>
</div>
<?php echo $__env->make('partials.external', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('auth.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\adv-banking\resources\views/auth/login.blade.php ENDPATH**/ ?>