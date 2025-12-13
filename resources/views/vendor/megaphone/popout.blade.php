<div id="kt_notify_account" class="bg-white" x-data="{ isDrawer: false }" x-init="isDrawer = false" x-bind:class="{ 'bg-white drawer drawer-end drawer-on': isDrawer }" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_notify_button" data-kt-drawer-close="#kt_notify_close">
    <div class="card w-100">
        <div class="card-header pe-5">
            <div class="card-title">
                <div class="d-flex justify-content-center flex-column me-3">
                    <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Notifications')}}</div>
                </div>
            </div>
            <div class="card-toolbar">
                <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_drawer_example_basic_close">
                    <span class="svg-icon svg-icon-2">
                        <i class="fal fa-times"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="card-body text-wrap">
            @forelse ($unread as $announcement)
            <div class="overflow-auto pb-5">
                <div class="notice bg-light rounded min-w-lg-400px flex-shrink-0 p-6">
                    <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                        <div class="mb-3 mb-md-0 fw-semibold">
                            <h5 class="text-dark fw-bolder fs-6">{{ $announcement['data']['title'] }}</h5>

                            <div class="fs-6 text-dark pe-7">{{ $announcement['data']['body'] }}</div>
                            <div class="fs-7 text-gray-700 pe-7">{{ $announcement->created_at->diffForHumans() }}</div>
                        </div>
                        @if($announcement->read_at === null)
                        <button x-data x-on:click.prevent="isDrawer = true; $wire.markAsRead('{{$announcement->id}}')" class="btn btn-info btn-sm px-6 align-self-center text-nowrap"> <i class="fal fa-thumbs-up"></i> {{__('Read')}} </button>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="flex items-center justify-between">
                <p tabindex="0" class="focus:outline-none fs-4 flex flex-shrink-0 leading-normal px-3 py-16 text-gray-500">
                    {{__('No notifications')}}
                </p>
            </div>
            @endforelse

        </div>
    </div>
</div>