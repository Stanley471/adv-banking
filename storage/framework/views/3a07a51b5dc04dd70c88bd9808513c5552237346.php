<div>
    <div class="row g-xl-8 mb-6">
        <div wire:ignore.self class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title"><?php echo e(__('Filter Beneficiary')); ?></h3>
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
        <div class="col-md-8">
            <div class="d-flex justify-content-center flex-column me-3">
                <div class="input-group input-group-solid mb-5 rounded-4">
                    <span class="input-group-text" id="basic-addon1"><i class="fal fa-search"></i></span>
                    <input type="search" class="form-control form-control-solid text-dark" wire:model="search" placeholder="<?php echo e(__('Search Beneficiary')); ?>" />
                </div>
            </div>
        </div>
        <div class="col-md-4 text-md-end">
            <button data-bs-toggle="modal" data-bs-target="#filter" class="btn btn-white text-dark me-4"><i class="fal fa-filter-list"></i> <?php echo e(__('Filter')); ?></button>
            <button id="kt_beneficiary_button" class="btn btn-dark me-4"><i class="fal fa-plus"></i> <?php echo e(__('Add Beneficiary')); ?></button>
            <div wire:ignore.self id="kt_beneficiary" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_beneficiary_button" data-kt-drawer-close="#kt_beneficiary_close" data-kt-drawer-width="{'md': '500px'}">
                <div class="card w-100">
                    <div class="card-header pe-5 border-0">
                        <div class="card-title">
                            <div class="d-flex justify-content-center flex-column me-3">
                                <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1"><?php echo e(__('Add Beneficiary')); ?></div>
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
                                    <i class="fal fa-users fa-2x text-info"></i>
                                </div>
                            </div>
                        </div>
                        <div class="pb-5 mt-10 position-relative zindex-1">
                            <form class="form w-100 mb-10" wire:submit.prevent="addBeneficiary" method="post">
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
                                <div class="fv-row mb-6 form-floating">
                                    <input class="form-control form-control-lg form-control-solid fs-2 fw-bold <?php $__errorArgs = ['merchantId'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text" wire:model.defer="merchantId" id="tag" />
                                    <label class="form-label fs-6 fw-bolder text-dark" for="merchant_id"><?php echo e(__('Merchant ID')); ?></label>
                                    <?php $__errorArgs = ['merchantId'];
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
                                <div class="bg-light-primary px-6 py-5 mb-10 rounded">
                                    <p class="text-dark fw-bold fs-6 mb-0"><?php echo e(__('Recipient')); ?>: <span id="recipient">-</span></p>
                                </div>
                                <div class="text-center mt-10">
                                    <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                                        <span wire:loading.remove wire:target="addBeneficiary"><?php echo e(__('Submit Request')); ?></span>
                                        <span wire:loading wire:target="addBeneficiary"><?php echo e(__('Processing Request...')); ?></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if($beneficiary->count() > 0): ?>
    <div class="" wire:loading.class.delay="opacity-50" wire:target="search, status, orderBy, perPage, date">
        <?php $__currentLoopData = $beneficiary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="d-flex flex-stack">
            <div class="d-flex align-items-center">
                <div class="symbol symbol-40px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="<?php echo e($val->recipient->business->name); ?>">
                    <?php if($val->recipient->avatar == null): ?>
                    <span class="symbol-label bg-info text-inverse-info fw-boldest"><?php echo e(substr(ucwords($val->recipient->business->name), 0, 1)); ?></span>
                    <?php else: ?>
                    <div class="symbol-label" style="background-image:url(<?php echo e(url('/').'/storage/app/'.$val->recipient->avatar); ?>)"></div>
                    <?php endif; ?>
                </div>
                <div class="ps-1">
                    <p class="fs-6 text-dark text-hover-primary fw-bolder mb-0"><?php echo e($val->recipient->business->name); ?></p>
                    <p class="fs-6 text-gray-800 text-hover-primary mb-0"><?php echo e($val->merchant_id); ?></p>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <a id="kt_transfer_<?php echo e($val->id); ?>_button" href="" class="btn btn-sm btn-secondary me-3"><i class="fal fa-arrow-up-from-bracket"></i> <?php echo e(__('Send Money')); ?></a>
                <a data-bs-toggle="modal" data-bs-target="#delete<?php echo e($val->id); ?>" href="" class="btn btn-sm btn-danger"><?php echo e(__('Delete')); ?></a>
            </div>
        </div>
        <?php if(!$loop->last): ?>
        <hr class="bg-light-border">
        <?php endif; ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('beneficiary.edit', ['val' => $val,'user' => $user,'settings' => $set])->html();
} elseif ($_instance->childHasBeenRendered('kt_edit_'. $val->id)) {
    $componentId = $_instance->getRenderedChildComponentId('kt_edit_'. $val->id);
    $componentTag = $_instance->getRenderedChildComponentTagName('kt_edit_'. $val->id);
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('kt_edit_'. $val->id);
} else {
    $response = \Livewire\Livewire::mount('beneficiary.edit', ['val' => $val,'user' => $user,'settings' => $set]);
    $html = $response->html();
    $_instance->logRenderedChild('kt_edit_'. $val->id, $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if($beneficiary->total() > 0 && $beneficiary->count() < $beneficiary->total()): ?><button wire:click="loadMore" wire:loading.remove class="btn btn-secondary btn-block"><?php echo e(__('See more')); ?></button><?php endif; ?>
    </div>
    <?php else: ?>
    <div class="text-center mt-20">
        <img src="<?php echo e(asset('asset/images/beneficiary.png')); ?>" style="height:auto; max-width:200px;" class="mb-6">
        <h3 class="text-dark"><?php echo e(__('No Beneficiary')); ?></h3>
        <p class="text-dark"><?php echo e(__('We couldn\'t find any beneficiary to this account')); ?></p>
    </div>
    <?php endif; ?>
</div>
</div>
<?php $__env->startPush('scripts'); ?>
<script>
    function checkTag() {
        var valName = $("#tag").val();
        if (valName.trim() != '') {
            var url = "<?php echo e(route('tag.check')); ?>";
            $.post(url, {
                tag: valName,
                "_token": "<?php echo e(csrf_token()); ?>"
            }, function(json) {
                if (json.st == 1) {
                    $("#message").show().text('Recipient doesn\'t exist');
                    $('button').attr('disabled', true);
                } else {
                    $("#recipient").text(json.user.first_name + ' ' + json.user.last_name);
                    $('button').attr('disabled', false);
                    $("#message").show().text('Recipient Exists');
                }
            }, 'json');
        }
    }
    $("#tag").keyup(checkTag);
    checkTag();
</script>
<?php $__env->stopPush(); ?><?php /**PATH C:\xampp\htdocs\adv-banking\resources\views/livewire/beneficiary/index.blade.php ENDPATH**/ ?>