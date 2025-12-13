@extends('front.menu', ['title' => $set->site_desc])
@section('css')

@stop
@section('content')
<section class="overflow-hidden pt-5 pb-1 bg-dark dd-bg">
    <div class="container pt-3 pt-sm-4 pt-xl-5">
        <div class="row">
            <div class="col-md-6 d-flex flex-column mt-md-4 pt-5 pb-3 pb-sm-4 py-md-5">
                <h1 class="display-5 pb-3 text-white">
                    {{getUi()->h1_t}}
                </h1>
                <p class="fs-3 text-start text-md-start pb-2 pb-md-3 mb-3 text-white">{{getUi()->h1_b}}</p>
                <div class="d-md-flex align-items-md-start">
                    <a href="{{route('register')}}" class="btn btn-info flex-shrink-0 me-md-4 mb-md-0 mb-sm-4 mb-3 rounded-pill">{{__('Open an account')}}</a>
                </div>
                <div class="d-flex align-items-center justify-content-center justify-content-md-start text-start pt-4 pt-lg-5 mt-xxl-5">
                    <div class="text-light">{{getUi()->h6_t}}</div>
                </div>
            </div>
            <div class="col-md-6 text-md-end text-center pt-5">
                <img src="{{asset('asset/images/'.getUi()->image1)}}" style="max-width:100%; height:auto;">
            </div>
        </div>
    </div>
