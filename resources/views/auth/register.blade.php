@extends('auth.menu', ['title' => 'Register'])
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
@section('content')
<div class="py-10">
  <div class="p-10 p-lg-15 mx-auto">
    @if($set->maintenance == 1)
    <div class="alert alert-danger">
      <div class="d-flex flex-column">
        <span>{{__('We are currently under maintenance, please try again later')}}</span>
      </div>
    </div>
    @endif
    @if($set->registration == 0)
    <div class="alert alert-danger">
      <div class="d-flex flex-column">
        <span>{{__('We are currently not accepting new users, please try again later')}}</span>
      </div>
    </div>
    @endif
    <div class="card rounded-5">
      <div class="card-body m-5">
        <form class="form w-100" action="{{route('submitregister')}}" method="post" id="kt_sign_up_form" novalidate="novalidate">
          @csrf
          <div class="text-start mb-10">
            <h1 class="text-dark mb-3 fs-2">{{__('Create an Account')}}</h1>
            <div class="text-dark fw-bold fs-5">{{__('Already have an account?')}}
              <a href="{{route('login')}}" class="link-info fw-bolder">{{__('Sign in here')}}</a>
            </div>
          </div>
          <div class="row fv-row mb-6">
            <div class="col-xl-6">
              <label class="form-label fw-bolder text-dark fs-6">{{__('Legal First Name')}}</label>
              <input class="form-control form-control-lg form-control-solid border-light" type="text" name="first_name" autocomplete="off" value="{{old('first_name')}}" required placeholder="John" />
              @error('first_name')
              <span class="form-text">{{$message}}</span>
              @enderror
            </div>
            <div class="col-xl-6">
              <label class="form-label fw-bolder text-dark fs-6">{{__('Legal Last Name')}}</label>
              <input class="form-control form-control-lg form-control-solid border-light" type="text" name="last_name" autocomplete="off" value="{{old('last_name')}}" required placeholder="Doe" />
              @error('last_name')
              <span class="form-text">{{$message}}</span>
              @enderror
            </div>
          </div>
          <div class="fv-row mb-6">
            <label class="form-label fs-6 fw-bolder text-dark">{{__('Email')}}</label>
            <input class="form-control form-control-lg form-control-solid border-light" type="email" name="email" autocomplete="email" value="{{old('email')}}" required placeholder="name@email.com" />
            @error('email')
            <span class="form-text">{{$message}}</span>
            @enderror
          </div>
          <div class="fv-row mb-6">
            <label class="form-label fs-6 fw-bolder text-dark">{{__('Phone')}}</label>
            <input type="hidden" name="code" id="code" class="text-uppercase">
            <input type="tel" name="phone" id="phone" value="{{old('phone')}}" class="form-control form-control-lg form-control-solid border-light" required>
            @error('phone')
            <span class="form-text">{{$message}}</span>
            @enderror
          </div>
          @if($set->referral)
          <div class="fv-row mb-6">
            <label class="form-label fw-bolder text-dark fs-6">{{__('Referral Merchant ID')}}</label>
            @if($referral == null)
            <input class="form-control form-control-lg form-control-solid border-light" type="text" name="username" autocomplete="off" value="{{old('username')}}" placeholder="Optional" />
            @else
            <input class="form-control form-control-lg form-control-solid border-light" type="text" name="username" autocomplete="off" value="{{(old('username') != null) ? old('username') : $referral}}" placeholder="Optional" />
            @endif
            @error('username')
            <span class="form-text">{{$message}}</span>
            @enderror
          </div>
          @endif
          <div class="fv-row mb-10" data-kt-password-meter="true">
            <div class="d-flex flex-stack mb-2">
              <label class="form-label fw-bolder text-dark fs-6 mb-0">{{__('Password')}}</label>
            </div>
            <div class="position-relative mb-3">
              <input class="form-control form-control-lg form-control-solid border-light" type="password" name="password" autocomplete="off" required data-toggle="password" id="password" value="{{old('password')}}" />
              <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2 input-password" data-kt-password-meter-control="visibility">
                <i class="bi bi-eye fs-2 text-dark"></i>
              </span>
            </div>

            <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
              <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
              <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
              <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
              <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
            </div>
            <div class="text-muted">{{__('Use 8 or more characters with a mix of letters, numbers & symbols')}}.</div>
            @error('password')
            <span class="form-text">{{$message}}</span>
            @enderror
          </div>
          <div class="form-check form-check-custom form-check-solid mb-6">
            <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="terms" required />
            <label class="form-check-label" for="flexCheckDefault">{{__('I agree to our')}} <a target="_blank" href="{{route('terms')}}" class="text-info">{{__('terms & conditions')}}</a></label>
          </div>
          @if($set->recaptcha==1)
          {!! RecaptchaV3::field('register') !!}
          @error('g-recaptcha-response')
          <span class="form-text">{{$message}}</span>
          @enderror
          @endif
          <div class="text-center">
            <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2" id="kt_sign_up_submit">
              <span class="indicator-label">{{__('Submit')}}</span>
            </button>
            @if($set->google_sl == 1)
            <a href="{{route('redirect.login', ['type' => 'google'])}}" class="btn btn-secondary btn-block btn-lg fw-bolder my-2">
              <img alt="Logo" src="{{asset('dashboard/media/svg/brand-logos/google-icon.svg')}}" class="h-20px me-3">Sign in with Google
            </a>
            @endif
            @if($set->facebook_sl == 1)
            <a href="{{route('redirect.login', ['type' => 'facebook'])}}" class="btn btn-secondary btn-block btn-lg fw-bolder my-2">
              <img alt="Logo" src="{{asset('dashboard/media/svg/brand-logos/facebook-icon.svg')}}" class="h-20px me-3">Sign in with Facebook
            </a>
            @endif
          </div>
        </form>
      </div>
    </div>
  </div>
  @include('partials.external')
</div>
@stop
@section('script')
<script src="{{asset('dashboard/js/custom/authentication/sign-up/general.js')}}"></script>
<script>
  ! function($) {
    'use strict';
    $(function() {
      $('[data-toggle="password"]').each(function() {
        var input = $(this);
        var eye_btn = $(this).parent().find('.input-password');
        eye_btn.css('cursor', 'pointer').addClass('input-password-hide');
        eye_btn.on('click', function() {
          if (eye_btn.hasClass('input-password-hide')) {
            eye_btn.removeClass('input-password-hide').addClass('input-password-show');
            eye_btn.find('.bi').removeClass('bi-eye').addClass('bi-eye-slash')
            input.attr('type', 'text');
          } else {
            eye_btn.removeClass('input-password-show').addClass('input-password-hide');
            eye_btn.find('.bi').removeClass('bi-eye-slash').addClass('bi-eye')
            input.attr('type', 'password');
          }
        });
      });
    });
  }(window.jQuery);
</script>
<script src="{{asset('front/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script>
  const phoneInputField = document.querySelector("#phone");
  const phoneInput = window.intlTelInput(phoneInputField, {
    onlyCountries: JSON.parse("{{validCountriesJson()}}".replace(/&quot;/g, '"')),
    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
  });
  var old = "{{old('code')}}";
  if (old.trim() != '') {
    phoneInput.setCountry(old)
  }
  $('#code').val(phoneInput.getSelectedCountryData().iso2);
  phoneInputField.addEventListener("countrychange", function() {
    $('#code').val(phoneInput.getSelectedCountryData().iso2);
  });
</script>
@endsection