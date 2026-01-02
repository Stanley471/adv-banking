<?php $__env->startSection('content'); ?>
<div class="toolbar" id="kt_toolbar">
    <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
        <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
            <h1 class="text-dark fw-bolder my-1 fs-2"><?php echo e(__('Invest')); ?></h1>
            <ul class="breadcrumb fw-semibold fs-base my-1 mb-6">
                <li class="breadcrumb-item text-muted">
                    <a href="<?php echo e(route('user.dashboard')); ?>" class="text-muted text-hover-primary">Dashboard </a>
                </li>
                <li class="breadcrumb-item text-dark"><?php echo e(__('Invest')); ?></li>
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
    $html = \Livewire\Livewire::mount('plans.index', ['user' => $user])->html();
} elseif ($_instance->childHasBeenRendered('ZyUhpI1')) {
    $componentId = $_instance->getRenderedChildComponentId('ZyUhpI1');
    $componentTag = $_instance->getRenderedChildComponentTagName('ZyUhpI1');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('ZyUhpI1');
} else {
    $response = \Livewire\Livewire::mount('plans.index', ['user' => $user]);
    $html = $response->html();
    $_instance->logRenderedChild('ZyUhpI1', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
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
<?php $__env->startSection('script'); ?>
<script>
    "use strict"
    $('#hide_balance').on('click', function() {
        $('#main_balance').text('************');
        $('#reveal_balance').show();
        $('#hide_balance').hide();
    });
    $('#reveal_balance').on('click', function() {
        $('#main_balance').text("<?php echo e(currencyFormat(number_format($user->followed()->sum('amount'),2)).' '.$currency->currency); ?>");
        $('#hide_balance').show();
        $('#reveal_balance').hide();
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\adv-banking\resources\views/user/plan/index.blade.php ENDPATH**/ ?>