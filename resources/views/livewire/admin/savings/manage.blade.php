<div>
    <div class="toolbar" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <h1 class="text-dark fw-bolder my-1 fs-2">{{in_array($plan->type, ['regular', 'duo', 'emergency']) ? ucwords($plan->type).__(' Savings') :__(' Saving Circle') }}</h1>
                <ul class="breadcrumb fw-semibold fs-base my-1 mb-6">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('admin.dashboard')}}" class="text-muted text-hover-primary">{{__('Dashboard')}} </a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('admin.save', ['type' => $plan->type])}}" class="text-muted text-hover-primary">{{__('Savings')}} </a>
                    </li>
                    <li class="breadcrumb-item text-dark">{{__('Plan')}}</li>
                </ul>
            </div>
            @if($plan->type == 'circle')
            <div class="d-flex align-items-center flex-nowrap text-nowrap py-1 mb-10">
                <button id="kt_leader_button" class="btn btn-dark"><i class="fa fa-crown text-warning"></i> {{__('Leader Board')}}</button>
                <div wire:ignore.self id="kt_leader" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_leader_button" data-kt-drawer-close="#kt_leader_close" data-kt-drawer-width="{'md': '500px'}">
                    <div class="card w-100">
                        <div class="card-header pe-5 border-0">
                            <div class="card-title">
                                <div class="d-flex justify-content-center flex-column me-3">
                                    <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Leader Board')}}</div>
                                </div>
                            </div>
                            <div class="card-toolbar">
                                <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_leader_close">
                                    <span class="svg-icon svg-icon-2">
                                        <i class="fal fa-times"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-wrap">
                            <div class="btn-wrapper text-center mb-3">
                                <div class="symbol symbol-100px symbol-circle me-5 mb-10">
                                    <div class="symbol-label fs-1 text-dark bg-light-info">
                                        <i class="fal fa-university fa-2x text-info"></i>
                                    </div>
                                </div>
                                <p class="text-dark fs-6">{{__('Top 100 users in this circle')}}</p>
                            </div>
                            <div class="pb-5 mt-10 position-relative zindex-1">
                                @forelse($plan->circle->savings->whereNotNull('amount')->take(100) as $leader)
                                <div class="d-flex flex-stack mb-6 bg-light p-3 rounded-3">
                                    <div class="d-flex align-items-center">
                                        <div class="ps-2">
                                            <p class="fs-6 text-dark fw-bolder me-5 mb-0">{{$loop->iteration}}.</p>
                                        </div>
                                        <div class="symbol symbol-40px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="{{$leader->user->business->name}}">
                                            @if($leader->user->avatar == null)
                                            <span class="symbol-label bg-info text-inverse-info fw-boldest">{{substr(ucwords($leader->user->business->name), 0, 1)}}</span>
                                            @else
                                            <div class="symbol-label" style="background-image:url({{url('/').'/storage/app/'.$leader->user->avatar}})"></div>
                                            @endif
                                        </div>
                                        <div class="ps-2">
                                            <p class="fs-6 text-dark fw-bolder mb-0"><a class="text-dark" href="{{route('user.manage', ['client' => $leader->user->id, 'type' => 'details'])}}">{{$leader->user->business->name}}</a></p>
                                            <p class="fs-6 text-info mb-0">{{$currency->currency_symbol.currencyFormat(number_format($leader->amount, 2)).' '.$currency->currency}}</p>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <p class="text-gray-600 text-center">{{__('No Users')}}</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
            <div class="container">
                <div class="row g-xl-8">
                    <div class="col-xl-12">
                        <div class="card bg-transparent card-xl-stretch mb-5 mb-xl-8">
                            <div class="card-body p-0 pb-9">
                                <div class="px-9 pt-6 rounded @if($plan->type != 'regular') h-400px @else h-300px @endif w-100 castro-secret2 bgi-no-repeat bgi-size-cover bgi-position-y-top rounded-5 mb-10">
                                    <div class="row mt-6">
                                        <div class="col-md-12">
                                            <div class="d-flex align-items-center">
                                                @if($plan->type == 'circle')
                                                <div class="symbol symbol-40px symbol-circle" data-bs-toggle="tooltip" title="">
                                                    <div class="symbol-label bg-transparent" style="background-image:url({{url('/').'/storage/app/'.$plan->circle->image}})"></div>
                                                </div>
                                                @endif
                                                <div class="ps-2">
                                                    <h3 class="m-0 text-white fw-bolder fs-3">
                                                        {{($plan->type != 'circle') ? $plan->name : $plan->circle->name}}
                                                    </h3>
                                                    <p class="fs-6 text-white mb-0"><a class="text-white" href="{{route('user.manage', ['client' => $plan->user->id, 'type' => 'details'])}}">{{$plan->user->business->name}}</a> @if($plan->type == 'duo') X <a class="text-white" href="{{route('user.manage', ['client' => $plan->partner->id, 'type' => 'details'])}}">{{$plan->partner->business->name}}</a> @endif</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center align-self-center flex-wrap pt-6">
                                        <p class="fw-bold fs-5 text-start text-white pt-5">
                                            <span class="fi fi-{{strtolower($currency->iso2)}} mr-2 fis fs-1 rounded-4 text-white"></span> {{__('Current Savings')}}
                                            <span class="fw-bolder fs-2hx d-block mt-n1 text-white">
                                                <span id="main_balance">
                                                    {{$currency->currency_symbol.currencyFormat(number_format($plan->amount, 2)).' '.$currency->currency}}
                                                </span>
                                            </span>
                                        </p>
                                    </div>
                                    @if($plan->type == 'regular')
                                    <p class="text-white me-2 mb-0 fs-6 mt-10">{{__('Duration: ').$plan->created_at->format('M j, Y').' - '.$plan->expiry_date->format('M j, Y')}}</p>
                                    <p class="text-white me-2 mb-2 fs-6">{{__('Returns: ').$currency->currency_symbol.currencyFormat(number_format($plan->amount + ($plan->amount * $plan->plan->interest / 100), 2)).' '.$currency->currency}} @ {{$plan->interest}}%</p>
                                    @endif
                                    @if($plan->type == 'circle')
                                    <div class="row mt-10">
                                        <div class="col-8">
                                            <p class="text-white me-2 mb-0 fs-6">{{__('Ends: ').$plan->circle->expiry_date->format('M j, Y')}}</p>
                                            <p class="text-white me-2 mb-2 fs-6">{{__('Returns: ').$currency->currency_symbol.currencyFormat(number_format($plan->amount + ($plan->amount * $plan->circle->interest / 100), 2)).' '.$currency->currency}} @ {{$plan->interest}}%</p>
                                        </div>
                                        <div class="col-4 text-end">
                                            @if($plan->type == 'circle')
                                            <span class="badge badge-info fs-6"><i class="fal fa-users"></i>
                                                {{$plan->circle->savings->count()}}
                                            </span>
                                            @endif
                                        </div>
                                        @if($first != null)
                                        <div class="col-md-6">
                                            <div class="d-flex flex-stack mb-6 bg-light p-3 rounded-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="ps-2">
                                                        <p class="fs-3 text-warning fw-bolder me-5 mb-0"><i class="fa fa-crown"></i></p>
                                                    </div>
                                                    <div class="symbol symbol-40px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="{{$first->user->business->name}}">
                                                        @if($first->user->avatar == null)
                                                        <span class="symbol-label bg-info text-inverse-info fw-boldest">{{substr(ucwords($first->user->business->name), 0, 1)}}</span>
                                                        @else
                                                        <div class="symbol-label" style="background-image:url({{url('/').'/storage/app/'.$first->user->avatar}})"></div>
                                                        @endif
                                                    </div>
                                                    <div class="ps-2">
                                                        <p class="fs-6 text-dark fw-bolder mb-0"><a class="text-dark" href="{{route('user.manage', ['client' => $first->user->id, 'type' => 'details'])}}">{{$first->user->business->name}}</a></p>
                                                        <p class="fs-6 text-info mb-0">{{$currency->currency_symbol.currencyFormat(number_format($first->amount, 2)).' '.$currency->currency}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    @endif
                                    @if(in_array($plan->type, ['emergency', 'duo']))
                                    <p class="text-white me-2 mb-2 fs-4 mt-10">
                                        {{__('Goal - ').$currency->currency_symbol.number_format($plan->goal, 2).' '.$currency->currency}}
                                    </p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="progress bg-light-primary w-100 h-5px mb-2">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: {{round($plan->transactionDeposit->sum('amount') * 100 /$plan->goal)}}%;"></div>
                                            </div>
                                            <p class="text-gray-400 me-2 mb-0 fs-6">{{__('Total savings between '.$from.' & '.$to.' - ').$currency->currency_symbol.currencyFormat(number_format($plan->transactionDeposit->sum('amount'), 2)).' '.$currency->currency}}</p>
                                            @if($plan->type == 'emergency')
                                            <p class="text-gray-400 me-2 mb-0 fs-6">{{__('Returns: ').$currency->currency_symbol.currencyFormat(number_format($plan->amount + ($plan->amount * $set->egi / 100), 2)).' '.$currency->currency}} @ {{$plan->interest}}%</p>
                                            <p class="text-gray-400 me-2 mb-0 fs-6">@if($set->egg) {{__('Interest will be returned if you reach your goal.')}} @endif</p>
                                            @elseif($plan->type == 'duo')
                                            <p class="text-gray-400 me-2 mb-0 fs-6">{{__('Returns: ').$currency->currency_symbol.currencyFormat(number_format($plan->amount + ($plan->amount * $set->dsi / 100), 2)).' '.$currency->currency}} @ {{$plan->interest}}%</p>
                                            <p class="text-gray-400 me-2 mb-0 fs-6">@if($set->dgg) {{__('Interest will be returned if you reach your goal.')}} @endif</p>
                                            @endif
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="d-flex justify-content-center flex-column me-3">
                                    <div class="col-md-12">
                                        <div class="input-group input-group-solid mb-5 rounded-4">
                                            <span class="input-group-text" id="basic-addon1"><i class="fal fa-search"></i></span>
                                            <input type="search" class="form-control form-control-solid text-dark" wire:model="search" placeholder="{{__('Transaction reference')}}" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-xl-8">
                                    @if($group->count() > 0)
                                    @foreach ($group as $date => $items)
                                    <div class="col-lg-12 col-md-12 mb-6">
                                        <h5 class="mb-6 text-info">{{($date == \Carbon\Carbon::today()->format('Y-m-d')) ? 'Today' : (($date == \Carbon\Carbon::yesterday()->format('Y-m-d')) ? 'Yesterday' : \Carbon\Carbon::create($date)->format('M j, Y'))}}</h5>
                                        @foreach ($items as $val)
                                        <div class="d-flex flex-stack cursor-pointer" id="kt_trx_{{$val->id}}_button">
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-40px symbol-circle me-5">
                                                    <div class="symbol-label fs-3 fw-bolder text-info bg-light-info">
                                                        @if($val->trx_type == 'debit')
                                                        <i class="fal fa-minus"></i>
                                                        @else
                                                        <i class="fal fa-plus"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="ps-1">
                                                    <p class="fs-6 text-dark text-hover-primary fw-bolder mb-0">{{$currency->currency_symbol.currencyFormat(number_format($val->amount, 2)).' '.$currency->currency}}</p>
                                                    <p class="fs-6 text-gray-800 text-hover-primary mb-0">{{ucwords(str_replace('_', ' ', $val->type))}}</p>
                                                </div>
                                            </div>
                                            <div class="ps-1 text-end">
                                                <p class="fs-6 text-dark mb-0">{{$val->created_at->toDayDateTimeString()}}</p>
                                                <p class="fs-6 text-gray-800 text-hover-primary mb-0">
                                                    @if($val->status == 'success')
                                                    <span class="badge badge-pill badge-success badge-sm">{{__('Success')}}</span>
                                                    @elseif($val->status == 'pending')
                                                    <span class="badge badge-pill badge-info badge-sm">{{__('Pending')}}</span>
                                                    @elseif($val->status == 'failed')
                                                    <span class="badge badge-pill badge-danger badge-sm">{{__('Failed')}}</span>
                                                    @elseif($val->status == 'cancelled')
                                                    <span class="badge badge-pill badge-danger badge-sm">{{__('Cancelled')}}</span>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        @if(!$loop->last)
                                        <hr class="bg-light-border">
                                        @endif
                                        @endforeach
                                    </div>
                                    @endforeach
                                    {{ $group->links() }}
                                    @else
                                    <div class="text-center mt-20">
                                        <img src="{{asset('asset/images/transactions.png')}}" style="height:auto; max-width:150px;" class="mb-6">
                                        <h3 class="text-dark">{{__('No Recent Transactions')}}</h3>
                                        <p class="text-dark">{{__('We couldn\'t find any transactions to this account')}}</p>
                                    </div>
                                    @endif
                                </div>

                                @include('partials.transfer.details', ['admincheck' => 0])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>