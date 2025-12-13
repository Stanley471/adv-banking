<div>
    <div class="toolbar" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <h1 class="text-dark fw-bolder my-1 fs-2">{{in_array($plan->type, ['regular', 'duo', 'emergency']) ? ucwords($plan->type).__(' Savings') :__(' Saving Circle') }}</h1>
                <ul class="breadcrumb fw-semibold fs-base my-1 mb-6">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('user.dashboard')}}" class="text-muted text-hover-primary">{{__('Dashboard')}} </a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('user.followed', ['type' => 'savings'])}}" class="text-muted text-hover-primary">{{__('Savings')}} </a>
                    </li>
                    <li class="breadcrumb-item text-dark">{{__('Plan')}}</li>
                </ul>
            </div>
            @if(!in_array($plan->type, ['regular', 'circle']))
            <div class="d-flex align-items-center flex-nowrap text-nowrap py-1 mb-10">
                <button id="kt_withdraw_money_button" class="btn btn-dark"><i class="fal fa-institution"></i> {{__('Withdraw')}}</button>
                <div wire:ignore.self id="kt_withdraw_money" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_withdraw_money_button" data-kt-drawer-close="#kt_withdraw_money_close" data-kt-drawer-width="{'md': '500px'}">
                    <div class="card w-100">
                        <div class="card-header pe-5 border-0">
                            <div class="card-title">
                                <div class="d-flex justify-content-center flex-column me-3">
                                    <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Withdraw')}}</div>
                                </div>
                            </div>
                            <div class="card-toolbar">
                                <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_withdraw_money_close">
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
                                <p class="text-dark fs-6">{{__('Withdraw money to account')}}</p>
                            </div>
                            <div class="pb-5 mt-10 position-relative zindex-1">
                                <form class="form w-100 mb-10" wire:submit.prevent="withdraw(Object.fromEntries(new FormData($event.target)))" method="post">
                                    <div class="fv-row mb-6">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text border-0 fs-2">{{$currency->currency_symbol}}</span>
                                            <input class="form-control form-control-lg form-control-solid fs-2 fw-bold @error('amount') is-invalid @enderror" type="text" step="any" wire:model.defer="withdraw_amount" autocomplete="transaction-amount" id="withdraw-amount" required placeholder="{{__('0.00')}}" />
                                            <span class="input-group-text border-0"><span class="fi fi-{{strtolower($currency->iso2)}} fis rounded-4 me-3 fs-1"></span></span>
                                        </div>
                                        @error('withdraw_amount')
                                        <span class="form-text text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="text-center mt-10">
                                        <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                                            <span wire:loading.remove wire:target="withdraw">{{__('Submit Request')}}</span>
                                            <span wire:loading wire:target="withdraw">{{__('Processing Request...')}}</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
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
                                            <p class="fs-6 text-dark fw-bolder mb-0">{{$leader->user->business->name}}</p>
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
                                        <div class="col-md-8">
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
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-end">
                                            @if($plan->expiry_date > \Carbon\Carbon::today() || $plan->type == 'circle')
                                            <button id="kt_top_money_button" class="btn btn-light-info"><i class="fal fa-plus"></i> {{__('Add Funds')}}</button>
                                            <div wire:ignore.self id="kt_top_money" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_top_money_button" data-kt-drawer-close="#kt_top_money_close" data-kt-drawer-width="{'md': '500px'}">
                                                <div class="card w-100">
                                                    <div class="card-header pe-5 border-0">
                                                        <div class="card-title">
                                                            <div class="d-flex justify-content-center flex-column me-3">
                                                                <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Savings Top up')}}</div>
                                                            </div>
                                                        </div>
                                                        <div class="card-toolbar">
                                                            <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_top_money_close">
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
                                                                    <i class="fal fa-users fa-2x text-info"></i>
                                                                </div>
                                                            </div>
                                                            <p class="text-dark fs-6">{{__('Add Funds')}}</p>
                                                        </div>
                                                        <div class="pb-5 mt-10 position-relative zindex-1">
                                                            <form class="form w-100 mb-10" wire:submit.prevent="add(Object.fromEntries(new FormData($event.target)))" method="post">
                                                                @error('added')
                                                                <div class="alert alert-danger">
                                                                    <div class="d-flex flex-column">
                                                                        <span>{{$message}}</span>
                                                                    </div>
                                                                </div>
                                                                @enderror
                                                                <div class="fv-row mb-6">
                                                                    <div class="input-group mb-3">
                                                                        <span class="input-group-text border-0 fs-2">{{$currency->currency_symbol}}</span>
                                                                        <input class="form-control form-control-lg form-control-solid fs-2 fw-bold @error('add_amount') is-invalid @enderror" type="text" step="any" wire:model.defer="add_amount" autocomplete="transaction-amount" id="add-amount" placeholder="{{__('0.00')}}" />
                                                                        <span class="input-group-text border-0"><span class="fi fi-{{strtolower($currency->iso2)}} fis rounded-4 me-3 fs-1"></span></span>
                                                                    </div>
                                                                    @error('add_amount')
                                                                    <span class="form-text text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="text-center mt-10">
                                                                    <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                                                                        <span wire:loading.remove wire:target="add">{{__('Submit Request')}}</span>
                                                                        <span wire:loading wire:target="add">{{__('Processing Request...')}}</span>
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                            @if($plan->type == 'circle' || $plan->type == 'emergency' || $plan->amount == 0 || $plan->amount == null)
                                            <!--begin::Menu-->
                                            <button type="button" class="btn btn-sm btn-icon btn-color-white btn-active-light-info me-n3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                                <!--begin::Svg Icon | path: icons/duotone/Layout/Layout-4-blocks-2.svg-->
                                                <span class="svg-icon svg-icon-3">
                                                    <i class="fal fa-grid-2"></i>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </button>
                                            <!--begin::Menu 3-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3 text-start" data-kt-menu="true" style="">
                                                <div class="menu-item px-3">
                                                    <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">{{__('Settings')}}</div>
                                                </div>
                                                @if($plan->type == 'circle' || $plan->type == 'emergency')
                                                <div class="menu-item px-3">
                                                    <a data-bs-toggle="modal" data-bs-target="#edit" href="" class="menu-link px-3">{{__('Edit Schedule')}}</a>
                                                </div>
                                                @endif
                                                @if($plan->amount == 0 || $plan->amount == null)
                                                <div class="menu-item px-3">
                                                    <a data-bs-toggle="modal" data-bs-target="#delete" href="" class="menu-link px-3">{{__('Delete')}}</a>
                                                </div>
                                                @endif
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div wire:ignore.self class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title">{{__('Delete')}}</h3>
                                                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                        <span class="svg-icon svg-icon-1">
                                                            <i class="fal fa-times"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete this plan?</p>
                                                    <div class="text-center">
                                                        <a wire:click="delete" class="btn btn-danger btn-block">{{__('Delete Plan')}}</span>
                                                        </a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div wire:ignore.self class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title">{{__('Edit Schedule')}}</h3>
                                                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                        <span class="svg-icon svg-icon-1">
                                                            <i class="fal fa-times"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <form wire:submit.prevent="edit" method="post">
                                                        @if($plan->type == 'circle')
                                                        @if($plan->circle->duration == 'monthly')
                                                        <div class="fv-row mb-6">
                                                            <label class="col-form-label">{{__('What day of the month works for you?')}}</label>
                                                            <select class="form-select form-select-lg form-select-solid" wire:model.defer="duration">
                                                                @for($i=1; $i<=28; $i++) <option value="{{($i < 10 ? 0 : '').$i}}">{{($i < 10 ? 0 : '').$i}}</option>
                                                                    @endfor
                                                            </select>
                                                            <span class="form-text">{{__('We will send a reminder to top up your plan on this day.')}}</span>
                                                            @error('duration')
                                                            <span class="form-text text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                        @else
                                                        <div class="fv-row mb-6">
                                                            <label class="col-form-label">{{__('What day of the week works for you?')}}</label>
                                                            <select class="form-select form-select-lg form-select-solid" wire:model.defer="duration">
                                                                <option value="monday">{{__('Monday')}}</option>
                                                                <option value="tuesday">{{__('Tuesday')}}</option>
                                                                <option value="wednesday">{{__('Wednesday')}}</option>
                                                                <option value="thursday">{{__('Thursday')}}</option>
                                                                <option value="friday">{{__('Friday')}}</option>
                                                                <option value="saturday">{{__('Saturday')}}</option>
                                                                <option value="sunday">{{__('Sunday')}}</option>
                                                            </select>
                                                            <span class="form-text">{{__('We will send a reminder to top up your plan on this day.')}}</span>
                                                            @error('duration')
                                                            <span class="form-text text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                        @endif
                                                        @elseif($plan->type == 'emergency')
                                                        <div class="fv-row mb-6">
                                                            <label class="col-form-label">{{__('What day of the month works for you?')}}</label>
                                                            <select class="form-select form-select-lg form-select-solid" wire:model.defer="duration">
                                                                @for($i=1; $i<=28; $i++) <option value="{{($i < 10 ? 0 : '').$i}}">{{($i < 10 ? 0 : '').$i}}</option>
                                                                    @endfor
                                                            </select>
                                                            <span class="form-text">{{__('We will send a reminder to top up your plan on this day.')}}</span>
                                                            @error('duration')
                                                            <span class="form-text text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                        @endif
                                                        <div class="text-right">
                                                            <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2" id="filepond-upload">
                                                                <span wire:loading.remove wire:target="edit">{{__('Submit')}}</span>
                                                                <span wire:loading wire:target="edit">{{__('Processing Request...')}}</span>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center align-self-center flex-wrap pt-6">
                                        <p class="fw-bold fs-5 text-start text-white pt-5">
                                            <span class="fi fi-{{strtolower($currency->iso2)}} mr-2 fis fs-1 rounded-4 text-white"></span> {{__('Current Savings')}}
                                            <span class="fw-bolder fs-2hx d-block mt-n1 text-white">
                                                <span id="main_balance">
                                                    @if($user->business->reveal_balance == 1){{$currency->currency_symbol.currencyFormat(number_format($plan->amount, 2)).' '.$currency->currency}} @else ************ @endif
                                                </span>
                                                <span class="ml-3 fs-3 cursor-pointer" wire:click="xBalance">
                                                    <i class="fal fa-eye-slash" id="hide_balance" @if($user->business->reveal_balance == 0) style="display:none;" @endif></i>
                                                    <i class="fal fa-eye" id="reveal_balance" @if($user->business->reveal_balance == 1) style="display:none;" @endif></i>
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
                                                        <p class="fs-6 text-dark fw-bolder mb-0">{{$first->user->business->name}}</p>
                                                        <p class="fs-6 text-info mb-0">{{$currency->currency_symbol.currencyFormat(number_format($first->amount, 2)).' '.$currency->currency}}</p>
                                                        @if($first->user->id != $user->id || $first->amount > $plan->amount)
                                                        <p class="fs-6 text-dark mb-0">{{__('You are below the top by ').$currency->currency_symbol.currencyFormat(number_format($first->amount - $plan->amount, 2)).' '.$currency->currency}}</p>
                                                        @endif
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
                                        <div class="col-md-6 text-end mt-6">
                                            @if($plan->type == 'duo')
                                            <p class="badge badge-light-info"><i class="fal fa-users"></i>
                                                @if($plan->user_id == $user->id)
                                                {{$plan->partner->business->name}}
                                                @else
                                                {{$plan->user->business->name}}
                                                @endif
                                            </p>
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
@push('scripts')
<script>
    "use strict"
    $('#hide_balance').on('click', function() {
        $('#main_balance').text('************');
        $('#reveal_balance').show();
        $('#hide_balance').hide();
    });
    $('#reveal_balance').on('click', function() {
        $('#main_balance').text("{{currencyFormat(number_format($plan->amount ,2)).' '.$currency->currency}}");
        $('#hide_balance').show();
        $('#reveal_balance').hide();
    });

    "use strict";

    document.addEventListener('livewire:load', function() {
        var addInput = $("#add-amount");
        addInput.on("input", function() {
            var num = $('#add-amount').val();
            var pre = parseFloat(convertToFloat(num));
            var formatted = formatNumber(addInput.val());
            $('#add-amount').val(formatted);
        });

        var withdrawInput = $("#withdraw-amount");
        withdrawInput.on("input", function() {
            var num = $('#withdraw-amount').val();
            var pre = parseFloat(convertToFloat(num));
            var formatted = formatNumber(withdrawInput.val());
            $('#withdraw-amount').val(formatted);
        });
    });
</script>
@endpush