</section>
<section class="container py-5 mt-md-3 my-lg-5">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4 px-4">
                    <img src="{{asset('asset/images/'.getUi()->image6)}}" class="rounded-5" alt="Invest">
                    <div class="pt-4 text-center">
                        <h3 class="text-dark">{{getUi()->w1_t}}</h3>
                        <p class="text-dark">{{getUi()->w1_b}}</p>
                    </div>
                </div>
                <div class="col-md-4 px-4">
                    <img src="{{asset('asset/images/'.getUi()->image7)}}" class="rounded-5" alt="Savings">
                    <div class="pt-4 text-center">
                        <h3 class="text-dark">{{getUi()->w2_t}}</h3>
                        <p class="text-dark">{{getUi()->w2_b}}</p>
                    </div>
                </div>
                <div class="col-md-4 px-4">
                    <img src="{{asset('asset/images/'.getUi()->image8)}}" class="rounded-5" alt="Loan">
                    <div class="pt-4 text-center">
                        <h3 class="text-dark">{{getUi()->w3_t}}</h3>
                        <p class="text-dark">{{getUi()->w3_b}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="container mt-2 pt-3 pt-lg-5 pb-5">
    <div class="row align-items-lg-center pt-md-3 pb-5 mb-2 mb-lg-4 mb-xl-5">
        <div class="col-md-5 order-md-2 mb-4 mb-md-0">
            <img src="{{asset('asset/images/'.getUi()->image5)}}">
        </div>
        <div class="col-md-7 order-md-1">
            <div class="pe-xl-5 me-md-2 me-lg-4">
                <h2 class="display-4 pb-3 text-dark">{{getUi()->h2_t}}</h2>
                <p class="fs-3 text-start text-md-start pb-2 pb-md-3 mb-3 text-dark">{{getUi()->h2_b}}</p>
                <div class="d-md-flex align-items-md-start">
                    <a href="{{route('register')}}" class="btn btn-info flex-shrink-0 me-md-4 mb-md-0 mb-sm-4 mb-3 rounded-pill">{{__('Start Your Financial Journey')}}</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="container pt-4 pt-lg-0 pb-4 pb-lg-5">
    <div class="row align-items-lg-center pt-md-3 pb-5 mb-2 mb-lg-4 mb-xl-5">
        <div class="col-md-6 order-md-1 mb-4 mb-md-0 text-center">
            <img src="{{asset('asset/images/'.getUi()->image3)}}" width="400">
        </div>
        <div class="col-md-6 order-md-2">
            <h2 class="h1 pb-3 pb-md-0 mb-md-5 text-dark">{{getUi()->h3_t}}</h2>
            <div class="steps">
                <div class="step pt-0 pt-md-3 pb-5">
                    <div class="step-number">
                        <div class="step-number-inner text-info fs-md">01</div>
                    </div>
                    <div class="step-body d-flex align-items-center ps-xl-1">
                        <div class="rellax ps-md-4 ps-xl-5" data-rellax-percentage="0.5" data-rellax-speed="0.4" data-disable-parallax-down="lg">
                            <h3 class="h5 text-gray">{{getUi()->step1_t}}</h3>
                            <p class="mb-0">{{getUi()->step1_b}}</p>
                        </div>
                    </div>
                </div>
                <div class="step pt-0 pt-md-4 pb-5">
                    <div class="step-number">
                        <div class="step-number-inner text-info fs-md">02</div>
                    </div>
                    <div class="step-body d-flex align-items-center ps-xl-1">
                        <div class="rellax ps-md-4 ps-xl-5" data-rellax-percentage="0.5" data-rellax-speed="0.5" data-disable-parallax-down="lg">
                            <h3 class="h5 text-gray">{{getUi()->step2_t}}</h3>
                            <p class="mb-0">{{getUi()->step2_b}}</p>
                        </div>
                    </div>
                </div>
                <div class="step pt-0 pt-md-4 pb-5">
                    <div class="step-number">
                        <div class="step-number-inner text-info fs-md">03</div>
                    </div>
                    <div class="step-body d-flex align-items-center ps-xl-1">
                        <div class="rellax ps-md-4 ps-xl-5" data-rellax-percentage="0.5" data-rellax-speed="0.4" data-disable-parallax-down="lg">
                            <h3 class="h5 text-gray">{{getUi()->step3_t}}</h3>
                            <p class="mb-0">{{getUi()->step3_b}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@if(count(getService()))
<section class="container pt-3 pb-5 pb-md-5">
    <div class="card border-0">
        <div class="card-body p-md-5 p-4 bg-info rounded-5">
            <div class="d-flex flex-column flex-md-row flex-md-nowrap align-items-start">
                <div class="col-md-7 ps-0 pe-lg-4 mb-5 mb-md-0">
                    <div style="max-width: 660px;">
                        <h2 class="h1 pb-3 mb-2 mb-md-3 text-white">{{getUi()->h3_t}}</h2>
                        <p class="pb-4 mb-0 mb-lg-3 text-white">{{getUi()->h3_b}}</p>
                        <div class="row row-cols-1 row-cols-sm-2 gx-lg-5 g-4">
                            @foreach(getService() as $val)
                            <div class="col pt-1 pt-sm-2 pt-lg-3">
                                <i class="fal fa-{{$val->icon}} d-block fs-2 text-white mb-2 mb-sm-3"></i>
                                <h3 class="h5 pb-sm-1 mb-2 text-white">{{$val->title}}</h3>
                                <p class="mb-0 text-white">{{$val->details}}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <img src="{{asset('asset/images/'.getUi()->image2)}}" width="500" class="ms-3 ms-sm-5 ms-xl-3" alt="Dashboard">
            </div>
        </div>
    </div>
</section>
@endif
@if(count(getReview()))
<section class="container py-5 mb-2 mt-md-2 mb-md-4 mt-lg-4 mb-lg-5">
    <div class="row pt-xl-1 pb-xl-3 align-items-center justify-content-center">
        <div class="col-md-4">
            <h2 class="text-center text-md-start mx-auto mx-md-0 pt-md-2 fs-1 fw-semibold">{{getUi()->h4_b}}</h2>

            <!-- Slider controls (Prev / next buttons) -->
            <div class="d-flex justify-content-center justify-content-md-start pb-4 mb-2 pt-2 pt-md-4 mt-md-5">
                <button type="button" id="prev-testimonial" class="btn btn-prev btn-icon btn-md me-2">
                    <i class="bx bx-chevron-left"></i>
                </button>
                <button type="button" id="next-testimonial" class="btn btn-next btn-icon btn-md ms-2">
                    <i class="bx bx-chevron-right"></i>
                </button>
            </div>
        </div>
        <div class="col-md-8">
            <div class="swiper mx-n2" data-swiper-options='{
              "slidesPerView": 1,
              "spaceBetween": 8,
              "autoplay": true,
              "loop": true,
              "navigation": {
                "prevEl": "#prev-testimonial",
                "nextEl": "#next-testimonial"
              },
              "breakpoints": {
                "500": {
                  "slidesPerView": 2
                },
                "1000": {
                  "slidesPerView": 2
                },
                "1200": {
                  "slidesPerView": 2
                }
              }
            }'>
                <div class="swiper-wrapper">
                    @foreach(getReview() as $val)
                    <div class="swiper-slide h-auto pt-4">
                        <figure class="d-flex flex-column px-2 px-sm-0 mb-0 mx-2">
                            <div class="card position-relative border-0 shadow-sm pt-4 rounded-5 bg-gradient-primary">
                                <figcaption class="d-flex align-items-center ps-4 pt-4">
                                    <img src="{{url('/').'/storage/app/'.$val->image}}" width="48" class="rounded-circle" alt="{{$val->name}}">
                                    <div class="ps-3">
                                        <h4 class="fs-5 fw-semibold mb-0">{{$val->name}}</h4>
                                        <span class="fs-sm text-dark">{{$val->occupation}}</span>
                                    </div>
                                </figcaption>
                                <blockquote class="card-body pb-3 mb-5">
                                    <p class="mb-0 text-dark fs-4 fw-semibold">“{{$val->review}}”</p>
                                </blockquote>
                            </div>
                        </figure>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@include('partials.livechat')
@if(count(getBrands()))
<section class="container mt-2 pt-3 pt-lg-5 pb-5">
    <h2 class="h3 text-center pb-3 pb-md-0 text-gray">{{__('As Featured In')}}</h2>
    <div class="swiper mx-n2" data-swiper-options='{
          "slidesPerView": 2,
          "pagination": {
            "el": ".swiper-pagination",
            "clickable": true
          },
          "breakpoints": {
            "500": {
              "slidesPerView": 3,
              "spaceBetween": 8
            },
            "650": {
              "slidesPerView": 4,
              "spaceBetween": 8
            },
            "900": {
              "slidesPerView": 5,
              "spaceBetween": 8
            },
            "1100": {
              "slidesPerView": 6,
              "spaceBetween": 8
            }
          }
        }'>
        <div class="swiper-wrapper">
            @foreach(getBrands() as $val)
            <div class="swiper-slide py-3">
                <div class="card card-body card-hover px-2 mx-2">
                    <img src="{{url('/').'/storage/app/'.$val->image}}" class="d-block mx-auto my-2" width="150" alt="Brand">
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination (bullets) -->
        <div class="swiper-pagination position-relative pt-2 mt-4"></div>
    </div>
</section>
@endif
@stop