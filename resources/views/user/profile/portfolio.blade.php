@extends('user.menu')

@section('content')
<div class="toolbar" id="kt_toolbar">
    <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
        <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
            <h1 class="text-dark fw-bolder my-1 fs-2">{{__('Portfolio')}}</h1>
            <ul class="breadcrumb fw-semibold fs-base my-1 mb-6">
                <li class="breadcrumb-item text-muted">
                    <a href="{{route('user.dashboard')}}" class="text-muted text-hover-primary">Dashboard </a>
                </li>
                <li class="breadcrumb-item text-dark">{{__('Portfolio')}}</li>
            </ul>
            <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-5 border-gray-300" id="tabs-icons-text" role="tablist">
                @if($set->project_investment)
                <li class="nav-item">
                    <a class="nav-link text-dark @if(route('user.followed', ['type' => 'project_investment'])==url()->current()) active @endif" id="tabs-icons-text-1-tab" href="{{route('user.followed', ['type' => 'project_investment'])}}" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="fal fa-rectangle-vertical-history"></i> {{__('Projects')}}</a>
                </li>
                @endif
                @if($set->mutual_fund)
                <li class="nav-item">
                    <a class="nav-link text-dark @if(route('user.followed', ['type' => 'mutual_fund'])==url()->current()) active @endif" id="tabs-icons-text-2-tab" href="{{route('user.followed', ['type' => 'mutual_fund'])}}" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="fal fa-globe"></i> {{__('Mutual Funds')}}</a>
                </li>
                @endif
                @if($set->loan)
                <li class="nav-item">
                    <a class="nav-link text-dark @if(route('user.followed', ['type' => 'loan'])==url()->current()) active @endif" id="tabs-icons-text-2-tab" href="{{route('user.followed', ['type' => 'loan'])}}" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="fal fa-landmark"></i> {{__('Loans')}}</a>
                </li>
                @endif
                @if($set->savings)
                <li class="nav-item">
                    <a class="nav-link text-dark @if(route('user.followed', ['type' => 'savings'])==url()->current()) active @endif" id="tabs-icons-text-2-tab" href="{{route('user.followed', ['type' => 'savings'])}}" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="fal fa-layer-group"></i> {{__('Savings')}}</a>
                </li>
                @endif
            </ul>
        </div>
    </div>
    <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
        <div class="container">
            @if(route('user.followed', ['type' => 'project_investment'])==url()->current() && $set->project_investment == 1)
            @forelse($user->followed(null, 'project') as $val)
            <div class="card mb-9 rounded-5 cursor-pointer" data-href="{{route('view.plan', ['plan' => $val->plan->id, 'type' => 'details'])}}">
                <div class="card-body pt-9 pb-0">
                    <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
                        <div class="symbol symbol-100px me-7 mb-4 symbol-circle">
                            <span class="symbol-label" style="background-image:url({{url('/').'/storage/app/'.$val->plan->image}});"></span>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <div class="d-flex flex-column">
                                    <p class="text-dark fs-1 fw-boldest me-3 mb-0">{{substr($val->plan->name, 0, 30)}}{{(Str::length($val->plan->name) > 30) ? '...' : ''}}</p>
                                    <p class="text-gray-800 fs-5 me-3 mb-3">{{$val->plan->location}}</p>
                                    <p>
                                        <span class="badge badge-light-info">{{$val->plan->category->name}}</span>
                                        <span class="badge badge-light-info">{{$val->plan->duration.' Months'}}</span>
                                        <span class="badge badge-light-info">{{($val->plan->status == 1) ? 'Published' : 'Disabled'}}</span>
                                        <span class="badge badge-light-info">{{($val->plan->insurance == 1) ? 'Insured' : 'No Insurance'}}</span>
                                    </p>
                                    @if($val->plan->followed->count())
                                    <div class="symbol-group symbol-hover mb-3">
                                        <!--begin::User-->
                                        @foreach($val->plan->followed->take(10) as $followers)
                                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="{{$followers->user->business->name}}">
                                            @if($followers->user->avatar == null)
                                            <span class="symbol-label bg-warning text-inverse-warning fw-boldest">{{substr(ucwords($followers->user->business->name), 0, 1)}}</span>
                                            @else
                                            <div class="symbol-label" style="background-image:url({{url('/').'/storage/app/'.$followers->user->avatar}})"></div>
                                            @endif
                                        </div>
                                        @endforeach
                                        @if($val->plan->followed->count() > 10)
                                        <div class="symbol symbol-35px symbol-circle">
                                            <span class="symbol-label bg-warning text-dark fs-8 fw-boldest">+{{$val->plan->followed->count() - 10}}</span>
                                        </div>
                                        @endif
                                    </div>
                                    @endif

                                </div>
                                <div class="d-flex mb-4">
                                    @if($user->followedPlan($val->plan->id))
                                    <span class="badge badge-secondary me-5 mt-3">{{__('Followed')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex flex-wrap justify-content-start">
                                <div class="border border-gray-600 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="fs-6 fw-boldest text-gray-700">{{\Carbon\Carbon::create($val->plan->start_date)->format('M j, Y')}} - {{\Carbon\Carbon::create($val->plan->close_date)->format('M j, Y')}}</div>
                                    <div class="fw-bold text-gray-400">Investment Closure</div>
                                </div>
                                <div class="border border-gray-600 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="fs-6 fw-boldest text-gray-700">{{\Carbon\Carbon::create($val->plan->expiring_date)->format('M j, Y')}}</div>
                                    <div class="fw-bold text-gray-400">Matures</div>
                                </div>
                                <div class="border border-gray-600 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="fs-6 fw-boldest text-gray-700">{{number_format($val->plan->original - $val->plan->units).'/'.number_format($val->plan->original)}} units</div>
                                    <div class="fw-bold text-gray-400">{{$currency->currency_symbol.currencyFormat(number_format($val->plan->price, 2))}} per unit</div>
                                </div>
                                <div class="border border-gray-600 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="fs-6 fw-boldest text-gray-700">{{$val->plan->interest}}%</div>
                                    <div class="fw-bold text-gray-400">Interest</div>
                                </div>
                                <div class="border border-gray-600 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="fs-6 fw-boldest text-gray-700">
                                        @if($val->plan->fee_type == "both")
                                        {{$val->plan->percent_pc}}% + {{$val->plan->fiat_pc.' '.$currency->currency}}
                                        @elseif($val->plan->fee_type == "fiat")
                                        {{$val->plan->fiat_pc.' '.$currency->currency}}
                                        @elseif($val->plan->fee_type == "percent")
                                        {{$val->plan->percent_pc}}%
                                        @elseif($val->plan->fee_type == "max")
                                        > {{$val->plan->fiat_pc.' '.$currency->currency}} - {{$val->plan->percent_pc}}%
                                        @elseif($val->plan->fee_type == "min")
                                        < {{$val->plan->fiat_pc.' '.$currency->currency}} - {{$val->plan->percent_pc}}% @endif </div>
                                            <div class="fw-bold text-gray-400">Investment Fee</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center mt-20">
                    <img src="{{asset('asset/images/beneficiary.png')}}" style="height:auto; max-width:250px;" class="mb-6">
                    <h3 class="text-dark">{{__('No Investment Plan Found')}}</h3>
                    <p class="text-dark">{{__('We couldn\'t find any investment plan ')}}</p>
                </div>
                @endforelse
            </div>
            @elseif(route('user.followed', ['type' => 'mutual_fund'])==url()->current() && $set->mutual_fund == 1)
            <div class="row">
                @forelse($user->followed(null, 'mutual') as $val)
                <div class="col-md-6 mb-6">
                    <div class="card cursor-pointer h-100 rounded-5" data-href="{{route('view.plan', ['plan' => $val->plan->id, 'type' => 'details'])}}">
                        <div class="card-body pt-9 pb-0">
                            <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
                                <div class="symbol symbol-100px me-7 mb-4 symbol-circle">
                                    <span class="symbol-label" style="background-image:url({{url('/').'/storage/app/'.$val->plan->image}});"></span>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                        <div class="d-flex flex-column">
                                            <p class="text-dark fs-1 fw-boldest me-3 mb-0">{{substr($val->plan->name, 0, 30)}}{{(Str::length($val->plan->name) > 30) ? '...' : ''}}</p>
                                            <p class="text-gray-800">{{$val->plan->trustee}}</p>
                                            <p>
                                                @if($val->plan->recommendation == 1)<span class="badge badge-light-info">Recommended</span>@endif
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
                                    @if($val->plan->first()->amount == $val->plan->last()->amount)
                                    <p class="fs-3 fw-bolder text-success">--</p>
                                    @elseif($val->plan->first()->amount > $val->plan->last()->amount)
                                    <p class="fs-3 fw-bolder text-success">+{{$val->plan->YTD('first')}}%</p>
                                    @else
                                    <p class="fs-3 fw-bolder text-danger">-{{$val->plan->YTD('last')}}%</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center mt-20">
                    <img src="{{asset('asset/images/beneficiary.png')}}" style="height:auto; max-width:250px;" class="mb-6">
                    <h3 class="text-dark">{{__('No Investment Plan Found')}}</h3>
                    <p class="text-dark">{{__('We couldn\'t find any investment plan ')}}</p>
                </div>
                @endforelse
            </div>
            @elseif(route('user.followed', ['type' => 'loan'])==url()->current() && $set->loan == 1)
            <div class="row">
                @forelse($user->loanApplications(null, null) as $val)
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
                                            <p class="fs-6 fw-bolder text-dark mb-0">{{$user->business->line_1.', '.$user->business->myState->name.', '.$user->business->city.', '.$user->business->postal_code}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @livewire('loan.installment', ['installments' => $val->installments, 'user' => $user, 'settings' => $set, 'index' => $loop->index])
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center mt-20">
                    <img src="{{asset('asset/images/transactions.png')}}" style="height:auto; max-width:250px;" class="mb-6">
                    <h3 class="text-dark">{{__('No Loan Application Found')}}</h3>
                    <p class="text-dark">{{__('We couldn\'t find any loan application ')}}</p>
                </div>
                @endforelse
            </div>
            @elseif(route('user.followed', ['type' => 'savings'])==url()->current() && $set->savings == 1)
            <div class="row">
                @if(getSavingCircles()->count() || $user->savings('all', 'circle')->count())
                <div class="col-md-12 mb-6">
                    <div class="text-start bg-white shadow-xs rounded-5 p-7 h-100 cursor-pointer" id="kt_circle_button">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-50px mt-1 mb-3">
                            <span class="symbol-label bg-light-info rounded-4">
                                <i class="fal fa-users fa-2x text-info"></i>
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <p class="text-dark fw-boldest fs-4 mt-4 d-block">{{__('Saving Circles')}}</p>
                        <p class="fs-1 fw-bolder text-info mb-0">{{$currency->currency_symbol.currencyFormat(number_format($user->savings('all', 'circle')->sum('amount'), 2)).' '.$currency->currency}}</p>
                        <p class="fs-6 text-gray-800 mb-0">{{__('Active Plans: ').$user->savings('all', 'circle')->count()}}</p>
                        <p class="fs-6 text-gray-800 mb-0">{{__('Total Saved: ').$currency->currency_symbol.currencyFormat(number_format($user->totalSavings('circle')->sum('amount'), 2)).' '.$currency->currency}}</p>
                        <p class="fs-6 text-gray-800 mb-0">{{__('Returns: ').$currency->currency_symbol.currencyFormat(number_format($user->totalSavingsReturn('circle')->sum('amount'), 2)).' '.$currency->currency}}</p>
                    </div>
                </div>
                <div id="kt_circle_money" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_circle_button" data-kt-drawer-close="#kt_circle_close" data-kt-drawer-width="{'md': '500px'}">
                    <div class="card w-100">
                        <div class="card-header pe-5 border-0">
                            <div class="card-title">
                                <div class="d-flex justify-content-center flex-column me-3">
                                    <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Saving Circles')}}</div>
                                </div>
                            </div>
                            <div class="card-toolbar">
                                <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_duo_close">
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
                            </div>
                            <div class="pb-5 mt-10 position-relative zindex-1">
                                @forelse($user->savings('all', 'circle')->get() as $circle)
                                <div class="d-flex flex-stack mb-6 bg-light p-3 rounded-3">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40px symbol-circle" data-bs-toggle="tooltip">
                                            <div class="symbol-label" style="background-image:url({{url('/').'/storage/app/'.$circle->circle->image}})"></div>
                                        </div>
                                        <div class="ps-2">
                                            <p class="fs-6 text-dark fw-bolder mb-0">{{$circle->circle->name}}</p>
                                            <p class="fs-6 text-info mb-0">{{$currency->currency_symbol.currencyFormat(number_format($circle->amount, 2)).' '.$currency->currency}}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <a href="{{route('save.manage', ['plan' => $circle->id])}}" class="btn btn-sm btn-light-info me-3"><i class="fal fa-check-circle"></i> {{__('Manage')}}</a>
                                    </div>
                                </div>
                                @empty
                                <p class="text-gray-600 text-center">{{__('No Active Plans')}}</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($set->rss || $user->savings('all', 'regular')->count())
                <div class="col-md-12 mb-6">
                    <div class="text-start bg-white shadow-xs rounded-5 p-7 h-100 cursor-pointer" id="kt_regular_button">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-50px mt-1 mb-3">
                            <span class="symbol-label bg-light-info rounded-4">
                                <i class="fal fa-sync fa-2x text-info"></i>
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <p class="text-dark fw-boldest fs-4 mt-4 d-block">{{__('Regular Savings')}}</p>
                        <p class="fs-1 fw-bolder text-info mb-0">{{$currency->currency_symbol.currencyFormat(number_format($user->savings('active', 'regular')->sum('amount'), 2)).' '.$currency->currency}}</p>
                        <p class="fs-6 text-gray-800 mb-0">{{__('Active plans: ').$user->savings('active', 'regular')->count()}}</p>
                        <p class="fs-6 text-gray-800 mb-0">{{__('Total Saved: ').$currency->currency_symbol.currencyFormat(number_format($user->totalSavings('regular')->sum('amount'), 2)).' '.$currency->currency}}</p>
                        <p class="fs-6 text-gray-800 mb-0">{{__('Returns: ').$currency->currency_symbol.currencyFormat(number_format($user->totalSavingsReturn('regular')->sum('amount'), 2)).' '.$currency->currency}}</p>
                    </div>
                </div>
                <div id="kt_regular_money" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_regular_button" data-kt-drawer-close="#kt_regular_close" data-kt-drawer-width="{'md': '500px'}">
                    <div class="card w-100">
                        <div class="card-header pe-5 border-0">
                            <div class="card-title">
                                <div class="d-flex justify-content-center flex-column me-3">
                                    <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Regular Savings')}}</div>
                                </div>
                            </div>
                            <div class="card-toolbar">
                                <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_regular_close">
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
                                        <i class="fal fa-sync fa-2x text-info"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="pb-5 mt-10 position-relative zindex-1">
                                @if($user->savings('active', 'regular')->count())
                                <p class="text-gray-600">{{__('Active Plans')}}</p>
                                @endif
                                @forelse($user->savings('active', 'regular')->get() as $regular)
                                <div class="d-flex flex-stack mb-6 bg-light p-3 rounded-3">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40px symbol-circle" data-bs-toggle="tooltip">
                                            <span class="symbol-label bg-info text-inverse-info fw-boldest"><i class="fal fa-layer-group"></i></span>
                                        </div>
                                        <div class="ps-2">
                                            <p class="fs-6 text-dark fw-bolder mb-0">{{$regular->name}}</p>
                                            <p class="fs-6 text-info mb-0">{{$currency->currency_symbol.currencyFormat(number_format($regular->amount, 2)).' '.$currency->currency}}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <a href="{{route('save.manage', ['plan' => $regular->id])}}" class="btn btn-sm btn-light-info me-3"><i class="fal fa-check-circle"></i> {{__('Manage')}}</a>
                                    </div>
                                </div>
                                @empty
                                <p class="text-gray-600 text-center">{{__('No Active Plans')}}</p>
                                @endforelse
                            </div>
                            <div class="pb-5 mt-10 position-relative zindex-1">
                                @if($user->savings('expired', 'regular')->count())
                                <p class="text-gray-600">{{__('Expired Plans')}}</p>
                                @endif
                                @foreach($user->savings('expired', 'regular')->get() as $regular)
                                <div class="d-flex flex-stack mb-6 bg-light p-3 rounded-3">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40px symbol-circle" data-bs-toggle="tooltip">
                                            <span class="symbol-label bg-info text-inverse-info fw-boldest"><i class="fal fa-layer-group"></i></span>
                                        </div>
                                        <div class="ps-2">
                                            <p class="fs-6 text-dark fw-bolder mb-0">{{$regular->name}}</p>
                                            <p class="fs-6 text-info mb-0">{{$currency->currency_symbol.currencyFormat(number_format($regular->amount, 2)).' '.$currency->currency}}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <a href="{{route('save.manage', ['plan' => $regular->id])}}" class="btn btn-sm btn-light-info me-3"><i class="fal fa-check-circle"></i> {{__('Manage')}}</a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($set->ess || $user->savings('all', 'emergency')->count())
                <div class="col-md-12 mb-6">
                    <div class="text-start bg-white shadow-xs rounded-5 p-7 h-100 cursor-pointer" id="kt_emergency_button">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-50px mt-1 mb-3">
                            <span class="symbol-label bg-light-info rounded-4">
                                <i class="fal fa-bell-on fa-2x text-info"></i>
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <p class="text-dark fw-boldest fs-4 mt-4 d-block">{{__('Emergency Savings')}}</p>
                        <p class="fs-1 fw-bolder text-info mb-0">{{$currency->currency_symbol.currencyFormat(number_format($user->savings('active', 'emergency')->sum('amount'), 2)).' '.$currency->currency}}</p>
                        <p class="fs-6 text-gray-800 mb-0">{{__('Active plans: ').$user->savings('all', 'emergency')->count()}}</p>
                        <p class="fs-6 text-gray-800 mb-0">{{__('Total Saved: ').$currency->currency_symbol.currencyFormat(number_format($user->totalSavings('emergency')->sum('amount'), 2)).' '.$currency->currency}}</p>
                        <p class="fs-6 text-gray-800 mb-0">{{__('Returns: ').$currency->currency_symbol.currencyFormat(number_format($user->totalSavingsReturn('emergency')->sum('amount'), 2)).' '.$currency->currency}}</p>
                    </div>
                </div>
                <div id="kt_emergency_money" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_emergency_button" data-kt-drawer-close="#kt_emergency_close" data-kt-drawer-width="{'md': '500px'}">
                    <div class="card w-100">
                        <div class="card-header pe-5 border-0">
                            <div class="card-title">
                                <div class="d-flex justify-content-center flex-column me-3">
                                    <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Emergency Savings')}}</div>
                                </div>
                            </div>
                            <div class="card-toolbar">
                                <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_emergency_close">
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
                                        <i class="fal fa-bell-on fa-2x text-info"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="pb-5 mt-10 position-relative zindex-1">
                                @forelse($user->savings('active', 'emergency')->get() as $emergency)
                                <div class="d-flex flex-stack mb-6 bg-light p-3 rounded-3">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40px symbol-circle" data-bs-toggle="tooltip">
                                            <span class="symbol-label bg-info text-inverse-info fw-boldest"><i class="fal fa-layer-group"></i></span>
                                        </div>
                                        <div class="ps-2">
                                            <p class="fs-6 text-dark fw-bolder mb-0">{{$emergency->name}}</p>
                                            <p class="fs-6 text-info mb-0">{{$currency->currency_symbol.currencyFormat(number_format($emergency->amount, 2)).' '.$currency->currency}}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <a href="{{route('save.manage', ['plan' => $emergency->id])}}" class="btn btn-sm btn-light-info me-3"><i class="fal fa-check-circle"></i> {{__('Manage')}}</a>
                                    </div>
                                </div>
                                @empty
                                <p class="text-gray-600 text-center">{{__('No Active Plans')}}</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($set->dss || $user->savings('all', 'duo')->count())
                <div class="col-md-12 mb-6">
                    <div class="text-start bg-white shadow-xs rounded-5 p-7 h-100 cursor-pointer" id="kt_duo_button">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-50px mt-1 mb-3">
                            <span class="symbol-label bg-light-info rounded-4">
                                <i class="fal fa-heart-circle-check fa-2x text-info"></i>
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <p class="text-dark fw-boldest fs-4 mt-4 d-block">{{__('Duo Savings')}}</p>
                        <p class="fs-1 fw-bolder text-info mb-0">{{$currency->currency_symbol.currencyFormat(number_format($user->savings('all', 'duo')->sum('amount'), 2)).' '.$currency->currency}}</p>
                        <p class="fs-6 text-gray-800 mb-0">{{__('Active Plans: ').$user->savings('all', 'duo')->count()}}</p>
                        @livewire('savings.invitations', ['user' => $user, 'settings' => $set])
                    </div>
                </div>
                <div id="kt_duo_money" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_duo_button" data-kt-drawer-close="#kt_duo_close" data-kt-drawer-width="{'md': '500px'}">
                    <div class="card w-100">
                        <div class="card-header pe-5 border-0">
                            <div class="card-title">
                                <div class="d-flex justify-content-center flex-column me-3">
                                    <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Duo Savings')}}</div>
                                </div>
                            </div>
                            <div class="card-toolbar">
                                <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_duo_close">
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
                                        <i class="fal fa-heart-circle-check fa-2x text-info"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="pb-5 mt-10 position-relative zindex-1">
                                @forelse($user->savings('all', 'duo')->get() as $duo)
                                <div class="d-flex flex-stack mb-6 bg-light p-3 rounded-3">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40px symbol-circle" data-bs-toggle="tooltip">
                                            @if($duo->user_id == $user->id)
                                            @if($duo->partner->avatar == null)
                                            <span class="symbol-label bg-info text-inverse-info fw-boldest">{{substr(ucwords($duo->partner->business->name), 0, 1)}}</span>
                                            @else
                                            <div class="symbol-label" style="background-image:url({{url('/').'/storage/app/'.$duo->partner->avatar}})"></div>
                                            @endif
                                            @else
                                            @if($duo->user->avatar == null)
                                            <span class="symbol-label bg-info text-inverse-info fw-boldest">{{substr(ucwords($duo->user->business->name), 0, 1)}}</span>
                                            @else
                                            <div class="symbol-label" style="background-image:url({{url('/').'/storage/app/'.$duo->user->avatar}})"></div>
                                            @endif
                                            @endif
                                        </div>
                                        <div class="ps-2">
                                            <p class="fs-6 text-dark fw-bolder mb-0">{{$duo->name}}</p>
                                            <p class="fs-6 text-info mb-0">{{$currency->currency_symbol.currencyFormat(number_format($duo->amount, 2)).' '.$currency->currency}}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <a href="{{route('save.manage', ['plan' => $duo->id])}}" class="btn btn-sm btn-light-info me-3"><i class="fal fa-check-circle"></i> {{__('Manage')}}</a>
                                    </div>
                                </div>
                                @empty
                                <p class="text-gray-600 text-center">{{__('No Active Plans')}}</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            @endif
        </div>
    </div>
</div>
@stop