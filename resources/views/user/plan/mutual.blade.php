@extends('user.menu')

@section('content')
<div class="toolbar" id="kt_toolbar">
    <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
        <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
            <h1 class="text-dark fw-bolder my-1 fs-2">{{__('Invest')}}</h1>
            <ul class="breadcrumb fw-semibold fs-base my-1 mb-6">
                <li class="breadcrumb-item text-muted">
                    <a href="{{route('user.dashboard')}}" class="text-muted text-hover-primary">{{__('Dashboard')}} </a>
                </li>
                <li class="breadcrumb-item text-muted">
                    <a href="{{route('user.plan')}}" class="text-muted text-hover-primary">{{__('Invest')}} </a>
                </li>
                <li class="breadcrumb-item text-dark">{{__('Plans')}}</li>
            </ul>
            <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-5 border-gray-300" id="tabs-icons-text" role="tablist">
                <li class="nav-item">
                    <a class="nav-link text-dark @if(route('user.mutual', ['type' => 'recommended'])==url()->current()) active @endif" id="tabs-icons-text-1-tab" href="{{route('user.mutual', ['type' => 'recommended'])}}" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="fal fa-fire fa-lg"></i> {{__('Recommended')}} ({{count(getMutual('recommended'))}})</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark @if(route('user.mutual', ['type' => 'all'])==url()->current()) active @endif" id="tabs-icons-text-2-tab" href="{{route('user.mutual', ['type' => 'all'])}}" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="fal fa-globe"></i> {{__('All')}} ({{count(getMutual())}})</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
        <div class="container">
            @if(route('user.mutual', ['type' => 'recommended'])==url()->current())
            @livewire('plans.mutual', ['type' => 'recommended', 'user' => $user, 'settings' => $set])
            @else
            @livewire('plans.mutual', ['type' => 'all', 'user' => $user, 'settings' => $set])
            @endif
        </div>
    </div>
</div>
@stop