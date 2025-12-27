<!-- Back Button -->
<button wire:click="resetTransferType" class="btn btn-sm btn-light mb-4">
    <i class="fas fa-arrow-left me-2"></i> <?php echo e(__('Back')); ?>

</button>

<div class="btn-wrapper text-center mb-3">
    <div class="symbol symbol-60px symbol-circle me-5 mb-6">
        <div class="symbol-label fs-1 text-dark bg-light-success">
            <i class="fas fa-university fa-2x text-success"></i>
        </div>
    </div>
    <p class="text-dark fs-6"><?php echo e(__('External Wire/ACH Transfer')); ?></p>
    <div class="alert alert-warning d-flex align-items-center p-3 mb-6">
        <i class="fas fa-info-circle me-2"></i>
        <span class="small"><?php echo e(__('External transfers take 1-3 business days to process')); ?></span>
    </div>
</div>

<form class="form w-100" wire:submit.prevent="transferExternal" method="post">
    <?php $__errorArgs = ['external_error'];
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
    
    <!-- Bank Name -->
    <div class="fv-row mb-6">
        <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Bank Name')); ?></label>
        <select class="form-select form-select-solid form-select-lg" wire:model.defer="external_bank_name" required>
            <option value=""><?php echo e(__('Select Bank')); ?></option>
            <option value="Bank of America">Bank of America</option>
            <option value="Chase Bank">Chase Bank</option>
            <option value="Wells Fargo">Wells Fargo</option>
            <option value="Citibank">Citibank</option>
            <option value="US Bank">US Bank</option>
            <option value="PNC Bank">PNC Bank</option>
            <option value="TD Bank">TD Bank</option>
            <option value="Capital One">Capital One</option>
            <option value="Other">Other</option>
        </select>
        <?php $__errorArgs = ['external_bank_name'];
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
    
    <!-- Routing Number -->
    <div class="fv-row mb-6">
        <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Routing Number')); ?></label>
        <input class="form-control form-control-lg form-control-solid" 
               type="text" 
               wire:model.defer="external_routing_number" 
               placeholder="9 digits" 
               minlength="9"
               maxlength="9"
               pattern="[0-9]{9}"
               required />
        <span class="form-text text-muted small"><?php echo e(__('9-digit routing number (found on checks)')); ?></span>
        <?php $__errorArgs = ['external_routing_number'];
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
    
    <!-- Account Number -->
    <div class="fv-row mb-6">
        <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Account Number')); ?></label>
        <input class="form-control form-control-lg form-control-solid" 
               type="text" 
               wire:model.defer="external_account_number" 
               placeholder="Enter account number" 
               required />
        <?php $__errorArgs = ['external_account_number'];
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
    
    <!-- Account Holder Name -->
    <div class="fv-row mb-6">
        <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Account Holder Name')); ?></label>
        <input class="form-control form-control-lg form-control-solid" 
               type="text" 
               wire:model.defer="external_account_holder_name" 
               placeholder="Full name as shown on account" 
               required />
        <?php $__errorArgs = ['external_account_holder_name'];
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
    
    <!-- Account Type -->
    <div class="fv-row mb-6">
        <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Account Type')); ?></label>
        <select class="form-select form-select-solid form-select-lg" wire:model.defer="external_account_type" required>
            <option value=""><?php echo e(__('Select Account Type')); ?></option>
            <option value="checking"><?php echo e(__('Checking')); ?></option>
            <option value="savings"><?php echo e(__('Savings')); ?></option>
        </select>
        <?php $__errorArgs = ['external_account_type'];
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
    
    <!-- Amount -->
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
    
    <!-- Transfer PIN -->
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
            <span wire:loading.remove wire:target="transferExternal">
                <i class="fas fa-paper-plane me-2"></i><?php echo e(__('Send Wire Transfer')); ?>

            </span>
            <span wire:loading wire:target="transferExternal"><?php echo e(__('Processing...')); ?></span>
        </button>
    </div>
</form><?php /**PATH C:\xampp\htdocs\adv-banking\resources\views/partials/transfer/external.blade.php ENDPATH**/ ?>