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
                <form class="form w-100" action="{{route('user.confirm-phone')}}" method="post">
                    @csrf
                    <div class="text-start mb-10">
                        <h1 class="text-dark fs-3 mb-3">{{__('Enter your verification code')}}</h1>
                        <div class="text-dark fw-bold fs-4">{{__('Input the OTP we sent to')}} {{$user->phone}}</div>
                        <p class="text-muted">You can <a href="{{route('user.resend-phone')}}" class="resend-sms text-info"><u>{{__('resend')}}</u></a> SMS after <span id="timer" class="font-weight-bold text-indigo text-lg"></span></p>
                    </div>
                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark">{{__('Code')}}</label>
                        <input class="form-control form-control-lg form-control-solid border-light" name="code" type="tel" minlength="4" maxlength="6" pattern="[0-9]+" autocomplete="one-time-code" value="{{old('code')}}" required placeholder="XXXXXX" autofocus onkeyup="this.value=removeSpacesPin(this.value);" onmouseout="this.value=removeSpacesPin(this.value);" />
                        @error('code')
                        <span class="form-text">{{ $message}}</span>
                        @enderror
                    </div>
                    @if($set->recaptcha==1)
                    {!! RecaptchaV3::field('otp') !!}
                    @error('g-recaptcha-response')
                    <span class="form-text">{{$message}}</span>
                    @enderror
                    @endif
                    <div class="text-center">
                        <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                            <span class="indicator-label">{{__('Verify Phone')}}</span>
                        </button>
                        <a href="{{route('user.dashboard')}}" class="btn btn-light-info btn-lg btn-block fw-bolder my-2">
                            <i class="fa-thin fa-arrow-left"></i> {{__('Back to Dashboard')}}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('partials.external')
</div>
@stop
@section('script')
<script>
    var countDownDate = moment("{{Carbon\Carbon::create($user->phone_time)->addMinutes(5)->toDateTimeString()}}").valueOf();

    var x = setInterval(function() {
        var now = moment.utc().valueOf();
        var distance = countDownDate - now + (1 * 60 * 60 * 1000);
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)).toString().padStart(2, '0');
        var seconds = Math.floor((distance % (1000 * 60)) / 1000).toString().padStart(2, '0');
        document.getElementById("timer").innerHTML = minutes + ":" + seconds;
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("timer").innerHTML = "0:00";
            $('.resend-sms').attr('disabled', false);
        }
    }, 1);
</script>
@endsection