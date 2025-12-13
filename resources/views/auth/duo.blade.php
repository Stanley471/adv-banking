@extends('auth.menu')

@section('content')
<div class="py-10">
    <div class="p-10 p-lg-15 mx-auto">
        <div class="text-center">
            <a href="{{route('home')}}" class="navbar-brand pe-3">
                <img class="mb-6 text-center" src="{{asset('asset/images/logo.png')}}" width="200" alt="{{$set->site_name}}" loading="lazy">
            </a>
        </div>
        @if($plan->partner_id == $user->id)
        <div class="card rounded-5">
            <div class="card-body m-5">
                @csrf
                <div class="text-start mb-10">
                    <p><a href="{{route('user.dashboard')}}" class="text-dark fw-bolder"><i class="fal fa-home"></i> {{__('Back to dashboard')}}</a></p>
                    <div class="symbol symbol-75px mt-1 mb-3">
                        <span class="symbol-label bg-info-light rounded-4">
                            <i class="fal fa-heart-circle-check fa-3x text-dark"></i>
                        </span>
                    </div>
                    <h1 class="text-dark fs-3 mb-3">{{$plan->name}}</h1>
                    <div class="text-dark fw-bold fs-4 mb-3">{{$plan->user->business->name.__(' has invited you to join a duo saving plan')}}</div>
                </div>
                <div class="text-center">
                    <a href="{{route('duo.plan.action', ['plan' => $plan->ref_id, 'type' => 'accept'])}}" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2 mb-6">
                        <span class="indicator-label">{{__('Accept Invitation')}}</span>
                    </a>
                    <a href="{{route('duo.plan.action', ['plan' => $plan->ref_id, 'type' => 'decline'])}}" class="btn btn-lg btn-danger btn-block fw-bolder me-3 my-2">
                        <span class="indicator-label">{{__('Decline Invitation')}}</span>
                    </a>
                </div>
            </div>
        </div>
        @else
        <div class="text-center mb-10">
            <p class="text-dark">{{__('Invalid Recipient')}}</p>
        </div>
        @endif
    </div>
    @include('partials.external')
</div>
@stop