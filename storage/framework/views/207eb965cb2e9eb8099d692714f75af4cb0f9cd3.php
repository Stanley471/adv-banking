<div>
    <div class="toolbar" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <h1 class="text-dark fw-bolder my-1 fs-2x mb-6"><?php echo e(__('Hi').' '.$user->first_name); ?>,</h1>
                <?php if($set->mutual_fund || $set->project_investment): ?>
                <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-5 border-gray-300" id="tabs-icons-text" role="tablist" wire:ignore>
                    <li class="nav-item">
                        <a class="nav-link text-dark <?php if(route('user.dashboard')==url()->current()): ?> active <?php endif; ?>" id="tabs-icons-text-1-tab" href="<?php echo e(route('user.dashboard')); ?>" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="fal fa-house-circle-check"></i> <?php echo e(__('Overview')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark <?php if(route('user.porfolio')==url()->current()): ?> active <?php endif; ?>" id="tabs-icons-text-2-tab" href="<?php echo e(route('user.porfolio')); ?>" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="fal fa-chart-pie"></i> <?php echo e(__('Porfolio')); ?></a>
                    </li>
                </ul>
                <?php endif; ?>
            </div>
            <?php if($set->bk_status == 1): ?>
            <div wire:ignore.self class="modal fade" id="bank_deposit" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title"><?php echo e(__('Bank Transfer')); ?></h3>
                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <span class="svg-icon svg-icon-1">
                                    <i class="fal fa-times"></i>
                                </span>
                            </div>
                        </div>
                        <form wire:submit.prevent="bankDeposit">
                            <div class="modal-body">
                                <?php echo csrf_field(); ?>
                                <div class="fv-row mb-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text border-0 fs-2"><?php echo e($currency->currency_symbol); ?></span>
                                        <input class="form-control form-control-lg form-control-solid fs-2 fw-bold <?php $__errorArgs = ['bank_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text" step="any" wire:model.defer="bank_amount" autocomplete="transaction-amount" id="bank_amount" min="1" max="<?php echo e($user->getFirstBalance()->amount); ?>" value="<?php echo e(old('bank_amount')); ?>" required placeholder="<?php echo e(__('0.00')); ?>" />
                                        <span class="input-group-text border-0"><span class="fi fi-<?php echo e(strtolower($currency->iso2)); ?> fis rounded-4 me-3 fs-1"></span></span>
                                    </div>
                                    <?php $__errorArgs = ['bank_amount'];
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
                                <div class="bg-light px-6 py-5 mb-10 rounded">
                                    <p class="text-dark fs-6 fw-bolder"><?php echo e(__('Account Details')); ?></p>
                                    <li class="d-flex align-items-center py-1">
                                        <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Bank Name')); ?>: <?php echo e($set->dp_bank_name); ?> <i class="fal fa-clone castro-copy fs-5" data-clipboard-text="<?php echo e($set->dp_bank_name); ?>" title="Copy"></i></span>
                                    </li>
                                    <li class="d-flex align-items-center py-1">
                                        <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Routing Code')); ?>: <?php echo e($set->bk_routing_code); ?> <i class="fal fa-clone castro-copy fs-5" data-clipboard-text="<?php echo e($set->bk_routing_code); ?>" title="Copy"></i></span>
                                    </li>
                                    <li class="d-flex align-items-center py-1">
                                        <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Account Number')); ?>: <?php echo e($set->bk_acct_no); ?> <i class="fal fa-clone castro-copy fs-5" data-clipboard-text="<?php echo e($set->bk_acct_no); ?>" title="Copy"></i></span>
                                    </li>
                                    <li class="d-flex align-items-center py-1">
                                        <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Account Name')); ?>: <?php echo e($set->bk_acct_name); ?> <i class="fal fa-clone castro-copy fs-5" data-clipboard-text="<?php echo e($set->bk_acct_name); ?>" title="Copy"></i></span>
                                    </li>
                                    <li class="d-flex align-items-center py-1" wire:ignore>
                                        <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Transaction Description')); ?>: <?php echo e($trx); ?> <i class="fal fa-clone castro-copy fs-5" data-clipboard-text="<?php echo e($trx); ?>" title="Copy"></i></span>
                                    </li>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-block btn-info" type="submit">
                                    <span wire:loading.remove wire:target="bankDeposit"><?php echo e(__('I\'hv made payment')); ?></span>
                                    <span wire:loading wire:target="bankDeposit"><?php echo e(__('Submitting request...')); ?></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php $__currentLoopData = getGateways(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('gateway', ['gateway' => $gateway,'user' => $user,'settings' => $set])->html();
} elseif ($_instance->childHasBeenRendered('gateway_deposit'. $gateway->id)) {
    $componentId = $_instance->getRenderedChildComponentId('gateway_deposit'. $gateway->id);
    $componentTag = $_instance->getRenderedChildComponentTagName('gateway_deposit'. $gateway->id);
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('gateway_deposit'. $gateway->id);
} else {
    $response = \Livewire\Livewire::mount('gateway', ['gateway' => $gateway,'user' => $user,'settings' => $set]);
    $html = $response->html();
    $_instance->logRenderedChild('gateway_deposit'. $gateway->id, $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="d-flex align-items-center flex-nowrap text-nowrap py-1 mb-10">
                    <button id="kt_bank_account_button" class="btn btn-white text-dark me-4"><i class="fal fa-plus"></i> <?php echo e(__('Add Funds')); ?></button>
                    <div wire:ignore.self id="kt_bank_account" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_bank_account_button" data-kt-drawer-close="#kt_bank_account_close" data-kt-drawer-width="{'md': '400px'}">
                        <div class="card w-100">
                            <div class="card-header pe-5 border-0">
                                <div class="card-title">
                                    <div class="d-flex justify-content-center flex-column me-3">
                                        <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1"><?php echo e(__('Top up')); ?></div>
                                    </div>
                                </div>
                                <div class="card-toolbar">
                                    <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_bank_account_close">
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
                                            <i class="fal fa-arrow-down-arrow-up fa-2x"></i>
                                        </div>
                                    </div>
                                    <p class="text-dark fs-6"><?php echo e(__('Add funds to account')); ?></p>
                                </div>
                                <div class="pb-5 mt-10 position-relative zindex-1">
                                    <!--begin::Item-->
                                    <?php if($set->bk_status == 1): ?>
                                    <div class="d-flex flex-stack mb-6 cursor-pointer" data-bs-toggle="modal" data-bs-target="#bank_deposit">
                                        <div class="d-flex align-items-center me-2">
                                            <div class="symbol symbol-45px me-5">
                                                <span class="symbol-label bg-light-primary text-dark">
                                                    <i class="fal fa-university"></i>
                                                </span>
                                            </div>
                                            <div class="me-5">
                                                <p class="fs-5 text-gray-800 text-hover-primary fw-bolder mb-0 text-start"><?php echo e(__('Bank Transfer')); ?></p>
                                                <p class="fs-6 text-gray-600"><?php echo e(__('No Transfer fee')); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php $__currentLoopData = getGateways(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="d-flex flex-stack mb-6 cursor-pointer" data-bs-toggle="modal" data-bs-target="#gateway_deposit<?php echo e($gateway->id); ?>">
                                        <div class="d-flex align-items-center me-2">
                                            <div class="symbol symbol-45px me-5">
                                                <span class="symbol-label bg-light-primary text-dark fs-2">
                                                    <i class="fal fa-plug"></i>
                                                </span>
                                            </div>
                                            <div class="me-5">
                                                <p class="fs-5 text-gray-800 text-hover-primary fw-bolder mb-0 text-start"><?php echo e($gateway->name); ?></p>
                                                <p class="fs-6 text-gray-600"><?php if($gateway->percent_charge!=null): ?><?php echo e($gateway->percent_charge); ?>% <?php else: ?> 0% <?php endif; ?>+ <?php if($gateway->fiat_charge!=null): ?><?php echo e($gateway->fiat_charge); ?> <?php else: ?> 0 <?php endif; ?><?php echo e($currency->currency); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if($set->payout): ?>
                    <button id="kt_send_money_button" class="btn btn-dark"><i class="fal fa-institution"></i> <?php echo e(__('Withdraw')); ?></button>
                    <div wire:ignore.self id="kt_send_money" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_send_money_button" data-kt-drawer-close="#kt_send_money_close" data-kt-drawer-width="{'md': '500px'}">
                        <div class="card w-100">
                            <div class="card-header pe-5 border-0">
                                <div class="card-title">
                                    <div class="d-flex justify-content-center flex-column me-3">
                                        <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1"><?php echo e(__('Withdraw')); ?></div>
                                    </div>
                                </div>
                                <div class="card-toolbar">
                                    <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_send_money_close">
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
                                    <p class="text-dark fs-6"><?php echo e(__('Ensure Bank account can hold ').$currency->currency); ?></p>
                                </div>
                                <a href="<?php echo e(route('user.profile', ['type' => 'bank'])); ?>">
                                    <div class="card bg-secondary">
                                        <div class="d-flex align-items-center p-3">
                                            <div class="symbol symbol-40px me-4">
                                                <div class="symbol-label fs-6 text-dark bg-white rounded-5">
                                                    <i class="fal fa-university text-dark"></i>
                                                </div>
                                            </div>
                                            <div class="ps-1">
                                                <p class="fs-6 text-dark text-hover-primary fw-bolder mb-0"><?php echo e(__('Add Bank account')); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <div class="pb-5 mt-10 position-relative zindex-1">
                                    <form class="form w-100 mb-10" wire:submit.prevent="payout(Object.fromEntries(new FormData($event.target)))" method="post">
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
                                            <div class="input-group mb-3">
                                                <span class="input-group-text border-0 fs-2"><?php echo e($currency->currency_symbol); ?></span>
                                                <input class="form-control form-control-lg form-control-solid fs-2 fw-bold <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text" step="any" wire:model.defer="amount" autocomplete="transaction-amount" id="payout-amount" required placeholder="<?php echo e(__('0.00')); ?>" />
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
                                        <div class="fv-row mb-6">
                                            <select class="form-select form-select-solid" wire:model="withdraw_type" id="withdraw_type">
                                                <option value=""><?php echo e(__('Select Payout type')); ?></option>
                                                <option value="bank"><?php echo e(__('Bank Account')); ?></option>
                                                <option value="other"><?php echo e(__('Other Payout methods')); ?></option>
                                            </select>
                                            <?php $__errorArgs = ['withdraw_type'];
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

                                        <div class="fv-row mb-6" id="bank_account" style="display:none;" wire:ignore>
                                            <select class="form-select form-select-solid" wire:model="bank">
                                                <option value=""><?php echo e(__('Select Bank Account')); ?></option>
                                                <?php $__currentLoopData = $user->banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($bank->id); ?>"><?php echo e($bank->bank->title.' - '.$bank->acct_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <?php $__errorArgs = ['bank'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="form-text"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                        <div style="display:none;" id="other" wire:ignore>
                                            <div class="fv-row mb-6">
                                                <select class="form-select form-select-solid" wire:model="other" id="changeMethod">
                                                    <option value=""><?php echo e(__('Select Withdrawal Method')); ?></option>
                                                    <?php $__currentLoopData = getOtherPayout(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $other): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($other->id); ?>" data-fc="<?php echo e($other->fc); ?>" data-pc="<?php echo e($other->pc); ?>" data-requirements="<?php echo e($other->requirements); ?>"><?php echo e($other->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="fv-row mb-6">
                                                <textarea class="form-control form-control-lg form-control-solid" type="text" wire:model.defer="requirements" id="requirements" rows="3" style="display:none;"></textarea>
                                            </div>
                                        </div>
                                        <?php $__errorArgs = ['other'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="form-text"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <?php $__errorArgs = ['requirements'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="form-text text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                        <input hidden id="pct" value="<?php echo e($set->pct); ?>">
                                        <input hidden id="fc" value="<?php echo e($set->fiat_pc); ?>">
                                        <input hidden id="pc" value="<?php echo e($set->percent_pc); ?>">

                                        <div class="bg-light-primary px-6 py-5 mb-10 rounded" wire:ignore>
                                            <p class="text-dark fw-bold fs-6 mb-0"><?php echo e(__('Balance after transaction')); ?>: <span id="balanceAfter"><?php echo e($currency->currency_symbol.currencyFormat(number_format($user->getFirstBalance()->amount, 2)).' '.$currency->currency); ?></span></p>
                                            <p class="text-dark fw-bold fs-6 mb-0"><?php echo e(__('Fee')); ?>: <span id="fee"><?php echo e($currency->currency_symbol.'0.00 '.$currency->currency); ?></span></p>
                                        </div>
                                        <div class="text-center mt-10">
                                            <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                                                <span wire:loading.remove wire:target="payout"><?php echo e(__('Submit Request')); ?></span>
                                                <span wire:loading wire:target="payout"><?php echo e(__('Processing Request...')); ?></span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if($set->money_transfer): ?>
                    <div wire:ignore.self id="kt_transfer_money" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_transfer_money_button" data-kt-drawer-close="#kt_transfer_money_close" data-kt-drawer-width="{'md': '500px'}">
                        <div class="card w-100">
                            <div class="card-header pe-5 border-0">
                                <div class="card-title">
                                    <div class="d-flex justify-content-center flex-column me-3">
                                        <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1"><?php echo e(__('Transfer Money')); ?></div>
                                    </div>
                                </div>
                                <div class="card-toolbar">
                                    <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_send_money_close">
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
                                    <p class="text-dark fs-6"><?php echo e(__('Transfer money to beneficiary')); ?></p>
                                </div>
                                <a href="<?php echo e(route('user.profile', ['type' => 'beneficiary'])); ?>">
                                    <div class="card bg-secondary">
                                        <div class="d-flex align-items-center p-3">
                                            <div class="symbol symbol-40px me-4">
                                                <div class="symbol-label fs-6 text-dark bg-white rounded-5">
                                                    <i class="fal fa-users text-dark"></i>
                                                </div>
                                            </div>
                                            <div class="ps-1">
                                                <p class="fs-6 text-dark text-hover-primary fw-bolder mb-0"><?php echo e(__('Add Beneficiary')); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <div class="pb-5 mt-10 position-relative zindex-1">
                                    <form class="form w-100 mb-10" wire:submit.prevent="transfer(Object.fromEntries(new FormData($event.target)))" method="post">
                                        <?php $__errorArgs = ['added_ben'];
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
                                            <div class="input-group mb-3">
                                                <span class="input-group-text border-0 fs-2"><?php echo e($currency->currency_symbol); ?></span>
                                                <input class="form-control form-control-lg form-control-solid fs-2 fw-bold <?php $__errorArgs = ['amount_ben'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text" step="any" wire:model.defer="ben_amount" autocomplete="transaction-amount" id="ben-amount" required placeholder="<?php echo e(__('0.00')); ?>" />
                                                <span class="input-group-text border-0"><span class="fi fi-<?php echo e(strtolower($currency->iso2)); ?> fis rounded-4 me-3 fs-1"></span></span>
                                            </div>
                                            <?php $__errorArgs = ['ben_amount'];
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
                                            <select class="form-select form-select-solid" wire:model="beneficiary" required wire:ignore>
                                                <option><?php echo e(__('Select Beneficiary')); ?></option>
                                                <?php $__currentLoopData = $user->beneficiary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ben): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($ben->id); ?>"><?php echo e($ben->recipient->business->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php $__errorArgs = ['beneficiary'];
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
                                            <input wire:model.defer="pin" type="password" minlength="4" maxlength="6" pattern="[0-9]+" class="form-control form-control-lg form-control-solid" required>
                                            <label class="form-label fw-bolder text-dark fs-6 mb-0" for="pin"><?php echo e(__('Transfer Pin')); ?></label>
                                            <?php $__errorArgs = ['pin'];
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
                                            <p class="text-dark fw-bold fs-6 mb-0"><?php echo e(__('Balance after transaction')); ?>: <span id="balanceAfterBen"><?php echo e($currency->currency_symbol.currencyFormat(number_format($user->getFirstBalance()->amount, 2)).' '.$currency->currency); ?></span></p>
                                            <p class="text-dark fw-bold fs-6 mb-0"><?php echo e(__('Fee')); ?>: <span id="feeBen"><?php echo e($currency->currency_symbol.'0.00 '.$currency->currency); ?></span></p>
                                        </div>
                                        <div class="text-center mt-10">
                                            <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                                                <span wire:loading.remove wire:target="transfer"><?php echo e(__('Submit Request')); ?></span>
                                                <span wire:loading wire:target="transfer"><?php echo e(__('Processing Request...')); ?></span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
        </div>
        <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
            <div class="container">
                <?php if($type == 'balance'): ?>
                <div class="row g-xl-8 mb-6">
                    <div class="card bg-transparent h-md-100">
                        <div class="card-body p-0">
                            <div class="px-9 pt-6 card-rounded w-100 bgi-no-repeat castro-secret2 bgi-size-cover bgi-position-y-top <?php if($next == 1): ?> h-250px <?php else: ?> h-200px <?php endif; ?>">
                                <div class="row mt-6">
                                    <div class="col-6">
                                        <h3 class="text-white fw-bold fs-3"><?php echo e('@'.$user->merchant_id); ?> <i class="fal fa-clone castro-copy fs-5" data-clipboard-text="<?php echo e($user->merchant_id); ?>" title="Copy"></i></h3>
                                    </div>
                                    <div class="col-6 text-end">
                                        <?php if($set->money_transfer): ?>
                                        <button id="kt_transfer_money_button" class="btn btn-light-info"><i class="fal fa-arrow-up-from-bracket"></i> <?php echo e(__('Transfer Money')); ?></button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="fw-bold fs-5 text-start pt-5 text-white">
                                    <span class="fi fi-<?php echo e(strtolower($currency->iso2)); ?> mr-2 fis fs-1 rounded-4 text-white"></span> <?php echo e(__('Available Balance')); ?>

                                    <span class="fw-bolder fs-2hx d-block mt-n1 text-white">
                                        <span id="main_balance">
                                            <?php if($user->business->reveal_balance == 1): ?><?php echo e($currency->currency_symbol.currencyFormat(number_format($user->getBalance($val->id)->amount,2)).' '.$currency->currency); ?> <?php else: ?> ************ <?php endif; ?>
                                        </span>
                                        <span class="ml-3 fs-3 cursor-pointer" wire:click="xBalance">
                                            <i class="fal fa-eye-slash" id="hide_balance" <?php if($user->business->reveal_balance == 0): ?> style="display:none;" <?php endif; ?>></i>
                                            <i class="fal fa-eye" id="reveal_balance" <?php if($user->business->reveal_balance == 1): ?> style="display:none;" <?php endif; ?>></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <?php if($next == 1): ?>
                            <div class="shadow-xs card-rounded mx-md-6 mx-2 mb-9 px-6 py-9 position-relative z-index-1 bg-white" style="margin-top: -50px">
                                <div class="row mb-6">
                                    <div class="col-md-8">
                                        <p class="fw-bolder text-info fs-6 mb-0"><?php echo e(__('Complete Account Setup')); ?></p>
                                    </div>
                                    <div class="col-md-4 text-end">
                                        <div class="d-flex flex-column w-100 me-2">
                                            <span class="text-dark me-2 fw-bolder mb-2 fs-3">
                                                <?php echo e(round($completed[0]/$completed[1])); ?>%
                                            </span>
                                            <div class="progress bg-light-primary w-100 h-5px">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo e(round($completed[0]/$completed[1])); ?>%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if($user->business->kyc_status==null || $user->business->kyc_status=="RESUBMIT" || $user->business->kyc_status=="PENDING"): ?>
                                <div class="d-flex align-items-center mb-9">
                                    <div class="symbol symbol-45px me-5 symbol-circle">
                                        <span class="symbol-label bg-info">
                                            <i class="fal fa-id-badge text-white"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <a href="<?php echo e(route('user.compliance', ['type' => 'personal'])); ?>">
                                            <div class="mb-1 pe-3 flex-grow-1">
                                                <div class="fs-5 text-dark text-hover-primary fw-bolder"><?php echo e(__('Verify Identity')); ?></div>
                                                <div class="text-gray-800 fw-semibold"><?php echo e(__('Kindly update your account information to have access to savings, investment, loan & more.')); ?></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <?php if($user->business->kin_first_name == null): ?>
                                <div class="d-flex align-items-center mb-9">
                                    <div class="symbol symbol-45px me-5 symbol-circle">
                                        <span class="symbol-label bg-info">
                                            <i class="fal fa-user text-white"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <a href="<?php echo e(route('user.profile', ['type' => 'profile'])); ?>#kin">
                                            <div class="mb-1 pe-3 flex-grow-1">
                                                <div class="fs-5 text-dark text-hover-primary fw-bolder"><?php echo e(__('Add Next of Kin')); ?></div>
                                                <div class="text-gray-800 fw-semibold"><?php echo e(__('You are yet to add a next of kin to your account, this is to ensure your funds are secured')); ?></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <?php if($user->business->pin == null): ?>
                                <div class="d-flex align-items-center mb-9">
                                    <div class="symbol symbol-45px me-5 symbol-circle">
                                        <span class="symbol-label bg-info">
                                            <i class="fal fa-key text-white"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <a href="<?php echo e(route('setup.pin')); ?>">
                                            <div class="mb-1 pe-3 flex-grow-1">
                                                <div class="fs-4 text-dark text-hover-primary fw-bolder"><?php echo e(__('Setup Transfer Pin')); ?></div>
                                                <div class="text-gray-800 fw-semibold"><?php echo e(__('This is required to transfer money from your account.')); ?></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <?php if($user->banks->count() == 0): ?>
                                <div class="d-flex align-items-center mb-9">
                                    <div class="symbol symbol-45px me-5 symbol-circle">
                                        <span class="symbol-label bg-info">
                                            <i class="fal fa-university text-white"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <a href="<?php echo e(route('user.profile', ['type' => 'bank'])); ?>">
                                            <div class="mb-1 pe-3 flex-grow-1">
                                                <div class="fs-5 text-dark text-hover-primary fw-bolder"><?php echo e(__('Add Bank Account')); ?></div>
                                                <div class="text-gray-800 fw-semibold"><?php echo e(__('A Bank account is required for faster payout')); ?></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <?php if($user->avatar == null): ?>
                                <div class="d-flex align-items-center mb-9">
                                    <div class="symbol symbol-45px me-5 symbol-circle">
                                        <span class="symbol-label bg-info">
                                            <i class="fal fa-user-plus text-white"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <a href="<?php echo e(route('user.profile', ['type' => 'profile'])); ?>">
                                            <div class="mb-1 pe-3 flex-grow-1">
                                                <div class="fs-5 text-dark text-hover-primary fw-bolder"><?php echo e(__('Choose your Avatar')); ?></div>
                                                <div class="text-gray-800 fw-semibold"><?php echo e(__('You are yet to setup a profile photo')); ?></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <?php if($user->phone_verify == 0 && $set->phone_verify == 1): ?>
                                <div class="d-flex align-items-center mb-9">
                                    <div class="symbol symbol-45px me-5 symbol-circle">
                                        <span class="symbol-label bg-info">
                                            <i class="fal fa-phone text-white"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <a href="<?php echo e(route('user.add-phone')); ?>">
                                            <div class="mb-1 pe-3 flex-grow-1">
                                                <div class="fs-5 text-dark text-hover-primary fw-bolder"><?php echo e(__('Verify Mobile Number ').$user->phone); ?></div>
                                                <div class="text-gray-800 fw-semibold"><?php echo e(__('You are yet to verify your mobile number')); ?>.</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <?php if($user->fa_status == 0): ?>
                                <div class="d-flex align-items-center mb-9">
                                    <div class="symbol symbol-45px me-5 symbol-circle">
                                        <span class="symbol-label bg-info">
                                            <i class="fal fa-hashtag-lock text-white"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <a href="<?php echo e(route('user.profile', ['type' => 'security'])); ?>">
                                            <div class="mb-1 pe-3 flex-grow-1">
                                                <div class="fs-5 text-dark text-hover-primary fw-bolder"><?php echo e(__('Secure your Account')); ?></div>
                                                <div class="text-gray-800 fw-semibold"><?php echo e(__('Protect your account with Two-factor authentication.')); ?></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php else: ?><div class="mb-9"></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="row g-xl-8">
                    <?php if($group->count() > 0): ?>
                    <h4 class="mb-0"><?php echo e(__('Recent Transactions')); ?></h4>
                    <?php $__currentLoopData = $group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-12 col-md-12 mb-6">
                        <h5 class="mb-6 text-info"><?php echo e(($date == \Carbon\Carbon::today()->format('Y-m-d')) ? 'Today' : (($date == \Carbon\Carbon::yesterday()->format('Y-m-d')) ? 'Yesterday' : \Carbon\Carbon::create($date)->format('M j, Y'))); ?></h5>
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="d-flex flex-stack cursor-pointer" id="kt_trx_<?php echo e($val->id); ?>_button">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-40px symbol-circle me-5">
                                    <div class="symbol-label fs-3 fw-bolder text-info bg-light-info">
                                        <?php if($val->trx_type == 'debit'): ?>
                                        <i class="fal fa-minus"></i>
                                        <?php else: ?>
                                        <i class="fal fa-plus"></i>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="ps-1">
                                    <p class="fs-6 text-dark text-hover-primary fw-bolder mb-0"><?php echo e($currency->currency_symbol.currencyFormat(number_format($val->amount, 2)).' '.$currency->currency); ?></p>
                                    <p class="fs-6 text-gray-800 text-hover-primary mb-0"><?php echo e(ucwords(str_replace('_', ' ', $val->type))); ?></p>
                                </div>
                            </div>
                            <div class="ps-1 text-end">
                                <p class="fs-6 text-dark mb-0"><?php echo e($val->created_at->toDayDateTimeString()); ?></p>
                                <p class="fs-6 text-gray-800 text-hover-primary mb-0">
                                    <?php if($val->status == 'success'): ?>
                                    <span class="badge badge-pill badge-success badge-sm"><?php echo e(__('Success')); ?></span>
                                    <?php elseif($val->status == 'pending'): ?>
                                    <span class="badge badge-pill badge-info badge-sm"><?php echo e(__('Pending')); ?></span>
                                    <?php elseif($val->status == 'failed'): ?>
                                    <span class="badge badge-pill badge-danger badge-sm"><?php echo e(__('Failed')); ?></span>
                                    <?php elseif($val->status == 'cancelled'): ?>
                                    <span class="badge badge-pill badge-danger badge-sm"><?php echo e(__('Cancelled')); ?></span>
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                        <?php if(!$loop->last): ?>
                        <hr class="bg-light-border">
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    <div class="text-center mt-20">
                        <img src="<?php echo e(asset('asset/images/transactions.png')); ?>" style="height:auto; max-width:150px;" class="mb-6">
                        <h3 class="text-dark"><?php echo e(__('No Recent Transactions')); ?></h3>
                        <p class="text-dark"><?php echo e(__('We couldn\'t find any transactions to this account')); ?></p>
                    </div>
                    <?php endif; ?>
                </div>
                <?php echo $__env->make('partials.transfer.details', ['admincheck' => 0], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
                <?php if($type == 'portfolio'): ?>
                <div class="row">
                    <div class="col-md-8">

                        <div class="d-flex flex-stack card-p flex-grow-1">
                            <div class="symbol symbol-45px">
                                <div class="symbol-label bg-light">
                                    <i class="fal fa-sync text-dark"></i>
                                </div>
                            </div>
                            <div class="d-flex flex-column text-end">
                                <span class="fw-boldest text-dark fs-2"><?php echo e(__('Unit Purchased')); ?></span>
                                <span class="text-dark-400 fw-bold fs-6"><?php echo e(__('All-time investment')); ?></span>
                            </div>
                        </div>
                        <?php if($user->planUnits()->count()): ?>
                        <div id="kt_chart_earning" class="card-rounded-bottom h-300px mb-10"></div>
                        <?php else: ?>
                        <div class="text-center mt-10 text-muted"><?php echo e(__('No Data')); ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-6">
                            <div class="card-body">
                                <p class="mb-0 text-gray-800 fs-6"><?php echo e(__('Total Units')); ?></p>
                                <p class="fw-bolder text-dark fs-3 mb-0"><?php echo e($user->planUnits()->sum('units') - $user->planUnitsSold()->sum('units')); ?></p>
                            </div>
                        </div>
                        <div class="card mb-6">
                            <div class="card-body">
                                <p class="mb-0 text-gray-800 fs-6"><?php echo e(__('Total Cost')); ?></p>
                                <p class="fw-bolder text-dark fs-3 mb-0"><?php echo e(number_format_short($user->planUnits()->sum('amount') - $user->planUnitsSold()->sum('amount')).' '.$currency->currency); ?></p>
                            </div>
                        </div>
                        <div class="card mb-6">
                            <div class="card-body">
                                <p class="mb-0 text-gray-800 fs-6"><?php echo e(__('Return on Investments (Completed)')); ?></p>
                                <p class="fw-bolder text-dark fs-3 mb-0"><?php echo e(number_format_short($returns[1] + $returns[2]).' '.$currency->currency); ?></p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <p class="mb-0 text-gray-800 fs-6"><?php echo e(__('Return on Investments (Pending)')); ?></p>
                                <p class="fw-bolder text-dark fs-3 mb-0"><?php echo e(number_format_short($returns[0]).' '.$currency->currency); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div><?php /**PATH /home/soccrquq/clovergatebank.com/resources/views/livewire/balance.blade.php ENDPATH**/ ?>