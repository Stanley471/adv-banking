@extends('user.menu')

@section('content')
<div class="toolbar" id="kt_toolbar">
    <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
        <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
            <h1 class="text-dark fw-bolder my-1 fs-2">{{__('Get a loan')}}</h1>
            <ul class="breadcrumb fw-semibold fs-base my-1 mb-6">
                <li class="breadcrumb-item text-muted">
                    <a href="{{route('user.dashboard')}}" class="text-muted text-hover-primary">Dashboard </a>
                </li>
                <li class="breadcrumb-item text-muted">
                    <a href="{{route('user.loan')}}" class="text-muted text-hover-primary">Loan </a>
                </li>
                <li class="breadcrumb-item text-dark">{{__('Plans')}}</li>
            </ul>
        </div> 
    </div>
    @if($plan->type == 'loan')
    @livewire('loan.apply', ['user' => $user, 'settings' => $set, 'plan' => $plan])
    @else
    @livewire('loan.buy', ['user' => $user, 'settings' => $set, 'plan' => $plan])
    @endif
</div>
</div>
@stop
@section('script')

@endsection