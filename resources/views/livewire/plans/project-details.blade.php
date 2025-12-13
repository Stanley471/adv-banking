<div>
    <div class="toolbar pb-0" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <h1 class="text-dark fw-bolder my-1 fs-2">{{__('Invest')}}</h1>
                <ul class="breadcrumb fw-semibold fs-base my-1 mb-6">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('user.dashboard')}}" class="text-muted text-hover-primary">{{__('Dashboard')}}</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('user.plan')}}" class="text-muted text-hover-primary">{{__('Invest')}}</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('user.project', ['type' => 'active'])}}" class="text-muted text-hover-primary">{{__('Plans')}}</a>
                    </li>
                    <li class="breadcrumb-item text-dark">{{ucwords($plan->name)}}</li>
                </ul>
            </div>
            <div class="d-flex align-items-center flex-nowrap text-nowrap py-1">
                @if($plan->units>0 && $plan->start_date <= Carbon\Carbon::now()->toDateTimeLocalString() && $plan->expiring_date > Carbon\Carbon::now()->toDateTimeLocalString())
                    @if($plan->close_date >= Carbon\Carbon::now()->toDateTimeLocalString())
                    <button id="kt_send_money_button" class="btn btn-dark me-4"><i class="fal fa-fire"></i> {{__('Invest Now')}}</button>
                    <div wire:ignore.self id="kt_send_money" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_send_money_button" data-kt-drawer-close="#kt_send_money_close" data-kt-drawer-width="{'md': '500px'}">
                        <div class="card w-100">
                            <div class="card-header pe-5 border-0">
                                <div class="card-title">
                                    <div class="d-flex justify-content-center flex-column me-3">
                                        <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Purchase Units')}}</div>
                                    </div>
                                </div>
                                <div class="card-toolbar">
                                    <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_send_money_close">
                                        <span class="svg-icon svg-icon-2">
                                            <i class="fal fa-times"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body text-wrap">
                                <div class="btn-wrapper text-center mb-3">
                                    <div class="symbol symbol-150px symbol-circle me-5 mb-10">
                                        <div class="symbol-label fs-1 text-dark" style="background-image:url({{url('/').'/storage/app/'.$plan->image}});"></div>
                                    </div>
                                    <p class="text-dark fs-5 fw-bold">{{$plan->name}}</p>
                                </div>
                                <div class="card bg-info">
                                    <div class="d-flex align-items-center p-3">
                                        <div class="symbol symbol-40px me-4">
                                            <div class="symbol-label fs-6 bg-white rounded-5">
                                                <i class="fal fa-gift text-dark"></i>
                                            </div>
                                        </div>
                                        <div class="ps-1">
                                            <p class="fs-6 text-white fw-bolder mb-0">{{__('You have ').$user->getFirstBalance()->waivers.__(' Investment Waivers')}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="pb-5 mt-10 position-relative zindex-1">
                                    <form class="form w-100 mb-10" wire:submit.prevent="purchase" method="post">
                                        @error('added')
                                        <div class="alert alert-danger">
                                            <div class="d-flex flex-column">
                                                <span>{{$message}}</span>
                                            </div>
                                        </div>
                                        @enderror
                                        <div class="fv-row mb-6">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text border-0 fs-2">#</span>
                                                <input class="form-control form-control-lg form-control-solid fs-2 fw-bold @error('amount') is-invalid @enderror" type="text" wire:model.defer="amount" autocomplete="transaction-amount" id="unit-amount" min="1" max="{{$plan->original}}" value="{{old('amount')}}" required placeholder="{{__('Number of units')}}" />
                                            </div>
                                            @error('amount')
                                            <span class="form-text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="bg-light-primary px-6 py-5 mb-10 rounded" wire:ignore>
                                            <p class="text-dark fw-bold fs-6 mb-0">{{__('Balance after transaction')}}: <span id="balanceAfter">{{$currency->currency_symbol.currencyFormat(number_format($user->getFirstBalance()->amount, 2)).' '.$currency->currency}}</span></p>
                                            <p class="text-dark fw-bold fs-6 mb-0">{{__('Amount')}}: <span id="amount">{{$currency->currency_symbol.'0.00 '.$currency->currency}}</span></p>
                                            <p class="text-dark fw-bold fs-6 mb-0">{{__('Fee')}}: <span id="fee">{{$currency->currency_symbol.'0.00 '.$currency->currency}}</span></p>
                                        </div>
                                        <div class="form-check form-check-custom form-check-solid mb-6">
                                            <input class="form-check-input" type="checkbox" id="flexCheckDefault" wire:model.defer="terms" required />
                                            <label class="form-check-label" for="flexCheckDefault">{{__('I agree to our')}} <a target="_blank" href="{{route('terms')}}">{{__('terms & conditions')}}</a></label>
                                        </div>
                                        @error('terms')
                                        <span class="form-text text-danger">{{$message}}</span>
                                        @enderror
                                        <div class="text-center mt-10">
                                            <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                                                <span wire:loading.remove wire:target="purchase">{{__('Purchase Units')}}</span>
                                                <span wire:loading wire:target="purchase">{{__('Processing Request...')}}</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endif
            </div>
        </div>
    </div>
    <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
        <div class="container">
            <div class="card mb-9 rounded-5">
                <div class="card-body pt-9 pb-0">
                    <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
                        <div class="symbol symbol-150px me-7 mb-4 symbol-circle">
                            <span class="symbol-label" style="background-image:url({{url('/').'/storage/app/'.$plan->image}});"></span>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <div class="d-flex flex-column">
                                    <p class="text-dark text-hover-primary fs-1 fw-boldest me-3 mb-0">{{$plan->name}}</p>
                                    <p class="text-gray-800 text-hover-primary fs-5 me-3 mb-3">{{$plan->location}}</p>
                                    <p>
                                        <span class="badge badge-light-info">{{$plan->category->name}}</span>
                                        <span class="badge badge-light-info">{{$plan->duration.' Months'}}</span>
                                        <span class="badge badge-light-info">{{($plan->status == 1) ? 'Published' : 'Disabled'}}</span>
                                        <span class="badge badge-light-info">{{($plan->insurance == 1) ? 'Insured' : 'No Insurance'}}</span>
                                    </p>
                                    @if($plan->followed->count())
                                    <div class="symbol-group symbol-hover mb-3">
                                        <!--begin::User-->
                                        @foreach($plan->followed->take(10) as $followers)
                                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="{{$followers->user->business->name}}">
                                            @if($followers->user->avatar == null)
                                            <span class="symbol-label bg-info text-inverse-warning fw-boldest">{{substr(ucwords($followers->user->business->name), 0, 1)}}</span>
                                            @else
                                            <div class="symbol-label" style="background-image:url({{url('/').'/storage/app/'.$followers->user->avatar}})"></div>
                                            @endif
                                        </div>
                                        @endforeach
                                        @if($plan->followed->count() > 10)
                                        <div class="symbol symbol-35px symbol-circle">
                                            <span class="symbol-label bg-info text-white fs-8 fw-boldest">+{{$plan->followed->count() - 10}}</span>
                                        </div>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                                <div class="d-flex mb-4">
                                    @if($user->followedPlan($plan->id))
                                    <span class="badge badge-secondary me-5 mt-3">{{__('Followed')}}</span>
                                    @else
                                    <a wire:click="follow" data-bs-original-title="Follow Plan" title="Follow Plan" class="cursor-pointer text-dark me-5"><i class="fa-thin fa-heart fa-2x"></i></a>
                                    @endif
                                    <a data-bs-toggle="modal" data-bs-target="#share" data-bs-original-title="Share Plan" title="Share Plan" class="cursor-pointer text-dark"><i class="fa-thin fa-arrow-up-from-bracket fa-2x"></i></a>
                                    <div class="modal fade" id="share" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header border-0">
                                                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                        <span class="svg-icon svg-icon-1">
                                                            <i class="fal fa-times"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="btn-wrapper text-center mb-3">
                                                        <div class="symbol symbol-200px symbol-circle me-5 mb-10">
                                                            <div class="symbol-label fs-1 text-dark" style="background-image:url({{url('/').'/storage/app/'.$plan->image}});"></div>
                                                        </div>
                                                        <p class="text-dark fs-1 fw-bolder mb-3">{{$plan->name}}</p>
                                                        <div class="d-flex">
                                                            <input id="kt_referral_link_input" type="text" class="form-control form-control-solid me-3 flex-grow-1" name="search" value="{{route('view.plan', ['plan' => $plan->id, 'type' => 'details'])}}">
                                                            <button class="btn btn-light fw-boldest flex-shrink-0 castro-copy text-dark" data-clipboard-text="{{route('view.plan', ['plan' => $plan->id, 'type' => 'details'])}}">Copy Link</button>
                                                        </div>
                                                        <div class="row mt-6 mb-6">
                                                            <div class="col-md-12">
                                                                <a href="https://www.facebook.com/sharer/sharer.php?u={{route('view.plan', ['plan' => $plan->id, 'type' => 'details'])}}" class="btn btn-icon btn-secondary mx-2" target="_blank">
                                                                    <i class="fab fa-facebook"></i>
                                                                </a>
                                                                <a href="https://twitter.com/intent/tweet?text={{route('view.plan', ['plan' => $plan->id, 'type' => 'details'])}}" class="btn btn-icon btn-secondary mx-2" target="_blank">
                                                                    <i class="fab fa-twitter"></i>
                                                                </a>
                                                                <a href="https://wa.me/?text={{route('view.plan', ['plan' => $plan->id, 'type' => 'details'])}}" class="btn btn-icon btn-secondary mx-2" target="_blank">
                                                                    <i class="fab fa-whatsapp"></i>
                                                                </a>
                                                                <a href="mailto:body={{route('view.plan', ['plan' => $plan->id, 'type' => 'details'])}}" class="btn btn-icon btn-secondary mx-2" target="_blank">
                                                                    <i class="fal fa-envelope"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap justify-content-start">
                                <div class="border border-gray-600 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="fs-6 fw-boldest text-gray-700">{{\Carbon\Carbon::create($plan->start_date)->format('M j, Y')}} - {{\Carbon\Carbon::create($plan->close_date)->format('M j, Y')}}</div>
                                    <div class="fw-bold text-gray-400">Investment Closure</div>
                                </div>
                                <div class="border border-gray-600 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="fs-6 fw-boldest text-gray-700">{{\Carbon\Carbon::create($plan->expiring_date)->format('M j, Y')}}</div>
                                    <div class="fw-bold text-gray-400">Matures</div>
                                </div>
                                <div class="border border-gray-600 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="fs-6 fw-boldest text-gray-700">{{number_format($plan->original - $plan->units).'/'.number_format($plan->original)}} units</div>
                                    <div class="fw-bold text-gray-400">{{$currency->currency_symbol.$plan->price}} per unit</div>
                                </div>
                                <div class="border border-gray-600 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="fs-6 fw-boldest text-gray-700">{{$plan->interest}}%</div>
                                    <div class="fw-bold text-gray-400">Interest</div>
                                </div>
                                <div class="border border-gray-600 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="fs-6 fw-boldest text-gray-700">
                                        @if($plan->fee_type == "both")
                                        {{$plan->percent_pc}}% + {{$plan->fiat_pc.' '.$currency->currency}}
                                        @elseif($plan->fee_type == "fiat")
                                        {{$plan->fiat_pc.' '.$currency->currency}}
                                        @elseif($plan->fee_type == "percent")
                                        {{$plan->percent_pc}}%
                                        @elseif($plan->fee_type == "max")
                                        > {{$plan->fiat_pc.' '.$currency->currency}} - {{$plan->percent_pc}}%
                                        @elseif($plan->fee_type == "min")
                                        < {{$plan->fiat_pc.' '.$currency->currency}} - {{$plan->percent_pc}}% @endif </div>
                                            <div class="fw-bold text-gray-400">Mtg Fee</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="separator"></div>
                        <div class="d-flex overflow-auto">
                            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold flex-wrap h-55px">
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary me-6 @if($type == 'details') active @endif" href="{{route('view.plan', ['plan' => $plan->id, 'type' => 'details'])}}">{{__('Description')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary me-6 @if($type == 'updates') active @endif" href="{{route('view.plan', ['plan' => $plan->id, 'type' => 'updates'])}}">{{__('Investment updates')}} ({{$plan->updates->count()}})</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary me-6 @if($type == 'followers') active @endif" href="{{route('view.plan', ['plan' => $plan->id, 'type' => 'followers'])}}">{{__('Followers & Investors')}} ({{$plan->followed->count()}})</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary me-6 @if($type == 'portfolio') active @endif" href="{{route('view.plan', ['plan' => $plan->id, 'type' => 'portfolio'])}}">{{__('My Portfolio')}} ({{$user->planUnits($plan->id)->count()}})</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                @if($type == 'details')
                <div class="card mb-10 rounded-5">
                    <div class="card-body">
                        <p class="preserveLines">{{$plan->details}}</p>
                    </div>
                </div>
                @endif

                @if($type == 'updates')
                @forelse($plan->updates as $cat)
                <div class="card mb-9 rounded-5">
                    <div class="card-body pt-9 pb-0">
                        <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                    <div class="d-flex flex-column">
                                        <p class="text-dark text-hover-primary fs-1 fw-boldest me-3 mb-0">{{$cat->title}}</p>
                                        <p class="text-gray-800 text-hover-primary fs-5 me-3 mb-3">{{$cat->stage}}</p>
                                        <p>
                                            <span class="badge badge-light-info">{{$cat->weeks.' weeks'}}</span>
                                        </p>
                                        <p class="text-gray-800 preserveLines">{{$cat->report}}</p>
                                        @if($cat->images->count())
                                        <div class="symbol-group symbol-hover mb-3">
                                            <!--begin::User-->
                                            @foreach($cat->images->take(10) as $images)
                                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="modal" data-bs-target="#updateimage{{$images->id}}" data-bs-toggle="tooltip" title="">
                                                <div class="symbol-label" style="background-image:url({{url('/').'/storage/app/'.$images->image}})"></div>
                                            </div>
                                            <div class="modal fade" id="updateimage{{$images->id}}" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-0">
                                                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                                <span class="svg-icon svg-icon-1">
                                                                    <i class="fal fa-times"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="text-center">
                                                                <img src="{{url('/').'/storage/app/'.$images->image}}" style="max-width:100%; height:auto;" class="rounded-5">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center mt-20">
                    <img src="{{asset('asset/images/beneficiary.png')}}" style="height:auto; max-width:250px;" class="mb-6">
                    <h3 class="text-dark">{{__('No Investment Update Found')}}</h3>
                    <p class="text-dark">{{__('We couldn\'t find any investment update')}}</p>
                </div>
                @endforelse
                @endif

                @if($type == 'followers')
                @livewire('plans.followers', ['plan' => $plan, 'type' => 'project'])
                @endif

                @if($type == 'portfolio')
                <div class="row">
                    <div class="col-md-12">
                        @if($user->planUnitsProject($plan->id)->count())
                        @foreach($user->planUnitsProject($plan->id) as $buy)
                        <livewire:plans.units :buy=$buy :user=$user :wire:key="'kt_category_'. $buy->id">
                            @if(!$loop->last)
                            <hr class="bg-light-border">
                            @endif
                            @endforeach
                            @else
                            <div class="text-center mt-10 text-muted">{{__('No Data')}}</div>
                            @endif
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>