<div class="card mb-9 rounded-5">
    <div class="card-body pt-9 pb-0">
        <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
            <div class="symbol symbol-100px me-7 mb-4 symbol-circle">
                <span class="symbol-label" style="background-image:url({{url('/').'/storage/app/'.$plan->image}});"></span>
            </div>
            <div class="flex-grow-1">
                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                    <div class="d-flex flex-column">
                        <p class="text-dark fs-1 fw-boldest me-3 mb-0">{{substr($plan->name, 0, 30)}}{{(Str::length($plan->name) > 30) ? '...' : ''}}</p>
                        <p>
                            @if($plan->recommendation == 1)<span class="badge badge-light-info">Recommended</span>@endif
                            <span class="badge badge-light-info">{{($plan->status == 1) ? 'Published' : 'Disabled'}}</span>
                            <span class="badge badge-light-info">Sell units: {{($plan->sell_units == 1) ? 'Yes' : 'No'}}</span>
                            <span class="badge badge-light-info">Return Dividend: {{($plan->dividend == 1) ? 'Yes' : 'No'}}</span>
                        </p>
                        @if($plan->followed->count())
                        <div class="symbol-group symbol-hover mb-3">
                            <!--begin::User-->
                            @foreach($plan->followed->take(10) as $followers)
                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="{{$followers->user->business->name}}">
                                @if($followers->user->avatar == null)
                                <span class="symbol-label bg-warning text-inverse-warning fw-boldest">{{substr(ucwords($followers->user->business->name), 0, 1)}}</span>
                                @else
                                <div class="symbol-label" style="background-image:url({{url('/').'/storage/app/'.$followers->user->avatar}})"></div>
                                @endif
                            </div>
                            @endforeach
                            @if($plan->followed->count() > 10)
                            <div class="symbol symbol-35px symbol-circle">
                                <span class="symbol-label bg-warning text-dark fs-8 fw-boldest">+{{$plan->followed->count() - 10}}</span>
                            </div>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
                <div class="d-flex flex-wrap justify-content-start">
                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                        <div class="fs-6 fw-boldest text-gray-700">@if($plan->claim_duration == null) Anytime @else {{$plan->claim_duration.' Months'}}@endif</div>
                        <div class="fw-bold text-gray-400">Claim Duration</div>
                    </div>
                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                        <div class="fs-6 fw-boldest text-gray-700">@if($plan->units == null)<i class="fal fa-infinity"></i> @else {{currencyFormat(number_format($plan->units))}}@endif</div>
                        <div class="fw-bold text-gray-400">Units</div>
                    </div>
                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                        <div class="fs-6 fw-boldest text-gray-700">{{$plan->custodian}}</div>
                        <div class="fw-bold text-gray-400">Fund Manager</div>
                    </div>
                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                        <div class="fs-6 fw-boldest text-gray-700">{{$plan->trustee}}</div>
                        <div class="fw-bold text-gray-400">Trustee</div>
                    </div>
                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
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
                    @if($plan->priceHistory->last()->date->diffInDays() <= 3 && $plan->priceHistory->last()->date >= \Carbon\Carbon::today())
                        <div class="alert alert-dismissible bg-warning d-flex flex-column flex-sm-row p-5 mt-3">
                            <i class="fal fa-clock fa-2x text-dark me-2"></i>
                            <div class="d-flex flex-column text-dark pe-0 pe-sm-10">
                                <h5 class="mb-1">Add more units, you have {{$plan->priceHistory->last()->date->diffInDays()}} days.</h5>
                                <span>Plan will soon be hidden from users, add more units history to keep your users updated. A reminder will be sent to your mail daily.</span>
                            </div>
                        </div>
                        @endif
                        @if($plan->priceHistory->last()->date < \Carbon\Carbon::today()) <div class="alert alert-dismissible bg-danger d-flex flex-column flex-sm-row p-5 mt-3">
                            <i class="fal fa-clock fa-2x text-white me-2"></i>
                            <div class="d-flex flex-column text-white pe-0 pe-sm-10">
                                <h5 class="mb-1">Add more units.</h5>
                                <span>Plan has been hidden from users, add more units history to keep your users updated.</span>
                            </div>
                </div>
                @endif
                @if($plan->fundComposition->count() == 0)
                <div class="alert alert-dismissible bg-info d-flex flex-column flex-sm-row p-5 mt-3">
                    <i class="fal fa-pie-chart fa-2x text-white me-2"></i>
                    <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                        <h5 class="mb-1">Fund composition</h5>
                        <span>You need to add what mutual fund is being invested in for plan to be displayed to users.</span>
                    </div>
                </div>
                @else
                <p class="mb-0 text-gray-600 fs-6">Fund Composition</p>
                <div class="progress w-100 h-15px mb-3">
                    @foreach($plan->fundComposition as $progress)
                    <div class="progress-bar {{$progress->color}}" style="width: {{$progress->percent}}%;"></div>
                    @endforeach
                </div>
                <p>
                    @foreach($plan->fundComposition as $progress)
                    <span class="me-3"><i class="fas fa-square {{str_replace('bg', 'text', $progress->color)}}"></i> {{ucwords($progress->name)}}: {{$progress->percent}}%</span>
                    @endforeach
                </p>
                @endif
            </div>
        </div>
        <div class="separator"></div>
        <div class="d-flex overflow-auto">
            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold flex-wrap h-55px">
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6 @if($type == 'edit') active @endif" href="{{route('admin.invest.plan', ['plan' => $plan->id, 'type' => 'edit'])}}">Edit Plan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6 @if($type == 'composition') active @endif" href="{{route('admin.invest.plan', ['plan' => $plan->id, 'type' => 'composition'])}}">Fund Composition</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6 @if($type == 'history') active @endif" href="{{route('admin.invest.plan', ['plan' => $plan->id, 'type' => 'history'])}}">Price History</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6 @if($type == 'followers') active @endif" href="{{route('admin.invest.plan', ['plan' => $plan->id, 'type' => 'followers'])}}">Followers & Investors ({{$plan->followed->count()}})</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6 @if($type == 'dividend') active @endif" href="{{route('admin.invest.plan', ['plan' => $plan->id, 'type' => 'dividend'])}}">Processed Dividend ({{$plan->processedDividends->count()}})</a>
                </li>
            </ul>
        </div>
    </div>
</div>