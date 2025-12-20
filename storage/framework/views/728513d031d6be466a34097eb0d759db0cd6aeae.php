<div>
    <div wire:ignore.self id="kt_devices_<?php echo e($val->id); ?>" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_devices_<?php echo e($val->id); ?>_button" data-kt-drawer-close="#kt_devices_<?php echo e($val->id); ?>_close" data-kt-drawer-width="{'md': '400px'}">
        <div class="card w-100">
            <div class="card-header pe-5 border-0">
                <div class="card-title">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1"><?php echo e(__('Devices & Sessions')); ?></div>
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_devices_<?php echo e($val->id); ?>_close">
                        <span class="svg-icon svg-icon-2">
                            <i class="fal fa-times"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body text-wrap">
                <div class="pb-5 mt-10 position-relative zindex-1">
                    <?php $__empty_1 = true; $__currentLoopData = $val->devices(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $device): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="d-flex flex-stack mb-6">
                        <div class="d-flex align-items-center me-2">
                            <div class="symbol symbol-45px me-5">
                                <span class="symbol-label bg-light-primary text-dark">
                                    <i class="fal fa-<?php echo e(strtolower($device->deviceType)); ?>"></i>
                                </span>
                            </div>
                            <div>
                                <p class="fs-5 text-gray-800 fw-bolder mb-0"><?php echo e($device->userAgent); ?></p>
                                <div class="fs-7 text-gray-800 fw-semibold"><?php echo e(__('Last login:')); ?> <?php echo e(\Carbon\Carbon::create($device->last_login)->format('d M, Y h:i:A')); ?></div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-center"><?php echo e(__('No Devices')); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="delete<?php echo e($val->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"><?php echo e(__('Delete User')); ?></h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="fal fa-times"></i>
                        </span>
                    </div>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this user, you can't undo this action?</p>
                    <div class="text-center">
                        <a wire:click="delete" class="btn btn-danger btn-block"><?php echo e(__('Delete user')); ?></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\adv-banking\resources\views/livewire/admin/users/edit-users.blade.php ENDPATH**/ ?>