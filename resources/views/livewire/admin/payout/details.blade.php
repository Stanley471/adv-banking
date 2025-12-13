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
                        <div class="symbol-label fs-1 text-dark">
                            @if($val->trx_type == 'debit')
                            <i class="fal fa-minus fa-2x"></i>
                            @else
                            <i class="fal fa-plus fa-2x"></i>
                            @endif
                        </div>
                    </div>
                    <p class="text-dark fs-1 fw-bolder">{{$currency->currency_symbol.currencyFormat(number_format($val->amount, 2)).' '.$currency->currency}}</p>
                </div>
                <div class="d-flex flex-column">
                    <li class="d-flex align-items-center py-2">
                        <span class="bullet me-5 bg-info bullet-vertical"></span> <span>{{__('Reference')}}: {{$val->ref_id}} <i class="fal fa-clone castro-copy fs-5" data-clipboard-text="{{$val->ref_id}}" title="Copy"></i></span>
                    </li>
                    <li class="d-flex align-items-center py-2">
                        <span class="bullet me-5 bg-info bullet-vertical"></span> <span>{{__('Charge')}}: {{$currency->currency_symbol.currencyFormat(number_format($val->charge, 2)).' '.$currency->currency}}</span>
                    </li>
                    <li class="d-flex align-items-center py-2">
                        <span class="bullet me-5 bg-info bullet-vertical"></span> <span>{{__('Date')}}: {{$val->created_at->toDayDateTimeString()}}</span>
                    </li>
                    <li class="d-flex align-items-center py-2">
                        <span class="bullet me-5 bg-info bullet-vertical"></span> <span>{{__('Type')}}: {{ucwords($val->type)}}</span>
                    </li>
                    @if($val->acct_id != null)
                    <li class="d-flex align-items-center py-2">
                        <span class="bullet me-5 bg-info bullet-vertical"></span> <span>{{__('Bank')}}: {{$val->acct->bank->title}}</span>
                    </li>
                    <li class="d-flex align-items-center py-2">
                        <span class="bullet me-5 bg-info bullet-vertical"></span> <span>{{__('Account Number')}}: {{$val->acct->acct_no}}</span>
                    </li>
                    <li class="d-flex align-items-center py-2">
                        <span class="bullet me-5 bg-info bullet-vertical"></span> <span>{{__('Account Name')}}: {{$val->acct->acct_name}}</span>
                    </li>
                    @else
                    <li class="d-flex align-items-center py-2">
                        <span class="bullet me-5 bg-info bullet-vertical"></span> <span>{{__('Payout Method')}}: {{$val->withdrawMethod->name}}</span>
                    </li>
                    <li class="d-flex align-items-center py-2">
                        <span class="bullet me-5 bg-info bullet-vertical"></span> <span>{{__('Details')}}: {{$val->details}}</span>
                    </li>
                    @endif
                    <li class="d-flex align-items-center py-2">
                        <span class="bullet me-5 bg-info bullet-vertical"></span> <span>{{__('Status')}}: <span class="badge badge-pill badge-secondary badge-sm">{{ucwords($val->status)}}</span></span>
                    </li>
                    @if($val->status == "declined")
                    <li class="d-flex align-items-center py-2">
                        <span class="bullet me-5 bg-info bullet-vertical"></span> <span>{{__('Decline Reason')}}: {{$val->decline_reason}}</span>
                    </li>
                    @endif
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
                    <span wire:loading.remove wire:target="approve">{{__('Approve Payout')}}</span>
                    <span wire:loading wire:target="approve">{{__('Processing Request...')}}</span>
                </button>
                <button class="btn btn-secondary btn-block mt-5" id="kt_decline_{{$val->id}}_button"><i class="fal fa-ban"></i> {{__('Decline Payout')}}</button>
                @endif
            </div>
        </div>
    </div>
    <div wire:ignore.self id="kt_decline_{{$val->id}}" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_decline_{{$val->id}}_button" data-kt-drawer-close="#kt_decline_{{$val->id}}_close" data-kt-drawer-width="{'md': '500px'}">
        <div class="card w-100">
            <div class="card-header pe-5 border-0">
                <div class="card-title">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Payout')}}</div>
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
                    <p class="text-dark fs-6 fw-bold">Decline Payout Request</p>
                </div>
                <div class="pb-5 mt-10 position-relative zindex-1">
                    <form class="form w-100 mb-10" wire:submit.prevent="decline" method="post">
                        <div class="fv-row mb-6">
                            <textarea class="form-control form-control-lg form-control-solid" rows="8" type="text" wire:model.defer="reason" required placeholder="Give a reason for payout decline"></textarea>
                            @error('reason')
                            <span class="form-text">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="text-center mt-10">
                            <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                                <span wire:loading.remove wire:target="decline">{{__('Decline Transaction')}}</span>
                                <span wire:loading wire:target="decline">{{__('Processing Request...')}}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>