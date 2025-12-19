<div>
    
   
    
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
        
        <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
            <div class="container">
                <?php if($type == 'balance'): ?>
                <div class="row g-xl-8 mb-6">
                    <div class="card bg-transparent h-md-100">
                        <div class="card-body p-0">
                            <div class="balance-section">
    <style>
    .balance-section {
        background: linear-gradient(135deg, #556B2F 0%, #6B8E23 100%);
        padding: 40px 24px 60px 24px;
        margin: 0 -24px -40px -24px;
        position: relative;
    }
    
    .balance-section .account-card {
        margin: 0 auto;
        max-width: 100%;
    }
    
    @media (max-width: 768px) {
        .balance-section {
            padding: 30px 16px 50px 16px;
            margin: 0 -16px -30px -16px;
        }
    }
    </style>
    
    <!-- THE ACCOUNT CARD CODE GOES HERE -->
    <style>
.balance-section {
    background: linear-gradient(135deg, #556B2F 0%, #6B8E23 100%);
    padding: 20px 16px 40px 16px;
    margin: 0 -24px 0 -24px;
    position: relative;
}

.account-card {
    background: linear-gradient(135deg, rgba(26, 35, 50, 0.95) 0%, rgba(13, 20, 32, 0.95) 100%), 
                url('<?php echo e(asset('asset/images/card-bg.png')); ?>');
    background-size: cover;
    background-position: center;
    border-radius: 20px;
    padding: 18px;
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(255, 255, 255, 0.15);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    color: white;
    max-width: 100%;
}


.account-card-content {
    position: relative;
    z-index: 1;
}

.account-type {
    font-size: 11px;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.5);
    margin-bottom: 8px;
    font-weight: 600;
}

.account-balance {
    font-size: 28px;
    font-weight: 700;
    margin: 6px 0 18px 0;
    color: #ffffff;
    letter-spacing: -0.5px;
}

.account-number-label {
    font-size: 11px;
    letter-spacing: 1.2px;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.5);
    margin-bottom: 6px;
    font-weight: 600;
}

.account-number {
    font-size: 16px;
    font-weight: 500;
    margin-bottom: 20px;
    color: #ffffff;
    letter-spacing: 2px;
}
.account-stats {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    margin-top: 8px;
}

.stat-item {
    text-align: left;
}

.stat-label {
    font-size: 9px;
    letter-spacing: 0.8px;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.5);
    margin-bottom: 4px;
    font-weight: 600;
    line-height: 1.2;
}

.stat-value {
    font-size: 18px;
    font-weight: 700;
    color: #ffffff;
}

@media (max-width: 768px) {
    .account-stats {
        gap: 20px;
    }
    
    .stat-label {
        font-size: 8px;
    }
    
    .stat-value {
        font-size: 16px;
    }
}

.stat-label {
    font-size: 10px;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.45);
    margin-bottom: 6px;
    font-weight: 600;
}

.stat-value {
    font-size: 16px;
    font-weight: 600;
    color: #ffffff;
}

.card-menu {
    position: absolute;
    top: 20px;
    right: 20px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background 0.3s;
    z-index: 2;
}

.card-menu:hover {
    background: rgba(255, 255, 255, 0.15);
}

.balance-toggle {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    margin-left: 12px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 6px;
    cursor: pointer;
    transition: background 0.3s;
    vertical-align: middle;
}

.balance-toggle:hover {
    background: rgba(255, 255, 255, 0.2);
}

