<div>
    <hr class="bg-secondary">
    <h3 class="mb-6 mt-10">Other Payout Methods</h3>
    <div wire:ignore.self class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">{{__('Filter')}}</h3>
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
    <div class="row g-xl-8">
        <div class="col-md-8">
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <div class="input-group input-group-solid mb-5 rounded-4">
                    <span class="input-group-text" id="basic-addon1"><i class="fal fa-search"></i></span>
                    <input type="search" class="form-control form-control-solid text-dark" wire:model="search" placeholder="{{__('Search Methods')}}" />
                </div>
            </div>
        </div>
        <div class="col-md-4 text-end">
            <button data-bs-toggle="modal" data-bs-target="#filter" class="btn btn-white text-dark me-4"><i class="fal fa-filter-list"></i> {{__('Filter')}}</button>
            <button id="kt_addmethod_button" class="btn btn-dark me-4"><i class="fal fa-plus"></i> {{__('Add Method')}}</button>
        </div>
    </div>
    <div wire:ignore.self id="kt_addmethod" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_addmethod_button" data-kt-drawer-close="#kt_addmethod_close" data-kt-drawer-width="{'md': '500px'}">
        <div class="card w-100">
            <div class="card-header pe-5 border-0">
                <div class="card-title">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Add a Payout Method')}}</div>
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
                    <form class="form w-100 mb-10" wire:submit.prevent="addMethod" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="fv-row mb-6">
                                    <input class="form-control form-control-lg form-control-solid" type="text" wire:model.defer="name" required placeholder="Name of Method" />
                                    @error('name')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6">
                                    <textarea class="form-control form-control-lg form-control-solid" type="text" wire:model.defer="requirements" rows="5" required placeholder="Payout requirements"></textarea>
                                    <span class="form-text">This will be showed to clients as placeholder to tell them, what they must provide for a successful withdrawal</span>
                                    @error('requirements')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="col-form-label">{{__('Minimum Amount')}}</label>
                                    <div class="input-group">
                                        <span class="input-group-text border-0">{{$currency->currency_symbol}}</span>
                                        <input type="number" wire:model.defer="min" steps="any" class="form-control form-control-lg form-control-solid" required placeholder="0.00">
                                    </div>
                                    @error('min')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="col-form-label">{{__('Maximum Amount')}}</label>
                                    <div class="input-group">
                                        <span class="input-group-text border-0">{{$currency->currency_symbol}}</span>
                                        <input type="number" wire:model.defer="max" steps="any" class="form-control form-control-lg form-control-solid" required placeholder="0.00">
                                    </div>
                                    @error('max')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6">
                                    <div class="input-group">
                                        <input type="number" step="any" wire:model.defer="pc" placeholder="{{__('Percent charge')}}" autocomplete="off" class="form-control form-control-lg form-control-solid">
                                        <span class="input-group-text border-0">%</span>
                                    </div>
                                    @error('pc')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6">
                                    <div class="input-group">
                                        <span class="input-group-text border-0">{{$currency->currency_symbol}}</span>
                                        <input type="number" step="any" wire:model.defer="fc" placeholder="{{__('Fiat charge')}}" autocomplete="off" class="form-control form-control-lg form-control-solid">
                                    </div>
                                    @error('fc')
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
                                <div class="text-center mt-10">
                                    <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                                        <span wire:loading.remove wire:target="addMethod">{{__('Submit Method')}}</span>
                                        <span wire:loading wire:target="addMethod">{{__('Processing Request...')}}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if($methods->count() > 0)
    <div class="table-responsive">
        <table id="kt_datatable_zero_configuration" class="table table-row-bordered gy-5" wire:loading.class.delay="opacity-50" wire:target="search, status, sortBy, orderBy, perPage, loadMore">
            <thead>
                <tr class="fw-semibold fs-6 text-muted">
                    <th class="min-w-20px">{{__('S/N')}}</th>
                    <th class="min-w-150px">{{__('Title')}}</th>
                    <th class="min-w-100px">{{__('Limit')}}</th>
                    <th class="min-w-50px">{{__('Charge')}}</th>
                    <th class="min-w-50px">{{__('Status')}}</th>
                    <th class="min-w-150px">{{__('Created')}}</th>
                    <th class="scope"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($methods as $val)
                <tr>
                    <td>{{$loop->iteration}}.</td>
                    <td>{{$val->name}}</td>
                    <td>{{$currency->currency_symbol.$val->min.' - '.$currency->currency_symbol.$val->max}}</td>
                    <td>{{$currency->currency_symbol.$val->fc.' + '.$val->pc}}%</td>
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
        @if($methods->total() > 0 && $methods->count() < $methods->total())<button wire:click="loadMore" wire:loading.remove class="btn btn-secondary btn-block">{{__('See more')}}</button>@endif
    </div>
    @else
    <div class="text-center mt-20">
        <img src="{{asset('asset/images/beneficiary.png')}}" style="height:auto; max-width:250px;" class="mb-6">
        <h3 class="text-dark">{{__('No Payout Method Found')}}</h3>
    </div>
    @endif
    @foreach($methods as $val)
    <livewire:admin.withdraw.edit :val=$val :wire:key="'kt_edit_'. $val->id">
        @endforeach
</div>