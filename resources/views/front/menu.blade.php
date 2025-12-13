<!doctype html>
<html class="no-js" lang="en">

<!-- ============================================================
     HEAD SECTION - Meta tags, Title, and Metadata
     ============================================================ -->
<head>
    <title>{{ $title }} - {{$set->site_name}}</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="index, follow">
    <meta name="apple-mobile-web-app-title" content="{{$set->site_name}}" />
    <meta name="application-name" content="{{$set->site_name}}" />
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="description" content="{{$set->site_desc}}" />
    <link rel="shortcut icon" href="{{asset('asset/images/favicon.png')}}" />
    
    <!-- ============================================================
         CSS STYLESHEETS - External libraries and custom styles
         ============================================================ -->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">


    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">


    <link rel="stylesheet" href="{{asset('front/css/theme.css')}}" type="text/css" media="all">
    <link rel="preload" media="screen" href="{{asset('front/vendor/boxicons/css/boxicons.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'" />
    <link rel="preload" media="screen" href="{{asset('front/vendor/lightgallery/css/lightgallery-bundle.min.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'" />
    <link rel="preload" media="screen" href="{{asset('front/vendor/swiper/swiper-bundle.min.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'" />
    <link rel="preload" href="{{asset('front/css/cookie.css')}}" type="text/css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="stylesheet" href="{{asset('front/css/toast.css')}}" type="text/css">
    <link href="{{asset('asset/fonts/fontawesome/css/all.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css" />
    @yield('css')
    @include('partials.font')
</head>

<!-- ============================================================
     BODY SECTION - Main content area
     ============================================================ -->
