<div>
    @if($val->type == 'project')
    @include('admin.invest.header', ['plan' => $val, 'type' => $type])
    @else
    @include('admin.invest.header-mutual', ['plan' => $val, 'type' => $type])
    @endif
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
    @if($followers->count() > 0)
    <div class="" wire:loading.class.delay="opacity-50" wire:target="search, status, orderBy, perPage, date">
        @foreach($followers as $val)
        <div class="d-flex flex-stack">
            @if($val->plan->type == 'project')
            <div class="d-flex align-items-center">
                <div class="symbol symbol-40px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="{{$val->user->business->name}}">
                    @if($val->user->avatar == null)
                    <span class="symbol-label bg-warning text-inverse-warning fw-boldest">{{substr(ucwords($val->user->business->name), 0, 1)}}</span>
                    @else
                    <div class="symbol-label" style="background-image:url({{url('/').'/storage/app/'.$val->user->avatar}})"></div>
                    @endif
                </div>
                <div class="ps-3">
                    <p class="fs-6 text-dark text-hover-primary fw-bolder mb-0"><a href="{{route('user.manage', ['client' => $val->user->id, 'type' => 'details'])}}">{{$val->user->business->name}}</a></p>
                    <p class="fs-6 text-gray-800 mb-0">{{$val->units.__(' units')}} => {{$currency->currency_symbol.currencyFormat(number_format($val->amount, 2))}}</p>
                </div>
            </div>
            <p class="fs-6 text-gray-800 mb-0">{{__('Return')}} {{$currency->currency_symbol.currencyFormat(number_format($val->amount + ($val->amount * $val->plan->interest / 100), 2))}}</p>
            @else
            <div class="d-flex align-items-center">
                <div class="symbol symbol-40px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="{{$val->user->business->name}}">
                    @if($val->user->avatar == null)
                    <span class="symbol-label bg-warning text-inverse-warning fw-boldest">{{substr(ucwords($val->user->business->name), 0, 1)}}</span>
                    @else
                    <div class="symbol-label" style="background-image:url({{url('/').'/storage/app/'.$val->user->avatar}})"></div>
                    @endif
                </div>
                <div class="ps-3">
                    <p class="fs-6 text-dark text-hover-primary fw-bolder mb-0">{{$val->user->business->name}}</p>
                    <p class="fs-6 text-gray-800 mb-0">{{$val->units.__(' units')}} </p>
                </div>
            </div>
            <p class="fs-6 text-gray-800 mb-0">
                {{__('Value')}} {{$currency->currency_symbol.currencyFormat(number_format($val->units * $val->plan->first()->amount, 2))}}
                @if($val->plan->yesterdayHistory())
                <span class="fw-bolder text-dark">[{{($val->plan->first()->amount == $val->plan->yesterdayHistory()->amount) ? '--' : (($val->plan->first()->amount > $val->plan->yesterdayHistory()->amount) ? '+'.$val->plan->upBy('today').'%' : '-'.$val->plan->upBy('yesterday').'%')}} 24h]</span>
                @else
                <span class="fw-bolder text-dark">[-- 24h]</span>
                @endif
            </p>
            @endif
        </div>
        @if(!$loop->last)
        <hr class="bg-light-border">
        @endif
        @endforeach
        @if($followers->total() > 0 && $followers->count() < $followers->total())<button wire:click="loadMore" wire:loading.remove class="btn btn-secondary btn-block">{{__('See more')}}</button>@endif
    </div>
    @else
    <div class="text-center mt-20">
        <img src="{{asset('asset/images/beneficiary.png')}}" style="height:auto; max-width:200px;" class="mb-6">
        <h3 class="text-dark">{{__('No Followers Found')}}</h3>
        <p class="text-dark">{{__('We couldn\'t find any followers to this investment')}}</p>
    </div>
    @endif
</div>