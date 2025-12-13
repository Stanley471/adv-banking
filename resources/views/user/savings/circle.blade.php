@extends('user.menu')

@section('content')
<div class="toolbar" id="kt_toolbar">
    <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
        <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
            <h1 class="text-dark fw-bolder my-1 fs-2">{{__('Save')}}</h1>
            <ul class="breadcrumb fw-semibold fs-base my-1 mb-6">
                <li class="breadcrumb-item text-muted">
                    <a href="{{route('user.dashboard')}}" class="text-muted text-hover-primary">{{__('Dashboard')}} </a>
                </li>
                <li class="breadcrumb-item text-muted">
                    <a href="{{route('user.savings')}}" class="text-muted text-hover-primary">{{__('Plans')}} </a>
                </li>
                <li class="breadcrumb-item text-dark">{{__('Circles')}}</li>
            </ul>
            <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-5 border-gray-300" id="tabs-icons-text" role="tablist">
                @foreach(getCircleCategory() as $circle)
                <li class="nav-item">
                    <a class="nav-link text-dark @if(route('saving.circles', ['type' => $circle->id])==url()->current()) active @endif" id="tabs-icons-text-1-tab" href="{{route('saving.circles', ['type' => $circle->id])}}" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">{{$circle->name}}</a>
                </li>
                @endforeach
                <li class="nav-item">
                    <a class="nav-link text-dark @if(route('saving.circles', ['type' => 'weekly'])==url()->current()) active @endif" id="tabs-icons-text-2-tab" href="{{route('saving.circles', ['type' => 'weekly'])}}" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">{{__('Weekly')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark @if(route('saving.circles', ['type' => 'monthly'])==url()->current()) active @endif" id="tabs-icons-text-3-tab" href="{{route('saving.circles', ['type' => 'monthly'])}}" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false">{{__('Monthly')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark @if(route('saving.circles', ['type' => 'all'])==url()->current()) active @endif" id="tabs-icons-text-3-tab" href="{{route('saving.circles', ['type' => 'all'])}}" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false">{{__('All')}}</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
        <div class="container">
            @foreach(getCircleCategory() as $circle)
            @if(route('saving.circles', ['type' => $circle->id])==url()->current())
            @livewire('savings.circles', ['type' => $circle->id, 'user' => $user, 'settings' => $set])
            @endif
            @endforeach

            @if(route('saving.circles', ['type' => 'weekly'])==url()->current())
            @livewire('savings.circles', ['type' => 'weekly', 'user' => $user, 'settings' => $set])
            @elseif(route('saving.circles', ['type' => 'monthly'])==url()->current())
            @livewire('savings.circles', ['type' => 'monthly', 'user' => $user, 'settings' => $set])
            @elseif(route('saving.circles', ['type' => 'all'])==url()->current())
            @livewire('savings.circles', ['type' => 'all', 'user' => $user, 'settings' => $set])
            @endif
        </div>
    </div>
</div>
@stop