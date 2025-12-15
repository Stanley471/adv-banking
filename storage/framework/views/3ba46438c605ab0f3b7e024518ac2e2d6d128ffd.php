<div>
    <!--begin::Menu wrapper-->
    <div>
        <div class="cursor-pointer symbol symbol-40px symbol-circle" data-kt-menu-trigger="{default: 'click'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
            <?php if($user->avatar == null): ?>
            <div class="symbol-label fs-3 text-dark"><?php echo e(strtoupper(substr($user->business->name, 0, 2))); ?></div>
            <?php else: ?>
            <div class="symbol-label" style="background-image:url(<?php echo e(url('/').'/storage/app/'.$user->avatar); ?>)"></div>
            <?php endif; ?>
        </div>
        <!--begin::User account menu-->
        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true" style="">
            <!--begin::Menu item-->
            <div class="menu-item px-3">
                <div class="menu-content d-flex align-items-center px-3">
                    <!--begin::Avatar-->
                    <div class="symbol symbol-50px symbol-circle me-5">
                        <?php if($user->avatar == null): ?>
                        <div class="symbol-label fs-3 text-dark"><?php echo e(strtoupper(substr($user->business->name, 0, 2))); ?></div>
                        <?php else: ?>
                        <div class="symbol-label" style="background-image:url(<?php echo e(url('/').'/storage/app/'.$user->avatar); ?>)"></div>
                        <?php endif; ?>
                    </div>
                    <!--end::Avatar-->

                    <!--begin::Username-->
                    <div class="d-flex flex-column">
                        <div class="fw-bolder d-flex align-items-center fs-5">
                            <?php echo e($user->business->name); ?>

                        </div>

                        <div class="fw-semibold text-hover-primary fs-5">
                            <?php echo e($user->email); ?>

                        </div>
                    </div>
                    <!--end::Username-->
                </div>
            </div>

            <div class="separator"></div>

            <div class="menu-item px-5 mb-0">
                <a href="<?php echo e(route('user.ticket')); ?>" class="menu-link px-5 py-3">
                    <i class="fal fa-clipboard-list-check me-3"></i> <?php echo e(__('Support Ticket')); ?>

                </a>
            </div>

            <div class="separator"></div>
            <div class="menu-item px-5 mb-0">
                <a href="<?php echo e(route('user.profile', ['type' => 'profile'])); ?>" class="menu-link px-5 py-3">
                    <i class="fal fa-user me-3"></i> <?php echo e(__('My Profile')); ?>

                </a>
            </div>

            <div class="separator"></div>

            <div class="menu-item px-5 mb-0">
                <a href="<?php echo e(route('user.logout')); ?>" class="menu-link px-5 py-3">
                    <i class="fal fa-sign-out me-3"></i> <?php echo e(__('Sign Out')); ?>

                </a>
            </div>
            <!--end::Menu item-->
        </div>
    </div>
    <!--end::User account menu-->
    <!--end::Menu wrapper-->
</div><?php /**PATH C:\xampp\htdocs\adv-banking\resources\views/livewire/settings/logout.blade.php ENDPATH**/ ?>