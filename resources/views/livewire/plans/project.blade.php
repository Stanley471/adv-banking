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
                        <label class="form-label fs-5 fw-bolder text-dark">{{__('Category')}}</label>
                        <select class="form-select form-select-solid" wire:model="category" required>
                            <option value="">Select Category</option>
                            @foreach($categoryAll as $val)
                            <option value="{{$val->id}}">{{$val->name}}</option>
                            @endforeach
                        </select>
                        @error('category')
                        <span class="form-text text-danger">{{$message}}</span>
                        @enderror
                    </div>
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
    @foreach($plans as $val)
    <div class="card mb-9 cursor-pointer rounded-5" data-href="{{route('view.plan', ['plan' => $val->id, 'type' => 'details'])}}">
        <div class="card-body pt-9 pb-0">
            <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
                <div class="symbol symbol-150px me-7 mb-4 symbol-circle">
                    <span class="symbol-label" style="background-image:url({{url('/').'/storage/app/'.$val->image}});"></span>
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <div class="d-flex flex-column">
                            <p class="text-dark fs-1 fw-boldest me-3 mb-0">{{substr($val->name, 0, 30)}}{{(Str::length($val->name) > 30) ? '...' : ''}}</p>
                            <p class="text-gray-800 fs-5 me-3 mb-3">{{$val->location}}</p>
                            <p>
                                <span class="badge badge-light-info">{{$val->category->name}}</span>
                                <span class="badge badge-light-info">{{$val->duration.' Months'}}</span>
                                <span class="badge badge-light-info">{{($val->status == 1) ? 'Published' : 'Disabled'}}</span>
                                <span class="badge badge-light-info">{{($val->insurance == 1) ? 'Insured' : 'No Insurance'}}</span>
                            </p>
                            @if($val->followed->count())
                            <div class="symbol-group symbol-hover mb-3">
                                <!--begin::User-->
                                @foreach($val->followed->take(10) as $followers)
                                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="{{$followers->user->business->name}}">
                                    @if($followers->user->avatar == null)
                                    <span class="symbol-label bg-warning text-inverse-warning fw-boldest">{{substr(ucwords($followers->user->business->name), 0, 1)}}</span>
                                    @else
                                    <div class="symbol-label" style="background-image:url({{url('/').'/storage/app/'.$followers->user->avatar}})"></div>
                                    @endif
                                </div>
                                @endforeach
                                @if($val->followed->count() > 10)
                                <div class="symbol symbol-35px symbol-circle">
                                    <span class="symbol-label bg-warning text-dark fs-8 fw-boldest">+{{$val->followed->count() - 10}}</span>
                                </div>
                                @endif
                            </div>
                            @endif

                        </div>
                        <div class="d-flex mb-4">
                            @if(in_array($type, ['active', 'coming']))
                            @if($user->followedPlan($val->id))
                            <span class="badge badge-secondary me-5 mt-3">{{__('Followed')}}</span>
                            @endif
                            @endif
                        </div>
                    </div>
                    <div class="d-flex flex-wrap justify-content-start">
                        <div class="border border-gray-600 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                            <div class="fs-6 fw-boldest text-gray-700">{{\Carbon\Carbon::create($val->start_date)->format('M j, Y')}} - {{\Carbon\Carbon::create($val->close_date)->format('M j, Y')}}</div>
                            <div class="fw-bold text-gray-400">Investment Closure</div>
                        </div>
                        <div class="border border-gray-600 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                            <div class="fs-6 fw-boldest text-gray-700">{{\Carbon\Carbon::create($val->expiring_date)->format('M j, Y')}}</div>
                            <div class="fw-bold text-gray-400">Matures</div>
                        </div>
                        <div class="border border-gray-600 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                            <div class="fs-6 fw-boldest text-gray-700">{{number_format($val->original - $val->units).'/'.number_format($val->original)}} units</div>
                            <div class="fw-bold text-gray-400">{{$currency->currency_symbol.$val->price}} per unit</div>
                        </div>
                        <div class="border border-gray-600 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                            <div class="fs-6 fw-boldest text-gray-700">{{$val->interest}}%</div>
                            <div class="fw-bold text-gray-400">Interest</div>
                        </div>
                        <div class="border border-gray-600 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                            <div class="fs-6 fw-boldest text-gray-700">
                                @if($val->fee_type == "both")
                                {{$val->percent_pc}}% + {{$val->fiat_pc.' '.$currency->currency}}
                                @elseif($val->fee_type == "fiat")
                                {{$val->fiat_pc.' '.$currency->currency}}
                                @elseif($val->fee_type == "percent")
                                {{$val->percent_pc}}%
                                @elseif($val->fee_type == "max")
                                > {{$val->fiat_pc.' '.$currency->currency}} - {{$val->percent_pc}}%
                                @elseif($val->fee_type == "min")
                                < {{$val->fiat_pc.' '.$currency->currency}} - {{$val->percent_pc}}% @endif </div>
                                    <div class="fw-bold text-gray-400">Mtg Fee</div>
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
                <h3 class="text-dark">{{__('No Investment Plan Found')}}</h3>
                <p class="text-dark">{{__('We couldn\'t find any investment plan ')}}</p>
            </div>
            @endif
    </div>
</div>