<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?php echo e($title); ?> | <?php echo e($set->site_name); ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="<?php echo e($set->site_desc); ?>" />
    <meta name="csrf_token" content="<?php echo e(csrf_token()); ?>" id="csrf_token" data-turbolinks-permanent>
    <link rel="shortcut icon" href="<?php echo e(asset('asset/images/favicon.png')); ?>" />
    <link href="<?php echo e(asset('asset/fonts/fontawesome/css/all.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('dashboard/plugins/custom/leaflet/leaflet.bundle.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('dashboard/plugins/global/plugins.bundle.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('dashboard/plugins/custom/datatables/datatables.bundle.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('dashboard/css/style.bundle.css')); ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css" />
    <link rel="stylesheet" href="<?php echo e(asset('vendor/megaphone/css/megaphone.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('asset/filepond/css/filepond.css')); ?>">
    <?php echo \Livewire\Livewire::styles(); ?>

    <?php echo $__env->yieldContent('css'); ?>
    <?php echo $__env->make('partials.font', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>

<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled aside-fixed aside-default-enabled">
    <div class="page-loading active text-indigo">
        <div class="page-loading-inner">
            <div class="page-spinner"></div><span></span>
        </div>
    </div>
    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-row flex-column-fluid">
            <div id="kt_aside" class="aside aside-default bg-white aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_toggle">
                <div class="aside-logo flex-column-auto pt-9 pb-10" id="kt_aside_logo">
                    <a href="<?php echo e(route('home')); ?>">
                        <img alt="Logo" src="<?php echo e(asset('asset/images/logo.png')); ?>" class="logo-default" style="height:auto; max-width:60%;" />
                        <img alt="Logo" src="<?php echo e(asset('asset/images/logo.png')); ?>" class="logo-minimize" style="height:auto; max-width:60%;" />
                    </a>
                </div>
                <div class="aside-menu flex-column-fluid">
                    <div class="menu menu-column menu-fit menu-rounded menu-title-dark menu-icon-dark menu-state-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold fs-5 my-5 mt-lg-2 mb-lg-0" id="kt_aside_menu" data-kt-menu="true">
                        <div class="menu-fit hover-scroll-y me-lg-n5 pe-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="20px" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer">
                            <div class="menu-item"><!--begin:Menu link-->
                                <a class="menu-link <?php if(route('admin.dashboard')==url()->current()): ?> active <?php endif; ?>" href="<?php echo e(route('admin.dashboard')); ?>">
                                    <span class="menu-icon"><!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                                        <i class="fal fa-home fs-3"></i>
                                    </span>
                                    <span class="menu-title"><?php echo e(__('Dashboard')); ?></span>
                                </a>
                            </div>
                            <div class="menu-item"><!--begin:Menu link-->
                                <a class="menu-link <?php if(route('admin.users')==url()->current() || strpos(url()->current(), 'admin/manage-user') !== false): ?>) active <?php endif; ?>" href="<?php echo e(route('admin.users')); ?>">
                                    <span class="menu-icon"><!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                                        <i class="fal fa-users fs-3"></i>
                                    </span>
                                    <span class="menu-title"><?php echo e(__('Clients')); ?></span>
                                </a>
                            </div>
                            <div class="menu-item"><!--begin:Menu link-->
                                <a class="menu-link <?php if(route('admin.kyc')==url()->current()): ?> active <?php endif; ?>" href="<?php echo e(route('admin.kyc')); ?>">
                                    <span class="menu-icon"><!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                                        <i class="fal fa-face-viewfinder fs-3"></i>
                                    </span>
                                    <span class="menu-title"><?php echo e(__('Pending KYC')); ?>

                                        <?php if($admin->pendingKYC()>0): ?>
                                        <span class="badge badge-sm badge-circle badge-danger mx-3">
                                            <?php echo e($admin->pendingKYC()); ?>

                                        </span>
                                        <?php endif; ?>
                                    </span>
                                </a>
                            </div>
                            <?php if($admin->support==1): ?>
                            <div class="menu-item"><!--begin:Menu link-->
                                <a class="menu-link <?php if(strpos(url()->current(), 'admin/ticket') !== false): ?>) active <?php endif; ?>" href="<?php echo e(route('admin.ticket', ['type' => 'open'])); ?>">
                                    <span class="menu-icon">
                                        <i class="fal fa-clipboard-list-check fs-3"></i>
                                    </span>
                                    <span class="menu-title"><?php echo e(__('Support Ticket')); ?>

                                        <?php if($admin->openTickets()>0): ?>
                                        <span class="badge badge-sm badge-circle badge-danger mx-3">
                                            <?php echo e($admin->openTickets()); ?>

                                        </span>
                                        <?php endif; ?>
                                    </span>
                                </a>
                            </div>
                            <?php endif; ?>
                            <?php if($admin->message==1): ?>
                            <div class="menu-item"><!--begin:Menu link-->
                                <a class="menu-link <?php if(strpos(url()->current(), 'admin/messages') !== false): ?>) active <?php endif; ?>" href="<?php echo e(route('admin.message', ['type' => 'inbox'])); ?>">
                                    <span class="menu-icon">
                                        <i class="fal fa-inbox fs-3"></i>
                                    </span>
                                    <span class="menu-title"><?php echo e(__('Messages')); ?>

                                        <?php if($admin->unreadMessages()>0): ?>
                                        <span class="badge badge-sm badge-circle badge-danger mx-3">
                                            <?php echo e($admin->unreadMessages()); ?>

                                        </span>
                                        <?php endif; ?>
                                    </span>
                                </a>
                            </div>
                            <?php endif; ?>
                            <?php if($admin->savings==1): ?>
                            <div class="menu-item"><!--begin:Menu link-->
                                <a class="menu-link <?php if(strpos(url()->current(), 'admin/save') !== false): ?>) active <?php endif; ?>" href="<?php echo e(route('admin.save', ['type' => 'regular'])); ?>">
                                    <span class="menu-icon">
                                        <i class="fal fa-layer-group fs-3"></i>
                                    </span>
                                    <span class="menu-title"><?php echo e(__('Savings')); ?></span>
                                </a>
                            </div>
                            <?php endif; ?>
                            <?php if($admin->loan==1): ?>
                            <div class="menu-item"><!--begin:Menu link-->
                                <a class="menu-link <?php if(strpos(url()->current(), 'admin/loan') !== false): ?>) active <?php endif; ?>" href="<?php echo e(route('admin.loan', ['type' => 'loanplans'])); ?>">
                                    <span class="menu-icon">
                                        <i class="fal fa-university fs-3"></i>
                                    </span>
                                    <span class="menu-title"><?php echo e(__('Loan & BNPL')); ?>

                                        <?php if($admin->pendingLoan()>0): ?>
                                        <span class="badge badge-sm badge-circle badge-danger mx-3">
                                            <?php echo e($admin->pendingLoan()); ?>

                                        </span>
                                        <?php endif; ?>
                                    </span>
                                </a>
                            </div>
                            <?php endif; ?>
                            <?php if($admin->investment==1): ?>
                            <div class="menu-item"><!--begin:Menu link-->
                                <a class="menu-link <?php if(strpos(url()->current(), 'admin/invest') !== false): ?>) active <?php endif; ?>" href="<?php echo e(route('admin.invest', ['type' => 'project-plans'])); ?>">
                                    <span class="menu-icon">
                                        <i class="fal fa-chart-pie fs-3"></i>
                                    </span>
                                    <span class="menu-title"><?php echo e(__('Investment')); ?></span>
                                </a>
                            </div>
                            <?php endif; ?>
                            <?php if($admin->deposit==1): ?>
                            <div class="menu-item"><!--begin:Menu link-->
                                <a class="menu-link <?php if(strpos(url()->current(), 'admin/deposit') !== false): ?>) active <?php endif; ?>" href="<?php echo e(route('admin.deposit', ['type' => 'pending'])); ?>">
                                    <span class="menu-icon">
                                        <i class="fal fa-circle-arrow-down fs-3"></i>
                                    </span>
                                    <span class="menu-title"><?php echo e(__('Deposit')); ?>

                                        <?php if($admin->pendingDeposit()>0): ?>
                                        <span class="badge badge-sm badge-circle badge-danger mx-3">
                                            <?php echo e($admin->pendingDeposit()); ?>

                                        </span>
                                        <?php endif; ?>
                                    </span>
                                </a>
                            </div>
                            <?php endif; ?>
                            <?php if($admin->payout==1): ?>
                            <div class="menu-item"><!--begin:Menu link-->
                                <a class="menu-link <?php if(strpos(url()->current(), 'admin/payout') !== false): ?>) active <?php endif; ?>" href="<?php echo e(route('admin.payout', ['type' => 'pending'])); ?>">
                                    <span class="menu-icon">
                                        <i class="fal fa-circle-arrow-up fs-3"></i>
                                    </span>
                                    <span class="menu-title"><?php echo e(__('Payout')); ?>

                                        <?php if($admin->pendingPayout()>0): ?>
                                        <span class="badge badge-sm badge-circle badge-danger mx-3">
                                            <?php echo e($admin->pendingPayout()); ?>

                                        </span>
                                        <?php endif; ?>
                                    </span>
                                </a>
                            </div>
                            <?php endif; ?>
                            <?php if($admin->news==1): ?>
                            <div class="menu-item"><!--begin:Menu link-->
                                <a class="menu-link <?php if(strpos(url()->current(), 'admin/blog') !== false): ?>) active <?php endif; ?>" href="<?php echo e(route('admin.blog', ['type' => 'articles'])); ?>">
                                    <span class="menu-icon">
                                        <i class="fal fa-newspaper fs-3"></i>
                                    </span>
                                    <span class="menu-title"><?php echo e(__('Blog')); ?>

                                        <?php if($admin->blogDraft()>0): ?>
                                        <span class="badge badge-sm badge-circle badge-danger mx-3">
                                            <?php echo e($admin->blogDraft()); ?>

                                        </span>
                                        <?php endif; ?>
                                    </span>
                                </a>
                            </div>
                            <?php endif; ?>
                            <?php if($admin->role=="super"): ?>
                            <div class="menu-item"><!--begin:Menu link-->
                                <a class="menu-link <?php if(route('admin.staffs')==url()->current()): ?> active <?php endif; ?>" href="<?php echo e(route('admin.staffs')); ?>">
                                    <span class="menu-icon">
                                        <i class="fal fa-users fs-3"></i>
                                    </span>
                                    <span class="menu-title"><?php echo e(__('Staff & Roles')); ?></span>
                                </a>
                            </div>
                            <?php endif; ?>
                            <?php if($admin->knowledge_base==1): ?>
                            <div class="menu-item"><!--begin:Menu link-->
                                <a class="menu-link <?php if(strpos(url()->current(), 'help_center/index') !== false): ?>) active <?php endif; ?>" href="<?php echo e(route('faq.index')); ?>">
                                    <span class="menu-icon">
                                        <i class="fal fa-question-circle fs-3"></i>
                                    </span>
                                    <span class="menu-title"><?php echo e(__('Help Center')); ?></span>
                                </a>
                            </div>
                            <?php endif; ?>
                            <?php if($admin->email_configuration==1): ?>
                            <div class="menu-item"><!--begin:Menu link-->
                                <a class="menu-link <?php if(strpos(url()->current(), 'admin/email') !== false): ?>) active <?php endif; ?>" href="<?php echo e(route('email.settings', ['type' => 'settings'])); ?>">
                                    <span class="menu-icon"><!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                                        <i class="fal fa-envelope fs-3"></i>
                                    </span>
                                    <span class="menu-title"><?php echo e(__('Email Configuration')); ?></span>
                                </a>
                            </div>
                            <?php endif; ?>
                            <?php if($admin->language==1): ?>
                            <div class="menu-item"><!--begin:Menu link-->
                                <a class="menu-link <?php if(strpos(url()->current(), 'admin/language') !== false): ?>) active <?php endif; ?>" href="<?php echo e(route('admin.language')); ?>">
                                    <span class="menu-icon"><!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                                        <i class="fal fa-language fs-3"></i>
                                    </span>
                                    <span class="menu-title"><?php echo e(__('Language')); ?></span>
                                </a>
                            </div>
                            <?php endif; ?>
                            <div class="menu-item"><!--begin:Menu link-->
                                <a class="menu-link <?php if(strpos(url()->current(), 'admin/settings') !== false): ?>) active <?php endif; ?>" href="<?php echo e(route('admin.settings', ['type' => 'system'])); ?>">
                                    <span class="menu-icon"><!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                                        <i class="fal fa-cog fs-3"></i>
                                    </span>
                                    <span class="menu-title"><?php echo e(__('Settings')); ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="aside-footer flex-column-auto" id="kt_aside_footer"></div>
            </div>
        </div>
    </div>
    <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
        <!--begin::Header-->
        <div id="kt_header" class="header" data-kt-sticky="true" data-kt-sticky-name="header" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
            <!--begin::Container-->
            <div class="container-fluid d-flex align-items-stretch justify-content-between">
                <!--begin::Logo bar-->
                <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                    <!--begin::Logo-->
                    <a href="<?php echo e(route('home')); ?>" class="d-lg-none">
                        <img alt="Logo" src="<?php echo e(asset('asset/images/logo.png')); ?>" style="height:auto; max-width:50%;" />
                    </a>
                    <!--end::Logo-->
                </div>
                <!--end::Logo bar-->
                <!--begin::Topbar-->
                <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
                    <!--begin::Search-->
                    <div class="d-flex align-items-stretch">

                    </div>
                    <!--end::Search-->
                    <!--begin::Toolbar wrapper-->
                    <div class="d-flex align-items-stretch flex-shrink-0">
                        <!--begin::User-->
                        <div class="d-flex align-items-center ms-2 ms-lg-3" id="kt_header_user_menu_toggle">
                            <!--begin::Menu wrapper-->
                            <div class="cursor-pointer symbol symbol-50px symbol-circle" data-kt-menu-trigger="{default: 'click'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                <div class="symbol-label fs-2 fw-bolder text-dark"><i class="fal fa-university"></i></div>
                            </div>
                            <!--begin::User account menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true" style="">
                                <!--begin::Menu item-->
                                <div class="menu-item px-5 mb-0">
                                    <a href="<?php echo e(route('admin.settings', ['type' => 'system'])); ?>" class="menu-link px-5 py-3">
                                        <i class="fal fa-user me-3"></i> <?php echo e(__('System settings')); ?>

                                    </a>
                                </div>

                                <div class="separator"></div>

                                <div class="menu-item px-5 mb-0">
                                    <a href="<?php echo e(route('admin.logout')); ?>" class="menu-link px-5 py-3">
                                        <i class="fal fa-sign-out me-3"></i> <?php echo e(__('Sign Out')); ?>

                                    </a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::User account menu-->
                            <!--end::Menu wrapper-->
                        </div>
                        <!--end::User -->
                        <!--begin::Aside Toggle-->
                        <div class="d-flex align-items-center d-lg-none ms-1 ms-lg-3">
                            <div class="btn btn-icon btn-icon-dark btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" id="kt_aside_toggle">
                                <!--begin::Svg Icon | path: icons/duotone/Text/Menu.svg-->
                                <span class="svg-icon svg-icon-2x">
                                    <i class="fa-thin fa-bars"></i>
                                </span>
                                <!--end::Svg Icon-->
                            </div>
                        </div>
                        <!--end::Aside Toggle-->
                    </div>
                    <!--end::Toolbar wrapper-->
                </div>
                <!--end::Topbar-->
            </div>
            <!--end::Container-->
        </div>
        <div class="content fs-6 d-flex flex-column flex-column-fluid" id="kt_content">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
        <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
            <!--begin::Container-->
            <div class="container-fluid d-flex flex-column flex-md-row flex-stack">
                <!--begin::Copyright-->
                <div class="text-dark order-2 order-md-1">
                    <span class="text-muted fw-bold me-2">2023 ©</span>
                    <a href="https://boomchart.io" target="_blank" class="text-gray-800 text-hover-primary">Boomchart</a>
                </div>
                <!--end::Copyright-->
                <!--begin::Menu-->
                <ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
                    <li class="menu-item">
                        <a href="<?php echo e(route('about')); ?>" target="_blank" class="menu-link px-2 text-dark"><?php echo e(__('About')); ?></a>
                    </li>
                    <li class="menu-item">
                        <a href="<?php echo e(route('terms')); ?>" target="_blank" class="menu-link px-2 text-dark"><?php echo e(__('Terms & Conditions')); ?></a>
                    </li>
                    <li class="menu-item">
                        <a href="<?php echo e(route('privacy')); ?>" target="_blank" class="menu-link px-2 text-dark"><?php echo e(__('Privacy')); ?></a>
                    </li>
                </ul>
                <!--end::Menu-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Footer-->
    </div>
    <script src="<?php echo e(asset('dashboard/plugins/global/plugins.bundle.js')); ?>"></script>
    <script src="<?php echo e(asset('dashboard/js/scripts.bundle.js')); ?>"></script>
    <script src="<?php echo e(asset('asset/fonts/fontawesome/js/all.js')); ?>"></script>
    <script src="<?php echo e(asset('dashboard/js/custom/general.js')); ?>"></script>
    <script src="<?php echo e(asset('asset/tinymce/tinymce.min.js')); ?>"></script>
</body>

</html>
<?php echo \Livewire\Livewire::scripts(); ?>

<?php echo $__env->yieldPushContent('scripts'); ?>
<script src="<?php echo e(asset('dashboard/js/alpine.js')); ?>"></script>
<?php echo $__env->yieldContent('script'); ?>

<script>
    window.livewire.on('success', data => {
        toastr.options.positionClass = 'toast-bottom-right';
        toastr.options.closeButton = true;
        toastr.success(data);
    });
    window.livewire.on('alert', data => {
        toastr.options.positionClass = 'toast-bottom-right';
        toastr.options.closeButton = true;
        toastr.warning(data);
    });
    window.livewire.on('closeModal', data => {
        $('#delete' + data).modal('hide');
    });
    window.livewire.on('closeDrawer', function() {
        KTDrawer.hideAll();
        KTDrawer.createInstances();
    });
    window.livewire.on('drawer', data => {
        KTDrawer.hideAll();
        KTDrawer.createInstances();
    });
    window.livewire.on('searchdrawer', data => {
        KTDrawer.createInstances();
    });
</script>

<?php if(session('success')): ?>
<script>
    "use strict";
    toastr.options.positionClass = 'toast-bottom-right';
    toastr.options.closeButton = true;
    toastr.success("<?php echo session('success'); ?>");
</script>
<?php endif; ?>

<?php if(session('alert')): ?>
<script>
    "use strict";
    toastr.options.positionClass = 'toast-bottom-right';
    toastr.options.closeButton = true;
    toastr.warning("<?php echo session('alert'); ?>");
</script>
<?php endif; ?>

<script>
    var defaultThemeMode = "light";
    var themeMode;

    if (document.documentElement) {
        if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
        } else {
            if (localStorage.getItem("data-bs-theme") !== null) {
                themeMode = localStorage.getItem("data-bs-theme");
            } else {
                themeMode = defaultThemeMode;
            }
        }

        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }

        document.documentElement.setAttribute("data-bs-theme", themeMode);
    }
</script>
<script>
    (function() {
        window.onload = function() {
            const preloader = document.querySelector('.page-loading');
            preloader.classList.remove('active');
            setTimeout(function() {
                preloader.remove();
            }, 1000);
        };
    })();

    // Wait for the page to load
    document.addEventListener("DOMContentLoaded", function () {
        // Find the active element with the "active" class
        const activeNavItem = document.querySelector('.menu-item.active');

        if (activeNavItem) {
            // Scroll to the active element
            activeNavItem.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });
</script><?php /**PATH /home/soccrquq/clovergatebank.com/resources/views/admin/menu.blade.php ENDPATH**/ ?>