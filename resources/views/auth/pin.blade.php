@extends('auth.menu')

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
        <form class="form w-100" action="{{route('create.pin')}}" method="post">
          @csrf
          <div class="text-start mb-10">
            <h1 class="text-dark mb-3 fs-2">{{__('Setup Pin')}}</h1>
            <div class="text-dark fw-bold fs-5">{{__('This is required to transfer money to other users on ').$set->site_name}}</div>
          </div>
          <div class="fv-row mb-10">
            <label class="form-label fs-6 fw-bolder text-dark">{{__('Code')}}</label>
            <input class="form-control form-control-lg form-control-solid border-light" name="pin" type="tel" minlength="4" maxlength="6" pattern="[0-9]+" autocomplete="one-time-code" value="{{old('code')}}" required placeholder="XXXX" autofocus onkeyup="this.value=removeSpacesPin(this.value);" onmouseout="this.value=removeSpacesPin(this.value);" />
            @error('pin')
            <span class="form-text">{{ $message}}</span>
            @enderror
          </div>
          @if($set->recaptcha==1)
          {!! RecaptchaV3::field('pin') !!}
          @error('g-recaptcha-response')
          <span class="form-text">{{$message}}</span>
          @enderror
          @endif
          <div class="text-center">
            <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2 rounded-5">
              <span class="indicator-label">{{__('Create Pin')}}</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  @include('partials.external')
</div>
@stop