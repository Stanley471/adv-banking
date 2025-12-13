@extends('admin.menu')
@section('content')
<div class="toolbar pb-0" id="kt_toolbar">
    <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
        <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
            <h1 class="text-dark fw-bolder my-1 fs-2">{{__('Manage Plan')}}</h1>
            <ul class="breadcrumb fw-semibold fs-base my-1 mb-6">
                <li class="breadcrumb-item text-muted">
                    <a href="{{route('admin.dashboard')}}" class="text-muted text-hover-primary">{{__('Dashboard')}}</a>
                </li>
                <li class="breadcrumb-item text-muted">
                    <a href="{{route('admin.invest', ['type' => ($plan->type == 'project') ? 'project-plans' : 'mutual-plans'])}}" class="text-muted text-hover-primary">{{__('Invest')}}</a>
                </li>
                <li class="breadcrumb-item text-dark">{{ucwords($plan->name)}}</li>
            </ul>
        </div>
        <div class="d-flex align-items-center flex-nowrap text-nowrap py-1">
            <button id="kt_mass_email_button" class="btn btn-info me-4"><i class="fal fa-envelope"></i> {{__('Email Followers & Investors')}}</button>
            @livewire('admin.invest.email', ['plan' => $plan, 'admin' => $admin])
        </div>
    </div>
</div>
<div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
    @if($plan->type == 'project')
    <div class="container">
        @if($type == 'edit')
        @livewire('admin.invest.edit', ['val' => $plan, 'admin' => $admin, 'type' => $type])
        @elseif($type == 'updates')
        @livewire('admin.invest.status', ['val' => $plan, 'admin' => $admin, 'type' => $type])
        @elseif($type == 'followers')
        @livewire('admin.invest.followers', ['val' => $plan, 'admin' => $admin, 'type' => $type])
        @endif
    </div>
    @else
    <div class="container">
        @if($type == 'edit')
        @livewire('admin.invest.edit-mutual', ['val' => $plan, 'admin' => $admin, 'type' => $type])
        @elseif($type == 'followers')
        @livewire('admin.invest.followers', ['val' => $plan, 'admin' => $admin, 'type' => $type])
        @elseif($type == 'history')
        @livewire('admin.invest.history', ['val' => $plan, 'admin' => $admin, 'type' => $type])
        @elseif($type == 'composition')
        @livewire('admin.invest.composition', ['val' => $plan, 'admin' => $admin, 'type' => $type])
        @endif
    </div>
    @endif
</div>
@stop