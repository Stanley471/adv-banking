@extends('auth.menu')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
@section('content')
<div class="py-10">
  <div class="p-10 p-lg-15 mx-auto">
    <div class="text-center">
      <a href="{{route('home')}}" class="navbar-brand pe-3">
        <img class="mb-6 text-center" src="{{asset('asset/images/logo.png')}}" width="200" alt="{{$set->site_name}}" loading="lazy">
      </a>
    </div>
    <div class="card rounded-5">
      <div class="card-body m-5">
        <form class="form w-100" action="{{route('user.create-phone')}}" method="post" id="kt_sign_up_form" novalidate="novalidate">
          @csrf
          <div class="text-start mb-10">
            <h1 class="text-dark fs-2 mb-3">{{__('Add Mobile')}}</h1>
          </div>
          <div class="fv-row mb-6">
            <label class="form-label fs-6 fw-bolder text-dark">{{__('Phone')}}</label>
            <input type="hidden" name="code" id="code" class="text-uppercase">
            <input type="tel" name="phone" id="phone" value="{{old('phone')}}" class="form-control form-control-lg form-control-solid border-light" required>
            @error('phone')
            <span class="form-text">{{$message}}</span>
            @enderror
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2" id="kt_sign_up_submit">
              <span class="indicator-label">{{__('Submit')}}</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  @include('partials.external')
</div>
@stop
@section('script')
<script src="{{asset('front/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script>
  const phoneInputField = document.querySelector("#phone");
  const phoneInput = window.intlTelInput(phoneInputField, {
    onlyCountries: ['{{$currency->iso2}}'],
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