<div>
    @include('admin.invest.header-mutual', ['plan' => $val, 'type' => $type])
    <div wire:ignore.self class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">{{__('Filter Status')}}</h3>
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
    <div wire:ignore.self id="kt_category" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_category_button" data-kt-drawer-close="#kt_category_close" data-kt-drawer-width="{'md': '500px'}">
        <div class="card w-100">
            <div class="card-header pe-5 border-0">
                <div class="card-title">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Create an Item')}}</div>
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_category_close">
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
                            <i class="fal fa-layer-group fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="pb-5 mt-10 position-relative zindex-1">
                    <form class="form w-100 mb-10" wire:submit.prevent="addStatus" method="post">
                        <div class="fv-row mb-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" wire:model.defer="name" required placeholder="Name" />
                            @error('name')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="fv-row mb-6">
                            <div class="input-group">
                                <input class="form-control form-control-lg form-control-solid" type="number" step="any" wire:model.defer="percent" required placeholder="Percent" />
                                <span class="input-group-text border-0">%</span>
                            </div>
                            @error('percent')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="fv-row mb-6">
                            <label class="form-label fs-6 fw-bolder text-dark">{{__('Colors')}}</label>
                            <select class="form-select form-select-solid" wire:model.defer="color" required>
                                <option value="bg-warning">Yellow</option>
                                <option value="bg-info">Blue</option>
                                <option value="bg-success">Green</option>
                                <option value="bg-secondary">Gray</option>
                                <option value="bg-danger">Red</option>
                                <option value="bg-dark">Black</option>
                                <option value="bg-info">Purple</option>
                            </select>
                            @error('color')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="text-center mt-10">
                            <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                                <span wire:loading.remove wire:target="addStatus">{{__('Create Item')}}</span>
                                <span wire:loading wire:target="addStatus">{{__('Processing Request...')}}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-xl-8 mb-6">
        <div class="col-md-6">
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <div class="input-group input-group-solid mb-5 rounded-4">
                    <span class="input-group-text" id="basic-addon1"><i class="fal fa-search"></i></span>
                    <input type="search" class="form-control form-control-solid text-dark" wire:model="search" placeholder="{{__('Search')}}" />
                </div>
            </div>
        </div>
        <div class="col-md-6 text-end">
            <button data-bs-toggle="modal" data-bs-target="#filter" class="btn btn-white text-dark me-4"><i class="fal fa-filter-list"></i> {{__('Filter')}}</button>
            <button id="kt_category_button" class="btn btn-dark me-4"><i class="fal fa-plus"></i> {{__('Item')}}</button>
        </div>
    </div>
    @if($category->count() > 0)
    @foreach($category as $cat)
    <div class="d-flex flex-stack">
        <div class="d-flex align-items-center">
            <div class="symbol symbol-20px symbol-circle me-4">
                <span class="symbol-label {{$cat->color}}"></span>
            </div>
            <div class="ps-1">
                <p class="fs-6 text-dark fw-bolder mb-0">{{$cat->name}}</p>
                <p class="fs-6 text-gray-600 mb-0">{{$cat->percent}}%</p>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <button id="kt_category_{{$cat->id}}_button" class="btn btn-sm btn-light-info me-3">Edit</button>
            <a data-bs-toggle="modal" data-bs-target="#delete{{$cat->id}}" class="btn btn-sm btn-danger">Delete</a>
        </div>
    </div>
    @if(!$loop->last)
    <hr class="bg-light-border">
    @endif
    @endforeach
    @if($category->total() > 0 && $category->count() < $category->total())<button wire:click="loadMore" wire:loading.remove class="btn btn-secondary btn-block">{{__('See more')}}</button>@endif
        @else
        <div class="text-center mt-20">
            <img src="{{asset('asset/images/beneficiary.png')}}" style="height:auto; max-width:250px;" class="mb-6">
            <h3 class="text-dark">{{__('No Item Found')}}</h3>
            <p class="text-dark">{{__('We couldn\'t find any item')}}</p>
        </div>
        @endif
        @foreach($category as $cat)
        <livewire:admin.invest.edit-composition :val=$cat :admin=$admin :wire:key="'kt_category_'. $cat->id">
            @endforeach
</div>