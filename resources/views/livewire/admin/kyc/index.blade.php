<div>
    <div wire:ignore.self class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">{{__('Filter KYC DOC')}}</h3>
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
                            <option value="title">{{__('Title')}}</option>
                            <option value="created_at">{{__('Date')}}</option>
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
    <div class="row g-xl-8">
        <div class="col-md-8">
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <div class="input-group input-group-solid mb-5 rounded-4">
                    <span class="input-group-text" id="basic-addon1"><i class="fal fa-search"></i></span>
                    <input type="search" class="form-control form-control-solid text-dark" wire:model="search" placeholder="{{__('Search KYC DOC')}}" />
                </div>
            </div>
        </div>
        <div class="col-md-4 text-end">
            <button data-bs-toggle="modal" data-bs-target="#filter" class="btn btn-white text-dark me-4"><i class="fal fa-filter-list"></i> {{__('Filter')}}</button>
            <button id="kt_addkyc_button" class="btn btn-dark me-4"><i class="fal fa-plus"></i> {{__('Add KYC')}}</button>
        </div>
    </div>
    <div wire:ignore.self id="kt_addkyc" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_addkyc_button" data-kt-drawer-close="#kt_addkyc_close" data-kt-drawer-width="{'md': '500px'}">
        <div class="card w-100">
            <div class="card-header pe-5 border-0">
                <div class="card-title">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Add a KYC')}}</div>
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_article_close">
                        <span class="svg-icon svg-icon-2">
                            <i class="fal fa-times"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body text-wrap">
                <div class="pb-5 mt-10 position-relative zindex-1">
                    <form class="form w-100 mb-10" wire:submit.prevent="addKYC" method="post">
                        <div class="fv-row mb-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" wire:model.defer="title" required placeholder="Name of KYC" />
                            @error('title')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="fv-row mb-6">
                            <select class="form-select form-select-solid" required wire:model="type" required>
                                <option value="">{{__('Select field type')}}</option>
                                <option value="text">{{__('Text')}}</option>
                                <option value="number">{{__('Number')}}</option>
                            </select>
                            @error('doc_type')
                            <span class="form-text">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="fv-row mb-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" wire:model.defer="min" required placeholder="Minimum Document Number" />
                            @error('min')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="fv-row mb-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" wire:model.defer="max" required placeholder="Maximum Document Number" />
                            @error('max')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="text-center mt-10">
                            <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                                <span wire:loading.remove wire:target="addKYC">{{__('Submit KYC')}}</span>
                                <span wire:loading wire:target="addKYC">{{__('Processing Request...')}}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if($kyc->count() > 0)
    <div class="table-responsive">
        <table id="kt_datatable_zero_configuration" class="table table-row-bordered gy-5" wire:loading.class.delay="opacity-50" wire:target="search, status, sortBy, orderBy, perPage, loadMore">
            <thead>
                <tr class="fw-semibold fs-6 text-muted">
                    <th class="min-w-20px">{{__('S/N')}}</th>
                    <th class="min-w-150px">{{__('Title')}}</th>
                    <th class="min-w-50px">{{__('Field Type')}}</th>
                    <th class="min-w-150px">{{__('Field length')}}</th>
                    <th class="min-w-50px">{{__('Status')}}</th>
                    <th class="min-w-150px">{{__('Created')}}</th>
                    <th class="scope"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($kyc as $val)
                <tr>
                    <td>{{$loop->iteration}}.</td>
                    <td>{{$val->title}}</td>
                    <td>{{$val->type}}</td>
                    <td>{{$val->min.'-'.$val->max}}</td>
                    <td>
                        @if($val->status==1)
                        <span class="badge badge-pill badge-info">{{__('Active')}}</span>
                        @elseif($val->status==0)
                        <span class="badge badge-pill badge-danger">{{__('Disabled')}}</span>
                        @endif
                    </td>
                    <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                    <td class="text-center">
                        <button id="kt_edit_{{$val->id}}_button" class="btn btn-sm btn-light-info">Edit</button>
                        @if($val->status==1)
                        <a wire:click="disable('{{$val->id}}')" class="btn btn-sm btn-secondary">Disable</a>
                        @else
                        <a wire:click="enable('{{$val->id}}')" class="btn btn-sm btn-secondary">Enable</a>
                        @endif
                        <a data-bs-toggle="modal" data-bs-target="#delete{{$val->id}}" href="" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if($kyc->total() > 0 && $kyc->count() < $kyc->total())<button wire:click="loadMore" wire:loading.remove class="btn btn-secondary btn-block">{{__('See more')}}</button>@endif
    </div>
    @else
    <div class="text-center mt-20">
        <img src="{{asset('asset/images/beneficiary.png')}}" style="height:auto; max-width:250px;" class="mb-6">
        <h3 class="text-dark">{{__('No KYC DOC Found')}}</h3>
        <p class="text-dark">{{__('We couldn\'t find any KYC DOC')}}</p>
    </div>
    @endif
    @foreach($kyc as $val)
    <livewire:admin.kyc.edit :val=$val :wire:key="'kt_edit_'. $val->id">
        @endforeach
</div>