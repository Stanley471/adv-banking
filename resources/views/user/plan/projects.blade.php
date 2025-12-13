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
                <li class="breadcrumb-item text-dark">{{__('Projects')}}</li>
            </ul>
            <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-5 border-gray-300" id="tabs-icons-text" role="tablist">
                <li class="nav-item">
                    <a class="nav-link text-dark @if(route('user.project', ['type' => 'active'])==url()->current()) active @endif" id="tabs-icons-text-1-tab" href="{{route('user.project', ['type' => 'active'])}}" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="fal fa-sledding fa-lg"></i> {{__('Active')}} ({{count(getProjects('active'))}})</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark @if(route('user.project', ['type' => 'coming'])==url()->current()) active @endif" id="tabs-icons-text-2-tab" href="{{route('user.project', ['type' => 'coming'])}}" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="fal fa-retweet"></i> {{__('Coming soon')}} ({{count(getProjects('coming'))}})</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark @if(route('user.project', ['type' => 'closed'])==url()->current()) active @endif" id="tabs-icons-text-3-tab" href="{{route('user.project', ['type' => 'closed'])}}" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="fal fa-hourglass-end"></i> {{__('Matured')}} ({{count(getProjects('closed'))}})</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
        <div class="container">
            @if(route('user.project', ['type' => 'active'])==url()->current())
            @livewire('plans.project', ['type' => 'active', 'user' => $user, 'settings' => $set])
            @elseif(route('user.project', ['type' => 'coming'])==url()->current())
            @livewire('plans.project', ['type' => 'coming', 'user' => $user, 'settings' => $set])
            @elseif(route('user.project', ['type' => 'closed'])==url()->current())
            @livewire('plans.project', ['type' => 'closed', 'user' => $user, 'settings' => $set])
            @endif
        </div>
    </div>
</div>
@stop