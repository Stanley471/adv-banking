<div>
    <?php if($type == "kin"): ?>
    <div class="card mb-10" id="kin">
        <div class="card-body">
            <form wire:submit.prevent="save" method="post">
                <?php echo csrf_field(); ?>
                <p class="fw-bolder fs-3 text-dark">Next of Kin</p>
                <div class="row fv-row">
                    <div class="col-xl-6 mb-6">
                        <label class="form-label fw-bolder text-dark fs-6"><?php echo e(__('First Name')); ?></label>
                        <input class="form-control form-control-lg form-control-solid" type="text" wire:model.defer="kin_first_name" autocomplete="off" placeholder="Legal first name" required />
                        <?php $__errorArgs = ['kin_first_name'];
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
                    <div class="col-xl-6 mb-6">
                        <label class="form-label fw-bolder text-dark fs-6"><?php echo e(__('Last Name')); ?></label>
                        <input class="form-control form-control-lg form-control-solid" type="text" wire:model.defer="kin_last_name" autocomplete="off" placeholder="Legal last name" required />
                        <?php $__errorArgs = ['kin_last_name'];
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
                </div>
                <div class="fv-row mb-6">
                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Email')); ?></label>
                    <input class="form-control form-control-lg form-control-solid" type="email" wire:model.defer="kin_email" autocomplete="email" placeholder="Email address" required />
                    <?php $__errorArgs = ['kin_email'];
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
                <div class="fv-row mb-6" wire:ignore>
                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Phone')); ?></label>
                    <input type="hidden" wire:model="kin_mobile_code" id="code" class="text-uppercase">
                    <input type="tel" id="phone" wire:model.defer="kin_mobile" class="form-control form-control-lg form-control-solid border-light" required>
                </div>
                <?php $__errorArgs = ['kin_mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="form-text mb-6 mt-n6"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <div class="fv-row mb-6">
                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Address')); ?></label>
                    <input class="form-control form-control-lg form-control-solid" type="text" wire:model.defer="kin_address" autocomplete="address" placeholder="Next of Kin Address" required />
                    <?php $__errorArgs = ['kin_address'];
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
                        <span wire:loading.remove wire:target="save"><?php echo e(__('Update Next of Kin')); ?></span>
                        <span wire:loading wire:target="save"><?php echo e(__('Processing Request...')); ?></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <?php else: ?>
    <div class="card mb-10">
        <div class="card-body">
            <form wire:submit.prevent="profile" method="post">
                <?php echo csrf_field(); ?>
                <div class="row fv-row">
                    <div class="col-xl-6 mb-6">
                        <label class="form-label fw-bolder text-dark fs-6"><?php echo e(__('First Name')); ?></label>
                        <input class="form-control form-control-lg form-control-solid" type="text" name="first_name" autocomplete="off" value="<?php echo e($user->first_name); ?>" required readonly />
                        <?php $__errorArgs = ['first_name'];
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
                    <div class="col-xl-6 mb-6">
                        <label class="form-label fw-bolder text-dark fs-6"><?php echo e(__('Last Name')); ?></label>
                        <input class="form-control form-control-lg form-control-solid" type="text" name="last_name" autocomplete="off" value="<?php echo e($user->last_name); ?>" required readonly />
                        <?php $__errorArgs = ['last_name'];
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
                </div>
                <div class="fv-row mb-6">
                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Email')); ?></label>
                    <input class="form-control form-control-lg form-control-solid" type="email" name="email" autocomplete="email" value="<?php echo e($user->email); ?>" required readonly />
                    <?php $__errorArgs = ['email'];
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
                <div class="fv-row mb-6">
                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Phone')); ?></label>
                    <div class="input-group mb-3">
                        <span class="input-group-text border-0"><span class="fi fi-<?php echo e(strtolower($user->mobile_code)); ?> fis rounded-4 me-3 fs-1"></span></span>
                        <input class="form-control form-control-lg form-control-solid" type="tel" name="phone" autocomplete="phone" value="<?php echo e($user->phone); ?>" required placeholder="123456789" readonly />
                    </div>
                    <?php $__errorArgs = ['phone'];
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
                <?php if($set->language == 1): ?>
                <div class="fv-row mb-6">
                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Language')); ?></label>
                    <select class="form-select form-select-solid" wire:model="language" required>
                        <option value="">Select a Language...</option>
                        <?php $__currentLoopData = getLang(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($lang->code); ?>"><?php echo e($lang->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <?php endif; ?>
                <div class="text-start">
                    <button type="submit" class="btn btn-lg btn-info fw-bolder me-3 my-2">
                        <span wire:loading.remove wire:target="profile"><?php echo e(__('Update Account')); ?></span>
                        <span wire:loading wire:target="profile"><?php echo e(__('Processing Request...')); ?></span>
                    </button>
                    <a data-bs-toggle="modal" data-bs-target="#delaccount" class="btn btn-lg btn-light-danger fw-bolder me-3 my-2"><?php echo e(__('Deactivate Account')); ?></a>
                </div>
            </form>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('front/vendor/jquery/dist/jquery.min.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script>
    function initPhoneToggle() {
        const phoneInputField = document.querySelector("#phone");
        const phoneInput = window.intlTelInput(phoneInputField, {
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });
        var old = "<?php echo e($user->business->kin_mobile); ?>";
        if (old.trim() != '') {
            phoneInput.setCountry(old)
        }
        $('#code').val(phoneInput.getSelectedCountryData().iso2);
        window.livewire.find('<?php echo e($_instance->id); ?>').set('kin_mobile_code', phoneInput.getSelectedCountryData().iso2);
        phoneInputField.addEventListener("countrychange", function() {
            $('#code').val(phoneInput.getSelectedCountryData().iso2);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('kin_mobile_code', phoneInput.getSelectedCountryData().iso2);
        });
    }
    document.addEventListener('livewire:load', function() {
        initPhoneToggle();
    });
    $(document).ready(function() {
        initPhoneToggle();
    });
</script>
<?php $__env->stopPush(); ?><?php /**PATH /home/soccrquq/clovergatebank.com/resources/views/livewire/settings/kin.blade.php ENDPATH**/ ?>