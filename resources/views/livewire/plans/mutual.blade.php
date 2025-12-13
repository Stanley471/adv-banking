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
                            <option value="interest">{{__('Interest')}}</option>
                            <option value="start_date">{{__('Start Date')}}</option>
                            <option value="close_date">{{__('Close Date')}}</option>
                            <option value="original">{{__('Units')}}</option>
                            <option value="duration">{{__('Duration')}}</option>
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
    <div class="row g-xl-8 mb-6">
        <div class="col-md-8">
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <div class="input-group input-group-solid mb-5 rounded-4">
                    <span class="input-group-text" id="basic-addon1"><i class="fal fa-search"></i></span>
                    <input type="search" class="form-control form-control-solid text-dark" wire:model="search" placeholder="{{__('Search plans')}}" />
                </div>
            </div>
        </div>
        <div class="col-md-4 text-end">
            <button data-bs-toggle="modal" data-bs-target="#filter" class="btn btn-dark me-4"><i class="fal fa-filter-list"></i> {{__('Filter')}}</button>
        </div>
    </div>
    @if($plans->count() > 0)
    <div class="row">
        @foreach($plans as $val)
        @if($val->priceHistory->last()->date >= \Carbon\Carbon::today() && $val->fundComposition->count())
        <div class="col-md-6 mb-6">
            <div class="card cursor-pointer h-100 rounded-5" data-href="{{route('view.plan', ['plan' => $val->id, 'type' => 'details'])}}">
                <div class="card-body pt-9 pb-0">
                    <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
                        <div class="symbol symbol-100px me-7 mb-4 symbol-circle">
                            <span class="symbol-label" style="background-image:url({{url('/').'/storage/app/'.$val->image}});"></span>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <div class="d-flex flex-column">
                                    <p class="text-dark fs-1 fw-boldest me-3 mb-0">{{substr($val->name, 0, 30)}}{{(Str::length($val->name) > 30) ? '...' : ''}}</p>
                                    <p class="text-gray-800">{{$val->trustee}}</p>
                                    <p>
                                        @if($val->sell_units == 1)<span class="badge badge-light-info">{{__('Sell Units Available')}}</span>@endif
                                        @if($val->dividend == 1)<span class="badge badge-light-info">{{__('Returns Dividend Annually')}}</span>@endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="bg-secondary">
                    <div class="row my-10">
                        <div class="col-6">
                            <p class="fs-3 text-gray-800 fw-bolder">{{__('YTD Returns')}}</p>
                        </div>
                        <div class="col-6 text-end">
                            @if($val->first()->amount == $val->last()->amount)
                            <p class="fs-3 fw-bolder text-success">--</p>
                            @elseif($val->first()->amount > $val->last()->amount)
                            <p class="fs-3 fw-bolder text-success">+{{$val->YTD('first')}}%</p>
                            @else
                            <p class="fs-3 fw-bolder text-danger">-{{$val->YTD('last')}}%</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
        @if($plans->total() > 0 && $plans->count() < $plans->total())<button wire:click="loadMore" wire:loading.remove class="btn btn-secondary btn-block">{{__('See more')}}</button>@endif
            @else
            <div class="text-center mt-20">
                <img src="{{asset('asset/images/beneficiary.png')}}" style="height:auto; max-width:250px;" class="mb-6">
                <h3 class="text-dark">{{__('No Investment Plan Found')}}</h3>
                <p class="text-dark">{{__('We couldn\'t find any investment plan ')}}</p>
            </div>
            @endif
    </div>
</div>