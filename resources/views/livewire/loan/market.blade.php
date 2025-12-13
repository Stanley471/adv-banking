<div>
    <div class="px-9 pt-6 rounded h-300px w-100 castro-secret2 bgi-no-repeat bgi-size-cover bgi-position-y-top rounded-5">
        <div class="d-flex flex-stack mt-6">
            <h3 class="m-0 text-white fw-bolder fs-3">{{__('Borrow Funds')}}</h3>
        </div>
        <div class="d-flex align-items-center align-self-center flex-wrap pt-6">
            <div class="fw-bold fs-5 text-start text-white pt-5">
                <span class="fi fi-{{strtolower($currency->iso2)}} mr-2 fis fs-1 rounded-4 text-white"></span> {{__('Current Loan')}}
                <span class="fw-bolder fs-2hx d-block mt-n1 text-white">
                    <span id="main_balance">
                        @if($user->business->reveal_balance == 1){{$currency->currency_symbol.currencyFormat(number_format($user->pendingLoan('product')->sum('payback'), 2)).' '.$currency->currency}} @else ************ @endif
                    </span>
                    <span class="ml-3 fs-3 cursor-pointer" wire:click="xBalance">
                        <i class="fal fa-eye-slash" id="hide_balance" @if($user->business->reveal_balance == 0) style="display:none;" @endif></i>
                        <i class="fal fa-eye" id="reveal_balance" @if($user->business->reveal_balance == 1) style="display:none;" @endif></i>
                    </span>
                </span>
            </div>
        </div>
    </div>
    <div class="mx-md-6 mx-4 mt-n21">
        @livewire('loan.guarantor', ['user' => $user, 'settings' => $set])
        <div class="d-flex justify-content-center flex-column me-3">
            <div class="col-md-12">
                <div class="input-group input-group-solid mb-5 rounded-4">
                    <span class="input-group-text"><i class="fal fa-search"></i></span>
                    <input type="search" class="form-control form-control-solid text-dark" wire:model="search" placeholder="{{__('Search product')}}" />
                    <span class="input-group-text cursor-pointer" id="kt_filter_button"><i class="fal fa-filter-list"></i></span>
                </div>
            </div>
        </div>
        <div wire:ignore.self id="kt_filter" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_filter_button" data-kt-drawer-close="#kt_filter_close" data-kt-drawer-width="{'md': '400px'}">
            <div class="card w-100">
                <div class="card-header pe-5 border-0">
                    <div class="card-title">
                        <div class="d-flex justify-content-center flex-column me-3">
                            <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Filter')}}</div>
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_filter_close">
                            <span class="svg-icon svg-icon-2">
                                <i class="fal fa-times"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-body text-wrap">
                    <div class="fv-row mb-6">
                        <label class="form-label fs-5 fw-bolder text-dark">{{__('Category')}}</label>
                        <select class="form-select form-select-solid" wire:model="category" required>
                            <option value="">All</option>
                            @foreach($categoryAll as $val)
                            <option value="{{$val->id}}">{{$val->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fv-row mb-6">
                        <label class="form-label fs-6 fw-bolder text-dark">{{__('Sort by')}}</label>
                        <select class="form-select form-select-solid" wire:model="sortBy">
                            <option value="name">{{__('Name')}}</option>
                            <option value="amount">{{__('Amount')}}</option>
                        </select>
                    </div>
                    <div class="fv-row mb-6">
                        <label class="form-label fs-6 fw-bolder text-dark">{{__('Order by')}}</label>
                        <select class="form-select form-select-solid" wire:model="orderBy">
                            <option value="asc">{{__('ASC')}}</option>
                            <option value="desc">{{__('DESC')}}</option>
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
        @if($plans->count())
        <div class="row g-8 row-cols-1 row-cols-sm-3">
            @foreach($plans as $val)
            <div class="col mb-3">
                <a href="{{route('user.market.plan', ['plan' => $val->id])}}">
                    <div class="bg-white shadow-xs rounded-5 p-7 cursor-pointer h-100 text-center">
                        <div class="symbol symbol-150px me-7 mb-4">
                            <span class="symbol-label" style="background-image:url({{url('/').'/storage/app/'.$val->image}});"></span>
                        </div>
                        <div class="d-flex flex-wrap flex-sm-nowrap mb-6 text-start">
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                    <div class="d-flex flex-column">
                                        <p class="text-dark fs-4 fw-boldest me-3 mb-2">{{$val->name}}</p>
                                        <p>
                                            <span class="badge badge-info">{{$val->category->name}}</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex flex-wrap justify-content-start">
                                    <div class="rounded-3 min-w-125px py-3 px-4 me-6 mb-3">
                                        <div class="fs-1 fw-boldest text-dark">{{$currency->currency_symbol.currencyFormat(number_format($val->amount, 2))}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        @if($plans->total() > 0 && $plans->count() < $plans->total())<button wire:click="loadMore" wire:loading.remove class="btn btn-secondary btn-block">See more</button>@endif
            @else
            <div class="row g-xl-8">
                <div class="col-lg-12 col-md-12">
                    <div class="text-center mt-20">
                        <img src="{{asset('asset/images/transactions.png')}}" style="height:auto; max-width:150px;" class="mb-6">
                        <h3 class="text-dark">{{__('No Product Found')}}</h3>
                        <p class="text-dark">{{__('We couldn\'t find any product')}}</p>
                    </div>
                </div>
            </div>
            @endif
    </div>
</div>