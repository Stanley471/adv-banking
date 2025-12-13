<div>
    <div wire:ignore.self id="kt_join_{{$val->id}}" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_join_{{$val->id}}_button" data-kt-drawer-close="#kt_join_{{$val->id}}_close" data-kt-drawer-width="{'md': '500px'}">
        <div class="card w-100">
            <div class="card-header pe-5 border-0">
                <div class="card-title">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Join Circle')}}</div>
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_join_{{$val->id}}_close">
                        <span class="svg-icon svg-icon-2">
                            <i class="fal fa-times"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body text-wrap">
                <div class="btn-wrapper text-center mb-3">
                    <div class="symbol symbol-100px me-7 mb-4 symbol-circle">
                        <span class="symbol-label bg-transparent" style="background-image:url({{url('/').'/storage/app/'.$val->image}}); background-size: auto 100%;"></span>
                    </div>
                    <p class="text-dark fs-4 fw-bolder mb-3">{{$val->name}}</p>
                    <p class="text-gray-700 fs-6">{{$val->description}}</p>
                </div>
                <div class="pb-5 mt-10 position-relative zindex-1">
                    <form class="form w-100 mb-10" wire:submit.prevent="join(Object.fromEntries(new FormData($event.target)))" method="post">
                        @error('added')
                        <div class="alert alert-danger">
                            <div class="d-flex flex-column">
                                <span>{{$message}}</span>
                            </div>
                        </div>
                        @enderror
                        <div class="fv-row mb-6">
                            <span class="form-check form-check-custom form-check-solid form-check-sm mb-3">
                                <input class="form-check-input suggested_amount me-3" type="radio" wire:model="automation" checked value="1">
                                {{__('Yes, I want to be debited now')}}
                            </span>
                            <span class="form-check form-check-custom form-check-solid form-check-sm">
                                <input class="form-check-input suggested_amount me-3" type="radio" wire:model="automation" value="0">
                                {{__('No, I want to save when I want to')}}
                            </span>
                            @error('automation')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        @if($val->circle_duration == 'monthly')
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
                        <div class="d-flex flex-column bg-light px-6 py-5 mb-10 rounded">
                            <li class="d-flex align-items-center py-2">
                                <span class="bullet me-5 bg-info bullet-vertical"></span> <span>{{__('Ends')}}: {{$val->expiry_date->format('M j, Y')}}</span>
                            </li>
                            <li class="d-flex align-items-center py-2">
                                <span class="bullet me-5 bg-info bullet-vertical"></span> <span>{{__('Amount')}}: {{$currency->currency_symbol.currencyFormat(number_format($val->amount, 2)).' '.$currency->currency}}/{{$val->duration}}</span>
                            </li>
                            <li class="d-flex align-items-center py-2">
                                <span class="bullet me-5 bg-info bullet-vertical"></span> <span>{{__('Interest')}}: {{$val->interest}}%</span>
                            </li>
                            <li class="d-flex align-items-center py-2">
                                <span class="bullet me-5 bg-info bullet-vertical"></span> <span>{{__('Members')}}: {{$val->savings->count()}}</span>
                            </li>
                        </div>
                        <div class="text-center mt-10">
                            <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                                <span wire:loading.remove wire:target="join">{{__('Join circle')}}</span>
                                <span wire:loading wire:target="join">{{__('Processing Request...')}}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>