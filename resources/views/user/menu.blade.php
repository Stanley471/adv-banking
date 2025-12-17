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
  <link href="{{asset('dashboard/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css" />
  <link rel="stylesheet" href="{{ asset('vendor/megaphone/css/megaphone.css') }}">
  <link rel="stylesheet" href="{{asset('asset/filepond/css/filepond.css')}}" />
  <link href="{{asset('dashboard/css/custom.css')}}" rel="stylesheet" type="text/css" />  <!-- ADD THIS -->

  @livewireStyles
  
  @yield('css')
  @include('partials.font')
</head>

<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled aside-fixed aside-default-enabled">
  
  <div class="modal fade" id="referral" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header border-0">
          <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
            <span class="svg-icon svg-icon-1">
              <i class="fal fa-times"></i>
            </span>
          </div>
        </div>
        <div class="modal-body">
          <div class="btn-wrapper text-center mb-3">
            <div class="symbol symbol-100px symbol-circle me-5 mb-10">
              <div class="symbol-label fs-1 text-dark">
                <i class="fal fa-gift fa-2x"></i>
              </div>
            </div>
            <p class="text-dark fs-1 fw-bolder mb-3">{{__('You have ').$user->getFirstBalance()->waivers.__(' Waivers')}}</p>
            <p class="text-gray-600 fs-3 fw-bolder mb-3">{{__('Investment Fee Waivers ')}}</p>
            <p>{{__('Earn investment waivers, anytime friends or family you refer to ').$set->site_name.'. You won\'t be charged investment fee for any investment if you have a waiver'}}</p>
            <a href="{{route('terms')}}" target="_blank">{{__('Read terms & conditions')}}</a>
            <div class="row mt-6 mb-6">
              <div class="col-md-12 mb-6">
                <h3 class="m-0 text-dark fw-bold fs-3">{{'@'.$user->merchant_id}} <i class="fal fa-clone castro-copy fs-5" data-clipboard-text="{{$user->merchant_id}}" title="Copy"></i></h3>
              </div>
              <div class="col-md-12">
                @foreach(getSocial() as $val)
                @if(!empty($val->value))
                <a href="{{$val->value}}" class="btn btn-icon btn-secondary mx-2" target="_blank">
                  <i class="fab fa-{{$val->type}}"></i>
                </a>
                @endif
                @endforeach
              </div>
            </div>
            <a href="{{route('user.referral')}}">{{__('View referral performance')}}</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="d-flex flex-column flex-root">
    <div class="page d-flex flex-row flex-column-fluid">
      <div id="kt_aside" class="aside aside-default bg-white aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_toggle">
        <div class="aside-logo flex-column-auto pt-9 pb-10" id="kt_aside_logo">
          <a href="{{route('user.dashboard')}}">
            <img alt="Logo" src="{{asset('asset/images/logo.png')}}" class="logo-default" style="height:auto; max-width:60%;" />
            <img alt="Logo" src="{{asset('asset/images/logo.png')}}" class="h-50px logo-minimize" style="height:auto; max-width:60%;" />
          </a>
        </div>
        <div class="aside-menu flex-column-fluid">
          <div class="menu menu-column menu-fit menu-rounded menu-title-dark menu-icon-dark menu-state-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold fs-5 my-5 mt-lg-2 mb-lg-0" id="kt_aside_menu" data-kt-menu="true">
            <div class="menu-fit hover-scroll-y me-lg-n5 pe-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="20px" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer">
              <div class="menu-item"><!--begin:Menu link-->
                <a class="menu-link @if(route('user.dashboard')==url()->current() || route('user.porfolio')==url()->current()) active @endif" href="{{route('user.dashboard')}}">
                  <span class="menu-icon"><!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                    <i class="fal fa-house-circle-check fs-3 text-info"></i>
                  </span>
                  <span class="menu-title">{{__('Dashboard')}}</span>
                </a>
              </div>
              @if($set->savings)
              <div class="menu-item"><!--begin:Menu link-->
                <a class="menu-link @if(strpos(url()->current(), 'user/savings') !== false)) active @endif" href="{{route('user.savings')}}">
                  <span class="menu-icon"><!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                    <i class="fal fa-layer-group fs-3 text-info"></i>
                  </span>
                  <span class="menu-title">{{__('Save')}}</span>
                </a>
              </div>
              @endif
              @if($set->loan)
              <div class="menu-item"><!--begin:Menu link-->
                <a class="menu-link @if(strpos(url()->current(), 'user/loan') !== false)) active @endif" href="{{route('user.loan')}}">
                  <span class="menu-icon"><!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                    <i class="fal fa-landmark fs-3 text-info"></i>
                  </span>
                  <span class="menu-title">{{__('Loan')}}</span>
                </a>
              </div>
              @endif
              @if($set->buy_now_pay_later)
              <div class="menu-item"><!--begin:Menu link-->
                <a class="menu-link @if(strpos(url()->current(), 'user/market') !== false)) active @endif" href="{{route('user.market')}}">
                  <span class="menu-icon"><!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                    <i class="fal fa-shopping-cart fs-3 text-info"></i>
                  </span>
                  <span class="menu-title">{{__('Buy now Pay later')}}</span>
                </a>
              </div>
              @endif
              @if($set->mutual_fund || $set->project_investment)
              <div class="menu-item"><!--begin:Menu link-->
                <a class="menu-link @if(strpos(url()->current(), 'user/plan') !== false)) active @endif" href="{{route('user.plan')}}">
                  <span class="menu-icon"><!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                    <i class="fal fa-spa fs-3 text-info"></i>
                  </span>
                  <span class="menu-title">{{__('Invest')}}</span>
                </a>
              </div>
              @endif
              <div class="menu-item"><!--begin:Menu link-->
                <a class="menu-link @if(strpos(url()->current(), 'user/portfolio/followed') !== false)) active @endif" href="{{sortPortfolio('project_investment')}}">
                  <span class="menu-icon"><!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                    <i class="fal fa-chart-user fs-3 text-info"></i>
                  </span>
                  <span class="menu-title">{{__('Portfolio')}}</span>
                </a>
              </div>
              <div class="menu-item"><!--begin:Menu link-->
                <a class="menu-link @if(route('user.transactions')==url()->current()) active @endif" href="{{route('user.transactions')}}">
                  <span class="menu-icon"><!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                    <i class="fal fa-heart-rate fs-3 text-info"></i>
                  </span>
                  <span class="menu-title">{{__('Transactions')}}</span>
                </a>
              </div>
              <div class="menu-item"><!--begin:Menu link-->
                <a class="menu-link @if(strpos(url()->current(), 'user/profile') !== false)) active @endif" href="{{route('user.profile', ['type' => 'profile'])}}">
                  <span class="menu-icon"><!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                    <i class="fal fa-cog fs-3 text-info"></i>
                  </span>
                  <span class="menu-title">{{__('Settings')}}</span>
                </a>
              </div>
              @if($set->referral && ($set->mutual_fund || $set->project_investment))
              <div class="menu-item"><!--begin:Menu link-->
                <a class="menu-link @if(strpos(url()->current(), 'user/referral') !== false)) active @endif" data-bs-toggle="modal" data-bs-target="#referral">
                  <span class="menu-icon">
                    <i class="fal fa-gift fs-3 text-info"></i>
                  </span>
                  <span class="menu-title">{{__('Referral')}}</span>
                </a>
              </div>
              @endif
              <div class="menu-item"><!--begin:Menu link-->
                <a class="menu-link @if(route('user.ticket')==url()->current()) active @endif" href="{{route('user.ticket')}}">
                  <span class="menu-icon">
                    <i class="fal fa-clipboard-list-check fs-3 text-info"></i>
                  </span>
                  <span class="menu-title">{{__('Support Ticket')}}</span>
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
          <a href="{{route('user.dashboard')}}" class="d-lg-none">
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
            <livewire:megaphone></livewire:megaphone>
            <!--begin::User-->
            <div class="d-flex align-items-center ms-2 ms-lg-3" id="kt_header_user_menu_toggle">
              @livewire('settings.logout', ['user' => $user])
            </div>
            <!--end::User -->
            <!--begin::Aside Toggle-->
            <div class="d-flex align-items-center d-lg-none ms-1 ms-lg-3">
              <div class="btn btn-icon btn-icon-dark btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" id="kt_aside_toggle">
                <!--begin::Svg Icon | path: icons/duotone/Text/Menu.svg-->
                <span class="svg-icon svg-icon-2x">
                  <i class="fal fa-bars"></i>
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
      <livewire:megaphone.popout></livewire:megaphone.popout>
      @yield('content')
    </div>
    <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
      <!--begin::Container-->
      <div class="container-fluid d-flex flex-column flex-md-row flex-stack">
        <!--begin::Copyright-->
        <div class="text-dark order-2 order-md-1">
          <span class="text-muted fw-bold me-2">2023 ©</span>
          <a href="{{route('home')}}" target="_blank" class="text-gray-800 text-hover-primary">{{$set->site_name}}</a>
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
  {!!$set->livechat!!}
  {!!$set->analytic_snippet!!}
  <script src="{{asset('dashboard/plugins/global/plugins.bundle.js')}}"></script>
  <script src="{{asset('dashboard/js/scripts.bundle.js')}}"></script>
  <script src="{{asset('asset/fonts/fontawesome/js/all.js')}}"></script>
  <script src="{{asset('dashboard/js/custom/general.js')}}"></script>
  <script src="{{asset('asset/filepond/js/preview.js')}}"></script>
  <script src="{{asset('asset/filepond/js/crop.js')}}"></script>
  <script src="{{asset('asset/filepond/js/transform.js')}}"></script>
  <script src="{{asset('asset/filepond/js/validate-type.js')}}"></script>
  <script src="{{asset('asset/filepond/js/validate-size.js')}}"></script>
  <script src="{{asset('asset/filepond/js/filepond.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.3.0/color-thief.min.js"></script>
</body>

</html>
@livewireScripts
@stack('scripts')
<script src="{{asset('dashboard/js/alpine.js')}}"></script>
@yield('script')
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
  (function() {
    window.onload = function() {
      const preloader = document.querySelector('.page-loading');
      preloader.classList.remove('active');
      setTimeout(function() {
        preloader.remove();
      }, 1000);
    };
  })();
</script>

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
  Livewire.on('avatar', data => {
    Livewire.emit('eventAvatar', data);
  });
  $('div[data-href]').on("click", function() {
    window.location.href = $(this).data('href');
  });
  $('span[data-href]').on("click", function() {
    window.location.href = $(this).data('href');
  });
</script>