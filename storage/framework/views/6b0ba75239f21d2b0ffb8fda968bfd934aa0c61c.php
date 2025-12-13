<?php $__env->startSection('content'); ?>
<div class="toolbar" id="kt_toolbar">
    <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
        <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
            <h1 class="text-dark fw-bolder my-1 fs-2 mb-10"><?php echo e(__('Settings')); ?></h1>
            <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-6 border-gray-300" id="tabs-icons-text" role="tablist">
                <li class="nav-item">
                    <a class="nav-link text-dark <?php if(route('admin.settings', ['type' => 'system'])==url()->current()): ?> active <?php endif; ?>" id="tabs-icons-text-1-tab" href="<?php echo e(route('admin.settings', ['type' => 'system'])); ?>" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><?php echo e(__('System Settings')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark <?php if(route('admin.settings', ['type' => 'payout'])==url()->current()): ?> active <?php endif; ?>" id="tabs-icons-text-2-tab" href="<?php echo e(route('admin.settings', ['type' => 'payout'])); ?>" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><?php echo e(__('Withdrawal')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark <?php if(route('admin.settings', ['type' => 'country'])==url()->current()): ?> active <?php endif; ?>" id="tabs-icons-text-1-tab" href="<?php echo e(route('admin.settings', ['type' => 'country'])); ?>" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><?php echo e(__('Country supported')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark <?php if(route('admin.settings', ['type' => 'money_transfer'])==url()->current()): ?> active <?php endif; ?>" id="tabs-icons-text-2-tab" href="<?php echo e(route('admin.settings', ['type' => 'money_transfer'])); ?>" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><?php echo e(__('P2P Transfer')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark <?php if(route('admin.settings', ['type' => 'bank_deposit'])==url()->current()): ?> active <?php endif; ?>" id="tabs-icons-text-2-tab" href="<?php echo e(route('admin.settings', ['type' => 'bank_deposit'])); ?>" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><?php echo e(__('Bank Deposit')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark <?php if(route('admin.settings', ['type' => 'kyc'])==url()->current()): ?> active <?php endif; ?>" id="tabs-icons-text-1-tab" href="<?php echo e(route('admin.settings', ['type' => 'kyc'])); ?>" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><?php echo e(__('KYC Documents')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark <?php if(route('admin.settings', ['type' => 'payment_gateway'])==url()->current()): ?> active <?php endif; ?>" id="tabs-icons-text-2-tab" href="<?php echo e(route('admin.settings', ['type' => 'payment_gateway'])); ?>" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><?php echo e(__('Payment Gateway')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark <?php if(route('admin.settings', ['type' => 'security'])==url()->current()): ?> active <?php endif; ?>" id="tabs-icons-text-2-tab" href="<?php echo e(route('admin.settings', ['type' => 'security'])); ?>" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><?php echo e(__('Security')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark <?php if(route('admin.settings', ['type' => 'recaptcha'])==url()->current()): ?> active <?php endif; ?>" id="tabs-icons-text-2-tab" href="<?php echo e(route('admin.settings', ['type' => 'recaptcha'])); ?>" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><?php echo e(__('Recaptcha')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark <?php if(route('admin.settings', ['type' => 'twilio'])==url()->current()): ?> active <?php endif; ?>" id="tabs-icons-text-2-tab" href="<?php echo e(route('admin.settings', ['type' => 'twilio'])); ?>" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><?php echo e(__('Twilio')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark <?php if(route('admin.settings', ['type' => 'policies'])==url()->current()): ?> active <?php endif; ?>" id="tabs-icons-text-2-tab" href="<?php echo e(route('admin.settings', ['type' => 'policies'])); ?>" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><?php echo e(__('Policies')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark <?php if(route('admin.settings', ['type' => 'social'])==url()->current()): ?> active <?php endif; ?>" id="tabs-icons-text-2-tab" href="<?php echo e(route('admin.settings', ['type' => 'social'])); ?>" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><?php echo e(__('Social Media')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark <?php if(route('admin.settings', ['type' => 'brands'])==url()->current()): ?> active <?php endif; ?>" id="tabs-icons-text-2-tab" href="<?php echo e(route('admin.settings', ['type' => 'brands'])); ?>" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><?php echo e(__('Brands')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark <?php if(route('admin.settings', ['type' => 'review'])==url()->current()): ?> active <?php endif; ?>" id="tabs-icons-text-2-tab" href="<?php echo e(route('admin.settings', ['type' => 'review'])); ?>" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><?php echo e(__('Reviews')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark <?php if(route('admin.settings', ['type' => 'services'])==url()->current()): ?> active <?php endif; ?>" id="tabs-icons-text-2-tab" href="<?php echo e(route('admin.settings', ['type' => 'services'])); ?>" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><?php echo e(__('Services')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark <?php if(route('admin.settings', ['type' => 'logo'])==url()->current()): ?> active <?php endif; ?>" id="tabs-icons-text-2-tab" href="<?php echo e(route('admin.settings', ['type' => 'logo'])); ?>" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><?php echo e(__('Logos & favicon')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark <?php if(route('admin.settings', ['type' => 'page'])==url()->current()): ?> active <?php endif; ?>" id="tabs-icons-text-2-tab" href="<?php echo e(route('admin.settings', ['type' => 'page'])); ?>" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><?php echo e(__('Custom Pages')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark <?php if(route('admin.settings', ['type' => 'home'])==url()->current()): ?> active <?php endif; ?>" id="tabs-icons-text-2-tab" href="<?php echo e(route('admin.settings', ['type' => 'home'])); ?>" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><?php echo e(__('About us & Home Page')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark <?php if(route('admin.settings', ['type' => 'team'])==url()->current()): ?> active <?php endif; ?>" id="tabs-icons-text-2-tab" href="<?php echo e(route('admin.settings', ['type' => 'team'])); ?>" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><?php echo e(__('Team')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark <?php if(route('admin.settings', ['type' => 'social_login'])==url()->current()): ?> active <?php endif; ?>" id="tabs-icons-text-2-tab" href="<?php echo e(route('admin.settings', ['type' => 'social_login'])); ?>" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><?php echo e(__('Social Login')); ?></a>
                </li>
            </ul>
        </div>
        <div class="d-flex align-items-center flex-nowrap text-nowrap py-1 mb-6">
            <a href="<?php echo e(route('run.migration')); ?>" class="btn btn-white text-dark me-4"><i class="fal fa-database"></i> <?php echo e(__('Run migrations')); ?></a>
            <a href="<?php echo e(route('optimize.system')); ?>" class="btn btn-warning text-dark me-4"><i class="fal fa-bolt"></i> <?php echo e(__('Optimize system')); ?></a>
        </div>
    </div>
    <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
        <div class="container">
            <div class="tab-content" id="myTabContent">
                <?php if(route('admin.settings', ['type' => 'system'])==url()->current()): ?>
                <div class="tab-pane fade <?php if(route('admin.settings', ['type' => 'system'])==url()->current()): ?>show active <?php endif; ?>" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                    <div class="card mb-10">
                        <div class="card-body">
                            <form action="<?php echo e(route('admin.settings.update', ['type' => 'system'])); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Website name')); ?></label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="site_name" value="<?php echo e($set->site_name); ?>" required />
                                    <?php $__errorArgs = ['site_name'];
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
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Website email')); ?></label>
                                    <input class="form-control form-control-lg form-control-solid" type="email" name="email" value="<?php echo e($set->email); ?>" required />
                                    <span class="form-text">Displayed on homepage</span>
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
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Support email')); ?></label>
                                    <input class="form-control form-control-lg form-control-solid" type="email" name="support_email" value="<?php echo e($set->support_email); ?>" required />
                                    <span class="form-text">For ticket</span>
                                    <?php $__errorArgs = ['support_email'];
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
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Mobile')); ?></label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="mobile" value="<?php echo e($set->mobile); ?>" required />
                                    <?php $__errorArgs = ['mobile'];
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
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Website title')); ?></label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="title" value="<?php echo e($set->title); ?>" required />
                                    <?php $__errorArgs = ['title'];
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
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Short description')); ?></label>
                                    <textarea class="form-control form-control-lg form-control-solid" type="text" name="site_desc" required rows="3"><?php echo e($set->site_desc); ?></textarea>
                                    <?php $__errorArgs = ['site_desc'];
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
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Address')); ?></label>
                                    <textarea class="form-control form-control-lg form-control-solid" type="text" name="address" required rows="3"><?php echo e($set->address); ?></textarea>
                                    <?php $__errorArgs = ['address'];
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
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Livechat snippet code')); ?></label>
                                    <textarea class="form-control form-control-lg form-control-solid" type="text" name="livechat" rows="3"><?php echo e($set->livechat); ?></textarea>
                                    <?php $__errorArgs = ['livechat'];
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
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Analytics snippet code')); ?></label>
                                    <textarea class="form-control form-control-lg form-control-solid" type="text" name="analytic_snippet" rows="3"><?php echo e($set->analytic_snippet); ?></textarea>
                                    <?php $__errorArgs = ['analytic_snippet'];
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
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Currency Format')); ?></label>
                                    <select class="form-select form-select-solid" name="currency_format" required>
                                        <option value="normal" <?php if($set->currency_format=="normal"): ?> selected <?php endif; ?></option><?php echo e(__('Normal - 1,000.00')); ?></option>
                                        <option value="reversed" <?php if($set->currency_format=="reversed"): ?> selected <?php endif; ?></option><?php echo e(__('Reveresd - 1.000,00')); ?></option>
                                    </select>
                                    <?php $__errorArgs = ['currency_format'];
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
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Default Website Font')); ?></label>
                                    <select class="form-select form-select-solid" name="default_font" required>
                                        <option value="Graphik" <?php if($set->default_font=="Graphik"): ?> selected <?php endif; ?></option><?php echo e(__('Graphik')); ?></option>
                                        <option value="HKGroteskPro" <?php if($set->default_font=="HKGroteskPro"): ?> selected <?php endif; ?></option><?php echo e(__('HKGroteskPro')); ?></option>
                                        <option value="Roboto" <?php if($set->default_font=="Roboto"): ?> selected <?php endif; ?></option><?php echo e(__('Roboto')); ?></option>
                                        <option value="STIX Two Text" <?php if($set->default_font=="STIX Two Text"): ?> selected <?php endif; ?></option><?php echo e(__('STIX Two Text')); ?></option>
                                        <option value="Atkinson Hyperlegible" <?php if($set->default_font=="Atkinson Hyperlegible"): ?> selected <?php endif; ?></option><?php echo e(__('Atkinson Hyperlegible')); ?></option>
                                        <option value="Open Sans" <?php if($set->default_font=="Open Sans"): ?> selected <?php endif; ?></option><?php echo e(__('Open Sans')); ?></option>
                                        <option value="Noto Sans JP" <?php if($set->default_font=="Noto Sans JP"): ?> selected <?php endif; ?></option><?php echo e(__('Noto Sans JP')); ?></option>
                                        <option value="Roboto Condensed" <?php if($set->default_font=="Roboto Condensed"): ?> selected <?php endif; ?></option><?php echo e(__('Roboto Condensed')); ?></option>
                                        <option value="Source Sans Pro" <?php if($set->default_font=="Source Sans Pro"): ?> selected <?php endif; ?></option><?php echo e(__('Source Sans Pro')); ?></option>
                                        <option value="Noto Sans" <?php if($set->default_font=="Noto Sans"): ?> selected <?php endif; ?></option><?php echo e(__('Noto Sans')); ?></option>
                                        <option value="PT Sans" <?php if($set->default_font=="PT Sans"): ?> selected <?php endif; ?></option><?php echo e(__('PT Sans')); ?></option>
                                        <option value="Georama" <?php if($set->default_font=="Georama"): ?> selected <?php endif; ?>><?php echo e(__('Georama')); ?></option>
                                        <option value="Lato" <?php if($set->default_font=="Lato"): ?> selected <?php endif; ?>><?php echo e(__('Lato')); ?></option>
                                        <option value="Montserrat" <?php if($set->default_font=="Montserrat"): ?> selected <?php endif; ?>><?php echo e(__('Montserrat')); ?></option>
                                        <option value="Hahmlet" <?php if($set->default_font=="Hahmlet"): ?> selected <?php endif; ?>><?php echo e(__('Hahmlet')); ?></option>
                                        <option value="Poppins" <?php if($set->default_font=="Poppins"): ?> selected <?php endif; ?>><?php echo e(__('Poppins')); ?></option>
                                        <option value="Oswald" <?php if($set->default_font=="Oswald"): ?> selected <?php endif; ?>><?php echo e(__('Oswald')); ?></option>
                                        <option value="Raleway" <?php if($set->default_font=="Raleway"): ?> selected <?php endif; ?>><?php echo e(__('Raleway')); ?></option>
                                        <option value="Nunito" <?php if($set->default_font=="Nunito"): ?> selected <?php endif; ?>><?php echo e(__('Nunito')); ?></option>
                                        <option value="Merriweather" <?php if($set->default_font=="Merriweather"): ?> selected <?php endif; ?>><?php echo e(__('Merriweather')); ?></option>
                                        <option value="Ubuntu" <?php if($set->default_font=="Ubuntu"): ?> selected <?php endif; ?>><?php echo e(__('Ubuntu')); ?></option>
                                        <option value="Rubik" <?php if($set->default_font=="Rubik"): ?> selected <?php endif; ?>><?php echo e(__('Rubik')); ?></option>
                                        <option value="Lora" <?php if($set->default_font=="Lora"): ?> selected <?php endif; ?>><?php echo e(__('Lora')); ?></option>
                                        <option value="Mukta" <?php if($set->default_font=="Mukta"): ?> selected <?php endif; ?>><?php echo e(__('Mukta')); ?></option>
                                        <option value="Inter" <?php if($set->default_font=="Inter"): ?> selected <?php endif; ?>><?php echo e(__('Inter')); ?></option>
                                        <option value="Quicksand" <?php if($set->default_font=="Quicksand"): ?> selected <?php endif; ?>><?php echo e(__('Quickand')); ?></option>
                                        <option value="Heebo" <?php if($set->default_font=="Heebo"): ?> selected <?php endif; ?>><?php echo e(__('Karla')); ?></option>
                                        <option value="Martel Sans" <?php if($set->default_font=="Martel Sans"): ?> selected <?php endif; ?>><?php echo e(__('Martel Sans')); ?></option>
                                        <option value="Oxygen" <?php if($set->default_font=="Oxygen"): ?> selected <?php endif; ?>><?php echo e(__('Oxygen')); ?></option>
                                        <option value="Cern" <?php if($set->default_font=="Cern"): ?> selected <?php endif; ?>><?php echo e(__('Cern')); ?></option>
                                    </select>
                                    <?php $__errorArgs = ['default_font'];
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
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Default Country & Currency')); ?></label>
                                    <select class="form-select form-select-solid" data-control="select2" data-placeholder="Select Currency" name="currency">
                                        <option></option>
                                        <?php $__currentLoopData = getAllCountry(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($val->id); ?>" <?php if($admin->currency()->real->iso2 == $val->iso2): ?>selected <?php endif; ?>><?php echo e($val->name.' '.$val->emoji.' '.$val->currency); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Admin URL')); ?></label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="admin_url" value="<?php echo e($set->admin_url); ?>" required />
                                    <?php $__errorArgs = ['admin_url'];
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
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Career URL')); ?></label>
                                    <input class="form-control form-control-lg form-control-solid" type="url" name="career_url" value="<?php echo e($set->career_url); ?>" />
                                    <span class="form-text">Available job positions link</span>
                                    <?php $__errorArgs = ['career_url'];
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
                                <div class="form-check form-check-custom form-check-solid mb-6">
                                    <input class="form-check-input" type="checkbox" id="registration" name="registration" value="1" <?php if($set->registration==1): ?>checked <?php endif; ?> />
                                    <label class="form-check-label" for="registration"><?php echo e(__('Registration')); ?></label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid mb-6">
                                    <input class="form-check-input" type="checkbox" id="maintenance" name="maintenance" value="1" <?php if($set->maintenance==1): ?>checked <?php endif; ?> />
                                    <label class="form-check-label" for="maintenance"><?php echo e(__('Maintenance mode')); ?></label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid mb-6">
                                    <input class="form-check-input" type="checkbox" id="phone_verify" name="phone_verify" value="1" <?php if($set->phone_verify==1): ?>checked <?php endif; ?> />
                                    <label class="form-check-label" for="phone_verify"><?php echo e(__('Require Phone Verification')); ?></label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid mb-6">
                                    <input class="form-check-input" type="checkbox" id="email_verify" name="email_verify" value="1" <?php if($set->email_verify==1): ?>checked <?php endif; ?> />
                                    <label class="form-check-label" for="email_verify"><?php echo e(__('Require Email Verification')); ?></label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid mb-6">
                                    <input class="form-check-input" type="checkbox" id="language" name="language" value="1" <?php if($set->language==1): ?>checked <?php endif; ?> />
                                    <label class="form-check-label" for="language"><?php echo e(__('Language translation')); ?></label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid mb-6">
                                    <input class="form-check-input" type="checkbox" id="referral" name="referral" value="1" <?php if($set->referral==1): ?>checked <?php endif; ?> />
                                    <label class="form-check-label" for="referral"><?php echo e(__('Referral - Investment fee waiver (active if mutual fund or project investment is active)')); ?></label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid mb-6">
                                    <input class="form-check-input" type="checkbox" id="loan" name="loan" value="1" <?php if($set->loan==1): ?>checked <?php endif; ?> />
                                    <label class="form-check-label" for="loan"><?php echo e(__('Loan')); ?></label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid mb-6">
                                    <input class="form-check-input" type="checkbox" id="buy_now_pay_later" name="buy_now_pay_later" value="1" <?php if($set->buy_now_pay_later==1): ?>checked <?php endif; ?> />
                                    <label class="form-check-label" for="buy_now_pay_later"><?php echo e(__('Buy now pay later')); ?></label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid mb-6">
                                    <input class="form-check-input" type="checkbox" id="savings" name="savings" value="1" <?php if($set->savings==1): ?>checked <?php endif; ?> />
                                    <label class="form-check-label" for="savings"><?php echo e(__('Savings')); ?></label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid mb-6">
                                    <input class="form-check-input" type="checkbox" id="mutual_fund" name="mutual_fund" value="1" <?php if($set->mutual_fund==1): ?>checked <?php endif; ?> />
                                    <label class="form-check-label" for="mutual_fund"><?php echo e(__('Mutual Fund')); ?></label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid mb-6">
                                    <input class="form-check-input" type="checkbox" id="project_investment" name="project_investment" value="1" <?php if($set->project_investment==1): ?>checked <?php endif; ?> />
                                    <label class="form-check-label" for="project_investment"><?php echo e(__('Project Investment')); ?></label>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-lg btn-info fw-bolder me-3 my-2"><?php echo e(__('Update')); ?></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if(route('admin.settings', ['type' => 'payment_gateway'])==url()->current()): ?>
                <div class="tab-pane fade <?php if(route('admin.settings', ['type' => 'payment_gateway'])==url()->current()): ?>show active <?php endif; ?>" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    <?php $__currentLoopData = $admin->allGateway(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div id="edit<?php echo e($val->id); ?>" class="modal fade" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"><?php echo e($val->name); ?></h5>
                                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                        <span class="svg-icon svg-icon-1">
                                            <i class="fal fa-times"></i>
                                        </span>
                                    </div>
                                </div>
                                <form action="<?php echo e(route('gateway.update', ['gateway' => $val->id])); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label"><?php echo e(__('Name of gateway for users')); ?></label>
                                                    <input value="<?php echo e($val->id); ?>" type="hidden" name="id">
                                                    <input type="text" value="<?php echo e($val->name); ?>" name="name" class="form-control form-control-lg form-control-solid">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="col-form-label"><?php echo e(__('Minimum Amount')); ?></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text border-0"><?php echo e($currency->currency_symbol); ?></span>
                                                        <input type="number" name="minamo" maxlength="10" class="form-control form-control-lg form-control-solid" value="<?php echo e($val->minamo); ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="col-form-label"><?php echo e(__('Maximum Amount')); ?></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text border-0"><?php echo e($currency->currency_symbol); ?></span>
                                                        <input type="number" name="maxamo" maxlength="10" class="form-control form-control-lg form-control-solid" value="<?php echo e($val->maxamo); ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label class="col-form-label"><?php echo e(__('Fiat Charge [Not Required]')); ?></label>
                                                <div class="input-group">
                                                    <span class="input-group-text border-0"><?php echo e($currency->currency_symbol); ?></span>
                                                    <input type="number" step="any" name="fiat_charge" value="<?php echo e($val->fiat_charge); ?>" class="form-control form-control-lg form-control-solid">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="col-form-label"><?php echo e(__('Percent Charge [Not Required]')); ?></label>
                                                <div class="input-group">
                                                    <input type="number" step="any" name="percent_charge" value="<?php echo e($val->percent_charge); ?>" class="form-control form-control-lg form-control-solid">
                                                    <span class="input-group-text border-0">%</span>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if($val->id==101): ?>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label"><?php echo e(__('PAYPAL Client Id')); ?></label>
                                                    <input type="text" value="<?php echo e($val->val1); ?>" class="form-control form-control-lg form-control-solid" id="val1" name="val1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label"><?php echo e(__('Secret key')); ?></label>
                                                    <input type="text" value="<?php echo e($val->val2); ?>" class="form-control form-control-lg form-control-solid" id="val2" name="val2">
                                                </div>
                                            </div>
                                        </div>
                                        <?php elseif($val->id==102): ?>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label"><?php echo e(__('Perfect Money USD account')); ?></label>
                                                    <input type="text" value="<?php echo e($val->val1); ?>" class="form-control form-control-lg form-control-solid" id="val1" name="val1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label"><?php echo e(__('Alternate passphrase')); ?></label>
                                                    <input type="text" value="<?php echo e($val->val2); ?>" class="form-control form-control-lg form-control-solid" id="val2" name="val2">
                                                </div>
                                            </div>
                                        </div>
                                        <?php elseif($val->id==103): ?>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label"><?php echo e(__('Secret key')); ?></label>
                                                    <input type="text" value="<?php echo e($val->val1); ?>" class="form-control form-control-lg form-control-solid" id="val1" name="val1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label"><?php echo e(__('Publishable key')); ?></label>
                                                    <input type="text" value="<?php echo e($val->val2); ?>" class="form-control form-control-lg form-control-solid" id="val2" name="val2">
                                                </div>
                                            </div>
                                        </div>
                                        <?php elseif($val->id==104): ?>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label"><?php echo e(__('Merchant email')); ?></label>
                                                    <input type="text" value="<?php echo e($val->val1); ?>" class="form-control form-control-lg form-control-solid" id="val1" name="val1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label"><?php echo e(__('Secret key')); ?></label>
                                                    <input type="text" value="<?php echo e($val->val2); ?>" class="form-control form-control-lg form-control-solid" id="val2" name="val2">
                                                </div>
                                            </div>
                                        </div>
                                        <?php elseif($val->id==107): ?>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label"><?php echo e(__('Public key')); ?></label>
                                                    <input type="text" value="<?php echo e($val->val1); ?>" class="form-control form-control-lg form-control-solid" id="val1" name="val1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label"><?php echo e(__('Secret key')); ?></label>
                                                    <input type="text" value="<?php echo e($val->val2); ?>" class="form-control form-control-lg form-control-solid" id="val2" name="val2">
                                                </div>
                                            </div>
                                        </div>
                                        <?php elseif($val->id==108): ?>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label"><?php echo e(__('Public key')); ?></label>
                                                    <input type="text" value="<?php echo e($val->val1); ?>" class="form-control form-control-lg form-control-solid" id="val1" name="val1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label"><?php echo e(__('Secret key')); ?></label>
                                                    <input type="text" value="<?php echo e($val->val2); ?>" class="form-control form-control-lg form-control-solid" id="val2" name="val2">
                                                </div>
                                            </div>
                                        </div>
                                        <?php elseif($val->id==501): ?>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label"><?php echo e(__('Api key')); ?></label>
                                                    <input type="text" value="<?php echo e($val->val1); ?>" class="form-control form-control-lg form-control-solid" id="val1" name="val1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label"><?php echo e(__('Xpub code')); ?></label>
                                                    <input type="text" value="<?php echo e($val->val2); ?>" class="form-control form-control-lg form-control-solid" id="val2" name="val2">
                                                </div>
                                            </div>
                                        </div>
                                        <?php elseif($val->id==505): ?>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label"><?php echo e(__('Public key')); ?></label>
                                                    <input type="text" value="<?php echo e($val->val1); ?>" class="form-control form-control-lg form-control-solid" id="val1" name="val1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label"><?php echo e(__('Private key')); ?></label>
                                                    <input type="text" value="<?php echo e($val->val2); ?>" class="form-control form-control-lg form-control-solid" id="val2" name="val2">
                                                </div>
                                            </div>
                                        </div>
                                        <?php elseif($val->id==506): ?>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label"><?php echo e(__('Public key')); ?></label>
                                                    <input type="text" value="<?php echo e($val->val1); ?>" class="form-control form-control-lg form-control-solid" id="val1" name="val1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label"><?php echo e(__('Private key')); ?></label>
                                                    <input type="text" value="<?php echo e($val->val2); ?>" class="form-control form-control-lg form-control-solid" id="val2" name="val2">
                                                </div>
                                            </div>
                                        </div>
                                        <?php elseif($val->id==507): ?>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label"><?php echo e(__('API key')); ?></label>
                                                    <input type="text" value="<?php echo e($val->val1); ?>" class="form-control form-control-lg form-control-solid" id="val1" name="val1">
                                                </div>
                                            </div>
                                        </div>
                                        <?php elseif($val->id==508): ?>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label"><?php echo e(__('Api Key')); ?></label>
                                                    <input type="text" value="<?php echo e($val->val1); ?>" class="form-control form-control-lg form-control-solid" id="val1" name="val1">
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <?php if($val->type == 1): ?>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label"><?php echo e(__('Instructions')); ?></label>
                                                    <textarea type="text" class="form-control form-control-lg form-control-solid" name="instructions"><?php echo e($val->instructions); ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label"><?php echo e(__('Payment Details')); ?></label>
                                                    <input type="text" value="<?php echo e($val->val1); ?>" class="form-control form-control-lg form-control-solid" id="val1" name="val1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-12"><?php echo e(__('Crypto')); ?></label>
                                            <div class="col-lg-12">
                                                <select class="form-select form-select-solid" name="crypto">
                                                    <option value="1" <?php if($val->crypto==1): ?>
                                                        selected
                                                        <?php endif; ?>><?php echo e(__('Yes')); ?>

                                                    </option>
                                                    <option value="0" <?php if($val->crypto==0): ?>
                                                        selected
                                                        <?php endif; ?>><?php echo e(__('No')); ?>

                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label"><?php echo e(__('Wallet address')); ?></label>
                                                    <input type="text" value="<?php echo e($val->val2); ?>" class="form-control form-control-lg form-control-solid" id="val2" name="val2">
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <div class="form-group">
                                            <label class="col-form-label"><?php echo e(__('Status')); ?></label>
                                            <select class="form-select form-select-solid" name="status">
                                                <option value="1" <?php if($val->status==1): ?>
                                                    selected
                                                    <?php endif; ?>
                                                    ><?php echo e(__('Active')); ?>

                                                </option>
                                                <option value="0" <?php if($val->status==0): ?>
                                                    selected
                                                    <?php endif; ?>
                                                    ><?php echo e(__('Deactive')); ?>

                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-neutral" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                                        <button type="submit" class="btn btn-info"><?php echo e(__('Save changes')); ?></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div wire:ignore.self class="modal fade" id="delete<?php echo e($val->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title"><?php echo e(__('Delete Gateway')); ?></h3>
                                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                        <span class="svg-icon svg-icon-1">
                                            <i class="fal fa-times"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this gateway?, you can't restore it after this</p>
                                    <div class="text-center">
                                        <a href="<?php echo e(route('gateway.delete', ['gateway'=>$val->id])); ?>" class="btn btn-danger btn-block"><?php echo e(__('Delete gateway')); ?></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="card mb-6">
                        <div class="card-header card-header-stretch">
                            <div class="card-title">
                                <h2 class="fw-boldest m-0">Automated Gateways</h2>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-bordered table-row-solid gy-5 gs-7" id="kt_api_keys_table">
                                    <thead>
                                        <tr class="text-start text-dark fw-bolder fs-7 text-uppercase px-7">
                                            <th class="w-250px min-w-100px ps-9">Main Name</th>
                                            <th class="w-275px min-w-100px px-0">Name for users</th>
                                            <th class="w-125px min-w-125px">Limit</th>
                                            <th class="w-125px min-w-50px">Charge</th>
                                            <th class="w-125px min-w-50px">Status</th>
                                            <th class="w-125px min-w-50px">Updated</th>
                                            <th class="w-100px"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="fs-6 fw-bold text-dark">
                                        <?php $__currentLoopData = $admin->automatedGateway(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($val->main_name); ?></td>
                                            <td><?php echo e($val->name); ?></td>
                                            <td><?php echo e($currency->currency_symbol.$val->minamo.' - '.$currency->currency_symbol.number_format($val->maxamo)); ?></td>
                                            <td><?php if($val->percent_charge!=null): ?><?php echo e($val->percent_charge); ?>% <?php else: ?> 0% <?php endif; ?> + <?php if($val->fiat_charge!=null): ?><?php echo e($val->fiat_charge.' '.$currency->currency); ?> <?php else: ?> 0 <?php echo e($currency->currency_symbol); ?> <?php endif; ?></td>
                                            <td>
                                                <?php if($val->status==0): ?>
                                                <span class="badge badge-danger badge-pill"><?php echo e(__('Disabled')); ?></span>
                                                <?php elseif($val->status==1): ?>
                                                <span class="badge badge-success badge-pill"><?php echo e(__('Active')); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->updated_at))); ?></td>
                                            <td class="text-center">
                                                <a data-bs-toggle="modal" data-bs-target="#edit<?php echo e($val->id); ?>" class="btn btn-info btn-sm text-white">
                                                    <?php echo e(__('Edit')); ?>

                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="add" class="modal fade" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Create Gateway</h5>
                                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                        <span class="svg-icon svg-icon-1">
                                            <i class="fal fa-times"></i>
                                        </span>
                                    </div>
                                </div>
                                <form action="<?php echo e(route('gateway.store')); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label"><?php echo e(__('Name of gateway for users')); ?></label>
                                                    <input type="text" name="name" class="form-control form-control-lg form-control-solid">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="col-form-label"><?php echo e(__('Minimum Amount')); ?></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text border-0"><?php echo e($currency->currency_symbol); ?></span>
                                                        <input type="number" name="minamo" maxlength="10" class="form-control form-control-lg form-control-solid" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="col-form-label"><?php echo e(__('Maximum Amount')); ?></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text border-0"><?php echo e($currency->currency_symbol); ?></span>
                                                        <input type="number" name="maxamo" maxlength="10" class="form-control form-control-lg form-control-solid" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <label class="col-form-label"><?php echo e(__('Fiat Charge [Not Required]')); ?></label>
                                                <div class="input-group">
                                                    <span class="input-group-text border-0"><?php echo e($currency->currency_symbol); ?></span>
                                                    <input type="number" step="any" name="fiat_charge" class="form-control form-control-lg form-control-solid">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="col-form-label"><?php echo e(__('Percent Charge [Not Required]')); ?></label>
                                                <div class="input-group">
                                                    <input type="number" step="any" name="percent_charge" class="form-control form-control-lg form-control-solid">
                                                    <span class="input-group-text border-0">%</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label"><?php echo e(__('Instructions')); ?></label>
                                                    <textarea type="text" class="form-control form-control-lg form-control-solid" name="instructions"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label"><?php echo e(__('Payment Details')); ?></label>
                                                    <input type="text" class="form-control form-control-lg form-control-solid" id="val1" name="val1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-12"><?php echo e(__('Crypto')); ?></label>
                                            <div class="col-lg-12">
                                                <select class="form-select form-select-solid" name="crypto">
                                                    <option value="1"><?php echo e(__('Yes')); ?>

                                                    </option>
                                                    <option value="0"><?php echo e(__('No')); ?>

                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label"><?php echo e(__('Wallet address')); ?></label>
                                                    <input type="text" value="<?php echo e($val->val2); ?>" class="form-control form-control-lg form-control-solid" id="val2" name="val2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-neutral" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                                        <button type="submit" class="btn btn-info"><?php echo e(__('Save changes')); ?></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header card-header-stretch">
                            <div class="card-title">
                                <h2 class="fw-boldest me-6">Manual Gateways</h2>
                                <a data-bs-toggle="modal" data-bs-target="#add" class="btn btn-info btn-sm text-white">
                                    <?php echo e(__('Add')); ?>

                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-bordered table-row-solid gy-5 gs-7" id="kt_api_keys_table">
                                    <thead>
                                        <tr class="text-start text-dark fw-bolder fs-7 text-uppercase px-7">
                                            <th class="w-275px min-w-100px px-0">Name</th>
                                            <th class="w-125px min-w-125px">Limit</th>
                                            <th class="w-125px min-w-50px">Charge</th>
                                            <th class="w-125px min-w-50px">Status</th>
                                            <th class="min-w-150px">Updated</th>
                                            <th class="w-200px"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="fs-6 fw-bold text-dark">
                                        <?php $__currentLoopData = $admin->manualGateway(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($val->name); ?></td>
                                            <td><?php echo e($currency->currency_symbol.$val->minamo.' - '.$currency->currency_symbol.number_format($val->maxamo)); ?></td>
                                            <td><?php if($val->percent_charge!=null): ?><?php echo e($val->percent_charge); ?>% <?php else: ?> 0% <?php endif; ?> + <?php if($val->fiat_charge!=null): ?><?php echo e($val->fiat_charge.' '.$currency->currency); ?> <?php else: ?> 0 <?php echo e($currency->currency_symbol); ?> <?php endif; ?></td>
                                            <td>
                                                <?php if($val->status==0): ?>
                                                <span class="badge badge-danger badge-pill"><?php echo e(__('Disabled')); ?></span>
                                                <?php elseif($val->status==1): ?>
                                                <span class="badge badge-success badge-pill"><?php echo e(__('Active')); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->updated_at))); ?></td>
                                            <td class="text-center">
                                                <a data-bs-toggle="modal" data-bs-target="#edit<?php echo e($val->id); ?>" class="btn btn-info btn-sm text-white">
                                                    <?php echo e(__('Edit')); ?>

                                                </a>
                                                <a data-bs-toggle="modal" data-bs-target="#delete<?php echo e($val->id); ?>" class="btn btn-danger btn-sm text-white">
                                                    <?php echo e(__('Delete')); ?>

                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if(route('admin.settings', ['type' => 'payout'])==url()->current()): ?>
                <div class="tab-pane fade <?php if(route('admin.settings', ['type' => 'payout'])==url()->current()): ?>show active <?php endif; ?>" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    <div class="card mb-10">
                        <div class="card-body">
                            <h4 class="mb-6">Bank Account Settings</h4>
                            <form action="<?php echo e(route('admin.settings.update', ['type' => 'payout'])); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Payout limit')); ?></label>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-6">
                                            <div class="input-group">
                                                <span class="input-group-text border-0"><?php echo e($currency->currency_symbol); ?></span>
                                                <input type="number" step="any" name="min_pl" placeholder="<?php echo e(__('Minimum amount')); ?>" value="<?php echo e($set->min_pl); ?>" autocomplete="off" class="form-control form-control-lg form-control-solid">
                                                <span class="input-group-text border-0"><?php echo e($currency->currency); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-6">
                                            <div class="input-group">
                                                <span class="input-group-text border-0"><?php echo e($currency->currency_symbol); ?></span>
                                                <input type="number" step="any" name="max_pl" placeholder="<?php echo e(__('Maximum amount')); ?>" value="<?php echo e($set->max_pl); ?>" autocomplete="off" class="form-control form-control-lg form-control-solid">
                                                <span class="input-group-text border-0"><?php echo e($currency->currency); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Account number length')); ?></label>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-6">
                                            <input type="number" name="min_account" placeholder="<?php echo e(__('Minimum amount')); ?>" value="<?php echo e($set->min_account); ?>" autocomplete="off" class="form-control form-control-lg form-control-solid">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-6">
                                            <input type="number" name="max_account" placeholder="<?php echo e(__('Maximum length')); ?>" value="<?php echo e($set->max_account); ?>" autocomplete="off" class="form-control form-control-lg form-control-solid">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Payout charge type')); ?></label>
                                    <select class="form-select form-select-solid" name="pct" id="pct" required>
                                        <option value="both" <?php if($set->pct=="both"): ?> selected <?php endif; ?>>Percentage & Fiat</option>
                                        <option value="percent" <?php if($set->pct=="percent"): ?> selected <?php endif; ?>>Percentage</option>
                                        <option value="fiat" <?php if($set->pct=="fiat"): ?> selected <?php endif; ?>>Fiat</option>
                                        <option value="none" <?php if($set->pct=="none"): ?> selected <?php endif; ?>>No fees</option>
                                        <option value="min" <?php if($set->pct=="min"): ?> selected <?php endif; ?>>Below</option>
                                        <option value="max" <?php if($set->pct=="max"): ?> selected <?php endif; ?>>Above</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-6">
                                            <div class="input-group">
                                                <input type="number" step="any" name="percent_pc" id="percent_pc" readonly placeholder="<?php echo e(__('percent charge')); ?>" value="<?php echo e($set->percent_pc); ?>" autocomplete="off" class="form-control form-control-lg form-control-solid">
                                                <span class="input-group-text border-0">%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-6">
                                            <div class="input-group">
                                                <span class="input-group-text border-0"><?php echo e($currency->currency_symbol); ?></span>
                                                <input type="number" step="any" name="fiat_pc" id="fiat_pc" placeholder="<?php echo e(__('fiat charge')); ?>" value="<?php echo e($set->fiat_pc); ?>" autocomplete="off" class="form-control form-control-lg form-control-solid">
                                                <span class="input-group-text border-0"><?php echo e($currency->currency); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-check form-check-custom form-check-solid mb-6">
                                    <input class="form-check-input" type="checkbox" id="payout" name="payout" value="1" <?php if($set->payout==1): ?>checked <?php endif; ?> />
                                    <label class="form-check-label" for="payout"><?php echo e(__('Bank Payout')); ?></label>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-lg btn-info fw-bolder me-3 my-2"><?php echo e(__('Update')); ?></a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.banks.index', ['admin' => $admin])->html();
} elseif ($_instance->childHasBeenRendered('USlyHdD')) {
    $componentId = $_instance->getRenderedChildComponentId('USlyHdD');
    $componentTag = $_instance->getRenderedChildComponentTagName('USlyHdD');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('USlyHdD');
} else {
    $response = \Livewire\Livewire::mount('admin.banks.index', ['admin' => $admin]);
    $html = $response->html();
    $_instance->logRenderedChild('USlyHdD', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.withdraw.index', ['admin' => $admin])->html();
} elseif ($_instance->childHasBeenRendered('NyprylF')) {
    $componentId = $_instance->getRenderedChildComponentId('NyprylF');
    $componentTag = $_instance->getRenderedChildComponentTagName('NyprylF');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('NyprylF');
} else {
    $response = \Livewire\Livewire::mount('admin.withdraw.index', ['admin' => $admin]);
    $html = $response->html();
    $_instance->logRenderedChild('NyprylF', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                </div>
                <?php endif; ?>
                <?php if(route('admin.settings', ['type' => 'money_transfer'])==url()->current()): ?>
                <div class="tab-pane fade <?php if(route('admin.settings', ['type' => 'money_transfer'])==url()->current()): ?>show active <?php endif; ?>" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    <div class="card mb-10">
                        <div class="card-body">
                            <form action="<?php echo e(route('admin.settings.update', ['type' => 'money_transfer'])); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Transfer limit')); ?></label>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-6">
                                            <div class="input-group">
                                                <span class="input-group-text border-0"><?php echo e($currency->currency_symbol); ?></span>
                                                <input type="number" step="any" name="min_tl" placeholder="<?php echo e(__('Minimum amount')); ?>" value="<?php echo e($set->min_tl); ?>" autocomplete="off" class="form-control form-control-lg form-control-solid" required>
                                                <span class="input-group-text border-0"><?php echo e($currency->currency); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-6">
                                            <div class="input-group">
                                                <span class="input-group-text border-0"><?php echo e($currency->currency_symbol); ?></span>
                                                <input type="number" step="any" name="max_tl" placeholder="<?php echo e(__('Maximum amount')); ?>" value="<?php echo e($set->max_tl); ?>" autocomplete="off" class="form-control form-control-lg form-control-solid" required>
                                                <span class="input-group-text border-0"><?php echo e($currency->currency); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Transfer charge type')); ?></label>
                                    <select class="form-select form-select-solid" name="tct" id="pct" required>
                                        <option value="both" <?php if($set->tct=="both"): ?> selected <?php endif; ?>>Percentage & Fiat</option>
                                        <option value="percent" <?php if($set->tct=="percent"): ?> selected <?php endif; ?>>Percentage</option>
                                        <option value="fiat" <?php if($set->tct=="fiat"): ?> selected <?php endif; ?>>Fiat</option>
                                        <option value="none" <?php if($set->tct=="none"): ?> selected <?php endif; ?>>No fees</option>
                                        <option value="min" <?php if($set->tct=="min"): ?> selected <?php endif; ?>>Below</option>
                                        <option value="max" <?php if($set->tct=="max"): ?> selected <?php endif; ?>>Above</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-6">
                                            <div class="input-group">
                                                <input type="number" step="any" name="percent_tc" id="percent_pc" readonly placeholder="<?php echo e(__('percent charge')); ?>" value="<?php echo e($set->percent_tc); ?>" autocomplete="off" class="form-control form-control-lg form-control-solid">
                                                <span class="input-group-text border-0">%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-6">
                                            <div class="input-group">
                                                <span class="input-group-text border-0"><?php echo e($currency->currency_symbol); ?></span>
                                                <input type="number" step="any" name="fiat_tc" id="fiat_pc" placeholder="<?php echo e(__('fiat charge')); ?>" value="<?php echo e($set->fiat_tc); ?>" autocomplete="off" class="form-control form-control-lg form-control-solid">
                                                <span class="input-group-text border-0"><?php echo e($currency->currency); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-check form-check-custom form-check-solid mb-6">
                                    <input class="form-check-input" type="checkbox" id="money_transfer" name="money_transfer" value="1" <?php if($set->money_transfer==1): ?>checked <?php endif; ?> />
                                    <label class="form-check-label" for="money_transfer"><?php echo e(__('P2P transfer between users')); ?></label>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-lg btn-info fw-bolder me-3 my-2"><?php echo e(__('Update')); ?></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if(route('admin.settings', ['type' => 'kyc'])==url()->current()): ?>
                <div class="tab-pane fade <?php if(route('admin.settings', ['type' => 'kyc'])==url()->current()): ?>show active <?php endif; ?>" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.kyc.index', ['admin' => $admin])->html();
} elseif ($_instance->childHasBeenRendered('91lB7QW')) {
    $componentId = $_instance->getRenderedChildComponentId('91lB7QW');
    $componentTag = $_instance->getRenderedChildComponentTagName('91lB7QW');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('91lB7QW');
} else {
    $response = \Livewire\Livewire::mount('admin.kyc.index', ['admin' => $admin]);
    $html = $response->html();
    $_instance->logRenderedChild('91lB7QW', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                </div>
                <?php endif; ?>
                <?php if(route('admin.settings', ['type' => 'country'])==url()->current()): ?>
                <div class="tab-pane fade <?php if(route('admin.settings', ['type' => 'country'])==url()->current()): ?>show active <?php endif; ?>" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.country.index', ['admin' => $admin])->html();
} elseif ($_instance->childHasBeenRendered('iRqNWwS')) {
    $componentId = $_instance->getRenderedChildComponentId('iRqNWwS');
    $componentTag = $_instance->getRenderedChildComponentTagName('iRqNWwS');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('iRqNWwS');
} else {
    $response = \Livewire\Livewire::mount('admin.country.index', ['admin' => $admin]);
    $html = $response->html();
    $_instance->logRenderedChild('iRqNWwS', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                </div>
                <?php endif; ?>
                <?php if(route('admin.settings', ['type' => 'bank_deposit'])==url()->current()): ?>
                <div class="tab-pane fade <?php if(route('admin.settings', ['type' => 'bank_deposit'])==url()->current()): ?>show active <?php endif; ?>" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    <div class="card mb-10">
                        <div class="card-body">
                            <form action="<?php echo e(route('admin.settings.update', ['type' => 'bank_deposit'])); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Bank name')); ?></label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="dp_bank_name" value="<?php echo e($set->dp_bank_name); ?>" required />
                                    <?php $__errorArgs = ['dp_bank_name'];
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
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Routing Code')); ?></label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="bk_routing_code" value="<?php echo e($set->bk_routing_code); ?>" required />
                                    <?php $__errorArgs = ['bk_routing_code'];
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
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Account Number')); ?></label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="bk_acct_no" value="<?php echo e($set->bk_acct_no); ?>" required />
                                    <?php $__errorArgs = ['bk_acct_no'];
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
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Account Name')); ?></label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="bk_acct_name" value="<?php echo e($set->bk_acct_name); ?>" required />
                                    <?php $__errorArgs = ['bk_acct_name'];
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
                                <div class="form-check form-check-custom form-check-solid mb-6">
                                    <input class="form-check-input" type="checkbox" id="bk_status" name="bk_status" value="1" <?php if($set->bk_status==1): ?>checked <?php endif; ?> />
                                    <label class="form-check-label" for="bk_status"><?php echo e(__('Bank Deposit')); ?></label>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-lg btn-info fw-bolder me-3 my-2"><?php echo e(__('Update')); ?></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if(route('admin.settings', ['type' => 'recaptcha'])==url()->current()): ?>
                <div class="tab-pane fade <?php if(route('admin.settings', ['type' => 'recaptcha'])==url()->current()): ?>show active <?php endif; ?>" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                    <div class="card mb-10">
                        <div class="card-body">
                            <form action="<?php echo e(route('admin.settings.update', ['type' => 'recaptcha'])); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <p class="fs-5 text-dark fw-bold"><?php echo e(__('Google Recaptcha V3, this will be enabled on registration and contact us page to prevent spamming and bots')); ?></p>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('NOCAPTCHA SECRET')); ?></label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="NOCAPTCHA_SECRET" value="<?php echo e($set->NOCAPTCHA_SECRET); ?>" required />
                                    <?php $__errorArgs = ['NOCAPTCHA_SECRET'];
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
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('NOCAPTCHA SITEKEY')); ?></label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="NOCAPTCHA_SITEKEY" value="<?php echo e($set->NOCAPTCHA_SITEKEY); ?>" required />
                                    <?php $__errorArgs = ['NOCAPTCHA_SITEKEY'];
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
                                <div class="form-check form-check-custom form-check-solid mb-6">
                                    <input class="form-check-input" type="checkbox" id="recaptcha" name="recaptcha" value="1" <?php if($set->recaptcha==1): ?>checked <?php endif; ?> />
                                    <label class="form-check-label" for="recaptcha"><?php echo e(__('Recaptcha')); ?></label>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-lg btn-info fw-bolder me-3 my-2"><?php echo e(__('Update')); ?></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if(route('admin.settings', ['type' => 'twilio'])==url()->current()): ?>
                <div class="tab-pane fade <?php if(route('admin.settings', ['type' => 'twilio'])==url()->current()): ?>show active <?php endif; ?>" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                    <div class="card mb-10">
                        <div class="card-body">
                            <form action="<?php echo e(route('admin.settings.update', ['type' => 'twilio'])); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Twilio account sid')); ?></label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="twilio_account_sid" value="<?php echo e($set->twilio_account_sid); ?>" required />
                                    <?php $__errorArgs = ['twilio_account_sid'];
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
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Twilio auth token')); ?></label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="twilio_auth_token" value="<?php echo e($set->twilio_auth_token); ?>" required />
                                    <?php $__errorArgs = ['twilio_auth_token'];
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
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Twilio number')); ?></label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="twilio_number" value="<?php echo e($set->twilio_number); ?>" required />
                                    <?php $__errorArgs = ['twilio_number'];
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
                                <div class="text-end">
                                    <button type="submit" class="btn btn-lg btn-info fw-bolder me-3 my-2"><?php echo e(__('Update')); ?></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if(route('admin.settings', ['type' => 'security'])==url()->current()): ?>
                <div class="tab-pane fade <?php if(route('admin.settings', ['type' => 'security'])==url()->current()): ?>show active <?php endif; ?>" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                    <div class="card mb-10">
                        <div class="card-body">
                            <p class="text-dark fs-5 fw-bold"><?php echo e(__('Change admin login credentials')); ?></p>
                            <form action="<?php echo e(route('admin.settings.update', ['type' => 'security'])); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Username')); ?></label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="username" value="<?php echo e($admin->username); ?>" />
                                    <?php $__errorArgs = ['username'];
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
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Password')); ?></label>
                                    <input class="form-control form-control-lg form-control-solid" type="password" name="password" required />
                                    <?php $__errorArgs = ['password'];
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
                                <div class="text-end">
                                    <button type="submit" class="btn btn-lg btn-info fw-bolder me-3 my-2"><?php echo e(__('Update')); ?></a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card mb-10">
                        <div class="card-body">
                            <p class="text-dark fs-5 fw-bold"><?php echo e(__('Admin Recovery')); ?></p>
                            <form action="<?php echo e(route('admin.settings.update', ['type' => 'settings'])); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Recovery email')); ?></label>
                                    <input class="form-control form-control-lg form-control-solid" type="email" name="recovery_email" value="<?php echo e($set->recovery_email); ?>" />
                                    <?php $__errorArgs = ['recovery_email'];
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
                                <div class="text-end">
                                    <button type="submit" class="btn btn-lg btn-info fw-bolder me-3 my-2"><?php echo e(__('Update')); ?></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if(route('admin.settings', ['type' => 'policies'])==url()->current()): ?>
                <div class="tab-pane fade <?php if(route('admin.settings', ['type' => 'policies'])==url()->current()): ?>show active <?php endif; ?>" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    <div class="card mb-10">
                        <div class="card-body">
                            <form action="<?php echo e(route('admin.settings.update', ['type' => 'policies'])); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Privacy policy')); ?></label>
                                    <textarea class="form-control form-control-lg form-control-solid tinymce" rows="20" name="privacy"><?php echo e($set->privacy); ?></textarea>
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Terms & Conditions')); ?></label>
                                    <textarea class="form-control form-control-lg form-control-solid tinymce" rows="20" name="terms"><?php echo e($set->terms); ?></textarea>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-lg btn-info fw-bolder me-3 my-2"><?php echo e(__('Update')); ?></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if(route('admin.settings', ['type' => 'social'])==url()->current()): ?>
                <div class="tab-pane fade <?php if(route('admin.settings', ['type' => 'social'])==url()->current()): ?>show active <?php endif; ?>" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    <div class="card mb-10">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-row-bordered gy-5">
                                    <thead>
                                        <tr class="fw-semibold fs-6 text-muted">
                                            <th><?php echo e(__('S/N')); ?></th>
                                            <th><?php echo e(__('Name')); ?></th>
                                            <th><?php echo e(__('Link')); ?></th>
                                            <th class="scope"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $admin->socialLinks(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(++$k); ?>.</td>
                                            <td><?php echo e($val->type); ?></td>
                                            <td><?php echo e(($val->value) ? $val->value : 'No link'); ?></td>
                                            <td class="text-right">
                                                <a class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#update<?php echo e($val->id); ?>" href=""><i class="fal fa-pencil"></i> <?php echo e(__('Edit')); ?></a>
                                            </td>
                                        </tr>
                                        <div id="update<?php echo e($val->id); ?>" class="modal fade" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title"><?php echo e(ucwords($val->type)); ?></h3>
                                                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                            <span class="svg-icon svg-icon-1">
                                                                <i class="fal fa-times"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <form action="<?php echo e(route('social-links.update', ['social' => $val->id])); ?>" method="post">
                                                        <div class="modal-body">
                                                            <?php echo csrf_field(); ?>
                                                            <div class="form-group row">
                                                                <div class="col-lg-12">
                                                                    <input type="url" name="link" class="form-control form-control-solid form-control-lg" placeholder="Enter link" value="<?php echo e($val->value); ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-info"><?php echo e(__('Update')); ?></button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if(route('admin.settings', ['type' => 'brands'])==url()->current()): ?>
                <div class="tab-pane fade <?php if(route('admin.settings', ['type' => 'brands'])==url()->current()): ?>show active <?php endif; ?>" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.brand.index', ['admin' => $admin])->html();
} elseif ($_instance->childHasBeenRendered('AsPj8VW')) {
    $componentId = $_instance->getRenderedChildComponentId('AsPj8VW');
    $componentTag = $_instance->getRenderedChildComponentTagName('AsPj8VW');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('AsPj8VW');
} else {
    $response = \Livewire\Livewire::mount('admin.brand.index', ['admin' => $admin]);
    $html = $response->html();
    $_instance->logRenderedChild('AsPj8VW', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                </div>
                <?php endif; ?>
                <?php if(route('admin.settings', ['type' => 'review'])==url()->current()): ?>
                <div class="tab-pane fade <?php if(route('admin.settings', ['type' => 'review'])==url()->current()): ?>show active <?php endif; ?>" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.review.index', ['admin' => $admin])->html();
} elseif ($_instance->childHasBeenRendered('sdSXGx6')) {
    $componentId = $_instance->getRenderedChildComponentId('sdSXGx6');
    $componentTag = $_instance->getRenderedChildComponentTagName('sdSXGx6');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('sdSXGx6');
} else {
    $response = \Livewire\Livewire::mount('admin.review.index', ['admin' => $admin]);
    $html = $response->html();
    $_instance->logRenderedChild('sdSXGx6', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                </div>
                <?php endif; ?>
                <?php if(route('admin.settings', ['type' => 'services'])==url()->current()): ?>
                <div class="tab-pane fade <?php if(route('admin.settings', ['type' => 'services'])==url()->current()): ?>show active <?php endif; ?>" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.services.index', ['admin' => $admin])->html();
} elseif ($_instance->childHasBeenRendered('1AnohLl')) {
    $componentId = $_instance->getRenderedChildComponentId('1AnohLl');
    $componentTag = $_instance->getRenderedChildComponentTagName('1AnohLl');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('1AnohLl');
} else {
    $response = \Livewire\Livewire::mount('admin.services.index', ['admin' => $admin]);
    $html = $response->html();
    $_instance->logRenderedChild('1AnohLl', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                </div>
                <?php endif; ?>
                <?php if(route('admin.settings', ['type' => 'logo'])==url()->current()): ?>
                <div class="tab-pane fade <?php if(route('admin.settings', ['type' => 'logo'])==url()->current()): ?>show active <?php endif; ?>" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.logo.index', ['admin' => $admin])->html();
} elseif ($_instance->childHasBeenRendered('0l572ZV')) {
    $componentId = $_instance->getRenderedChildComponentId('0l572ZV');
    $componentTag = $_instance->getRenderedChildComponentTagName('0l572ZV');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('0l572ZV');
} else {
    $response = \Livewire\Livewire::mount('admin.logo.index', ['admin' => $admin]);
    $html = $response->html();
    $_instance->logRenderedChild('0l572ZV', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                </div>
                <?php endif; ?>
                <?php if(route('admin.settings', ['type' => 'page'])==url()->current()): ?>
                <div class="tab-pane fade <?php if(route('admin.settings', ['type' => 'page'])==url()->current()): ?>show active <?php endif; ?>" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.page.index', ['admin' => $admin])->html();
} elseif ($_instance->childHasBeenRendered('StPQXzK')) {
    $componentId = $_instance->getRenderedChildComponentId('StPQXzK');
    $componentTag = $_instance->getRenderedChildComponentTagName('StPQXzK');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('StPQXzK');
} else {
    $response = \Livewire\Livewire::mount('admin.page.index', ['admin' => $admin]);
    $html = $response->html();
    $_instance->logRenderedChild('StPQXzK', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                </div>
                <?php endif; ?>
                <?php if(route('admin.settings', ['type' => 'home'])==url()->current()): ?>
                <div class="tab-pane fade <?php if(route('admin.settings', ['type' => 'home'])==url()->current()): ?>show active <?php endif; ?>" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.home.index', ['admin' => $admin])->html();
} elseif ($_instance->childHasBeenRendered('4EktWXE')) {
    $componentId = $_instance->getRenderedChildComponentId('4EktWXE');
    $componentTag = $_instance->getRenderedChildComponentTagName('4EktWXE');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('4EktWXE');
} else {
    $response = \Livewire\Livewire::mount('admin.home.index', ['admin' => $admin]);
    $html = $response->html();
    $_instance->logRenderedChild('4EktWXE', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                </div>
                <?php endif; ?>
                <?php if(route('admin.settings', ['type' => 'team'])==url()->current()): ?>
                <div class="tab-pane fade <?php if(route('admin.settings', ['type' => 'team'])==url()->current()): ?>show active <?php endif; ?>" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.team.index', ['admin' => $admin])->html();
} elseif ($_instance->childHasBeenRendered('US5bZLo')) {
    $componentId = $_instance->getRenderedChildComponentId('US5bZLo');
    $componentTag = $_instance->getRenderedChildComponentTagName('US5bZLo');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('US5bZLo');
} else {
    $response = \Livewire\Livewire::mount('admin.team.index', ['admin' => $admin]);
    $html = $response->html();
    $_instance->logRenderedChild('US5bZLo', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                </div>
                <?php endif; ?>
                <?php if(route('admin.settings', ['type' => 'social_login'])==url()->current()): ?>
                <div class="tab-pane fade <?php if(route('admin.settings', ['type' => 'social_login'])==url()->current()): ?>show active <?php endif; ?>" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    <div class="card mb-10">
                        <div class="card-body">
                            <form action="<?php echo e(route('admin.settings.update', ['type' => 'social_login'])); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <p>Redirect route => <?php echo e(route('callback.login', ['type' => 'google'])); ?></p>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Google Client ID')); ?></label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="google_ci" value="<?php echo e($set->google_ci); ?>" />
                                    <?php $__errorArgs = ['google_ci'];
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
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Google Client Secret')); ?></label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="google_cs" value="<?php echo e($set->google_cs); ?>" />
                                    <?php $__errorArgs = ['google_cs'];
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
                                <div class="form-check form-check-custom form-check-solid mb-6">
                                    <input class="form-check-input" type="checkbox" id="google_sl" name="google_sl" value="1" <?php if($set->google_sl==1): ?>checked <?php endif; ?> />
                                    <label class="form-check-label" for="google_sl"><?php echo e(__('Google login')); ?></label>
                                </div>
                                <p>Redirect route => <?php echo e(route('callback.login', ['type' => 'facebook'])); ?></p>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Facebook Client ID')); ?></label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="facebook_ci" value="<?php echo e($set->facebook_ci); ?>" />
                                    <?php $__errorArgs = ['facebook_ci'];
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
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Facebook Client Secret')); ?></label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="facebook_cs" value="<?php echo e($set->facebook_cs); ?>" />
                                    <?php $__errorArgs = ['facebook_cs'];
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
                                <div class="form-check form-check-custom form-check-solid mb-6">
                                    <input class="form-check-input" type="checkbox" id="facebook_sl" name="facebook_sl" value="1" <?php if($set->facebook_sl==1): ?>checked <?php endif; ?> />
                                    <label class="form-check-label" for="facebook_sl"><?php echo e(__('Facebook login')); ?></label>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-lg btn-info fw-bolder me-3 my-2"><?php echo e(__('Update')); ?></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<?php if(route('admin.settings', ['type' => 'policies'])==url()->current()): ?>
<script src="<?php echo e(asset('asset/tinymce/tinymce.min.js')); ?>"></script>
<script src="<?php echo e(asset('asset/tinymce/init-tinymce.js')); ?>"></script>
<?php endif; ?>
<script>
    function pct() {
        var pct = $("#pct").find(":selected").val();
        var myarr = pct;
        if (myarr == "both") {
            $("#fiat_pc").attr({
                required: true,
                readonly: false,
                placeholder: 'Fiat charge'
            });
            $("#percent_pc").attr({
                required: true,
                readonly: false,
                placeholder: 'Percent charge'
            });
        } else if (myarr == "fiat") {
            $("#fiat_pc").attr({
                required: true,
                readonly: false,
                placeholder: 'Fiat charge'
            });
            $("#percent_pc").attr({
                required: false,
                readonly: true,
                placeholder: 'Percent charge'
            });
        } else if (myarr == "percent") {
            $("#fiat_pc").attr({
                required: false,
                readonly: true,
                placeholder: 'Fiat charge'
            });
            $("#percent_pc").attr({
                required: true,
                readonly: false,
                placeholder: 'Percent charge'
            });
        } else if (myarr == "none") {
            $("#fiat_pc").attr({
                required: false,
                readonly: true,
                placeholder: 'Fiat charge'
            });
            $("#percent_pc").attr({
                required: false,
                readonly: true,
                placeholder: 'Percent charge'
            });
        } else {
            $("#fiat_pc").attr({
                required: true,
                readonly: false,
                placeholder: 'Amount'
            });
            $("#percent_pc").attr({
                required: false,
                readonly: true
            });
        }
    }
    $("#pct").change(pct);
    pct();
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/soccrquq/clovergatebank.com/resources/views/admin/settings/index.blade.php ENDPATH**/ ?>