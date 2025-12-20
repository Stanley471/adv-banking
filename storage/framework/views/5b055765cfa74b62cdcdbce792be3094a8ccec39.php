<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<?php $__env->startSection('content'); ?>
<?php if($type == 'users'): ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.users.index', ['admin' => $admin, 'settings' => $set, 'type' => 'users'])->html();
} elseif ($_instance->childHasBeenRendered('P8ntrPl')) {
    $componentId = $_instance->getRenderedChildComponentId('P8ntrPl');
    $componentTag = $_instance->getRenderedChildComponentTagName('P8ntrPl');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('P8ntrPl');
} else {
    $response = \Livewire\Livewire::mount('admin.users.index', ['admin' => $admin, 'settings' => $set, 'type' => 'users']);
    $html = $response->html();
    $_instance->logRenderedChild('P8ntrPl', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php else: ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.users.index', ['admin' => $admin, 'settings' => $set, 'type' => 'kyc'])->html();
} elseif ($_instance->childHasBeenRendered('R9gzpEr')) {
    $componentId = $_instance->getRenderedChildComponentId('R9gzpEr');
    $componentTag = $_instance->getRenderedChildComponentTagName('R9gzpEr');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('R9gzpEr');
} else {
    $response = \Livewire\Livewire::mount('admin.users.index', ['admin' => $admin, 'settings' => $set, 'type' => 'kyc']);
    $html = $response->html();
    $_instance->logRenderedChild('R9gzpEr', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\adv-banking\resources\views/admin/user/index.blade.php ENDPATH**/ ?>