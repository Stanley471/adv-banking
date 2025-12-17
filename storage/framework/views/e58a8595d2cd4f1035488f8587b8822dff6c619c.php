<div wire:ignore.self id="kt_regular_money" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_regular_button" data-kt-drawer-close="#kt_regular_close" data-kt-drawer-width="{'md': '500px'}">
    <div class="card w-100">
        <div class="card-header pe-5 border-0">
            <div class="card-title">
                <div class="d-flex justify-content-center flex-column me-3">
                    <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1"><?php echo e(__('Regular Savings')); ?></div>
                </div>
            </div>
            <div class="card-toolbar">
                <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_regular_close">
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
                        <i class="fal fa-sync fa-2x text-info"></i>
                    </div>
                </div>
                <p class="text-dark fs-5"><?php echo e(__('Create Regular Plan')); ?></p>
            </div>
            <div class="pb-5 mt-10 position-relative zindex-1">
                <form class="form w-100 mb-10" wire:submit.prevent="regular(Object.fromEntries(new FormData($event.target)))" method="post">
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
                        <label class="col-form-label"><?php echo e(__('How much would you like to start with?')); ?></label>
                        <div class="input-group mb-3">
                            <span class="input-group-text border-0 fs-2"><?php echo e($currency->currency_symbol); ?></span>
                            <input class="form-control form-control-lg form-control-solid fs-2 fw-bold <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text" step="any" wire:model.defer="regular_amount" autocomplete="transaction-amount" id="regular-amount" required placeholder="<?php echo e(__('0.00')); ?>" />
                            <span class="input-group-text border-0"><span class="fi fi-<?php echo e(strtolower($currency->iso2)); ?> fis rounded-4 me-3 fs-1"></span></span>
                        </div>
                        <?php $__errorArgs = ['regular_amount'];
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
                    <div class="row g-9 mb-6" wire:ignore data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                        <?php $__currentLoopData = collect(json_decode($set->rga))->pluck('value')->toArray(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4 col-6">
                            <span class="form-check form-check-custom form-check-solid form-check-sm fs-2">
                                <input class="form-check-input suggested_amount me-3 rga" type="radio" id="rga" name="rga" value="<?php echo e($val); ?>" <?php if($loop->first): ?> checked="checked" <?php endif; ?>>
                                <?php echo e($currency->currency_symbol.currencyFormat(number_format($val, 2))); ?>

                            </span>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="fv-row mb-6">
                        <label class="col-form-label"><?php echo e(__('How long will you like to save?')); ?></label>
                        <select class="form-select form-select-solid" wire:model="regular_plan" required id="regular_plan">
                            <?php $__currentLoopData = getRegularSavings(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($plan->id); ?>" data-duration="<?php echo e($plan->duration); ?>" data-interest="<?php echo e($plan->interest); ?>"><?php echo e($plan->duration); ?> <?php echo e(($plan->duration > 1) ? 'Months' : 'Month'); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['regular_plan'];
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
                        <input class="form-control form-control-lg form-control-solid" type="text" wire:model.defer="regular_name" required placeholder="Name of Plan" />
                        <?php $__errorArgs = ['regular_name'];
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
                        <span class="form-check form-check-custom form-check-solid form-check-sm mb-3">
                            <input class="form-check-input suggested_amount me-3" type="radio" wire:model="regular_automation" checked value="1">
                            <?php echo e(__('Yes, I want to be debited now')); ?>

                        </span>
                        <span class="form-check form-check-custom form-check-solid form-check-sm">
                            <input class="form-check-input suggested_amount me-3" type="radio" wire:model="regular_automation" value="0">
                            <?php echo e(__('No, I want to save when I want to')); ?>

                        </span>
                        <?php $__errorArgs = ['regular_automation'];
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
                    <div class="bg-light-primary px-6 py-5 mb-10 rounded" wire:ignore>
                        <p class="text-dark fw-bold fs-6 mb-0"><?php echo e(__('Interest')); ?>: <span id="regular_interest">0</span>%</p>
                        <p class="text-dark fw-bold fs-6 mb-0"><?php echo e(__('Return')); ?>: <span id="regular_return"><?php echo e($currency->currency_symbol.'0 '.$currency->currency); ?></span></p>
                        <p class="text-dark fw-bold fs-6 mb-0"><?php echo e(__('Ends')); ?>: <span id="regular_expiry">-</span></p>
                    </div>
                    <div class="text-center mt-10">
                        <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                            <span wire:loading.remove wire:target="regular"><?php echo e(__('Submit Request')); ?></span>
                            <span wire:loading wire:target="regular"><?php echo e(__('Processing Request...')); ?></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div wire:ignore.self id="kt_emergency_money" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_emergency_button" data-kt-drawer-close="#kt_emergency_close" data-kt-drawer-width="{'md': '500px'}">
    <div class="card w-100">
        <div class="card-header pe-5 border-0">
            <div class="card-title">
                <div class="d-flex justify-content-center flex-column me-3">
                    <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1"><?php echo e(__('Emergency Savings')); ?></div>
                </div>
            </div>
            <div class="card-toolbar">
                <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_emergency_close">
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
                        <i class="fal fa-sync fa-2x text-info"></i>
                    </div>
                </div>
                <p class="text-dark fs-5"><?php echo e(__('Create an Emergency Plan')); ?></p>
            </div>
            <div class="pb-5 mt-10 position-relative zindex-1">
                <form class="form w-100 mb-10" wire:submit.prevent="emergency(Object.fromEntries(new FormData($event.target)))" method="post">
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
                        <label class="col-form-label"><?php echo e(__('What is your goal?')); ?></label>
                        <div class="input-group mb-3">
                            <span class="input-group-text border-0 fs-2"><?php echo e($currency->currency_symbol); ?></span>
                            <input class="form-control form-control-lg form-control-solid fs-2 fw-bold <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text" step="any" wire:model.defer="emergency_goal" autocomplete="transaction-amount" id="emergency-goal" required placeholder="<?php echo e(__('0.00')); ?>" />
                            <span class="input-group-text border-0"><span class="fi fi-<?php echo e(strtolower($currency->iso2)); ?> fis rounded-4 me-3 fs-1"></span></span>
                        </div>
                        <?php $__errorArgs = ['emergency_goal'];
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
                        <label class="col-form-label"><?php echo e(__('How much would you like to start with?')); ?></label>
                        <div class="input-group mb-3">
                            <span class="input-group-text border-0 fs-2"><?php echo e($currency->currency_symbol); ?></span>
                            <input class="form-control form-control-lg form-control-solid fs-2 fw-bold <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text" step="any" wire:model.defer="emergency_amount" autocomplete="transaction-amount" id="emergency-amount" required placeholder="<?php echo e(__('0.00')); ?>" />
                            <span class="input-group-text border-0"><span class="fi fi-<?php echo e(strtolower($currency->iso2)); ?> fis rounded-4 me-3 fs-1"></span></span>
                        </div>
                        <?php $__errorArgs = ['emergency_amount'];
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
                    <div class="row g-9 mb-6" wire:ignore data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                        <?php $__currentLoopData = collect(json_decode($set->ega))->pluck('value')->toArray(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4 col-6">
                            <span class="form-check form-check-custom form-check-solid form-check-sm fs-2">
                                <input class="form-check-input suggested_amount me-3 ega" type="radio" id="ega" name="ega" value="<?php echo e($val); ?>" <?php if($loop->first): ?> checked="checked" <?php endif; ?>>
                                <?php echo e($currency->currency_symbol.currencyFormat(number_format($val, 2))); ?>

                            </span>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="fv-row mb-6">
                        <input class="form-control form-control-lg form-control-solid" type="text" wire:model.defer="emergency_name" required placeholder="Name of Plan" />
                        <?php $__errorArgs = ['emergency_name'];
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
                        <label class="col-form-label"><?php echo e(__('What day of the month works for you?')); ?></label>
                        <select class="form-select form-select-lg form-select-solid" wire:model.defer="emergency_month">
                            <?php for($i=1; $i<=28; $i++): ?> <option value="<?php echo e(($i < 10 ? 0 : '').$i); ?>"><?php echo e(($i < 10 ? 0 : '').$i); ?></option>
                                <?php endfor; ?>
                        </select>
                        <span class="form-text"><?php echo e(__('We will send a reminder to top up your emergency plan on this day.')); ?></span>
                        <?php $__errorArgs = ['emergency_month'];
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
                        <span class="form-check form-check-custom form-check-solid form-check-sm mb-3">
                            <input class="form-check-input suggested_amount me-3" type="radio" wire:model="emergency_automation" checked value="1">
                            <?php echo e(__('Yes, I want to be debited now')); ?>

                        </span>
                        <span class="form-check form-check-custom form-check-solid form-check-sm">
                            <input class="form-check-input suggested_amount me-3" type="radio" wire:model="emergency_automation" value="0">
                            <?php echo e(__('No, I want to save when I want to')); ?>

                        </span>
                        <?php $__errorArgs = ['regular_automation'];
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
                    <div class="bg-light-primary px-6 py-5 mb-10 rounded" wire:ignore>
                        <p class="text-dark fw-bold fs-6 mb-0"><?php echo e(__('Interest')); ?>: <span id="emergency_interest">0</span>%</p>
                        <p class="text-dark fw-bold fs-6 mb-0"><?php echo e(__('Return')); ?>: <span id="emergency_return"><?php echo e($currency->currency_symbol.'0 '.$currency->currency); ?></span></p>
                        <?php if($set->egg): ?>
                        <p class="text-dark fw-bold fs-6 mb-0"><?php echo e(__('Interest will be returned if you reach your goal on ').\Carbon\Carbon::now()->addYear(1)->format('M j, Y')); ?></p>
                        <?php else: ?>
                        <p class="text-dark fw-bold fs-6 mb-0"><?php echo e(__('Interest will be returned on ').\Carbon\Carbon::now()->addYear(1)->format('M j, Y')); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="text-center mt-10">
                        <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                            <span wire:loading.remove wire:target="emergency"><?php echo e(__('Submit Request')); ?></span>
                            <span wire:loading wire:target="emergency"><?php echo e(__('Processing Request...')); ?></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div wire:ignore.self id="kt_duo_money" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_duo_button" data-kt-drawer-close="#kt_duo_close" data-kt-drawer-width="{'md': '500px'}">
    <div class="card w-100">
        <div class="card-header pe-5 border-0">
            <div class="card-title">
                <div class="d-flex justify-content-center flex-column me-3">
                    <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1"><?php echo e(__('Duo Savings')); ?></div>
                </div>
            </div>
            <div class="card-toolbar">
                <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_duo_close">
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
                        <i class="fal fa-sync fa-2x text-info"></i>
                    </div>
                </div>
                <p class="text-dark fs-5"><?php echo e(__('Create an Duo Plan')); ?></p>
            </div>
            <div class="pb-5 mt-10 position-relative zindex-1">
                <form class="form w-100 mb-10" wire:submit.prevent="duo(Object.fromEntries(new FormData($event.target)))" method="post">
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
                        <label class="col-form-label"><?php echo e(__('What is your goal?')); ?></label>
                        <div class="input-group mb-3">
                            <span class="input-group-text border-0 fs-2"><?php echo e($currency->currency_symbol); ?></span>
                            <input class="form-control form-control-lg form-control-solid fs-2 fw-bold <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text" step="any" wire:model.defer="duo_goal" autocomplete="transaction-amount" id="duo-goal" required placeholder="<?php echo e(__('0.00')); ?>" />
                            <span class="input-group-text border-0"><span class="fi fi-<?php echo e(strtolower($currency->iso2)); ?> fis rounded-4 me-3 fs-1"></span></span>
                        </div>
                        <?php $__errorArgs = ['duo_goal'];
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
                        <input class="form-control form-control-lg form-control-solid" type="text" wire:model.defer="duo_name" required placeholder="Name of Plan" />
                        <?php $__errorArgs = ['duo_name'];
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
                    <div class="bg-light-primary px-6 py-5 mb-10 rounded" wire:ignore>
                        <p class="text-dark fw-bold fs-6 mb-0"><?php echo e(__('Recipient')); ?>: <span id="recipient">-</span></p>
                        <p class="text-dark fw-bold fs-6 mb-0"><?php echo e(__('Interest')); ?>: <span id="duo_interest">0</span>%</p>
                        <p class="text-dark fw-bold fs-6 mb-0"><?php echo e(__('Return')); ?>: <span id="duo_return"><?php echo e($currency->currency_symbol.'0 '.$currency->currency); ?></span></p>
                        <?php if($set->dgg): ?>
                        <p class="text-dark fw-bold fs-6 mb-0"><?php echo e(__('Interest will be returned if you reach your goal on ').\Carbon\Carbon::now()->addYear(1)->format('M j, Y')); ?></p>
                        <?php else: ?>
                        <p class="text-dark fw-bold fs-6 mb-0"><?php echo e(__('Interest will be returned on ').\Carbon\Carbon::now()->addYear(1)->format('M j, Y')); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="text-center mt-10">
                        <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2" id="duo_button">
                            <span wire:loading.remove wire:target="duo"><?php echo e(__('Submit Request')); ?></span>
                            <span wire:loading wire:target="duo"><?php echo e(__('Processing Request...')); ?></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\adv-banking\resources\views/partials/savings.blade.php ENDPATH**/ ?>