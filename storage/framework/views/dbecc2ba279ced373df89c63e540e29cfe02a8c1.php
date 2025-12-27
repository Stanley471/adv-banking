<!-- Back Button -->
<button wire:click="resetTransferType" class="btn btn-sm btn-light mb-4">
    <i class="fas fa-arrow-left me-2"></i> <?php echo e(__('Back')); ?>

</button>

<div class="btn-wrapper text-center mb-3">
    <div class="symbol symbol-60px symbol-circle me-5 mb-6">
        <div class="symbol-label fs-1 text-dark bg-light-primary">
            <i class="fas fa-users fa-2x text-primary"></i>
        </div>
    </div>
    <p class="text-dark fs-6"><?php echo e(__('Internal Transfer - Send to ').$set->site_name.__(' users')); ?></p>
</div>

<?php if(!$transfer_confirmed): ?>
<!-- Step 1: Account Verification -->
<form class="form w-100 mb-10" wire:submit.prevent="verifyAccount" method="post">
    <?php $__errorArgs = ['account_error'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <div class="alert alert-danger">
        <span><?php echo e($message); ?></span>
    </div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    
    <div class="fv-row mb-6">
        <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Account Number / Merchant ID')); ?></label>
        <input class="form-control form-control-lg form-control-solid <?php $__errorArgs = ['account_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
               type="text" 
               wire:model.defer="account_number" 
               placeholder="<?php echo e(__('Enter account number or @merchantID')); ?>" 
               required />
        <?php $__errorArgs = ['account_number'];
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
        <button type="submit" class="btn btn-lg btn-primary btn-block fw-bolder">
            <span wire:loading.remove wire:target="verifyAccount"><?php echo e(__('Verify Account')); ?></span>
            <span wire:loading wire:target="verifyAccount"><?php echo e(__('Verifying...')); ?></span>
        </button>
    </div>
</form>

<?php else: ?>
<!-- Step 2: Confirmed - Enter Amount -->
<div class="card bg-light-success mb-6">
    <div class="card-body p-4">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <div class="symbol symbol-50px me-3">
                    <div class="symbol-label bg-success text-white">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
                <div>
                    <p class="fw-bold mb-0 text-dark"><?php echo e($recipient_name); ?></p>
                    <p class="text-muted small mb-0">Account: <?php echo e($account_number); ?></p>
                </div>
            </div>
            <button wire:click="resetTransferType" class="btn btn-sm btn-light-danger">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
</div>

<form class="form w-100" wire:submit.prevent="transferInternal" method="post">
    <?php $__errorArgs = ['transfer_error'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <div class="alert alert-danger">
        <span><?php echo e($message); ?></span>
    </div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    
    <div class="fv-row mb-6">
        <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Amount')); ?></label>
        <div class="input-group">
            <span class="input-group-text fs-2"><?php echo e($currency->currency_symbol); ?></span>
            <input class="form-control form-control-lg form-control-solid fs-2 fw-bold" 
                   type="text" 
                   wire:model.defer="transfer_amount" 
                   placeholder="0.00" 
                   required />
        </div>
        <?php $__errorArgs = ['transfer_amount'];
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
    
    <div class="fv-row mb-6">
        <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Transfer PIN')); ?></label>
        <input wire:model.defer="transfer_pin" 
               type="password" 
               minlength="4" 
               maxlength="6" 
               pattern="[0-9]+" 
               class="form-control form-control-lg form-control-solid" 
               required>
        <?php $__errorArgs = ['transfer_pin'];
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
        <button type="submit" class="btn btn-lg btn-success btn-block fw-bolder">
            <span wire:loading.remove wire:target="transferInternal">
                <i class="fas fa-paper-plane me-2"></i><?php echo e(__('Send Money')); ?>

            </span>
            <span wire:loading wire:target="transferInternal"><?php echo e(__('Processing...')); ?></span>
        </button>
    </div>
</form>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\adv-banking\resources\views/partials/transfer/internal.blade.php ENDPATH**/ ?>