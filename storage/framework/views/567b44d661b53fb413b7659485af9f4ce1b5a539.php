<div>
    <div wire:ignore.self class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"><?php echo e(__('Filter Messages')); ?></h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="fal fa-times"></i>
                        </span>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="fv-row mb-6">
                        <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Sort by')); ?></label>
                        <select class="form-select form-select-solid" wire:model="sortBy">
                            <option value="asc"><?php echo e(__('ASC')); ?></option>
                            <option value="desc"><?php echo e(__('DESC')); ?></option>
                        </select>
                    </div>
                    <div class="fv-row mb-6">
                        <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Order by')); ?></label>
                        <select class="form-select form-select-solid" wire:model="orderBy">
                            <option value="created_at"><?php echo e(__('Date')); ?></option>
                        </select>
                    </div>
                    <div class="fv-row mb-6">
                        <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Per page')); ?></label>
                        <select class="form-select form-select-solid" wire:model="perPage">
                            <option value="10"><?php echo e(__('10')); ?></option>
                            <option value="25"><?php echo e(__('25')); ?></option>
                            <option value="50"><?php echo e(__('50')); ?></option>
                            <option value="100"><?php echo e(__('100')); ?></option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
        <div class="container">
            <div class="row g-xl-8">
                <div class="col-md-6">
                    <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                        <div class="input-group input-group-solid mb-5 rounded-4">
                            <span class="input-group-text" id="basic-addon1"><i class="fal fa-search"></i></span>
                            <input type="search" class="form-control form-control-solid text-dark" wire:model="search" placeholder="<?php echo e(__('Search messages')); ?>" />
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <button data-bs-toggle="modal" data-bs-target="#deleteall" disabled id="deleteAll" class="btn btn-danger me-4"><i class="fal fa-trash"></i> <?php echo e(__('Delete')); ?></button>
                    <button data-bs-toggle="modal" data-bs-target="#filter" class="btn btn-dark me-4"><i class="fal fa-filter-list"></i> <?php echo e(__('Filter')); ?></button>
                </div>
            </div>
            <div wire:ignore.self class="modal fade" id="deleteall" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title"><?php echo e(__('Delete Message')); ?></h3>
                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <span class="svg-icon svg-icon-1">
                                    <i class="fal fa-times"></i>
                                </span>
                            </div>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this?</p>
                            <div class="text-center">
                                <a wire:click="deleteAll" class="btn btn-danger btn-block"><?php echo e(__('Delete')); ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if($message->count() > 0): ?>
            <div class="table-responsive">
                <table id="kt_datatable_zero_configuration" class="table table-row-bordered gy-5" wire:loading.class.delay="opacity-50" wire:target="search, status, sortBy, orderBy, perPage, loadMore">
                    <thead>
                        <tr class="fw-semibold fs-6 text-muted">
                            <th>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" id="all" wire:model="all" wire:click="setAll" />
                                </div>
                            </th>
                            <th class="min-w-20px"><?php echo e(__('S/N')); ?></th>
                            <th class="min-w-250px"><?php echo e(__('Subject')); ?></th>
                            <th class="min-w-150px"><?php echo e(__('Created')); ?></th>
                            <th class="scope"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $message; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" id="check<?php echo e($val->id); ?>" wire:model="archive.<?php echo e($val->id); ?>" wire:click="checked" />
                                </div>
                            </td>
                            <td><?php echo e($loop->iteration); ?>.</td>
                            <td><?php echo e(substr($val->subject, 0, 70)); ?>...</td>
                            <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->created_at))); ?></td>
                            <td class="text-center">
                                <button id="kt_message_<?php echo e($val->id); ?>_button" class="btn btn-sm btn-light-info">Details</button>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php if($message->total() > 0 && $message->count() < $message->total()): ?><button wire:click="loadMore" wire:loading.remove class="btn btn-secondary btn-block"><?php echo e(__('See more')); ?></button><?php endif; ?>
            </div>
            <?php else: ?>
            <div class="text-center mt-20">
                <img src="<?php echo e(asset('asset/images/beneficiary.png')); ?>" style="height:auto; max-width:250px;" class="mb-6">
                <h3 class="text-dark"><?php echo e(__('No Message Found')); ?></h3>
                <p class="text-dark"><?php echo e(__('We couldn\'t find any message in your inbox')); ?></p>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <?php $__currentLoopData = $message; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.message.sent-message', ['val' => $val,'type' => $type,'admin' => $admin])->html();
} elseif ($_instance->childHasBeenRendered('kt_message_'. $val->id)) {
    $componentId = $_instance->getRenderedChildComponentId('kt_message_'. $val->id);
    $componentTag = $_instance->getRenderedChildComponentTagName('kt_message_'. $val->id);
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('kt_message_'. $val->id);
} else {
    $response = \Livewire\Livewire::mount('admin.message.sent-message', ['val' => $val,'type' => $type,'admin' => $admin]);
    $html = $response->html();
    $_instance->logRenderedChild('kt_message_'. $val->id, $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->startPush('scripts'); ?>
<script>
    window.livewire.on('closeDrawer', function() {
        KTDrawer.hideAll();
        KTDrawer.createInstances();
    });
    window.livewire.on('closeModal', function() {
        $('#deleteall').modal('hide');
    });
    window.livewire.on('clearMarkAll', function() {
        $('#add').val(0);
    });
    window.livewire.on('updatemarked', function(data) {
        $('#deleteAll').attr('disabled', (data == 1) ? false : true);
    });
    window.livewire.on('drawer', data => {
        KTDrawer.hideAll();
        KTDrawer.createInstances();
    });
</script>
<?php $__currentLoopData = $message; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<script>
    $(document).on('click', '#readMore<?php echo e($val->id); ?>', function(e) {
        e.preventDefault();
        $('#main-data<?php echo e($val->id); ?>').hide();
        $('#main-data-hide<?php echo e($val->id); ?>').show();
    });
    $(document).on('click', '#readLess<?php echo e($val->id); ?>', function(e) {
        e.preventDefault();
        $('#main-data<?php echo e($val->id); ?>').show();
        $('#main-data-hide<?php echo e($val->id); ?>').hide();
    });
</script>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopPush(); ?><?php /**PATH C:\xampp\htdocs\adv-banking\resources\views/livewire/admin/users/sent-emails.blade.php ENDPATH**/ ?>