<div>
    <div wire:ignore.self id="kt_trx_<?php echo e($val->id); ?>" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_trx_<?php echo e($val->id); ?>_button" data-kt-drawer-close="#kt_trx_<?php echo e($val->id); ?>_close">
        <div class="card w-100">
            <div class="card-header pe-5 border-0">
                <div class="card-title">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1"><?php echo e(__('Transaction Details')); ?></div>
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_trx_<?php echo e($val->id); ?>_close">
                        <span class="svg-icon svg-icon-2">
                            <i class="fal fa-times"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body text-wrap">
                <div class="btn-wrapper text-center mb-3">
                    <div class="symbol symbol-100px symbol-circle me-5 mb-10">
                        <div class="symbol-label fs-1 text-dark">
                            <?php if($val->trx_type == 'debit'): ?>
                            <i class="fal fa-minus fa-2x"></i>
                            <?php else: ?>
                            <i class="fal fa-plus fa-2x"></i>
                            <?php endif; ?>
                        </div>
                    </div>
                    <p class="text-dark fs-1 fw-bolder"><?php echo e($currency->currency_symbol.currencyFormat(number_format($val->amount, 2)).' '.$currency->currency); ?></p>
                </div>
                <div class="d-flex flex-column">
                    <li class="d-flex align-items-center py-2">
                        <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Reference')); ?>: <?php echo e($val->ref_id); ?> <i class="fal fa-clone castro-copy fs-5" data-clipboard-text="<?php echo e($val->ref_id); ?>" title="Copy"></i></span>
                    </li>
                    <li class="d-flex align-items-center py-2">
                        <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Charge')); ?>: <?php echo e($currency->currency_symbol.currencyFormat(number_format($val->charge, 2)).' '.$currency->currency); ?></span>
                    </li>
                    <li class="d-flex align-items-center py-2">
                        <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Date')); ?>: <?php echo e($val->created_at->toDayDateTimeString()); ?></span>
                    </li>
                    <li class="d-flex align-items-center py-2">
                        <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Type')); ?>: <?php echo e(ucwords($val->type)); ?></span>
                    </li>
                    <?php if($val->type == 'deposit'): ?>
                    <li class="d-flex align-items-center py-2">
                        <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Method')); ?>: <?php echo e($val->gateway->name); ?></span>
                    </li>
                    <?php elseif($val->type == 'bank_transfer'): ?>
                    <li class="d-flex align-items-center py-2">
                        <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Bank Reference')); ?>: <?php echo e($val->bank_reference); ?></span>
                    </li>
                    <?php endif; ?>
                    <li class="d-flex align-items-center py-2">
                        <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Status')); ?>: <span class="badge badge-pill badge-secondary badge-sm"><?php echo e(ucwords($val->status)); ?></span></span>
                    </li>
                    <?php if($val->status == "declined"): ?>
                    <li class="d-flex align-items-center py-2">
                        <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Decline Reason')); ?>: <?php echo e($val->decline_reason); ?></span>
                    </li>
                    <?php endif; ?>
                    <?php if($val->staff_id != null): ?>
                    <li class="d-flex align-items-center py-2">
                        <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Edited by')); ?>: <?php echo e($val->staff->first_name.' '.$val->staff->last_name); ?></span>
                    </li>
                    <li class="d-flex align-items-center py-2">
                        <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Date & Time')); ?>: <?php echo e($val->updated_at->toDayDateTimeString()); ?></span>
                    </li>
                    <?php endif; ?>
                </div>
                <?php if($val->status == "pending"): ?>
                <button class="btn btn-info btn-block mt-5" wire:click="approve"><i class="fal fa-thumbs-up"></i>
                    <span wire:loading.remove wire:target="approve"><?php echo e(__('Approve Deposit')); ?></span>
                    <span wire:loading wire:target="approve"><?php echo e(__('Processing Request...')); ?></span>
                </button>
                <button class="btn btn-secondary btn-block mt-5" id="kt_decline_<?php echo e($val->id); ?>_button"><i class="fal fa-ban"></i> <?php echo e(__('Decline Deposit')); ?></button>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div wire:ignore.self id="kt_decline_<?php echo e($val->id); ?>" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_decline_<?php echo e($val->id); ?>_button" data-kt-drawer-close="#kt_decline_<?php echo e($val->id); ?>_close" data-kt-drawer-width="{'md': '500px'}">
        <div class="card w-100">
            <div class="card-header pe-5 border-0">
                <div class="card-title">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1"><?php echo e(__('Deposit')); ?></div>
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_decline_close">
                        <span class="svg-icon svg-icon-2">
                            <i class="fal fa-times"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body text-wrap">
                <div class="btn-wrapper text-center mb-3">
                    <div class="symbol symbol-100px symbol-circle me-5 mb-10">
                        <div class="symbol-label fs-1 text-dark">
                            <i class="fal fa-ban fa-2x"></i>
                        </div>
                    </div>
                    <p class="text-dark fs-6 fw-bold">Decline Deposit Request</p>
                </div>
                <div class="pb-5 mt-10 position-relative zindex-1">
                    <form class="form w-100 mb-10" wire:submit.prevent="decline" method="post">
                        <div class="fv-row mb-6">
                            <textarea class="form-control form-control-lg form-control-solid" rows="8" type="text" wire:model.defer="reason" required placeholder="Give a reason for Deposit decline"></textarea>
                            <?php $__errorArgs = ['reason'];
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
                        <div class="text-center mt-10">
                            <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                                <span wire:loading.remove wire:target="decline"><?php echo e(__('Decline Transaction')); ?></span>
                                <span wire:loading wire:target="decline"><?php echo e(__('Processing Request...')); ?></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\adv-banking\resources\views/livewire/admin/deposit/details.blade.php ENDPATH**/ ?>