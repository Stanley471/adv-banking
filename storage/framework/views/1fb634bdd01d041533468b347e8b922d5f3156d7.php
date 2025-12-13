<div>
    <div class="toolbar pb-0" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <h1 class="text-dark fw-bolder my-1 fs-2"><?php echo e(__('Deposit')); ?></h1>
                <ul class="breadcrumb fw-semibold fs-base my-1 mb-6">
                    <li class="breadcrumb-item text-muted">
                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-muted text-hover-primary"><?php echo e(__('Dashboard')); ?></a>
                    </li>
                    <li class="breadcrumb-item text-dark"><?php echo e(__('Deposit')); ?></li>
                    <li class="breadcrumb-item text-dark"><?php echo e(ucwords($type)); ?></li>
                </ul>
                <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-6 border-gray-300" id="tabs-icons-text" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link text-dark <?php if(route('admin.deposit', ['type' => 'pending'])==url()->current()): ?> active <?php endif; ?>" id="tabs-icons-text-1-tab" href="<?php echo e(route('admin.deposit', ['type' => 'pending'])); ?>" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><?php echo e(__('Pending')); ?> (<?php echo e(number_format_short_nc($pending)); ?>)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark <?php if(route('admin.deposit', ['type' => 'success'])==url()->current()): ?> active <?php endif; ?>" id="tabs-icons-text-2-tab" href="<?php echo e(route('admin.deposit', ['type' => 'success'])); ?>" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><?php echo e(__('Success')); ?> (<?php echo e(number_format_short_nc($success)); ?>)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark <?php if(route('admin.deposit', ['type' => 'declined'])==url()->current()): ?> active <?php endif; ?>" id="tabs-icons-text-2-tab" href="<?php echo e(route('admin.deposit', ['type' => 'declined'])); ?>" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><?php echo e(__('Declined')); ?> (<?php echo e(number_format_short_nc($declined)); ?>)</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php $__env->startPush('scripts'); ?>
<script>
    window.livewire.on('closeDrawer', function() {
        KTDrawer.hideAll();
        KTDrawer.createInstances();
    });
</script>
<?php $__env->stopPush(); ?><?php /**PATH /home/soccrquq/clovergatebank.com/resources/views/livewire/admin/deposit/header.blade.php ENDPATH**/ ?>