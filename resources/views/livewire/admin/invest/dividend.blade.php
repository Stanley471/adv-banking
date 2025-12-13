<div>
    @include('admin.invest.header-mutual', ['plan' => $val, 'type' => $type])
    <div class="row g-xl-8 mb-6 mt-10">
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
    </div>
    @if($dividend->count() > 0)
    <div class="" wire:loading.class.delay="opacity-50" wire:target="search, status, orderBy, perPage, date">
        @foreach($dividend as $val)
        <div class="d-flex flex-stack">
            <div class="d-flex align-items-center">
                <div class="ps-3">
                    <p class="fs-6 text-dark mb-0">{{$currency->currency_symbol.currencyFormat(number_format($val->amount, 2))}}</p>
                </div>
            </div>
            <p class="fs-6 text-gray-800 mb-0">{{__('Date')}} {{$val->created_at->format('M j, Y')}}</p>
        </div>
        @if(!$loop->last)
        <hr class="bg-light-border">
        @endif
        @endforeach
        @if($dividend->total() > 0 && $dividend->count() < $dividend->total())<button wire:click="loadMore" wire:loading.remove class="btn btn-secondary btn-block">{{__('See more')}}</button>@endif
    </div>
    @else
    <div class="text-center mt-20">
        <img src="{{asset('asset/images/beneficiary.png')}}" style="height:auto; max-width:200px;" class="mb-6">
        <h3 class="text-dark">{{__('No Dividend Log Found')}}</h3>
    </div>
    @endif
</div>