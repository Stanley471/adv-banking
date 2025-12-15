<div id="kt_notify_account" class="bg-white" x-data="{ isDrawer: false }" x-init="isDrawer = false" x-bind:class="{ 'bg-white drawer drawer-end drawer-on': isDrawer }" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_notify_button" data-kt-drawer-close="#kt_notify_close">
    <div class="card w-100">
        <div class="card-header pe-5">
            <div class="card-title">
                <div class="d-flex justify-content-center flex-column me-3">
                    <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1"><?php echo e(__('Notifications')); ?></div>
                </div>
            </div>
            <div class="card-toolbar">
                <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_drawer_example_basic_close">
                    <span class="svg-icon svg-icon-2">
                        <i class="fal fa-times"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="card-body text-wrap">
            <?php $__empty_1 = true; $__currentLoopData = $unread; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $announcement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="overflow-auto pb-5">
                <div class="notice bg-light rounded min-w-lg-400px flex-shrink-0 p-6">
                    <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                        <div class="mb-3 mb-md-0 fw-semibold">
                            <h5 class="text-dark fw-bolder fs-6"><?php echo e($announcement['data']['title']); ?></h5>

                            <div class="fs-6 text-dark pe-7"><?php echo e($announcement['data']['body']); ?></div>
                            <div class="fs-7 text-gray-700 pe-7"><?php echo e($announcement->created_at->diffForHumans()); ?></div>
                        </div>
                        <?php if($announcement->read_at === null): ?>
                        <button x-data x-on:click.prevent="isDrawer = true; $wire.markAsRead('<?php echo e($announcement->id); ?>')" class="btn btn-info btn-sm px-6 align-self-center text-nowrap"> <i class="fal fa-thumbs-up"></i> <?php echo e(__('Read')); ?> </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="flex items-center justify-between">
                <p tabindex="0" class="focus:outline-none fs-4 flex flex-shrink-0 leading-normal px-3 py-16 text-gray-500">
                    <?php echo e(__('No notifications')); ?>

                </p>
            </div>
            <?php endif; ?>

        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\adv-banking\resources\views/vendor/megaphone/popout.blade.php ENDPATH**/ ?>