<body>
    <main class="page-wrapper">
        <!-- ============================================================
             HEADER/NAVIGATION SECTION
             ============================================================ -->
        <header class="header navbar navbar-expand-lg position-absolute navbar-sticky @if(url()->current() == route('home')) navbar-dark @else navbar-light @endif">
            <div class="container px-3">
                <a href="{{route('home')}}" class="navbar-brand pe-3">
                    @if(url()->current() == route('home'))
                    <img src="{{asset('asset/images/maccity logo.png')}}"  width="200" alt="{{$set->site_name}}" loading="lazy">
                    @else
                    <img src="{{asset('asset/images/maccity logo.png')}}" width="200" alt="{{$set->site_name}}" loading="lazy">
                    @endif
                </a>
                <div id="navbarNav" class="offcanvas offcanvas-end mt-3">
                    <div class="offcanvas-header border-bottom">
                        <h5 class="offcanvas-title">{{__('Menu')}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <!-- ============================================================
                             MOBILE MENU / NAVIGATION ITEMS
                             ============================================================ -->
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a href="{{route('about')}}" class="nav-link fw-medium fs-sm">{{__('ABOUT')}}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('blog')}}" class="nav-link fw-medium fs-sm">{{__('BLOG')}}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('help.center')}}" class="nav-link fw-medium fs-sm">{{__('FAQ')}}</a>
                            </li>
                            <li class="nav-item d-md-none d-sm-block">
                                <a href="{{route('login')}}" class="nav-link fw-medium fs-sm">{{__('Sign in')}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <button type="button" class="navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- ============================================================
                     LOGIN & REGISTER BUTTONS (Desktop)
                     ============================================================ -->
                <a href="{{route('login')}}" class="d-none d-lg-inline-flex me-4 text-decoration-none @if(url()->current() == route('home')) text-white @else text-dark @endif" rel="noopener">
                    {{__('Log In')}}
                </a>
                <a href="{{route('register')}}" class="btn btn-info btn-sm fs-sm rounded-pill d-none d-lg-inline-flex" rel="noopener">
                    {{__('Register')}} <i class="fal fa-angle-right mx-2"></i>
                </a>
            </div>
        </header>
        
        <!-- ============================================================
             PAGE CONTENT - Yielded from child views
             ============================================================ -->
        @yield('content')
        
        <!-- ============================================================
             FOOTER SECTION
             ============================================================ -->
        <footer class="footer dark-mode border-top border-light py-5 bg-dark" data-jarallax data-img-position="0% 100%" data-speed="0.5">
            <div class="container pt-lg-4">
                <div class="row pb-5">
                    <div class="col-xl-12 col-lg-12 col-md-12 pt-4 pt-md-1 pt-lg-0">
                        <!-- ============================================================
                             FOOTER LINKS - Company, Resources, Legal, Contact
                             ============================================================ -->
                        <div id="footer-links" class="row">
                            <!-- Company Links -->
                            <div class="col-xl-3 col-lg-3 col-6">
                                <h6 class="mb-2">{{__('Company')}}</h6>
                                <ul class="nav flex-column mb-2 mb-lg-0">
                                    @if($set->career_url != null)
                                    <li class="nav-item"><a href="{{$set->career_url}}" target="_blank" class="footer-link d-inline-block px-0 pt-1 pb-2">{{__('Careers')}}</a></li>
                                    @endif
                                    <li class="nav-item"><a href="{{route('about')}}" class="footer-link d-inline-block px-0 pt-1 pb-2">{{__('About')}}</a></li>
                                    <li class="nav-item"><a href="{{route('contact')}}" class="footer-link d-inline-block px-0 pt-1 pb-2">{{__('Contact Us')}}</a></li>
                                </ul>
                            </div>
                            <!-- Resources Links -->
                            <div class="col-xl-3 col-lg-3 col-6 pt-2 pt-lg-0">
                                <h6 class="mb-2">{{__('Resources')}}</h6>
                                <ul class="nav flex-column mb-2 mb-lg-0 mb-3">
                                    <li class="nav-item"><a href="{{route('help.center')}}" class="footer-link d-inline-block px-0 pt-1 pb-2">{{__('Help Centre')}}</a></li>
                                    <li class="nav-item"><a href="{{route('blog')}}" class="footer-link d-inline-block px-0 pt-1 pb-2">{{__('Blog')}}</a></li>
                                    @foreach(getPage() as $val)
                                    <li class="nav-item"><a href="{{route('page', ['page' => $val->slug])}}" class="footer-link d-inline-block px-0 pt-1 pb-2">{{$val->title}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- Legal Links -->
                            <div class="col-xl-3 col-lg-3 col-6 pt-2 pt-lg-0">
                                <h6 class="mb-2">{{__('Legal')}}</h6>
                                <ul class="nav flex-column mb-2 mb-lg-0">
                                    <li class="nav-item"><a href="{{route('terms')}}" class="footer-link d-inline-block px-0 pt-1 pb-2">{{__('Terms & Conditions')}}</a></li>
                                    <li class="nav-item"><a href="{{route('privacy')}}" class="footer-link d-inline-block px-0 pt-1 pb-2">{{__('Privacy Policy')}}</a></li>
                                </ul>
                            </div>
                            <!-- Contact Information -->
                            <div class="col-xl-3 col-lg-3 col-6 pt-2 pt-lg-0">
                                <h6 class="mb-2">{{__('Contact')}}</h6>
                                <p class="fs-sm pb-lg-3 mb-0 text-dark"><a class="footer-link" href="mailto:{{$set->email}}"><i class="fal fa-envelope"></i> {{$set->email}}</a></p>
                                <p class="fs-sm mb-3 text-dark"><a class="footer-link" href="tel:{{$set->mobile}}"><i class="fal fa-phone-volume"></i> {{$set->mobile}}</a></p>
                                <div class="d-flex mb-5">
                                    @foreach(getSocial() as $val)
                                    @if(!empty($val->value))
                                    <a href="{{$val->value}}" class="mx-2 text-white">
                                        <i class="fab fa-{{$val->type}}"></i>
                                    </a>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================
                         LANGUAGE & ADDRESS SECTION
                         ============================================================ -->
                    <div class="col-lg-4 col-md-4">
                        <!-- Language Dropdown -->
                        @if($set->language==1)
                        <div class="btn-group dropdown mb-5">
                            <button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle me-5 text-dark" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="fi fi-{{getDefaultLang()->code}} me-2 fis fs-sm rounded-4 text-dark"></span> <span>{{getDefaultLang()->name}}</span>
                            </button>
                            <div class="dropdown-menu my-1">
                                @foreach(getLang() as $val)
                                <a class="dropdown-item" href="{{route('lang', ['locale' => $val->code])}}"><span class="fi fi-{{$val->code}} me-2 fis fs-sm rounded-4 text-dark"></span> {{$val->name}}</a>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        <!-- Address Information -->
                        @if(getUi()->address1_t)
                        <p class="fs-sm pb-lg-3 mb-1 text-dark"><span class="fi fi-{{strtolower(getUi()->address1_c)}} me-2 fis fs-sm rounded-4 text-dark"></span> {{getUi()->address1_t}}</p>
                        @endif
                        @if(getUi()->address2_t)
                        <p class="fs-sm pb-lg-3 mb-1 text-dark"><span class="fi fi-{{strtolower(getUi()->address2_c)}} me-2 fis fs-sm rounded-4 text-dark"></span> {{getUi()->address2_t}}</p>
                        @endif
                        @if(getUi()->address3_t)
                        <p class="fs-sm pb-lg-3 mb-1 text-dark"><span class="fi fi-{{strtolower(getUi()->address3_c)}} me-2 fis fs-sm rounded-4 text-dark"></span> {{getUi()->address3_t}}</p>
                        @endif
                    </div>
                </div>
                <!-- ============================================================
                     COPYRIGHT & DISCLAIMER
                     ============================================================ -->
                <div class="space-1">
                    <!-- Copyright -->
                    <div class="w-md-75 text-lg-center mx-lg-auto">
                        <p class="small text-dark">© {{$set->site_name}}. {{date('Y')}}. {{__('All rights reserved.')}}</p>
                        <p class="small text-dark">{{__('When you visit or interact with our sites, services or tools, we or our authorised service providers may use cookies for storing information to help provide you with a better, faster and safer experience and for marketing purposes.')}}</p>
                    </div>
                    <!-- End Copyright -->
                </div>
            </div>
        </footer>


        <!-- ============================================================
             BACK TO TOP BUTTON
             ============================================================ -->
        <a href="#top" class="btn-scroll-top" data-scroll>
            <span class="btn-scroll-top-tooltip text-muted fs-sm me-2">{{__('Top')}}</span>
            <i class="btn-scroll-top-icon bx bx-chevron-up"></i>
        </a>
    </main>
    
    <!-- ============================================================
         THIRD-PARTY INTEGRATIONS
         ============================================================ -->
    <!-- Live Chat -->
    {!!$set->livechat!!}
    <!-- Analytics -->
    {!!$set->analytic_snippet!!}
    
    <!-- ============================================================
         JAVASCRIPT LIBRARIES & SCRIPTS
         ============================================================ -->
    <script src="{{asset('front/vendor/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('front/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('front/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js')}}"></script>
    <script src="{{asset('front/vendor/swiper/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('front/vendor/jarallax/dist/jarallax.min.js')}}"></script>
    <script src="{{asset('front/vendor/cleave.js/dist/cleave.min.js')}}"></script>
    <script src="{{asset('front/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('front/vendor/parallax-js/dist/parallax.min.js')}}"></script>
    <script src="{{asset('front/vendor/rellax/rellax.min.js')}}"></script>
    <script src="{{asset('front/vendor/shufflejs/dist/shuffle.min.js')}}"></script>
    <script src="{{asset('front/vendor/lightgallery/lightgallery.min.js')}}"></script>
    <script src="{{asset('front/vendor/lightgallery/plugins/video/lg-video.min.js')}}"></script>
    <script src="{{asset('front/vendor/@lottiefiles/lottie-player/dist/lottie-player.js')}}"></script>
    <script src="{{asset('front/js/theme.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.7.6/lottie_svg.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/orestbida/cookieconsent@v2.8.9/dist/cookieconsent.js"></script>
    <script src="{{asset('front/js/cookie.js')}}"></script>
    <script src="{{asset('front/js/toast.js')}}"></script>
    <script src="{{asset('asset/fonts/fontawesome/js/all.js')}}"></script>
    
    <!-- ============================================================
         PAGE-SPECIFIC SCRIPTS (from child views)
         ============================================================ -->
    @yield('script')

    <!-- ============================================================
         SESSION & TOAST NOTIFICATIONS
         ============================================================ -->
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

    <!-- ============================================================
         RECAPTCHA V3 INITIALIZATION
         ============================================================ -->
    @if($set->recaptcha==1)
    {!! RecaptchaV3::initJs() !!}
    @endif

</body>

</html>