<div wire:ignore.self id="kt_regular_money" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_regular_button" data-kt-drawer-close="#kt_regular_close" data-kt-drawer-width="{'md': '500px'}">
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
                <p class="text-dark fs-5">{{__('Create Regular Plan')}}</p>
            </div>
            <div class="pb-5 mt-10 position-relative zindex-1">
                <form class="form w-100 mb-10" wire:submit.prevent="regular(Object.fromEntries(new FormData($event.target)))" method="post">
                    @error('added')
                    <div class="alert alert-danger">
                        <div class="d-flex flex-column">
                            <span>{{$message}}</span>
                        </div>
                    </div>
                    @enderror
                    <div class="fv-row mb-6">
                        <label class="col-form-label">{{__('How much would you like to start with?')}}</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text border-0 fs-2">{{$currency->currency_symbol}}</span>
                            <input class="form-control form-control-lg form-control-solid fs-2 fw-bold @error('amount') is-invalid @enderror" type="text" step="any" wire:model.defer="regular_amount" autocomplete="transaction-amount" id="regular-amount" required placeholder="{{__('0.00')}}" />
                            <span class="input-group-text border-0"><span class="fi fi-{{strtolower($currency->iso2)}} fis rounded-4 me-3 fs-1"></span></span>
                        </div>
                        @error('regular_amount')
                        <span class="form-text text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="row g-9 mb-6" wire:ignore data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                        @foreach(collect(json_decode($set->rga))->pluck('value')->toArray() as $val)
                        <div class="col-md-4 col-6">
                            <span class="form-check form-check-custom form-check-solid form-check-sm fs-2">
                                <input class="form-check-input suggested_amount me-3 rga" type="radio" id="rga" name="rga" value="{{$val}}" @if($loop->first) checked="checked" @endif>
                                {{$currency->currency_symbol.currencyFormat(number_format($val, 2))}}
                            </span>
                        </div>
                        @endforeach
                    </div>
                    <div class="fv-row mb-6">
                        <label class="col-form-label">{{__('How long will you like to save?')}}</label>
                        <select class="form-select form-select-solid" wire:model="regular_plan" required id="regular_plan">
                            @foreach(getRegularSavings() as $plan)
                            <option value="{{$plan->id}}" data-duration="{{$plan->duration}}" data-interest="{{$plan->interest}}">{{$plan->duration}} {{($plan->duration > 1) ? 'Months' : 'Month'}}</option>
                            @endforeach
                        </select>
                        @error('regular_plan')
                        <span class="form-text">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="fv-row mb-6">
                        <input class="form-control form-control-lg form-control-solid" type="text" wire:model.defer="regular_name" required placeholder="Name of Plan" />
                        @error('regular_name')
                        <span class="form-text text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="fv-row mb-6">
                        <span class="form-check form-check-custom form-check-solid form-check-sm mb-3">
                            <input class="form-check-input suggested_amount me-3" type="radio" wire:model="regular_automation" checked value="1">
                            {{__('Yes, I want to be debited now')}}
                        </span>
                        <span class="form-check form-check-custom form-check-solid form-check-sm">
                            <input class="form-check-input suggested_amount me-3" type="radio" wire:model="regular_automation" value="0">
                            {{__('No, I want to save when I want to')}}
                        </span>
                        @error('regular_automation')
                        <span class="form-text text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="bg-light-primary px-6 py-5 mb-10 rounded" wire:ignore>
                        <p class="text-dark fw-bold fs-6 mb-0">{{__('Interest')}}: <span id="regular_interest">0</span>%</p>
                        <p class="text-dark fw-bold fs-6 mb-0">{{__('Return')}}: <span id="regular_return">{{$currency->currency_symbol.'0 '.$currency->currency}}</span></p>
                        <p class="text-dark fw-bold fs-6 mb-0">{{__('Ends')}}: <span id="regular_expiry">-</span></p>
                    </div>
                    <div class="text-center mt-10">
                        <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                            <span wire:loading.remove wire:target="regular">{{__('Submit Request')}}</span>
                            <span wire:loading wire:target="regular">{{__('Processing Request...')}}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div wire:ignore.self id="kt_emergency_money" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_emergency_button" data-kt-drawer-close="#kt_emergency_close" data-kt-drawer-width="{'md': '500px'}">
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
                        <i class="fal fa-sync fa-2x text-info"></i>
                    </div>
                </div>
                <p class="text-dark fs-5">{{__('Create an Emergency Plan')}}</p>
            </div>
            <div class="pb-5 mt-10 position-relative zindex-1">
                <form class="form w-100 mb-10" wire:submit.prevent="emergency(Object.fromEntries(new FormData($event.target)))" method="post">
                    @error('added')
                    <div class="alert alert-danger">
                        <div class="d-flex flex-column">
                            <span>{{$message}}</span>
                        </div>
                    </div>
                    @enderror
                    <div class="fv-row mb-6">
                        <label class="col-form-label">{{__('What is your goal?')}}</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text border-0 fs-2">{{$currency->currency_symbol}}</span>
                            <input class="form-control form-control-lg form-control-solid fs-2 fw-bold @error('amount') is-invalid @enderror" type="text" step="any" wire:model.defer="emergency_goal" autocomplete="transaction-amount" id="emergency-goal" required placeholder="{{__('0.00')}}" />
                            <span class="input-group-text border-0"><span class="fi fi-{{strtolower($currency->iso2)}} fis rounded-4 me-3 fs-1"></span></span>
                        </div>
                        @error('emergency_goal')
                        <span class="form-text text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="fv-row mb-6">
                        <label class="col-form-label">{{__('How much would you like to start with?')}}</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text border-0 fs-2">{{$currency->currency_symbol}}</span>
                            <input class="form-control form-control-lg form-control-solid fs-2 fw-bold @error('amount') is-invalid @enderror" type="text" step="any" wire:model.defer="emergency_amount" autocomplete="transaction-amount" id="emergency-amount" required placeholder="{{__('0.00')}}" />
                            <span class="input-group-text border-0"><span class="fi fi-{{strtolower($currency->iso2)}} fis rounded-4 me-3 fs-1"></span></span>
                        </div>
                        @error('emergency_amount')
                        <span class="form-text text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="row g-9 mb-6" wire:ignore data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                        @foreach(collect(json_decode($set->ega))->pluck('value')->toArray() as $val)
                        <div class="col-md-4 col-6">
                            <span class="form-check form-check-custom form-check-solid form-check-sm fs-2">
                                <input class="form-check-input suggested_amount me-3 ega" type="radio" id="ega" name="ega" value="{{$val}}" @if($loop->first) checked="checked" @endif>
                                {{$currency->currency_symbol.currencyFormat(number_format($val, 2))}}
                            </span>
                        </div>
                        @endforeach
                    </div>
                    <div class="fv-row mb-6">
                        <input class="form-control form-control-lg form-control-solid" type="text" wire:model.defer="emergency_name" required placeholder="Name of Plan" />
                        @error('emergency_name')
                        <span class="form-text text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="fv-row mb-6">
                        <label class="col-form-label">{{__('What day of the month works for you?')}}</label>
                        <select class="form-select form-select-lg form-select-solid" wire:model.defer="emergency_month">
                            @for($i=1; $i<=28; $i++) <option value="{{($i < 10 ? 0 : '').$i}}">{{($i < 10 ? 0 : '').$i}}</option>
                                @endfor
                        </select>
                        <span class="form-text">{{__('We will send a reminder to top up your emergency plan on this day.')}}</span>
                        @error('emergency_month')
                        <span class="form-text text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="fv-row mb-6">
                        <span class="form-check form-check-custom form-check-solid form-check-sm mb-3">
                            <input class="form-check-input suggested_amount me-3" type="radio" wire:model="emergency_automation" checked value="1">
                            {{__('Yes, I want to be debited now')}}
                        </span>
                        <span class="form-check form-check-custom form-check-solid form-check-sm">
                            <input class="form-check-input suggested_amount me-3" type="radio" wire:model="emergency_automation" value="0">
                            {{__('No, I want to save when I want to')}}
                        </span>
                        @error('regular_automation')
                        <span class="form-text text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="bg-light-primary px-6 py-5 mb-10 rounded" wire:ignore>
                        <p class="text-dark fw-bold fs-6 mb-0">{{__('Interest')}}: <span id="emergency_interest">0</span>%</p>
                        <p class="text-dark fw-bold fs-6 mb-0">{{__('Return')}}: <span id="emergency_return">{{$currency->currency_symbol.'0 '.$currency->currency}}</span></p>
                        @if($set->egg)
                        <p class="text-dark fw-bold fs-6 mb-0">{{__('Interest will be returned if you reach your goal on ').\Carbon\Carbon::now()->addYear(1)->format('M j, Y')}}</p>
                        @else
                        <p class="text-dark fw-bold fs-6 mb-0">{{__('Interest will be returned on ').\Carbon\Carbon::now()->addYear(1)->format('M j, Y')}}</p>
                        @endif
                    </div>
                    <div class="text-center mt-10">
                        <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                            <span wire:loading.remove wire:target="emergency">{{__('Submit Request')}}</span>
                            <span wire:loading wire:target="emergency">{{__('Processing Request...')}}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div wire:ignore.self id="kt_duo_money" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_duo_button" data-kt-drawer-close="#kt_duo_close" data-kt-drawer-width="{'md': '500px'}">
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
                        <i class="fal fa-sync fa-2x text-info"></i>
                    </div>
                </div>
                <p class="text-dark fs-5">{{__('Create an Duo Plan')}}</p>
            </div>
            <div class="pb-5 mt-10 position-relative zindex-1">
                <form class="form w-100 mb-10" wire:submit.prevent="duo(Object.fromEntries(new FormData($event.target)))" method="post">
                    @error('added')
                    <div class="alert alert-danger">
                        <div class="d-flex flex-column">
                            <span>{{$message}}</span>
                        </div>
                    </div>
                    @enderror
                    <div class="fv-row mb-6">
                        <label class="col-form-label">{{__('What is your goal?')}}</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text border-0 fs-2">{{$currency->currency_symbol}}</span>
                            <input class="form-control form-control-lg form-control-solid fs-2 fw-bold @error('amount') is-invalid @enderror" type="text" step="any" wire:model.defer="duo_goal" autocomplete="transaction-amount" id="duo-goal" required placeholder="{{__('0.00')}}" />
                            <span class="input-group-text border-0"><span class="fi fi-{{strtolower($currency->iso2)}} fis rounded-4 me-3 fs-1"></span></span>
                        </div>
                        @error('duo_goal')
                        <span class="form-text text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="fv-row mb-6">
                        <input class="form-control form-control-lg form-control-solid" type="text" wire:model.defer="duo_name" required placeholder="Name of Plan" />
                        @error('duo_name')
                        <span class="form-text text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="fv-row mb-6 form-floating">
                        <input class="form-control form-control-lg form-control-solid fs-2 fw-bold @error('merchantId') is-invalid @enderror" type="text" wire:model.defer="merchantId" id="tag" />
                        <label class="form-label fs-6 fw-bolder text-dark" for="merchant_id">{{__('Merchant ID')}}</label>
                        @error('merchantId')
                        <span class="form-text text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="bg-light-primary px-6 py-5 mb-10 rounded" wire:ignore>
                        <p class="text-dark fw-bold fs-6 mb-0">{{__('Recipient')}}: <span id="recipient">-</span></p>
                        <p class="text-dark fw-bold fs-6 mb-0">{{__('Interest')}}: <span id="duo_interest">0</span>%</p>
                        <p class="text-dark fw-bold fs-6 mb-0">{{__('Return')}}: <span id="duo_return">{{$currency->currency_symbol.'0 '.$currency->currency}}</span></p>
                        @if($set->dgg)
                        <p class="text-dark fw-bold fs-6 mb-0">{{__('Interest will be returned if you reach your goal on ').\Carbon\Carbon::now()->addYear(1)->format('M j, Y')}}</p>
                        @else
                        <p class="text-dark fw-bold fs-6 mb-0">{{__('Interest will be returned on ').\Carbon\Carbon::now()->addYear(1)->format('M j, Y')}}</p>
                        @endif
                    </div>
                    <div class="text-center mt-10">
                        <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2" id="duo_button">
                            <span wire:loading.remove wire:target="duo">{{__('Submit Request')}}</span>
                            <span wire:loading wire:target="duo">{{__('Processing Request...')}}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>