<div>
    <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
        <div class="container">
            <div class="row g-xl-8 mb-6">
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
                <div class="col-md-6">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <div class="input-group input-group-solid mb-5 rounded-4">
                            <span class="input-group-text" id="basic-addon1"><i class="fal fa-search"></i></span>
                            <input type="search" class="form-control form-control-solid text-dark" wire:model="search" placeholder="{{__('Search')}}" />
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-md-end">
                    <button data-bs-toggle="modal" data-bs-target="#filter" class="btn btn-white text-dark me-4"><i class="fal fa-filter-list"></i> {{__('Filter')}}</button>
                </div>
            </div>
            @if($loan->count() > 0)
            <div class="" wire:loading.class.delay="opacity-50" wire:target="search, status, orderBy, perPage, date">
                @foreach($loan as $val)
                <div class="col-md-12 mb-6">
                    <div class="card h-100 rounded-5">
                        <div class="card-body pt-9 pb-0">
                            <div class="text-end">
                                <span class="badge badge-info badge-lg">{{ucwords($val->status)}}</span>
                            </div>
                            <div class="d-flex flex-stack">
                                <div class="d-flex align-items-center">
                                    @if($val->plan->type == 'product')
                                    <div class="symbol symbol-100px me-4">
                                        <span class="symbol-label" style="background-image:url({{url('/').'/storage/app/'.$val->plan->image}});"></span>
                                    </div>
                                    @endif
                                    <div class="ps-1">
                                        <p class="text-dark fs-1 fw-boldest me-3 mb-0">{{$currency->currency_symbol.currencyFormat(number_format($val->amount, 2))}}</p>
                                        <p class="text-gray-800 mb-1">{{$val->plan->name}}</p>
                                        <p class="mb-1">
                                            <span class="badge badge-light-info">{{$val->plan->duration.' Months'}}</span>
                                            <span class="badge badge-light-info">{{($val->plan->installment == 1) ? 'Installment' : 'No Installment'}}</span>
                                        </p>
                                        <p class="text-muted">{{$val->ref_id}}</p>
                                        @if($val->plan->digital_link != null && $val->plan->product_type == 'digital')
                                        <a href="$val->plan->digital_link" class="text-info" target="_blank"><i class="fal fa-arrow-down"></i> {{__('Download Link')}}</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if($val->plan->type == 'loan')
                            <hr class="bg-secondary">
                            <div class="my-6">
                                <div class="d-flex flex-stack">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40px me-4">
                                            <span class="symbol-label" style="background-image:url({{url('/').'/storage/app/'.$val->acct->bank->image}});"></span>
                                        </div>
                                        <div class="ps-1">
                                            <p class="fs-5 fw-bolder text-dark mb-0">{{$val->acct->bank->title}}</p>
                                            <p class="fs-6 text-gray-600 mb-0">{{$val->acct->acct_name}} - {{$val->acct->acct_no}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if($val->plan->type == 'product')
                            <hr class="bg-secondary">
                            <div class="my-6">
                                <div class="d-flex flex-stack">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40px me-4">
                                            <i class="fal fa-location-dot fa-2x"></i>
                                        </div>
                                        <div class="ps-1">
                                            <p class="fs-5 fw-bolder text-dark mb-0">{{$val->user->business->line_1.', '.$val->user->business->myState->name.', '.$val->user->business->city.', '.$val->user->business->postal_code}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if($val->installments->count())
                            <hr class="bg-secondary">
                            <div class="my-6">
                                <p class="fs-5 fw-bolder text-dark mb-0">{{__('Payment log')}}</p>
                                <div class="timeline mt-6">
                                    @foreach ($val->installments as $date)
                                    <div class="timeline-item">
                                        <div class="timeline-line w-40px"></div>
                                        <div class="timeline-icon symbol symbol-circle symbol-40px me-4">
                                            <div class="symbol-label bg-light fs-3">
                                                @if($date->status == 'unpaid')
                                                <i class="fal fa-calendar-alt"></i>
                                                @else
                                                <i class="fa fa-check-circle text-success"></i>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="timeline-content mt-n1">
                                            <div class="bg-light px-6 py-5 rounded-4 @if(!$loop->first && $date->previous()->status == 'unpaid') opacity-50 @endif @if($date->status == 'paid') bg-light-success @elseif($date->expiry_date < \Carbon\Carbon::today() && $date->status == 'unpaid') bg-light-danger @endif">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p class="text-dark fw-bolder fs-6 mb-0">{{$date->expiry_date->format('M j, Y')}}</span></p>
                                                    </div>
                                                </div>
                                                <p class="text-dark fw-bold fs-6 mb-0">{{$currency->currency_symbol.currencyFormat(number_format($date->payback))}} @ {{$date->application->percent}}% Interest</p>
                                                <p class="text-dark fw-bold fs-6 mb-0">{{$currency->currency_symbol.currencyFormat(number_format($date->failed))}} @ {{$date->application->failed_percent}}% after {{$date->expiry_date->format('M j, Y')}}</p>
                                                @if($date->status == 'paid')
                                                <p class="mb-0">{{__('Reference: ').$date->ref_id}}</p>
                                                <span class="badge badge-success">{{__('Paid')}} {{$currency->currency_symbol.currencyFormat(number_format($date->initial + $date->profit)).__(' on ').$date->updated_at->format('M j, Y')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
                @if($loan->total() > 0 && $loan->count() < $loan->total())<button wire:click="loadMore" wire:loading.remove class="btn btn-secondary btn-block">{{__('See more')}}</button>@endif
            </div>
            @else
            <div class="text-center mt-20">
                <img src="{{asset('asset/images/beneficiary.png')}}" style="height:auto; max-width:200px;" class="mb-6">
                <h3 class="text-dark">{{__('No Loan Application Found')}}</h3>
            </div>
            @endif
        </div>
    </div>
</div>