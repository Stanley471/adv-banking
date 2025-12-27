<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>{{$title}} | {{$set->site_name}}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="{{$set->site_desc}}" />
    <meta name="csrf_token" content="{{ csrf_token() }}" id="csrf_token" data-turbolinks-permanent>
    <link rel="shortcut icon" href="{{asset('asset/images/favicon.png')}}" />
    <link href="{{asset('asset/fonts/fontawesome/css/all.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('dashboard/plugins/custom/leaflet/leaflet.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('dashboard/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('dashboard/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('dashboard/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css" />
    <link rel="stylesheet" href="{{ asset('vendor/megaphone/css/megaphone.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/filepond/css/filepond.css') }}">
    @livewireStyles
    @yield('css')
    @include('partials.font')
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
                    <a href="{{route('home')}}">
                        <img alt="Logo" src="{{asset('asset/images/logo.png')}}" class="logo-default" style="height:auto; max-width:60%;" />
                        <img alt="Logo" src="{{asset('asset/images/logo.png')}}" class="logo-minimize" style="height:auto; max-width:60%;" />
                    </a>
                </div>
                <div class="aside-menu flex-column-fluid">
                    <div class="menu menu-column menu-fit menu-rounded menu-title-dark menu-icon-dark menu-state-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold fs-5 my-5 mt-lg-2 mb-lg-0" id="kt_aside_menu" data-kt-menu="true">
                        <div class="menu-fit hover-scroll-y me-lg-n5 pe-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="20px" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer">
                            <div class="menu-item"><!--begin:Menu link-->
                                <a class="menu-link @if(route('admin.dashboard')==url()->current()) active @endif" href="{{route('admin.dashboard')}}">
                                    <span class="menu-icon"><!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                                        <i class="fal fa-home fs-3"></i>
                                    </span>
                                    <span class="menu-title">{{__('Dashboard')}}</span>
                                </a>
                            </div>
                            <div class="menu-item"><!--begin:Menu link-->
                                <a class="menu-link @if(route('admin.users')==url()->current() || strpos(url()->current(), 'admin/manage-user') !== false)) active @endif" href="{{route('admin.users')}}">
                                    <span class="menu-icon"><!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                                        <i class="fal fa-users fs-3"></i>
                                    </span>
                                    <span class="menu-title">{{__('Clients')}}</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a href="{{route('admin.transactions.pending')}}" class="nav-link">
                                    <i class="fas fa-clock"></i> Pending Transfers
                                         @if(\App\Models\Transactions::where('status', 'pending')->count() > 0)
                                            <span class="badge badge-warning ms-2">{{\App\Models\Transactions::where('status', 'pending')->count()}}</span>
                                        @endif
                                </a>
                            </div>
                            <div class="menu-item"><!--begin:Menu link-->
                                <a class="menu-link @if(route('admin.kyc')==url()->current()) active @endif" href="{{route('admin.kyc')}}">
                                    <span class="menu-icon"><!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                                        <i class="fal fa-face-viewfinder fs-3"></i>
                                    </span>
                                    <span class="menu-title">{{__('Pending KYC')}}
                                        @if($admin->pendingKYC()>0)
                                        <span class="badge badge-sm badge-circle badge-danger mx-3">
                                            {{$admin->pendingKYC()}}
                                        </span>
                                        @endif
                                    </span>
                                </a>
                            </div>
                            @if($admin->support==1)
                            <div class="menu-item"><!--begin:Menu link-->
                                <a class="menu-link @if(strpos(url()->current(), 'admin/ticket') !== false)) active @endif" href="{{route('admin.ticket', ['type' => 'open'])}}">
                                    <span class="menu-icon">
                                        <i class="fal fa-clipboard-list-check fs-3"></i>
                                    </span>
                                    <span class="menu-title">{{__('Support Ticket')}}
                                        @if($admin->openTickets()>0)
                                        <span class="badge badge-sm badge-circle badge-danger mx-3">
                                            {{$admin->openTickets()}}
                                        </span>
                                        @endif
                                    </span>
                                </a>
                            </div>
                            @endif
                            @if($admin->message==1)
                            <div class="menu-item"><!--begin:Menu link-->
                                <a class="menu-link @if(strpos(url()->current(), 'admin/messages') !== false)) active @endif" href="{{route('admin.message', ['type' => 'inbox'])}}">
                                    <span class="menu-icon">
                                        <i class="fal fa-inbox fs-3"></i>
                                    </span>
                                    <span class="menu-title">{{__('Messages')}}
                                        @if($admin->unreadMessages()>0)
                                        <span class="badge badge-sm badge-circle badge-danger mx-3">
                                            {{$admin->unreadMessages()}}
                                        </span>
                                        @endif
                                    </span>
                                </a>
                            </div>
                            @endif
                            @if($admin->savings==1)
                            <div class="menu-item"><!--begin:Menu link-->
                                <a class="menu-link @if(strpos(url()->current(), 'admin/save') !== false)) active @endif" href="{{route('admin.save', ['type' => 'regular'])}}">
                                    <span class="menu-icon">
                                        <i class="fal fa-layer-group fs-3"></i>
                                    </span>
                                    <span class="menu-title">{{__('Savings')}}</span>
                                </a>
                            </div>
                            @endif
                            @if($admin->loan==1)
                            <div class="menu-item"><!--begin:Menu link-->
                                <a class="menu-link @if(strpos(url()->current(), 'admin/loan') !== false)) active @endif" href="{{route('admin.loan', ['type' => 'loanplans'])}}">
                                    <span class="menu-icon">
                                        <i class="fal fa-university fs-3"></i>
                                    </span>
                                    <span class="menu-title">{{__('Loan & BNPL')}}
                                        @if($admin->pendingLoan()>0)
                                        <span class="badge badge-sm badge-circle badge-danger mx-3">
                                            {{$admin->pendingLoan()}}
                                        </span>
                                        @endif
                                    </span>
                                </a>
                            </div>
                            @endif
                            @if($admin->investment==1)
                            <div class="menu-item"><!--begin:Menu link-->
                                <a class="menu-link @if(strpos(url()->current(), 'admin/invest') !== false)) active @endif" href="{{route('admin.invest', ['type' => 'project-plans'])}}">
                                    <span class="menu-icon">
                                        <i class="fal fa-chart-pie fs-3"></i>
                                    </span>
                                    <span class="menu-title">{{__('Investment')}}</span>
                                </a>
                            </div>
                            @endif
                            @if($admin->deposit==1)
                            <div class="menu-item"><!--begin:Menu link-->
                                <a class="menu-link @if(strpos(url()->current(), 'admin/deposit') !== false)) active @endif" href="{{route('admin.deposit', ['type' => 'pending'])}}">
                                    <span class="menu-icon">
                                        <i class="fal fa-circle-arrow-down fs-3"></i>
                                    </span>
                                    <span class="menu-title">{{__('Deposit')}}
                                        @if($admin->pendingDeposit()>0)
                                        <span class="badge badge-sm badge-circle badge-danger mx-3">
                                            {{$admin->pendingDeposit()}}
                                        </span>
                                        @endif
                                    </span>
                                </a>
                            </div>
                            @endif
                            @if($admin->payout==1)
                            <div class="menu-item"><!--begin:Menu link-->
                                <a class="menu-link @if(strpos(url()->current(), 'admin/payout') !== false)) active @endif" href="{{route('admin.payout', ['type' => 'pending'])}}">
                                    <span class="menu-icon">
                                        <i class="fal fa-circle-arrow-up fs-3"></i>
                                    </span>
                                    <span class="menu-title">{{__('Payout')}}
                                        @if($admin->pendingPayout()>0)
                                        <span class="badge badge-sm badge-circle badge-danger mx-3">
                                            {{$admin->pendingPayout()}}
                                        </span>
                                        @endif
                                    </span>
                                </a>
                            </div>
                            @endif
                            @if($admin->news==1)
                            <div class="menu-item"><!--begin:Menu link-->
                                <a class="menu-link @if(strpos(url()->current(), 'admin/blog') !== false)) active @endif" href="{{route('admin.blog', ['type' => 'articles'])}}">
                                    <span class="menu-icon">
                                        <i class="fal fa-newspaper fs-3"></i>
                                    </span>
                                    <span class="menu-title">{{__('Blog')}}
                                        @if($admin->blogDraft()>0)
                                        <span class="badge badge-sm badge-circle badge-danger mx-3">
                                            {{$admin->blogDraft()}}
                                        </span>
                                        @endif
                                    </span>
                                </a>
                            </div>
                            @endif
                            @if($admin->role=="super")
                            <div class="menu-item"><!--begin:Menu link-->
                                <a class="menu-link @if(route('admin.staffs')==url()->current()) active @endif" href="{{route('admin.staffs')}}">
                                    <span class="menu-icon">
                                        <i class="fal fa-users fs-3"></i>
                                    </span>
                                    <span class="menu-title">{{__('Staff & Roles')}}</span>
                                </a>
                            </div>
                            @endif
                            @if($admin->knowledge_base==1)
                            <div class="menu-item"><!--begin:Menu link-->
                                <a class="menu-link @if(strpos(url()->current(), 'help_center/index') !== false)) active @endif" href="{{route('faq.index')}}">
                                    <span class="menu-icon">
                                        <i class="fal fa-question-circle fs-3"></i>
                                    </span>
                                    <span class="menu-title">{{__('Help Center')}}</span>
                                </a>
                            </div>
                            @endif
                            @if($admin->email_configuration==1)
                            <div class="menu-item"><!--begin:Menu link-->
                                <a class="menu-link @if(strpos(url()->current(), 'admin/email') !== false)) active @endif" href="{{route('email.settings', ['type' => 'settings'])}}">
                                    <span class="menu-icon"><!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                                        <i class="fal fa-envelope fs-3"></i>
                                    </span>
                                    <span class="menu-title">{{__('Email Configuration')}}</span>
                                </a>
                            </div>
                            @endif
                            @if($admin->language==1)
                            <div class="menu-item"><!--begin:Menu link-->
                                <a class="menu-link @if(strpos(url()->current(), 'admin/language') !== false)) active @endif" href="{{route('admin.language')}}">
                                    <span class="menu-icon"><!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                                        <i class="fal fa-language fs-3"></i>
                                    </span>
                                    <span class="menu-title">{{__('Language')}}</span>
                                </a>
                            </div>
                            @endif
                            <div class="menu-item"><!--begin:Menu link-->
                                <a class="menu-link @if(strpos(url()->current(), 'admin/settings') !== false)) active @endif" href="{{route('admin.settings', ['type' => 'system'])}}">
                                    <span class="menu-icon"><!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                                        <i class="fal fa-cog fs-3"></i>
                                    </span>
                                    <span class="menu-title">{{__('Settings')}}</span>
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
                    <a href="{{route('home')}}" class="d-lg-none">
                        <img alt="Logo" src="{{asset('asset/images/logo.png')}}" style="height:auto; max-width:50%;" />
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
                                    <a href="{{route('admin.settings', ['type' => 'system'])}}" class="menu-link px-5 py-3">
                                        <i class="fal fa-user me-3"></i> {{__('System settings')}}
                                    </a>
                                </div>

                                <div class="separator"></div>

                                <div class="menu-item px-5 mb-0">
                                    <a href="{{route('admin.logout')}}" class="menu-link px-5 py-3">
                                        <i class="fal fa-sign-out me-3"></i> {{__('Sign Out')}}
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
            @yield('content')
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
                        <a href="{{route('about')}}" target="_blank" class="menu-link px-2 text-dark">{{__('About')}}</a>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('terms')}}" target="_blank" class="menu-link px-2 text-dark">{{__('Terms & Conditions')}}</a>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('privacy')}}" target="_blank" class="menu-link px-2 text-dark">{{__('Privacy')}}</a>
                    </li>
                </ul>
                <!--end::Menu-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Footer-->
    </div>
    <script src="{{asset('dashboard/plugins/global/plugins.bundle.js')}}"></script>
    <script src="{{asset('dashboard/js/scripts.bundle.js')}}"></script>
    <script src="{{asset('asset/fonts/fontawesome/js/all.js')}}"></script>
    <script src="{{asset('dashboard/js/custom/general.js')}}"></script>
    <script src="{{asset('asset/tinymce/tinymce.min.js')}}"></script>
</body>

</html>
@livewireScripts
@stack('scripts')
<script src="{{asset('dashboard/js/alpine.js')}}"></script>
@yield('script')

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

@if (session('success'))
<script>
    "use strict";
    toastr.options.positionClass = 'toast-bottom-right';
    toastr.options.closeButton = true;
    toastr.success("{!! session('success') !!}");
</script>
@endif

@if (session('alert'))
<script>
    "use strict";
    toastr.options.positionClass = 'toast-bottom-right';
    toastr.options.closeButton = true;
    toastr.warning("{!! session('alert') !!}");
</script>
@endif

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
</script>