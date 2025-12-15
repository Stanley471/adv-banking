<!doctype html>
<html class="no-js" lang="en">

<head>
  <title>{{ $title }} - {{$set->site_name}}</title>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="robots" content="index, follow">
  <meta name="apple-mobile-web-app-title" content="{{$set->site_name}}" />
  <meta name="application-name" content="{{$set->site_name}}" />
  <meta name="description" content="{{$set->site_desc}}" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="shortcut icon" href="{{asset('asset/images/favicon.png')}}" />
  <link href="{{asset('asset/fonts/fontawesome/css/all.css')}}" rel="stylesheet" type="text/css">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <link href="{{asset('dashboard/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('dashboard/css/style.qbundle.css')}}" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css" />
  @livewireStyles
  @yield('css')
  @include('partials.font')
   <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
  
</head>


  <body style="background: url('{{ asset('asset/images/login_bg.jpg') }}') no-repeat center center fixed; background-size: cover;">
 <!-- <div class="page-loading active text-indigo">
    <div class="page-loading-inner">
      <div class="page-spinner"></div><span></span>
    </div>
  </div>  -->

  
  <!--begin::Main-->
    <div class="container min-vh-100 d-flex align-items-center justify-content-center">
        <div class="col-md-5 col-lg-4">
            @yield('content')
        </div>
    </div>

  {!!$set->livechat!!}
  {!!$set->analytic_snippet!!}
  <script src="{{asset('dashboard/plugins/global/plugins.bundle.js')}}"></script>
  <script src="{{asset('dashboard/js/scripts.bundle.js')}}"></script>
  <script src="{{asset('asset/fonts/fontawesome/js/all.js')}}"></script>
  <script src="{{asset('dashboard/js/custom/general.js')}}"></script>
</body>

</html>
@livewireScripts
@stack('scripts')
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

@if($set->recaptcha==1)
{!! RecaptchaV3::initJs() !!}
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