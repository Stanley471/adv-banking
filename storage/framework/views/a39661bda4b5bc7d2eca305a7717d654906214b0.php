<div>
    <div class="row g-xl-8 mb-6">
        <div wire:ignore.self class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title"><?php echo e(__('Filter Bank Account')); ?></h3>
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
        <div class="col-md-6">
            <div class="d-flex justify-content-center flex-column me-3">
                <div class="input-group input-group-solid mb-5 rounded-4">
                    <span class="input-group-text" id="basic-addon1"><i class="fal fa-search"></i></span>
                    <input type="search" class="form-control form-control-solid text-dark" wire:model="search" placeholder="<?php echo e(__('Search Bank Account')); ?>" />
                </div>
            </div>
        </div>
        <div class="col-md-6 text-md-end">
            <button data-bs-toggle="modal" data-bs-target="#filter" class="btn btn-white text-dark me-4"><i class="fal fa-filter-list"></i> <?php echo e(__('Filter')); ?></button>
            <button id="kt_beneficiary_button" class="btn btn-dark me-4"><i class="fal fa-plus"></i> <?php echo e(__('Add Bank account')); ?></button>
            <div wire:ignore.self id="kt_beneficiary" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_beneficiary_button" data-kt-drawer-close="#kt_beneficiary_close" data-kt-drawer-width="{'md': '500px'}">
                <div class="card w-100">
                    <div class="card-header pe-5 border-0">
                        <div class="card-title">
                            <div class="d-flex justify-content-center flex-column me-3">
                                <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1"><?php echo e(__('Add Bank account')); ?></div>
                            </div>
                        </div>
                        <div class="card-toolbar">
                            <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_beneficiary_close">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fal fa-times"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-wrap">
                        <div class="btn-wrapper text-center mb-3">
                            <div class="symbol symbol-100px symbol-circle me-5 mb-10">
                                <div class="symbol-label fs-1 text-dark bg-light-info">
                                    <i class="fal fa-university fa-2x text-info"></i>
                                </div>
                            </div>
                        </div>
                        <div class="pb-5 mt-10 position-relative zindex-1">
                            <form class="form w-100 mb-10" wire:submit.prevent="addBank" method="post">
                                <?php $__errorArgs = ['added'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="alert alert-danger">
                                    <div class="d-flex flex-column">
                                        <span><?php echo e($message); ?></span>
                                    </div>
                                </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <div class="fv-row mb-6">
                                    <select class="form-select form-select-solid" wire:model.defer="user_bank" required>
                                        <option><?php echo e(__('Select Bank')); ?></option>
                                        <?php $__currentLoopData = $getBank; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($val->id); ?>"><?php echo e($val->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['user_bank'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="form-text"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="fv-row mb-6 form-floating">
                                    <input class="form-control form-control-lg form-control-solid fs-2 fw-bold <?php $__errorArgs = ['acct_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text" wire:model.defer="acct_no" required id="acct_no" />
                                    <label class="form-label fs-6 fw-bolder text-dark" for="acct_no"><?php echo e(__('Account Number')); ?></label>
                                    <?php $__errorArgs = ['acct_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="form-text text-danger"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="fv-row mb-6 form-floating">
                                    <input class="form-control form-control-lg form-control-solid fs-2 fw-bold <?php $__errorArgs = ['acct_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text" wire:model.defer="acct_name" required id="acct_name" />
                                    <label class="form-label fs-6 fw-bolder text-dark" for="acct_name"><?php echo e(__('Account Name')); ?></label>
                                    <?php $__errorArgs = ['acct_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="form-text text-danger"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="text-center mt-10">
                                    <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                                        <span wire:loading.remove wire:target="addBank"><?php echo e(__('Submit Request')); ?></span>
                                        <span wire:loading wire:target="addBank"><?php echo e(__('Processing Request...')); ?></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if($bank->count() > 0): ?>
    <div class="" wire:loading.class.delay="opacity-50" wire:target="search, status, orderBy, perPage, date">
        <?php $__currentLoopData = $bank; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="d-flex flex-stack">
            <div class="d-flex align-items-center">
                <div class="symbol symbol-40px me-4">
                    <span class="symbol-label" style="background-image:url(<?php echo e(url('/').'/storage/app/'.$val->bank->image); ?>);"></span>
                </div>
                <div class="ps-1">
                    <p class="fs-6 text-dark text-hover-primary fw-bolder mb-0"><?php echo e($val->bank->title.' - '.$val->acct_no); ?></p>
                    <p class="fs-6 text-gray-800 text-hover-primary mb-0"><?php echo e($val->acct_name); ?></p>
                </div>
            </div>
            <a data-bs-toggle="modal" data-bs-target="#delete<?php echo e($val->id); ?>" href="" class="btn btn-sm btn-danger"><?php echo e(__('Delete')); ?></a>
        </div>
        <?php if(!$loop->last): ?>
        <hr class="bg-light-border">
        <?php endif; ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('bank.edit', ['val' => $val])->html();
} elseif ($_instance->childHasBeenRendered('kt_edit_'. $val->id)) {
    $componentId = $_instance->getRenderedChildComponentId('kt_edit_'. $val->id);
    $componentTag = $_instance->getRenderedChildComponentTagName('kt_edit_'. $val->id);
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('kt_edit_'. $val->id);
} else {
    $response = \Livewire\Livewire::mount('bank.edit', ['val' => $val]);
    $html = $response->html();
    $_instance->logRenderedChild('kt_edit_'. $val->id, $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if($bank->total() > 0 && $bank->count() < $bank->total()): ?><button wire:click="loadMore" wire:loading.remove class="btn btn-secondary btn-block"><?php echo e(__('See more')); ?></button><?php endif; ?>
    </div>
    <?php else: ?>
    <div class="text-center mt-20">
        <img src="<?php echo e(asset('asset/images/beneficiary.png')); ?>" style="height:auto; max-width:200px;" class="mb-6">
        <h3 class="text-dark"><?php echo e(__('No Bank Account')); ?></h3>
        <p class="text-dark"><?php echo e(__('We couldn\'t find any bank account to this account')); ?></p>
    </div>
    <?php endif; ?>
</div><?php /**PATH /home/soccrquq/clovergatebank.com/resources/views/livewire/bank/index.blade.php ENDPATH**/ ?>