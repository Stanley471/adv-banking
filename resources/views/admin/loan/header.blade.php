<div class="card mb-9 rounded-5">
    <div class="card-body pt-9 pb-0">
        <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
            <div class="symbol symbol-100px me-7 mb-4 symbol-circle">
                <span class="symbol-label" style="background-image:url({{url('/').'/storage/app/'.$plan->image}});"></span>
            </div>
            <div class="flex-grow-1">
                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                    <div class="d-flex flex-column">
                        <p class="text-dark fs-1 fw-boldest me-3 mb-0">{{$plan->name}}</p>
                        <p class="text-gray-800 fs-5 me-3 mb-3">{{$plan->location}}</p>
                        <p>
                            <span class="badge badge-light-info">{{$plan->category->name}}</span>
                            <span class="badge badge-light-info">{{$plan->duration.' Months'}}</span>
                            <span class="badge badge-light-info">{{($plan->status == 1) ? 'Published' : 'Disabled'}}</span>
                            <span class="badge badge-light-info">{{($plan->insurance == 1) ? 'Insured' : 'No Insurance'}}</span>
                        </p>
                    </div>
                </div>
                <div class="d-flex flex-wrap justify-content-start">
                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                        <div class="fs-6 fw-boldest text-gray-700">{{\Carbon\Carbon::create($plan->start_date)->format('M j, Y')}} - {{\Carbon\Carbon::create($plan->close_date)->format('M j, Y')}}</div>
                        <div class="fw-bold text-gray-400">Investment Closure</div>
                    </div>
                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                        <div class="fs-6 fw-boldest text-gray-700">{{\Carbon\Carbon::create($plan->expiring_date)->format('M j, Y')}}</div>
                        <div class="fw-bold text-gray-400">Matures</div>
                    </div>
                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                        <div class="fs-6 fw-boldest text-gray-700">{{number_format($plan->original - $plan->units).'/'.number_format($plan->original)}} units</div>
                        <div class="fw-bold text-gray-400">{{$currency->currency_symbol.$plan->price}} per unit</div>
                    </div>
                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                        <div class="fs-6 fw-boldest text-gray-700">{{$plan->interest}}%</div>
                        <div class="fw-bold text-gray-400">Interest</div>
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
                                <div class="fw-bold text-gray-400">Investment Fee</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="separator"></div>
            <div class="d-flex overflow-auto">
                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold flex-wrap h-55px">
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6 @if($type == 'edit') active @endif" href="{{route('admin.invest.plan', ['plan' => $plan->id, 'type' => 'edit'])}}">Edit Plan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6 @if($type == 'updates') active @endif" href="{{route('admin.invest.plan', ['plan' => $plan->id, 'type' => 'updates'])}}">Investment updates ({{$plan->updates->count()}})</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6 @if($type == 'followers') active @endif" href="{{route('admin.invest.plan', ['plan' => $plan->id, 'type' => 'followers'])}}">Followers & Investors ({{$plan->followed->count()}})</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>