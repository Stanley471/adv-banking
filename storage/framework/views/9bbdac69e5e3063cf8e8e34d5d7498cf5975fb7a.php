<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<?php $__env->startSection('content'); ?>
<?php if($type == 'users'): ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.users.index', ['admin' => $admin, 'settings' => $set, 'type' => 'users'])->html();
} elseif ($_instance->childHasBeenRendered('2uQxWCr')) {
    $componentId = $_instance->getRenderedChildComponentId('2uQxWCr');
    $componentTag = $_instance->getRenderedChildComponentTagName('2uQxWCr');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('2uQxWCr');
} else {
    $response = \Livewire\Livewire::mount('admin.users.index', ['admin' => $admin, 'settings' => $set, 'type' => 'users']);
    $html = $response->html();
    $_instance->logRenderedChild('2uQxWCr', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php else: ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.users.index', ['admin' => $admin, 'settings' => $set, 'type' => 'kyc'])->html();
} elseif ($_instance->childHasBeenRendered('2Rdpuhl')) {
    $componentId = $_instance->getRenderedChildComponentId('2Rdpuhl');
    $componentTag = $_instance->getRenderedChildComponentTagName('2Rdpuhl');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('2Rdpuhl');
} else {
    $response = \Livewire\Livewire::mount('admin.users.index', ['admin' => $admin, 'settings' => $set, 'type' => 'kyc']);
    $html = $response->html();
    $_instance->logRenderedChild('2Rdpuhl', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/soccrquq/clovergatebank.com/resources/views/admin/user/index.blade.php ENDPATH**/ ?>