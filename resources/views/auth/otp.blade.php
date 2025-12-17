@extends('auth.menu')

@section('content')
 <!-- Styles scoped to this login component: card size, background, and underline inputs -->
    <style>
        .login-card { width: 120%; min-width: 0;  border: 10px solid grey; }
        .login-card .card-body { padding: 1.5rem; }

        @media (max-width: 576px) { .login-card { width: 92%; } }
    .card {
    background: rgba(92, 78, 78, 0.15) !important;
    backdrop-filter: blur(12px) !important;
    -webkit-backdrop-filter: blur(12px) !important;
    /*    text-shadow: 1px 1px #ffffff;*/
        color: #ffffff !important;
    border-radius: 24px !important;
    box-shadow: 0 20px 50px rgba(0,0,0,0.35) !important;
    border: 1px solid rgba(255,255,255,0.25) !important;
}
.underline-input {
    width: 100% !important;
    box-sizing: border-box;

    padding-left: 0 !important;
    padding-right: 0 !important;

    border: 0 !important;
    border-bottom: 1px solid #d1d5db !important;

    border-radius: 0 !important;
    box-shadow: none !important;

    background-color: transparent !important;
    color: #fff;
}

        .underline-input:focus { box-shadow: none; border-bottom-color: #0d6efd; outline: none; color: #ffffff }

    </style>
<div class="py-10">
    <div class="p-10 p-lg-15 mx-auto">
        <div class="text-center">
            <a href="{{route('home')}}" class="navbar-brand pe-3">
                <img class="mb-6 text-center" src="{{asset('asset/images/logo.png')}}" width="200" alt="{{$set->site_name}}" loading="lazy">
            </a>
        </div>
        <div class="card rounded-5">
            <div class="card-body m-5" style="color: #ffffff">
                <form class="form w-100" action="{{route('confirm.otp')}}" method="post">
                    @csrf
                    <div class="text-start mb-10">
                        <h1 class="mb-3 fs-2">{{__('Enter your One Time Password')}}</h1>
                        <div class="fw-bold fs-5">{{__('Input the OTP we sent to')}} {{ substr($user->email, 0, 3) }}***@***{{ substr(explode('@', $user->email)[1], -4) }}</div>
                        <p>{{__('You can')}} <a href="{{route('resend.otp')}}" class="resend-sms" style="color: #588a00" ><u>{{__('resend')}}</u></a> {{__('Email after')}} <span id="timer" class="font-weight-bold text-indigo text-lg"></span></p>
                    </div>
                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder ">{{__('Code')}}</label>
                        <input class="form-control form-control-lg form-control-solid underline-input" name="code" type="tel" minlength="4" maxlength="6" pattern="[0-9]+" autocomplete="one-time-code" value="{{old('code')}}" autofocus onkeyup="this.value=removeSpacesPin(this.value);" onmouseout="this.value=removeSpacesPin(this.value);" />
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
                        <button type="submit" class="btn btn-lg btn-block fw-bolder me-3 my-2" style="background-color: #588a00; color: #ffffff;">
                            <span class="indicator-label">{{__('Verify OTP')}}</span>
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
<script>
    var countDownDate = moment("{{Carbon\Carbon::create($user->email_time)->addMinutes(5)->toDateTimeString()}}").valueOf();

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