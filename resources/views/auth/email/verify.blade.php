@extends('auth.email.menu')

@section('content')
<div class="d-flex flex-row-fluid flex-column flex-column-fluid text-center p-10 py-20">
    <div class="pt-30 mb-12 error-bg"></div>
    <div class="text-center">
        <div class="d-flex flex-column flex-lg-row-fluid">
            <div class="d-flex flex-center flex-column flex-column-fluid">
                <div class="w-lg-700px w-700px">
                    <h1 class="fw-bolder fs-5tx text-white mb-3">{{__('Verify Your Email')}}</h1>
                    <div class="fs-3 fw-bold text-white mb-10">{{__('We have sent an email to')}}
                        <span class="text-info fw-bolder">{{$user->email}}</span>
                        <br />{{__('pelase follow a link to verify your email.')}}
                    </div>
                    <div class="fs-5">
                        <span class="fw-bold text-white">{{__('Did\'t receive an email?')}}</span>
                        <a href="{{route('user.send-email')}}" class="text-info fw-bolder">{{__('Resend')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop