<?php $__env->startSection('content'); ?>
<div class="toolbar" id="kt_toolbar">
    <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
        <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
            <h1 class="text-dark fw-bolder my-1 fs-2"><?php echo e(__('Save')); ?></h1>
            <ul class="breadcrumb fw-semibold fs-base my-1 mb-6">
                <li class="breadcrumb-item text-muted">
                    <a href="<?php echo e(route('user.dashboard')); ?>" class="text-muted text-hover-primary">Dashboard </a>
                </li>
                <li class="breadcrumb-item text-dark"><?php echo e(__('Plans')); ?></li>
            </ul>
        </div>
    </div>
    <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
        <div class="container">
            <div class="row g-xl-8">
                <div class="col-xl-12">
                    <div class="card bg-transparent card-xl-stretch mb-5 mb-xl-8">
                        <div class="card-body p-0 pb-9">
                            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('savings.index', ['user' => $user, 'settings' => $set])->html();
} elseif ($_instance->childHasBeenRendered('sYTiBlA')) {
    $componentId = $_instance->getRenderedChildComponentId('sYTiBlA');
    $componentTag = $_instance->getRenderedChildComponentTagName('sYTiBlA');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('sYTiBlA');
} else {
    $response = \Livewire\Livewire::mount('savings.index', ['user' => $user, 'settings' => $set]);
    $html = $response->html();
    $_instance->logRenderedChild('sYTiBlA', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\adv-banking\resources\views/user/savings/index.blade.php ENDPATH**/ ?>