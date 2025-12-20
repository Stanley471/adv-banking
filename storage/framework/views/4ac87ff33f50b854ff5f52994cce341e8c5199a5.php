<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.helpcenter.index')->html();
} elseif ($_instance->childHasBeenRendered('Jxj76zT')) {
    $componentId = $_instance->getRenderedChildComponentId('Jxj76zT');
    $componentTag = $_instance->getRenderedChildComponentTagName('Jxj76zT');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('Jxj76zT');
} else {
    $response = \Livewire\Livewire::mount('admin.helpcenter.index');
    $html = $response->html();
    $_instance->logRenderedChild('Jxj76zT', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>;
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\adv-banking\resources\views/admin/helpcenter/index.blade.php ENDPATH**/ ?>