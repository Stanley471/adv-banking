<div>
    <div wire:ignore.self id="kt_trx_{{$val->id}}" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_trx_{{$val->id}}_button" data-kt-drawer-close="#kt_trx_{{$val->id}}_close">
        <div class="card w-100">
            <div class="card-header pe-5 border-0">
                <div class="card-title">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Transaction Details')}}</div>
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_trx_{{$val->id}}_close">
                        <span class="svg-icon svg-icon-2">
                            <i class="fal fa-times"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body text-wrap">
                <div class="btn-wrapper text-center mb-3">
                    <div class="symbol symbol-100px symbol-circle me-5 mb-10">
                        @if($val->user->avatar == null)
                        <span class="symbol-label bg-warning text-inverse-warning fw-boldest">{{substr(ucwords($val->user->business->name), 0, 1)}}</span>
                        @else
                        <div class="symbol-label" style="background-image:url({{url('/').'/storage/app/'.$val->user->avatar}})"></div>
                        @endif
                    </div>
                    <p class="text-dark fs-1 fw-bolder">{{$currency->currency_symbol.number_format($val->amount, 2).' '.$currency->currency}}</p>
                    <p class="fs-6 fw-bolder mb-0"><a href="{{route('user.manage', ['client' => $val->user->id, 'type' => 'details'])}}" class="text-info">{{$val->user->business->name}}</a></p>
                </div>
                <div class="timeline mt-6">
                    @if($val->status == 'pending')
                    @if($val->plan->installment == 1)
                    @foreach ($month as $date)
                    <div class="timeline-item">
                        <div class="timeline-line w-40px"></div>
                        <div class="timeline-icon symbol symbol-circle symbol-40px me-4">
                            <div class="symbol-label bg-light">
                                <i class="fal fa-calendar-alt"></i>
                            </div>
                        </div>
                        <div class="timeline-content mt-n1">
                            <div class="bg-light px-6 py-5 rounded" wire:ignore>
                                <p class="text-dark fw-bolder fs-6 mb-0">{{$date->addMonths(1)->format('M j, Y')}}</span></p>
                                <p class="text-dark fw-bold fs-6 mb-0"><span class="interest"></span> {{$currency->currency_symbol.currencyFormat(number_format((($val->amount * $val->percent/100) + $val->amount) / $duration))}} @ {{$val->percent}}% Interest</p>
                                <p class="text-dark fw-bold fs-6 mb-0"><span class="failed_interest"></span> {{$currency->currency_symbol.currencyFormat(number_format((($val->amount * $val->failed_percent/100) + $val->amount) / $duration))}} @ {{$val->failed_percent}}% after {{$date->format('M j, Y')}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="timeline-item">
                        <div class="timeline-line w-40px"></div>
                        <div class="timeline-icon symbol symbol-circle symbol-40px me-4">
                            <div class="symbol-label bg-light">
                                <i class="fal fa-calendar-alt"></i>
                            </div>
                        </div>
                        <div class="timeline-content mt-n1">
                            <div class="bg-light px-6 py-5 rounded" wire:ignore>
                                <p class="text-dark fw-bolder fs-6 mb-0">{{$month->endDate->format('M j, Y')}}</span></p>
                                <p class="text-dark fw-bold fs-6 mb-0"><span class="interest"></span> {{$currency->currency_symbol.currencyFormat(number_format((($val->amount * $val->percent/100) + $val->amount) / $duration))}} @ {{$val->percent}}% Interest</p>
                                <p class="text-dark fw-bold fs-6 mb-0"><span class="failed_interest"></span> {{$currency->currency_symbol.currencyFormat(number_format((($val->amount * $val->failed_percent/100) + $val->amount) / $duration))}} @ {{$val->failed_percent}}% after {{$month->endDate->format('M j, Y')}}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    @else
                    <div class="timeline mt-6">
                        @foreach ($val->installments as $date)
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
                                    <p class="text-dark fw-bolder fs-6 mb-0">{{$date->expiry_date->format('M j, Y')}}</span></p>
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
                    @endif
                </div>
                <div class="d-flex flex-column">
                    @if($val->plan->type == 'loan')
                    <li class="d-flex align-items-center py-2">
                        <span class="bullet me-5 bg-info bullet-vertical"></span> <span>{{__('Plan')}}: {{$val->plan->name}} </span>
                    </li>
                    @else
                    <li class="d-flex align-items-center py-2">
                        <span class="bullet me-5 bg-info bullet-vertical"></span> <span>{{__('Product')}}: {{$val->plan->name}} </span>
                    </li>
                    @if($val->plan->product_type == 'physical')
                    <li class="d-flex align-items-center py-2">
                        <span class="bullet me-5 bg-info bullet-vertical"></span> <span>{{__('Address')}}: {{$val->user->business->line_1.', '.$val->user->business->myState->name.', '.$val->user->business->city.', '.$val->user->business->postal_code}} </span>
                    </li>
                    @endif
                    @endif
                    <li class="d-flex align-items-center py-2">
                        <span class="bullet me-5 bg-info bullet-vertical"></span> <span>{{__('Reference')}}: {{$val->ref_id}} <i class="fal fa-clone castro-copy fs-5" data-clipboard-text="{{$val->ref_id}}" title="Copy"></i></span>
                    </li>
                    <li class="d-flex align-items-center py-2">
                        <span class="bullet me-5 bg-info bullet-vertical"></span> <span>{{__('Date')}}: {{$val->created_at->toDayDateTimeString()}}</span>
                    </li>
                    @if($val->plan->type == 'loan')
                    <li class="d-flex align-items-center py-2">
                        <span class="bullet me-5 bg-info bullet-vertical"></span> <span>{{__('Bank')}}: {{$val->acct->bank->title}}</span>
                    </li>
                    @endif
                    <li class="d-flex align-items-center py-2">
                        <span class="bullet me-5 bg-info bullet-vertical"></span> <span>{{__('Account Number')}}: {{$val->acct->acct_no}}</span>
                    </li>
                    <li class="d-flex align-items-center py-2">
                        <span class="bullet me-5 bg-info bullet-vertical"></span> <span>{{__('Account Name')}}: {{$val->acct->acct_name}}</span>
                    </li>
                    <li class="d-flex align-items-center py-2">
                        <span class="bullet me-5 bg-info bullet-vertical"></span> <span>{{__('Status')}}: <span class="badge badge-pill badge-secondary badge-sm">{{ucwords($val->status)}}</span></span>
                    </li>
                    @if($val->staff_id != null)
                    <li class="d-flex align-items-center py-2">
                        <span class="bullet me-5 bg-info bullet-vertical"></span> <span>{{__('Edited by')}}: {{$val->staff->first_name.' '.$val->staff->last_name}}</span>
                    </li>
                    <li class="d-flex align-items-center py-2">
                        <span class="bullet me-5 bg-info bullet-vertical"></span> <span>{{__('Date & Time')}}: {{$val->updated_at->toDayDateTimeString()}}</span>
                    </li>
                    @endif
                </div>
                @if($val->status == "pending")
                <button class="btn btn-info btn-block mt-5" wire:click="approve"><i class="fal fa-thumbs-up"></i>
                    <span wire:loading.remove wire:target="approve">{{__('Approve Loan')}}</span>
                    <span wire:loading wire:target="approve">{{__('Processing Request...')}}</span>
                </button>
                <button class="btn btn-secondary btn-block mt-5" id="kt_decline_{{$val->id}}_button"><i class="fal fa-ban"></i> {{__('Decline Loan')}}</button>
                @endif
            </div>
        </div>
    </div>
    <div wire:ignore.self id="kt_decline_{{$val->id}}" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_decline_{{$val->id}}_button" data-kt-drawer-close="#kt_decline_{{$val->id}}_close" data-kt-drawer-width="{'md': '500px'}">
        <div class="card w-100">
            <div class="card-header pe-5 border-0">
                <div class="card-title">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Loan')}}</div>
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_decline_close">
                        <span class="svg-icon svg-icon-2">
                            <i class="fal fa-times"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body text-wrap">
                <div class="btn-wrapper text-center mb-3">
                    <div class="symbol symbol-100px symbol-circle me-5 mb-10">
                        <div class="symbol-label fs-1 text-dark">
                            <i class="fal fa-ban fa-2x"></i>
                        </div>
                    </div>
                    <p class="text-dark fs-6 fw-bold">Decline Loan Request</p>
                </div>
                <div class="pb-5 mt-10 position-relative zindex-1">
                    <form class="form w-100 mb-10" wire:submit.prevent="decline" method="post">
                        <div class="fv-row mb-6">
                            <textarea class="form-control form-control-lg form-control-solid" rows="8" type="text" wire:model.defer="reason" required placeholder="Give a reason for loan decline"></textarea>
                            @error('reason')
                            <span class="form-text">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="text-center mt-10">
                            <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                                <span wire:loading.remove wire:target="decline">{{__('Decline Loan')}}</span>
                                <span wire:loading wire:target="decline">{{__('Processing Request...')}}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>