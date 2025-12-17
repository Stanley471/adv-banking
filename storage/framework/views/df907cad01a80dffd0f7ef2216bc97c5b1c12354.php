<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('ticket.user', ['user' => $user, 'settings' => $set])->html();
} elseif ($_instance->childHasBeenRendered('n9HH50k')) {
    $componentId = $_instance->getRenderedChildComponentId('n9HH50k');
    $componentTag = $_instance->getRenderedChildComponentTagName('n9HH50k');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('n9HH50k');
} else {
    $response = \Livewire\Livewire::mount('ticket.user', ['user' => $user, 'settings' => $set]);
    $html = $response->html();
    $_instance->logRenderedChild('n9HH50k', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\adv-banking\resources\views/user/support/index.blade.php ENDPATH**/ ?>