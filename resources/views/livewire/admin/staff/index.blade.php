<div>
    <div class="toolbar" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <h1 class="text-dark fw-bolder my-1 fs-2">{{__('Staffs & Roles')}}</h1>
                <ul class="breadcrumb fw-semibold fs-base my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('admin.dashboard')}}" class="text-muted text-hover-primary">{{__('Dashboard')}}</a>
                    </li>
                    <li class="breadcrumb-item text-dark">{{__('Staff')}}</li>
                </ul>
            </div>
            <div class="d-flex align-items-center flex-nowrap text-nowrap py-1">
                <button data-bs-toggle="modal" data-bs-target="#filter" class="btn btn-white text-dark me-4"><i class="fal fa-filter-list"></i> {{__('Filter')}}</button>
                <button id="kt_staff_button" class="btn btn-dark me-4"><i class="fal fa-plus"></i> {{__('Add a Staff')}}</button>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">{{__('Filter Staff')}}</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="fal fa-times"></i>
                        </span>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="fv-row mb-6">
                        <label class="form-label fs-6 fw-bolder text-dark">{{__('Sort by')}}</label>
                        <select class="form-select form-select-solid" wire:model="sortBy">
                            <option value="asc">{{__('ASC')}}</option>
                            <option value="desc">{{__('DESC')}}</option>
                        </select>
                    </div>
                    <div class="fv-row mb-6">
                        <label class="form-label fs-6 fw-bolder text-dark">{{__('Order by')}}</label>
                        <select class="form-select form-select-solid" wire:model="orderBy">
                            <option value="created_at">{{__('Date')}}</option>
                        </select>
                    </div>
                    <div class="fv-row mb-6">
                        <label class="form-label fs-6 fw-bolder text-dark">{{__('Status')}}</label>
                        <select class="form-select form-select-solid" wire:model="status">
                            <option value="">{{__('All')}}</option>
                            <option value="0">{{__('Active')}}</option>
                            <option value="1">{{__('Blocked')}}</option>
                        </select>
                    </div>
                    <div class="fv-row mb-6">
                        <label class="form-label fs-6 fw-bolder text-dark">{{__('Per page')}}</label>
                        <select class="form-select form-select-solid" wire:model="perPage">
                            <option value="10">{{__('10')}}</option>
                            <option value="25">{{__('25')}}</option>
                            <option value="50">{{__('50')}}</option>
                            <option value="100">{{__('100')}}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self id="kt_staff" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_staff_button" data-kt-drawer-close="#kt_staff_close" data-kt-drawer-width="{'md': '500px'}">
        <div class="card w-100">
            <div class="card-header pe-5 border-0">
                <div class="card-title">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Create a Staff')}}</div>
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_staff_close">
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
                            <i class="fal fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="pb-5 mt-10 position-relative zindex-1">
                    <form class="form w-100 mb-10" wire:submit.prevent="addStaff" method="post">
                        <div class="row fv-row mb-6">
                            <div class="col-xl-6">
                                <input class="form-control form-control-lg form-control-solid" type="text" wire:model.defer="first_name" autocomplete="off" required placeholder="First Name" />
                                @error('first_name')
                                <span class="form-text">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <input class="form-control form-control-lg form-control-solid" type="text" wire:model.defer="last_name" autocomplete="off" required placeholder="Last Name" />
                                @error('last_name')
                                <span class="form-text">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="fv-row mb-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" wire:model.defer="username" required placeholder="Username" />
                            @error('username')
                            <span class="form-text">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="fv-row mb-6">
                            <input class="form-control form-control-lg form-control-solid" type="password" wire:model.defer="password" required placeholder="Password" />
                            @error('password')
                            <span class="form-text">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input type="checkbox" wire:model.defer="profile" id="customCheckLogin1" class="custom-control-input" value="1">
                                    <label class="custom-control-label" for="customCheckLogin1">
                                        <span class="text-muted">{{__('Customer')}}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input type="checkbox" wire:model.defer="support" id="customCheckLogin2" class="custom-control-input" value="1">
                                    <label class="custom-control-label" for="customCheckLogin2">
                                        <span class="text-muted">{{__('Ticket')}}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input type="checkbox" wire:model.defer="promo" id="customCheckLogin3" class="custom-control-input" value="1">
                                    <label class="custom-control-label" for="customCheckLogin3">
                                        <span class="text-muted">{{__('Promotion')}}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input type="checkbox" wire:model.defer="message" id="customCheckLogin4" class="custom-control-input" value="1">
                                    <label class="custom-control-label" for="customCheckLogin4">
                                        <span class="text-muted">{{__('Message')}}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input type="checkbox" wire:model.defer="deposit" id="deposit" class="custom-control-input" value="1">
                                    <label class="custom-control-label" for="deposit">
                                        <span class="text-muted">{{__('Deposit')}}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input type="checkbox" wire:model.defer="payout" id="payout" class="custom-control-input" value="1">
                                    <label class="custom-control-label" for="payout">
                                        <span class="text-muted">{{__('Payout')}}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input type="checkbox" wire:model.defer="knowledge_base" id="customCheckLogin12" class="custom-control-input" value="1">
                                    <label class="custom-control-label" for="customCheckLogin12">
                                        <span class="text-muted">{{__('Help Center')}}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input type="checkbox" wire:model.defer="email_configuration" id="customCheckLogin14" class="custom-control-input" value="1">
                                    <label class="custom-control-label" for="customCheckLogin14">
                                        <span class="text-muted">{{__('Email Settings')}}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input type="checkbox" wire:model.defer="general_settings" id="customCheckLogin15" class="custom-control-input" value="1">
                                    <label class="custom-control-label" for="customCheckLogin15">
                                        <span class="text-muted">{{__('General Settings')}}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input type="checkbox" wire:model.defer="news" id="customCheckLogin16" class="custom-control-input" value="1">
                                    <label class="custom-control-label" for="customCheckLogin16">
                                        <span class="text-muted">{{__('Blog')}}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input type="checkbox" wire:model.defer="language" id="language" class="custom-control-input" value="1">
                                    <label class="custom-control-label" for="language">
                                        <span class="text-muted">{{__('Language')}}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input type="checkbox" wire:model.defer="investment" id="investment" class="custom-control-input" value="1">
                                    <label class="custom-control-label" for="investment">
                                        <span class="text-muted">{{__('Investment')}}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input type="checkbox" wire:model.defer="loan" id="loan" class="custom-control-input" value="1">
                                    <label class="custom-control-label" for="loan">
                                        <span class="text-muted">{{__('Loan')}}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input type="checkbox" wire:model.defer="savings" id="savings" class="custom-control-input" value="1">
                                    <label class="custom-control-label" for="savings">
                                        <span class="text-muted">{{__('Savings')}}</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-10">
                            <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                                <span wire:loading.remove wire:target="addStaff">{{__('Submit Request')}}</span>
                                <span wire:loading wire:target="addStaff">{{__('Processing Request...')}}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
        <div class="container">
            <div class="row g-xl-8">
                <div class="col-lg-12 col-md-12">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <div class="col-md-12">
                            <div class="input-group input-group-solid mb-5 rounded-4">
                                <span class="input-group-text" id="basic-addon1"><i class="fal fa-search"></i></span>
                                <input type="search" class="form-control form-control-solid text-dark" wire:model="search" placeholder="{{__('Search Staff')}}" />
                            </div>
                        </div>
                    </div>
                    @if($staffs->count() > 0)
                    <div class="table-responsive">
                        <table id="kt_datatable_zero_configuration" class="table table-row-bordered gy-5" wire:loading.class.delay="opacity-50" wire:target="search, status, sortBy, orderBy, perPage, loadMore">
                            <thead>
                                <tr class="fw-semibold fs-6 text-muted">
                                    <th class="min-w-20px">{{__('S/N')}}</th>
                                    <th class="min-w-100px">{{__('Name')}}</th>
                                    <th class="min-w-100px">{{__('Username')}}</th>
                                    <th class="50px">{{__('Status')}}</th>
                                    <th class="min-w-50px">{{__('Created')}}</th>
                                    <th class="scope"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($staffs as $val)
                                <tr>
                                    <td>{{$loop->iteration}}.</td>
                                    <td>{{$val->first_name.' '.$val->last_name}}</td>
                                    <td>{{$val->username}}</td>
                                    <td>
                                        @if($val->status==0)
                                        <span class="badge badge-pill badge-info">{{__('Active')}}</span>
                                        @elseif($val->status==1)
                                        <span class="badge badge-pill badge-danger">{{__('Blocked')}}</span>
                                        @endif
                                    </td>
                                    <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                                    <td class="text-center">
                                        <button id="kt_staff_{{$val->id}}_button" class="btn btn-sm btn-light-info">Edit</button>
                                        <button id="kt_devices_{{$val->id}}_button" class="btn btn-sm btn-light-info">Devices & Sessions</button>
                                        <button data-bs-toggle="modal" data-bs-target="#password{{$val->id}}" class="btn btn-sm btn-light-info">Password</button>
                                        @if($val->status==0)
                                        <a wire:click="block('{{$val->id}}')" class="btn btn-sm btn-secondary">Block</a>
                                        @else
                                        <a wire:click="unblock('{{$val->id}}')" class="btn btn-sm btn-secondary">Unblock</a>
                                        @endif
                                        <button data-bs-toggle="modal" data-bs-target="#delete{{$val->id}}" class="btn btn-sm btn-danger">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center mt-20">
                        <img src="{{asset('asset/images/beneficiary.png')}}" style="height:auto; max-width:250px;" class="mb-6">
                        <h3 class="text-dark">{{__('No Staff Found')}}</h3>
                        <p class="text-dark">{{__('We couldn\'t find any staff, create your first staff')}}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @foreach($staffs as $val)
    <livewire:admin.staff.edit :val=$val :wire:key="'kt_staff_'. $val->id">
        <div wire:ignore.self id="kt_devices_{{$val->id}}" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_devices_{{$val->id}}_button" data-kt-drawer-close="#kt_devices_{{$val->id}}_close" data-kt-drawer-width="{'md': '400px'}">
            <div class="card w-100">
                <div class="card-header pe-5 border-0">
                    <div class="card-title">
                        <div class="d-flex justify-content-center flex-column me-3">
                            <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Devices & Sessions')}}</div>
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_devices_{{$val->id}}_close">
                            <span class="svg-icon svg-icon-2">
                                <i class="fal fa-times"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-body text-wrap">
                    <div class="pb-5 mt-10 position-relative zindex-1">
                        @foreach($val->devices() as $device)
                        <div class="d-flex flex-stack mb-6">
                            <div class="d-flex align-items-center me-2">
                                <div class="symbol symbol-45px me-5">
                                    <span class="symbol-label bg-light-primary text-dark">
                                        <i class="fal fa-{{strtolower($device->deviceType)}}"></i>
                                    </span>
                                </div>
                                <div>
                                    <p class="fs-5 text-gray-800 fw-bolder mb-0">{{$device->userAgent}}</p>
                                    <div class="fs-7 text-gray-800 fw-semibold">{{__('Last login:')}} {{\Carbon\Carbon::create($device->last_login)->format('d M, Y h:i:A')}}</div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div wire:ignore.self class="modal fade" id="password{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">{{__('Change Password')}}</h3>
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <span class="svg-icon svg-icon-1">
                                <i class="fal fa-times"></i>
                            </span>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="resetPassword('{{$val->id}}')" method="post" class="mb-10">
                            @csrf
                            <div class="fv-row mb-6 form-floating">
                                <input type="password" wire:model="new_password" id="new_password" class="form-control form-control-lg form-control-solid" required>
                                <label class="form-label fw-bolder text-dark fs-6 mb-0" for="new_password">{{__('New password')}}</label>
                                @error('new_password')
                                <span class="form-text text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-info btn-block">
                                    <span wire:loading.remove wire:target="resetPassword('{{$val->id}}')">{{__('Change Password')}}</span>
                                    <span wire:loading wire:target="resetPassword('{{$val->id}}')">{{__('Processing Request...')}}</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
</div>
@push('scripts')
<script>
    window.livewire.on('closeDrawer', function() {
        KTDrawer.hideAll();
        KTDrawer.createInstances();
    });
    window.livewire.on('drawer', data => {
        KTDrawer.hideAll();
        KTDrawer.createInstances();
    });
    window.livewire.on('closeModal', function(data) {
        var myModal = $(`#delete${data}`);
        myModal.modal('hide');
    });
</script>
@endpush