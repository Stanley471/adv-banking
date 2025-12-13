<div>
    <div wire:ignore.self class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">{{__('Filter Messages')}}</h3>
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
                            <option value="name">{{__('Name')}}</option>
                            <option value="created_at">{{__('Date')}}</option>
                        </select>
                    </div>
                    <div class="fv-row mb-6">
                        <label class="form-label fs-6 fw-bolder text-dark">{{__('Category')}}</label>
                        <select class="form-select form-select-solid" wire:model="cat_id" required>
                            <option value="">Select Category</option>
                            @foreach($categoryAll as $bval)
                            <option value="{{$bval->id}}">{{$bval->name}}</option>
                            @endforeach
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
    <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
        <div class="container">
            <div class="row g-xl-8">
                <div class="col-md-8">
                    <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                        <div class="input-group input-group-solid mb-5 rounded-4">
                            <span class="input-group-text" id="basic-addon1"><i class="fal fa-search"></i></span>
                            <input type="search" class="form-control form-control-solid text-dark" wire:model="search" placeholder="{{__('Search plans')}}" />
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-end">
                    <button data-bs-toggle="modal" data-bs-target="#filter" class="btn btn-light text-dark me-4"><i class="fal fa-filter-list"></i> {{__('Filter')}}</button>
                    <button id="kt_article_button" class="btn btn-info me-4"><i class="fal fa-pie-chart"></i> {{__('Add circle')}}</button>
                </div>
            </div>
            <div wire:ignore.self id="kt_article" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_article_button" data-kt-drawer-close="#kt_article_close" data-kt-drawer-width="{'md': '900px'}">
                <div class="card w-100">
                    <div class="card-header pe-5 border-0">
                        <div class="card-title">
                            <div class="d-flex justify-content-center flex-column me-3">
                                <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Create a Circle')}}</div>
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
                            <form class="form w-100 mb-10" wire:submit.prevent="addPlan" method="post">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card card-flush py-4">
                                            <!--begin::Card body-->
                                            <div class="card-body text-center pt-0" wire:ignore>
                                                <!--begin::Image input-->
                                                <!--begin::Image input placeholder-->
                                                <style>
                                                    .image-input-placeholder {
                                                        background-image: url({{asset('dashboard/media/svg/files/blank-image.svg')
                                                    }})
                                                    }
                                                </style>
                                                <!--end::Image input placeholder-->

                                                <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                                                    <!--begin::Preview existing avatar-->
                                                    <div class="image-input-wrapper w-150px h-150px"></div>
                                                    <!--end::Preview existing avatar-->

                                                    <!--begin::Label-->
                                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" aria-label="Change avatar" data-bs-original-title="Change avatar" data-kt-initialized="1">
                                                        <i class="bi bi-pencil-fill fs-7"></i>

                                                        <!--begin::Inputs-->
                                                        <input type="file" wire:model="image" id="image" accept=".png, .jpg, .jpeg, .webp" required>
                                                        <input type="hidden" name="avatar_remove">
                                                        <!--end::Inputs-->
                                                    </label>
                                                    <!--end::Label-->

                                                    <!--begin::Cancel-->
                                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" aria-label="Cancel avatar" data-bs-original-title="Cancel avatar" data-kt-initialized="1">
                                                        <i class="bi bi-x fs-2"></i>
                                                    </span>
                                                    <!--end::Cancel-->

                                                    <!--begin::Remove-->
                                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" aria-label="Remove avatar" data-bs-original-title="Remove avatar" data-kt-initialized="1">
                                                        <i class="bi bi-x fs-2"></i>
                                                    </span>
                                                    <!--end::Remove-->
                                                </div>
                                                <!--end::Image input-->

                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">Set the thumbnail image. Only *.png, *.jpg and *.jpeg image files are accepted</div>
                                                @error('image')
                                                <span class="form-text text-danger">{{$message}}</span>
                                                @enderror
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Card body-->
                                        </div>
                                        <div class="fv-row mb-6">
                                            <label class="form-label fs-5 fw-bolder text-dark">{{__('Category')}}</label>
                                            <select class="form-select form-select-solid" wire:model.defer="selectCategory" required>
                                                <option value="">Select Category</option>
                                                @foreach($categoryAll as $val)
                                                <option value="{{$val->id}}">{{$val->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('selectCategory')
                                            <span class="form-text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="fv-row mb-6">
                                            <label class="form-label fs-5 fw-bolder text-dark">{{__('Status')}}</label>
                                            <select class="form-select form-select-solid" wire:model.defer="status" required>
                                                <option value="1">{{__('Published')}}</option>
                                                <option value="0">{{__('Disabled')}}</option>
                                            </select>
                                            @error('status')
                                            <span class="form-text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="fv-row mb-6">
                                            <input class="form-control form-control-lg form-control-solid" type="text" wire:model.defer="name" required placeholder="Name of Circle" />
                                            @error('name')
                                            <span class="form-text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="fv-row mb-6">
                                            <label class="col-form-label">{{__('Amount')}}</label>
                                            <div class="input-group">
                                                <span class="input-group-text border-0">{{$currency->currency_symbol}}</span>
                                                <input type="number" wire:model.defer="amount" steps="any" class="form-control form-control-lg form-control-solid" required placeholder="0.00">
                                            </div>
                                            @error('amount')
                                            <span class="form-text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="fv-row mb-6">
                                            <label class="col-form-label">{{__('Interest')}}</label>
                                            <div class="input-group">
                                                <input type="number" wire:model.defer="interest" steps="any" class="form-control form-control-lg form-control-solid" required placeholder="1">
                                                <span class="input-group-text border-0">%</span>
                                            </div>
                                            @error('interest')
                                            <span class="form-text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="fv-row mb-6">
                                            <label class="form-label fs-5 fw-bolder text-dark">{{__('Duration')}}</label>
                                            <select class="form-select form-select-solid" wire:model.defer="circle_duration" required>
                                                <option value="weekly">{{__('Weekly')}}</option>
                                                <option value="monthly">{{__('Monthly')}}</option>
                                            </select>
                                            @error('circle_duration')
                                            <span class="form-text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="fv-row mb-6">
                                            <textarea class="form-control form-control-lg form-control-solid" rows="10" type="text" wire:model.defer="description" placeholder="Detailed description of Circle"></textarea>
                                            @error('description')
                                            <span class="form-text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="text-center mt-10">
                                            <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                                                <span wire:loading.remove wire:target="addPlan">{{__('Submit Circle')}}</span>
                                                <span wire:loading wire:target="addPlan">{{__('Processing Request...')}}</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @if($plans->count() > 0)
            @foreach($plans as $val)
            <div class="card mb-9 rounded-5">
                <div class="card-body pt-9 pb-0">
                    <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
                        <div class="symbol symbol-100px me-7 mb-4 symbol-circle">
                            <span class="symbol-label" style="background-image:url({{url('/').'/storage/app/'.$val->image}});"></span>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <div class="d-flex flex-column">
                                    <p class="text-dark fs-1 fw-boldest me-3 mb-2">{{substr($val->name, 0, 30)}}{{(Str::length($val->name) > 30) ? '...' : ''}}</p>
                                    <p>
                                        <span class="badge badge-light-info">{{$val->circleCategory->name}}</span>
                                        <span class="badge badge-light-info">{{ucwords($val->circle_duration)}}</span>
                                        <span class="badge badge-light-info">Members: {{$val->savings->count()}}</span>
                                        <span class="badge badge-light-info">{{($val->status == 1) ? 'Published' : 'Disabled'}}</span>
                                    </p>
                                </div>
                                <div class="d-flex mb-4">
                                    <button id="kt_members_{{$val->id}}_button" class="btn btn-primary me-3">Leader Board</button>
                                    <button id="kt_edit_{{$val->id}}_button" class="btn btn-dark me-3">Edit</button>
                                    <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$val->id}}">Delete</a>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap justify-content-start">
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="fs-6 fw-boldest text-gray-700">{{$currency->currency_symbol.currencyFormat(number_format($val->amount))}}</div>
                                    <div class="fw-bold text-gray-400">Amount</div>
                                </div>
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="fs-6 fw-boldest text-gray-700">{{$val->interest}}%</div>
                                    <div class="fw-bold text-gray-400">Interest</div>
                                </div>
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="fs-6 fw-boldest text-gray-700">{{$currency->currency_symbol.currencyFormat(number_format($val->savings->sum('amount')))}}</div>
                                    <div class="fw-bold text-gray-400">Savings</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @if($plans->total() > 0 && $plans->count() < $plans->total())<button wire:click="loadMore" wire:loading.remove class="btn btn-secondary btn-block">{{__('See more')}}</button>@endif
                @else
                <div class="text-center mt-20">
                    <img src="{{asset('asset/images/beneficiary.png')}}" style="height:auto; max-width:250px;" class="mb-6">
                    <h3 class="text-dark">{{__('No Circle Found')}}</h3>
                </div>
                @endif
        </div>
    </div>
    @foreach($plans as $val)
    <livewire:admin.savings.edit-circle :val=$val :admin=$admin :wire:key="'kt_edit_'. $val->id">
        @endforeach
</div>