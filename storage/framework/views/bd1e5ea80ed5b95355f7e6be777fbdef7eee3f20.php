<div>
    <div wire:ignore.self class="modal fade" id="gateway_deposit<?php echo e($gateway->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"><?php echo e($gateway->name); ?></h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="fal fa-times"></i>
                        </span>
                    </div>
                </div>
                <form wire:submit.prevent="gateway">
                    <div class="modal-body">
                        <?php echo csrf_field(); ?>
                        <div class="fv-row mb-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text border-0 fs-2"><?php echo e($currency->currency_symbol); ?></span>
                                <input class="form-control form-control-lg form-control-solid fs-2 fw-bold <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text" step="any" wire:model.defer="amount" autocomplete="transaction-amount" id="amount" min="1" max="<?php echo e($user->getFirstBalance()->amount); ?>" value="<?php echo e(old('amount')); ?>" required placeholder="<?php echo e(__('0.00')); ?>" autofocus/>
                                <span class="input-group-text border-0"><span class="fi fi-<?php echo e(strtolower($currency->iso2)); ?> fis rounded-4 me-3 fs-1"></span></span>
                            </div>
                            <?php $__errorArgs = ['amount'];
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
                        <?php if($gateway->type==1): ?>
                        <?php if($gateway->val1): ?>
                        <div class="fv-row mb-6 form-floating">
                            <input class="form-control form-control-lg form-control-solid fs-2 fw-bold <?php $__errorArgs = ['details'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text" wire:model.defer="details" required id="details" />
                            <label class="form-label fs-6 fw-bolder text-dark" for="details"><?php echo e($gateway->val1); ?></label>
                            <?php $__errorArgs = ['details'];
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
                        <?php endif; ?>
                        <div class="fv-row mb-6">
                            <label class="form-label fs-6 text-dark"><?php echo e(__('Proof of payment')); ?></label>
                            <input class="form-control form-control-lg form-control-solid" type="file" wire:model="image" required/>
                            <?php $__errorArgs = ['image'];
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
                        <?php if($gateway->instructions || $gateway->crypto=1): ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="bg-light px-6 py-5 mb-10 rounded text-wrap" wire:ignore style="overflow-wrap: break-word;">
                                    <?php if($gateway->instructions): ?>
                                    <li class="align-items-center py-1">
                                        <span><?php echo e(__('Instructions')); ?>: <?php echo e($gateway->instructions); ?></span>
                                    </li>
                                    <?php endif; ?>
                                    <?php if($gateway->crypto=1): ?>
                                    <li class="align-items-center py-1">
                                        <span><?php echo e(__('Wallet address')); ?>: <?php echo e($gateway->val2); ?> <i class="fal fa-clone castro-copy fs-5" data-clipboard-text="<?php echo e($gateway->val2); ?>" title="Copy"></i></span>
                                    </li>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-block btn-info" type="submit">
                            <span wire:loading.remove wire:target="gateway"><?php echo e(__('Fund account')); ?></span>
                            <span wire:loading wire:target="gateway"><?php echo e(__('Submitting request...')); ?></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><?php /**PATH /home/soccrquq/clovergatebank.com/resources/views/livewire/gateway.blade.php ENDPATH**/ ?>