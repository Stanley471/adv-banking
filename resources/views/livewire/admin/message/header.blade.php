<div>
    <div class="toolbar pb-0" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <h1 class="text-dark fw-bolder my-1 fs-2">{{__('Messages')}}</h1>
                <ul class="breadcrumb fw-semibold fs-base my-1 mb-6">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('admin.dashboard')}}" class="text-muted text-hover-primary">{{__('Dashboard')}}</a>
                    </li>
                    <li class="breadcrumb-item text-dark">{{ucwords($type)}}</li>
                </ul>
                <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-6 border-gray-300" id="tabs-icons-text" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link text-dark @if(route('admin.message', ['type' => 'inbox'])==url()->current()) active @endif" id="tabs-icons-text-1-tab" href="{{route('admin.message', ['type' => 'inbox'])}}" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">{{__('Inbox')}} ({{number_format_short_nc($unreadMessage)}})</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark @if(route('admin.message', ['type' => 'sent'])==url()->current()) active @endif" id="tabs-icons-text-2-tab" href="{{route('admin.message', ['type' => 'sent'])}}" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">{{__('Sent')}} ({{number_format_short_nc($sentMessage)}})</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark @if(route('admin.message', ['type' => 'contacts'])==url()->current()) active @endif" id="tabs-icons-text-2-tab" href="{{route('admin.message', ['type' => 'contacts'])}}" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">{{__('Contacts')}} ({{number_format_short_nc($contacts)}})</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark @if(route('admin.message', ['type' => 'deleted'])==url()->current()) active @endif" id="tabs-icons-text-2-tab" href="{{route('admin.message', ['type' => 'deleted'])}}" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">{{__('Deleted')}} ({{number_format_short_nc($deletedMessage)}})</a>
                    </li>
                </ul>
            </div>
            <div class="d-flex align-items-center flex-nowrap text-nowrap py-1">
                <button id="kt_dashboard_button" class="btn btn-secondary me-4"><i class="fal fa-bell"></i> {{__('Dashboard notification for all users')}}</button>
                <button id="kt_mass_email_button" class="btn btn-info me-4"><i class="fal fa-bell"></i> {{__('Email all Subscribers')}}</button>
            </div>
        </div>
    </div>
    <div wire:ignore.self id="kt_mass_email" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_mass_email_button" data-kt-drawer-close="#kt_mass_email_close" data-kt-drawer-width="{'md': '500px'}">
        <div class="card w-100">
            <div class="card-header pe-5 border-0">
                <div class="card-title">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Send Email')}}</div>
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_mass_email_close">
                        <span class="svg-icon svg-icon-2">
                            <i class="fal fa-times"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body text-wrap">
                <div class="btn-wrapper text-center mb-3">
                    <div class="symbol symbol-100px symbol-circle me-5 mb-10">
                        <div class="symbol-label fs-1 text-dark">
                            <i class="fal fa-envelope fa-2x"></i>
                        </div>
                    </div>
                    <p class="text-dark fs-6 fw-bold">Send Emails to only active subscribers</p>
                </div>
                <div class="pb-5 mt-10 position-relative zindex-1">
                    <form class="form w-100 mb-10" wire:submit.prevent="sendEmail" method="post">
                        <div class="fv-row mb-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" wire:model.defer="subject" required placeholder="Subject" />
                            @error('subject')
                            <span class="form-text">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="fv-row mb-6">
                            <textarea class="form-control form-control-lg form-control-solid" rows="8" type="text" wire:model.defer="message" required placeholder="Message"></textarea>
                            @error('message')
                            <span class="form-text">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="text-center mt-10">
                            <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2" id="filepond-upload">
                                <span wire:loading.remove wire:target="sendEmail">{{__('Add to Queue')}}</span>
                                <span wire:loading wire:target="sendEmail">{{__('Processing Request...')}}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self id="kt_dashboard" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_dashboard_button" data-kt-drawer-close="#kt_dashboard_close" data-kt-drawer-width="{'md': '500px'}">
        <div class="card w-100">
            <div class="card-header pe-5 border-0">
                <div class="card-title">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Send Dashboard Alert')}}</div>
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_dashboard_close">
                        <span class="svg-icon svg-icon-2">
                            <i class="fal fa-times"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body text-wrap">
                <div class="btn-wrapper text-center mb-3">
                    <div class="symbol symbol-100px symbol-circle me-5 mb-10">
                        <div class="symbol-label fs-1 text-dark">
                            <i class="fal fa-bell fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="pb-5 mt-10 position-relative zindex-1">
                    <form class="form w-100 mb-10" wire:submit.prevent="sendNotify" method="post">
                        <div class="fv-row mb-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" wire:model.defer="dashboard_subject" required placeholder="Subject" />
                            @error('dashboard_subject')
                            <span class="form-text">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="fv-row mb-6">
                            <textarea class="form-control form-control-lg form-control-solid" rows="8" type="text" wire:model.defer="dashboard_message" required placeholder="Message"></textarea>
                            @error('dashboard_message')
                            <span class="form-text">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="text-center mt-10">
                            <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2" id="filepond-upload">
                                <span wire:loading.remove wire:target="sendNotify">{{__('Add to Queue')}}</span>
                                <span wire:loading wire:target="sendNotify">{{__('Processing Request...')}}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    window.livewire.on('closeDrawer', function() {
        KTDrawer.hideAll();
        KTDrawer.createInstances();
    });
</script>
@endpush