@media (max-width: 768px) {
    .balance-section {
        padding: 16px 12px 30px 12px;
    }
    
    .account-card {
        padding: 16px;
    }
    
    .account-balance {
        font-size: 24px;
    }
    
    .account-stats {
        flex-direction: column;
        gap: 12px;
    }
}
</style>
<div class="balance-section">
    <div class="account-card" style="background: url('<?php echo e(asset('asset/images/card-bg.png')); ?>'); background-size: cover; background-position: center;">
        <?php if($set->money_transfer): ?>
        <div class="card-menu" id="kt_transfer_money_button" title="Transfer Money">
            <i class="fas fa-ellipsis-h"></i>
        </div>
        <?php endif; ?>
        
        <div class="account-card-content">
            <div class="account-type">CHECKINGS</div>
            <div class="account-balance">
                <span id="main_balance">
                    <?php if($user->business->reveal_balance == 1): ?>
                        <?php echo e($currency->currency_symbol.currencyFormat(number_format($user->getBalance($val->id)->amount,2))); ?>

                    <?php else: ?> 
                        ************
                    <?php endif; ?>
                </span>
                <span class="balance-toggle" wire:click="xBalance">
                    <?php if($user->business->reveal_balance == 1): ?>
                        <i class="fal fa-eye-slash"></i>
                    <?php else: ?>
                        <i class="fal fa-eye"></i>
                    <?php endif; ?>
                </span>
            </div>
            
            <div class="account-number-label">ACCOUNT NUMBER</div>
            <div class="account-number">
                •••• <?php echo e(substr($user->merchant_id, -4)); ?>

                <i class="fal fa-clone castro-copy" data-clipboard-text="<?php echo e($user->merchant_id); ?>" title="Copy" style="font-size: 14px; margin-left: 8px; cursor: pointer; opacity: 0.7;"></i>
            </div>
            
            <div class="account-stats">
    <div class="stat-item">
        <div class="stat-label">Credits - <?php echo e(\Carbon\Carbon::now()->format('F Y')); ?></div>
        <div class="stat-value"><?php echo e($currency->currency_symbol); ?>0.00</div>
    </div>
    <div class="stat-item">
        <div class="stat-label">Debits - <?php echo e(\Carbon\Carbon::now()->format('F Y')); ?></div>
        <div class="stat-value"><?php echo e($currency->currency_symbol); ?>0.00</div>
    </div>
</div>
        </div>
    </div>
    <!-- Icon Grid Container -->
<div class="icon-grid-section">
    <style>
    .icon-grid-section {
        background: white;
        border-radius: 24px 24px 0 0;
        padding: 30px 20px 20px 20px;
        margin-top: 20px;
    }
    
    .icon-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 25px;
    }
    
    .icon-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-decoration: none;
        cursor: pointer;
    }
    .icon-box {
    width: 85px;
    height: 85px;
    background: #556B2F;
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 10px;
    transition: all 0.3s;
}

.icon-box i {
    font-size: 36px;
    color: white !important;
}
    
    .icon-box:hover {
        background: #6B8E23;
        transform: translateY(-2px);
    }
    
    
    .icon-label {
        font-size: 13px;
        font-weight: 600;
        color: #1a1f3a;
        text-align: center;
        line-height: 1.3;
    }
    
    /* Nested Card */
    .nested-card {
        background: linear-gradient(135deg, #556B2F 0%, #6B8E23 100%);
        border-radius: 20px;
        padding: 25px 20px;
        margin-top: 10px;
    }
    
    .nested-card-inner {
        background: white;
        border-radius: 16px;
        padding: 25px 20px;
    }
    
    @media (max-width: 768px) {
        .icon-box {
            width: 60px;
            height: 60px;
        }
        
        .icon-box i {
            font-size: 24px;
        }
        
        .icon-label {
            font-size: 12px;
        }
    }
    </style>
    
    <!-- First Row: Top 3 Icons -->
    <div class="icon-grid">
        <a href="<?php echo e(route('user.profile', ['type' => 'profile'])); ?>" class="icon-item">
            <div class="icon-box" style="width: 85px; height: 85px; background: #556B2F;">
    <i class="fas fa-star" style="color: white !important; font-size: 36px;"></i>
</div>
            <div class="icon-label">View<br>Profile</div>
        </a>
        
        <a href="<?php echo e(route('user.ticket')); ?>" class="icon-item">
            <div class="icon-box" style="width: 85px; height: 85px; background: #556B2F;">
                <i class="fas fa-envelope" style="color: white !important; font-size: 36px;"></i>
            </div>
            <div class="icon-label">contact<br>Support</div>
        </a>
        
        <a href="#" class="icon-item" data-bs-toggle="modal" data-bs-target="#crypto_deposit">
            <div class="icon-box" style="width: 85px; height: 85px; background: #556B2F;">
                <i class="fas fa-credit-card" style="color: white !important; font-size: 36px;"></i>
            </div>
            <div class="icon-label">Cryptocurrency<br>Deposit</div>
        </a>
    </div>
    
    <!-- Nested Card with Second Row -->
    <div class="nested-card">
        <div class="nested-card-inner">
            <div class="icon-grid">
                <a href="#" class="icon-item" id="kt_send_money_button">
                    <div class="icon-box" style="width: 85px; height: 85px; background: #556B2F;">
                        <i class="fas fa-share" style="color: white !important; font-size: 36px;"></i>
                    </div>
                    <div class="icon-label">Wire<br>Transfer</div>
                </a>
                
                <a href="#" class="icon-item" id="kt_transfer_money_button">
                    <div class="icon-box" style="width: 85px; height: 85px; background: #556B2F;">
                        <i class="fas fa-exchange-alt" style="color: white !important; font-size: 36px;"></i>
                    </div>
                    <div class="icon-label">Local<br>Transfer</div>
                </a>
                
                <a href="#" class="icon-item" data-bs-toggle="modal" data-bs-target="#bank_deposit">
                    <div class="icon-box" style="width: 85px; height: 85px; background: #556B2F;">
                        <i class="fas fa-credit-card" style="color: white !important; font-size: 36px;"></i>
                    </div>
                    <div class="icon-label">Check<br>Deposit</div>
                </a>
            </div>
            <!-- Third Row: Savings Statement, Checking Statement, Credit Card -->
<div class="icon-grid">
    <a href="#" class="icon-item">
        <div class="icon-box" style="width: 85px; height: 85px; background: #556B2F;">
            <i class="fas fa-list-alt" style="color: white !important; font-size: 36px;"></i>
        </div>
        <div class="icon-label">Savings<br>Statement</div>
    </a>
    
    <a href="#" class="icon-item">
        <div class="icon-box" style="width: 85px; height: 85px; background: #556B2F;">
            <i class="fas fa-bars" style="color: white !important; font-size: 36px;"></i>
        </div>
        <div class="icon-label">Checking<br>Statement</div>
    </a>
    
    <a href="#" class="icon-item">
        <div class="icon-box" style="width: 85px; height: 85px; background: #556B2F;">
            <i class="fas fa-credit-card" style="color: white !important; font-size: 36px;"></i>
        </div>
        <div class="icon-label">Credit<br>Card</div>
    </a>
</div>

<!-- Fourth Row: Mac Loans, Mac Investment, Mac Tips -->
<div class="icon-grid">
    <?php if($set->loan): ?>
    <a href="<?php echo e(route('user.loan')); ?>" class="icon-item">
        <div class="icon-box" style="width: 85px; height: 85px; background: #556B2F;">
            <i class="fas fa-money-bill" style="color: white !important; font-size: 36px;"></i>
        </div>
        <div class="icon-label">Mac<br>Loans</div>
    </a>
    <?php endif; ?>
    
    <?php if($set->mutual_fund || $set->project_investment): ?>
    <a href="<?php echo e(route('user.plan')); ?>" class="icon-item">
        <div class="icon-box" style="width: 85px; height: 85px; background: #556B2F;">
            <i class="fas fa-chart-line" style="color: white !important; font-size: 36px;"></i>
        </div>
        <div class="icon-label">Mac<br>Investment</div>
    </a>
    <?php endif; ?>
    
    <a href="#" class="icon-item">
        <div class="icon-box" style="width: 85px; height: 85px; background: #556B2F;">
            <i class="fas fa-lightbulb" style="color: white !important; font-size: 36px;"></i>
        </div>
        <div class="icon-label">Mac<br>Tips</div>
    </a>
</div>

<!-- Beneficiaries Section -->
<div style="margin-top: 30px; padding: 0 10px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
        <h3 style="color: #556B2F; font-size: 20px; font-weight: bold; margin: 0;">Beneficiaries</h3>
        <a href="<?php echo e(route('user.profile', ['type' => 'beneficiary'])); ?>" style="background: white; border: 2px solid #556B2F; color: #556B2F; padding: 8px 16px; border-radius: 20px; text-decoration: none; font-weight: 600; font-size: 14px; display: flex; align-items: center; gap: 5px;">
            Add New <i class="fas fa-user-plus"></i>
        </a>
    </div>
    <p style="color: #999; text-align: center; font-size: 14px;">
        No Beneficiary. <a href="<?php echo e(route('user.profile', ['type' => 'beneficiary'])); ?>" style="color: #556B2F; text-decoration: none; font-weight: 600;">Add New</a>
    </p>
</div>
        </div>
    </div>
</div>

</div>
</div>
    

                            <div style="display: none"class="px-9 pt-6 card-rounded w-100 bgi-no-repeat castro-secret2 bgi-size-cover bgi-position-y-top <?php if($next == 1): ?> h-250px <?php else: ?> h-200px <?php endif; ?>">
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
    <!-- Bottom Sticky Navigation -->
<style>
.bottom-nav-wrapper {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 1000;
    pointer-events: none;
}

.bottom-nav {
    background: linear-gradient(to right, 
        rgba(139, 90, 43, 0.3) 0%, 
        rgba(139, 90, 43, 0.15) 25%, 
        transparent 40%, 
        transparent 60%, 
        rgba(139, 90, 43, 0.15) 75%, 
        rgba(139, 90, 43, 0.3) 100%);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    padding: 15px 0 25px 0;
    border-radius: 30px 30px 0 0;
    pointer-events: auto;
}

.bottom-nav-grid {
    display: flex;
    justify-content: space-around;
    align-items: flex-end;
    max-width: 600px;
    margin: 0 auto;
    padding: 0 20px;
    position: relative;
}

.bottom-nav-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-decoration: none;
    flex: 1;
    max-width: 80px;
}

