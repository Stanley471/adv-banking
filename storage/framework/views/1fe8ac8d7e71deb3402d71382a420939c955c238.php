<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('ticket.header', ['type' => $type, 'admin' => $admin])->html();
} elseif ($_instance->childHasBeenRendered('W9aqXFT')) {
    $componentId = $_instance->getRenderedChildComponentId('W9aqXFT');
    $componentTag = $_instance->getRenderedChildComponentTagName('W9aqXFT');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('W9aqXFT');
} else {
    $response = \Livewire\Livewire::mount('ticket.header', ['type' => $type, 'admin' => $admin]);
    $html = $response->html();
    $_instance->logRenderedChild('W9aqXFT', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('ticket.'.$type, ['type' => $type, 'admin' => $admin])->html();
} elseif ($_instance->childHasBeenRendered('GvcVDAu')) {
    $componentId = $_instance->getRenderedChildComponentId('GvcVDAu');
    $componentTag = $_instance->getRenderedChildComponentTagName('GvcVDAu');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('GvcVDAu');
} else {
    $response = \Livewire\Livewire::mount('ticket.'.$type, ['type' => $type, 'admin' => $admin]);
    $html = $response->html();
    $_instance->logRenderedChild('GvcVDAu', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\adv-banking\resources\views/admin/support/index.blade.php ENDPATH**/ ?>