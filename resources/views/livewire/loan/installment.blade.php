<div>
    @if($installments->count())
    <hr class="bg-secondary">
    <div class="my-6">
        <p class="fs-5 fw-bolder text-dark mb-0">{{__('Payment log')}}</p>
        <div class="timeline mt-6">
            @foreach ($installments as $date)
            <div class="timeline-item">
                <div class="timeline-line w-40px"></div>
                <div class="timeline-icon symbol symbol-circle symbol-40px me-4">
                    <div class="symbol-label bg-light fs-3">
                        @if($date->status == 'unpaid')
                        <i class="fal fa-calendar-alt"></i>
                        @else
                        <i class="fa fa-check-circle text-success"></i>
                        @endif
                    </div>
                </div>
                <div class="timeline-content mt-n1">
                    <div class="bg-light px-6 py-5 rounded-4 @if(!$loop->first && $date->previous()->status == 'unpaid') opacity-50 @endif @if($date->status == 'paid') bg-light-success @elseif($date->expiry_date < \Carbon\Carbon::today() && $date->status == 'unpaid') bg-light-danger @endif">
                        <div class="row">
                            <div class="col-8">
                                <p class="text-dark fw-bolder fs-6 mb-0">{{$date->expiry_date->format('M j, Y')}}</span></p>
                            </div>
                            <div class="col-4 text-end">
                                @if($loop->first && $date->status == 'unpaid')
                                <a wire:click="pay('{{$date->id}}')" class="btn btn-dark btn-sm rounded-5">
                                    <span wire:loading.remove wire:target="pay('{{$date->id}}')"><i class="fal fa-money-check"></i> {{__('Pay')}}</span>
                                    <span wire:loading wire:target="pay('{{$date->id}}')">{{__('Processing...')}}</span>
                                </a>
                                @elseif(!$loop->first && $date->previous()->status == 'paid' && $date->status == 'unpaid')
                                <a wire:click="pay('{{$date->id}}')" class="btn btn-dark btn-sm rounded-5">
                                    <span wire:loading.remove wire:target="pay('{{$date->id}}')"><i class="fal fa-money-check"></i> {{__('Pay')}}</span>
                                    <span wire:loading wire:target="pay('{{$date->id}}')">{{__('Processing...')}}</span>
                                </a>
                                @endif
                            </div>
                        </div>
                        <p class="text-dark fw-bold fs-6 mb-0">{{$currency->currency_symbol.currencyFormat(number_format($date->payback))}} @ {{$date->application->percent}}% Interest</p>
                        <p class="text-dark fw-bold fs-6 mb-0">{{$currency->currency_symbol.currencyFormat(number_format($date->failed))}} @ {{$date->application->failed_percent}}% after {{$date->expiry_date->format('M j, Y')}}</p>
                        @if($date->status == 'paid')
                        <p class="mb-0">{{__('Reference: ').$date->ref_id}}</p>
                        <span class="badge badge-success">{{__('Paid')}} {{$currency->currency_symbol.currencyFormat(number_format($date->initial + $date->profit)).__(' on ').$date->updated_at->format('M j, Y')}}</span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>