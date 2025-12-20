<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.invest.header', ['type' => $type, 'admin' => $admin])->html();
} elseif ($_instance->childHasBeenRendered('KWLzwIH')) {
    $componentId = $_instance->getRenderedChildComponentId('KWLzwIH');
    $componentTag = $_instance->getRenderedChildComponentTagName('KWLzwIH');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('KWLzwIH');
} else {
    $response = \Livewire\Livewire::mount('admin.invest.header', ['type' => $type, 'admin' => $admin]);
    $html = $response->html();
    $_instance->logRenderedChild('KWLzwIH', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.invest.'.$type, ['type' => $type, 'admin' => $admin])->html();
} elseif ($_instance->childHasBeenRendered('E2DjxdR')) {
    $componentId = $_instance->getRenderedChildComponentId('E2DjxdR');
    $componentTag = $_instance->getRenderedChildComponentTagName('E2DjxdR');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('E2DjxdR');
} else {
    $response = \Livewire\Livewire::mount('admin.invest.'.$type, ['type' => $type, 'admin' => $admin]);
    $html = $response->html();
    $_instance->logRenderedChild('E2DjxdR', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\adv-banking\resources\views/admin/invest/index.blade.php ENDPATH**/ ?>