.bottom-nav-icon {
    width: 50px;
    height: 50px;
    background: #556B2F;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 5px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

.bottom-nav-icon i {
    font-size: 24px;
    color: white !important;
}

.bottom-nav-label {
    font-size: 11px;
    font-weight: 600;
    color: #2d3748;
    text-align: center;
    line-height: 1.2;
}

/* Home Icon - Special Styling */
.bottom-nav-item.home-item {
    position: relative;
    margin-top: -15px;
}

.bottom-nav-item.home-item .bottom-nav-icon {
    width: 70px;
    height: 70px;
    background: #556B2F;
    border-radius: 20px;
    box-shadow: 0 8px 20px rgba(85, 107, 47, 0.4);
}

.bottom-nav-item.home-item .bottom-nav-icon i {
    font-size: 32px;
}

/* Separator Lines */
.nav-separator {
    position: absolute;
    width: 100%;
    height: 2px;
    background: linear-gradient(to right, 
        #8B5A2B 0%, 
        rgba(139, 90, 43, 0.3) 20%, 
        transparent 40%, 
        transparent 60%, 
        rgba(139, 90, 43, 0.3) 80%, 
        #8B5A2B 100%);
    top: 15px;
    left: 0;
    z-index: -1;
}

/* Add padding to body */
body {
    padding-bottom: 110px;
}

@media (max-width: 768px) {
    .bottom-nav-icon {
        width: 45px;
        height: 45px;
        background: transparent;
        border: none;
    }
    
    .bottom-nav-icon i {
        font-size: 20px;
    }
    
    .bottom-nav-item.home-item .bottom-nav-icon {
        width: 60px;
        height: 60px;
        background: transparent;
        border: none;
    }
    
    .bottom-nav-item.home-item .bottom-nav-icon i {
        font-size: 28px;
    }
    
    .bottom-nav-label {
        font-size: 10px;
    }
}
</style>

<div class="bottom-nav-wrapper d-lg-none">
    <div class="bottom-nav">
        <div class="nav-separator"></div>
        <div class="bottom-nav-grid">
            <a href="<?php echo e(route('user.profile', ['type' => 'profile'])); ?>" class="bottom-nav-item">
                <div class="bottom-nav-icon">
                    <i class="fas fa-cog" style="color: #556B2F !important; background: transparent; border: none;"></i>
                </div>
                <div class="bottom-nav-label">Settings</div>
            </a>
            
            <a href="#" class="bottom-nav-item">
                <div class="bottom-nav-icon">
                    <i class="fas fa-bell" style="color: #556B2F !important; background: transparent; border: none;"></i>
                </div>
                <div class="bottom-nav-label">Notifications</div>
            </a>
            
            <a href="<?php echo e(route('user.dashboard')); ?>" class="bottom-nav-item home-item">
                <div class="bottom-nav-icon">
                    <i class="fas fa-home" style="color: #556B2F !important; background: transparent; border: none;"></i>
                </div>
                <div class="bottom-nav-label">Home<br><span style="font-size: 9px; color: #556B2F;">Checking</span></div>
            </a>
            
            <a href="<?php echo e(route('user.ticket')); ?>" class="bottom-nav-item">
                <div class="bottom-nav-icon">
                    <i class="fas fa-comments" style="color: #556B2F !important; background: transparent; border: none;"></i>
                </div>
                <div class="bottom-nav-label">Support</div>
            </a>
            
            <div class="bottom-nav-item" style="cursor: pointer;" onclick="document.querySelector('#kt_header_user_menu_toggle').click();">
                <div class="bottom-nav-icon">
                    <i class="fas fa-sign-out-alt" style="color: #556B2F !important; background: transparent; border: none;"></i>
                </div>
                <div class="bottom-nav-label">Logout</div>
            </div>
        </div>
    </div>
</div>
</div>

<?php /**PATH C:\xampp\htdocs\adv-banking\resources\views/livewire/balance.blade.php ENDPATH**/ ?>