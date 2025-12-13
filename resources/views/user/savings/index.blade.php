@extends('user.menu')

@section('content')
<div class="toolbar" id="kt_toolbar">
    <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
        <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
            <h1 class="text-dark fw-bolder my-1 fs-2">{{__('Save')}}</h1>
            <ul class="breadcrumb fw-semibold fs-base my-1 mb-6">
                <li class="breadcrumb-item text-muted">
                    <a href="{{route('user.dashboard')}}" class="text-muted text-hover-primary">Dashboard </a>
                </li>
                <li class="breadcrumb-item text-dark">{{__('Plans')}}</li>
            </ul>
        </div>
    </div>
    <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
        <div class="container">
            <div class="row g-xl-8">
                <div class="col-xl-12">
                    <div class="card bg-transparent card-xl-stretch mb-5 mb-xl-8">
                        <div class="card-body p-0 pb-9">
                            @livewire('savings.index', ['user' => $user, 'settings' => $set])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop