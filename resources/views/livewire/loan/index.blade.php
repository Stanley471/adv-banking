<div>
    <div class="px-9 pt-6 rounded h-250px w-100 castro-secret2 bgi-no-repeat bgi-size-cover bgi-position-y-top rounded-5">
        <div class="d-flex flex-stack mt-6">
            <h3 class="m-0 text-white fw-bolder fs-3">{{__('Borrow Funds')}}</h3>
        </div>
        <div class="d-flex align-items-center align-self-center flex-wrap pt-6">
            <div class="fw-bold fs-5 text-start text-white pt-5">
                <span class="fi fi-{{strtolower($currency->iso2)}} mr-2 fis fs-1 rounded-4 text-white"></span> {{__('Current Loan')}}
                <span class="fw-bolder fs-2hx d-block mt-n1 text-white">
                    <span id="main_balance">
                        @if($user->business->reveal_balance == 1){{$currency->currency_symbol.currencyFormat(number_format($user->pendingLoan('loan')->sum('payback'), 2)).' '.$currency->currency}} @else ************ @endif
                    </span>
                    <span class="ml-3 fs-3 cursor-pointer" wire:click="xBalance">
                        <i class="fal fa-eye-slash" id="hide_balance" @if($user->business->reveal_balance == 0) style="display:none;" @endif></i>
                        <i class="fal fa-eye" id="reveal_balance" @if($user->business->reveal_balance == 1) style="display:none;" @endif></i>
                    </span>
                </span>
            </div>
        </div>
    </div>
    <div class="mx-md-6 mx-4 mt-n20">
        @livewire('loan.guarantor', ['user' => $user, 'settings' => $set])
        <div class="row g-8 row-cols-1 row-cols-sm-2">
            @if($plans->count())
            @foreach($plans as $val)
            <div class="col mb-3">
                <a href="{{route('user.loan.plan', ['plan' => $val->id])}}">
                    <div class="text-start bg-white shadow-xs rounded-5 p-7 cursor-pointer">
                        <div class="symbol symbol-75px mt-1 mb-3">
                            <span class="symbol-label bg-light-info rounded-4">
                                <i class="fal fa-landmark fa-3x text-info"></i>
                            </span>
                        </div>
                        <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                    <div class="d-flex flex-column">
                                        <p class="text-dark fs-1 fw-boldest me-3 mb-2">{{$val->name}}</p>
                                        <p>
                                            <span class="badge badge-light-info">{{$val->duration.' Months'}}</span>
                                            <span class="badge badge-light-info">{{($val->installment == 1) ? 'Installment' : 'No Installment'}}</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex flex-wrap justify-content-start">
                                    <div class="rounded-3 min-w-125px py-3 px-4 me-6 mb-3">
                                        <div class="fs-6 fw-boldest text-dark">{{$currency->currency_symbol.currencyFormat(number_format($val->min)).' - '.$currency->currency_symbol.currencyFormat(number_format($val->max))}}</div>
                                        <div class="fw-bold text-dark">Amount</div>
                                    </div>
                                    <div class="rounded-3 min-w-125px py-3 px-4 me-6 mb-3">
                                        <div class="fs-6 fw-boldest text-dark">{{$val->interest}}%</div>
                                        <div class="fw-bold text-dark">Interest</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>