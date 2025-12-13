<div>
    <div wire:ignore.self id="kt_transfer_{{$val->id}}" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_transfer_{{$val->id}}_button" data-kt-drawer-close="#kt_transfer_{{$val->id}}_close" data-kt-drawer-width="{'md': '500px'}">
        <div class="card w-100">
            <div class="card-header pe-5 border-0">
                <div class="card-title">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Transfer Money')}}</div>
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_send_{{$val->id}}_close">
                        <span class="svg-icon svg-icon-2">
                            <i class="fal fa-times"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body text-wrap">
                <div class="btn-wrapper text-center mb-3">
                    <div class="symbol symbol-100px symbol-circle me-5 mb-10">
                        @if($val->recipient->avatar == null)
                        <span class="symbol-label bg-warning text-inverse-warning fw-boldest">{{substr(ucwords($val->recipient->business->name), 0, 1)}}</span>
                        @else
                        <div class="symbol-label" style="background-image:url({{url('/').'/storage/app/'.$val->recipient->avatar}})"></div>
                        @endif
                    </div>
                    <p class="text-dark fs-6">{{__('Transfer money to ').$val->recipient->business->name}}</p>
                </div>
                <div class="pb-5 mt-10 position-relative zindex-1">
                    <form class="form w-100 mb-10" wire:submit.prevent="transfer(Object.fromEntries(new FormData($event.target)))" method="post">
                        @error('added_ben')
                        <div class="alert alert-danger">
                            <div class="d-flex flex-column">
                                <span>{{$message}}</span>
                            </div>
                        </div>
                        @enderror
                        <div class="fv-row mb-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text border-0 fs-2">{{$currency->currency_symbol}}</span>
                                <input class="form-control form-control-lg form-control-solid fs-2 fw-bold ben-amount{{$val->id}} @error('amount_ben') is-invalid @enderror" type="text" step="any" wire:model.defer="ben_amount" autocomplete="transaction-amount" min="1" max="{{$user->getFirstBalance()->amount}}" required placeholder="{{__('0.00')}}" />
                                <span class="input-group-text border-0"><span class="fi fi-{{strtolower($currency->iso2)}} fis rounded-4 me-3 fs-1"></span></span>
                            </div>
                            @error('ben_amount')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="fv-row mb-6 form-floating">
                            <input wire:model.defer="pin" type="password" minlength="4" maxlength="6" pattern="[0-9]+" class="form-control form-control-lg form-control-solid" required>
                            <label class="form-label fw-bolder text-dark fs-6 mb-0" for="pin">{{__('Transfer Pin')}}</label>
                            @error('pin')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="bg-light-primary px-6 py-5 mb-10 rounded" wire:ignore>
                            <p class="text-dark fw-bold fs-6 mb-0">{{__('Balance after transaction')}}: <span id="balanceAfterBen{{$val->id}}">{{$currency->currency_symbol.currencyFormat(number_format($user->getFirstBalance()->amount, 2)).' '.$currency->currency}}</span></p>
                            <p class="text-dark fw-bold fs-6 mb-0">{{__('Fee')}}: <span id="feeBen{{$val->id}}">{{$currency->currency_symbol.'0.00 '.$currency->currency}}</span></p>
                        </div>
                        <div class="text-center mt-10">
                            <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                                <span wire:loading.remove wire:target="transfer">{{__('Submit Request')}}</span>
                                <span wire:loading wire:target="transfer">{{__('Processing Request...')}}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="delete{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">{{__('Delete Beneficiary')}}</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="fal fa-times"></i>
                        </span>
                    </div>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this beneficiary?</p>
                    <div class="text-center">
                        <a wire:click="delete" class="btn btn-danger btn-block">{{__('Delete Beneficiary')}}</span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    "use strict"

    function checkAmount(amountInput) {
        var currencySymbol = '{{$currency->currency_symbol}}';
        var currencyCode = '{{$currency->currency}}';
        var balance = parseFloat('{{$user->getFirstBalance()->amount}}');
        if (amountInput.val().trim() == "") {
            amountInput.val(null);
        } else {
            var num = amountInput.val();
            var pre = parseFloat(convertToFloat(num));
            var formatted = formatNumber(amountInput.val());
            amountInput.val(formatted);

            var fee = parseFloat(calculateFee(pre, '{{$set->tct}}', '{{$set->fiat_tc}}', '{{$set->percent_tc}}'));
            $('#feeBen{{$val->id}}').text(currencySymbol + fee.toFixed(2).replace(/(\d)(?=(\d{3})+\.\d\d$)/g, "$1,") + ' ' + currencyCode);
            if (parseFloat(fee + pre) <= balance) {
                $('#balanceAfterBen{{$val->id}}').text(currencySymbol + parseFloat(balance - fee - pre).toFixed(2).replace(/(\d)(?=(\d{3})+\.\d\d$)/g, "$1,") + ' ' + currencyCode);
            } else {
                $('#balanceAfterBen{{$val->id}}').text('Insufficient Balance');
            }
        }
    }

    var benInput@php echo $val->merchant_id;@endphp = $(".ben-amount{{$val->id}}");

    benInput@php echo $val->merchant_id;@endphp.on("input", function() {
        checkAmount(benInput@php echo $val->merchant_id;@endphp);
    });
</script>
@endpush