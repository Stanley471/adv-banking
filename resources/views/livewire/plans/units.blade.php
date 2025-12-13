<div>
    <div class="d-flex flex-stack">
        <div class="d-flex align-items-center">
            <div class="symbol symbol-40px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="{{$buy->user->business->name}}">
                @if($buy->user->avatar == null)
                <span class="symbol-label bg-warning text-inverse-warning fw-boldest">{{substr(ucwords($buy->user->business->name), 0, 1)}}</span>
                @else
                <div class="symbol-label" style="background-image:url({{url('/').'/storage/app/'.$buy->user->avatar}})"></div>
                @endif
            </div>
            <div class="ps-3">
                <p class="fs-5 text-dark text-hover-primary fw-bolder mb-0">{{$buy->id}}</p>
                <p class="fs-6 text-gray-800 mb-0">{{number_format($buy->units).__(' units')}} => {{$currency->currency_symbol.number_format($buy->amount, 2)}}</p>
                <p class="fs-6 text-gray-800 mb-0">{{__('Returns ')}} => {{$currency->currency_symbol.number_format($buy->amount + ($buy->amount * $buy->plan->interest / 100), 2)}} on {{$buy->plan->expiring_date->format('M j, y')}}</p>
            </div>
        </div>
    </div>
</div>