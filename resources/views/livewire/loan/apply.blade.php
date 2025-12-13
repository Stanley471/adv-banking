<div>
    <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
        <div class="container">
            <div class="card mb-9 rounded-5">
                <div class="card-body">
                    <div class="card">
                        <div class="card-header p-0">
                            <div class="card-title">
                                <h2 class="fw-boldest m-0">{{$plan->name}}</h2>
                            </div>
                        </div>
                        <div class="card-body py-10 p-2">
                            <form class="form w-100 mb-10" wire:submit.prevent="apply(Object.fromEntries(new FormData($event.target)))" method="post">
                                @error('added')
                                <div class="alert alert-danger">
                                    <div class="d-flex flex-column">
                                        <span>{{$message}}</span>
                                    </div>
                                </div>
                                @enderror
                                <div class="fv-row mb-6">
                                    <div class="input-group mb-3" wire:ignore>
                                        <span class="input-group-text border-0 fs-2">{{$currency->currency_symbol}}</span>
                                        <input class="form-control form-control-lg form-control-solid fs-1 fw-bold @error('amount') is-invalid @enderror" type="text" step="any" wire:model="amount" autocomplete="transaction-amount" id="loan-amount" required placeholder="{{__('0.00')}}" />
                                        <span class="input-group-text border-0"><span class="fi fi-{{strtolower($currency->iso2)}} fis rounded-4 me-3 fs-1"></span></span>
                                    </div>
                                    @error('amount')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="row g-9 mb-6" wire:ignore data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                                    @foreach(collect(json_decode($plan->suggested_amount))->pluck('value')->toArray() as $val)
                                    <div class="col-md-2 col-6">
                                        <span class="form-check form-check-custom form-check-solid form-check-sm fs-2">
                                            <input class="form-check-input suggested_amount me-3" type="radio" id="suggested_amount" name="suggested_amount" value="{{$val}}" @if($loop->first) checked="checked" @endif>
                                            {{$currency->currency_symbol.currencyFormat(number_format($val, 2))}}
                                        </span>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="fv-row mb-6">
                                    <select class="form-select form-select-solid" wire:model.defer="bank" required>
                                        <option>{{__('Select Bank Account')}}</option>
                                        @foreach($banks as $bank)
                                        <option value="{{$bank->id}}">{{$bank->bank->title.' - '.$bank->acct_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('bank')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="card bg-secondary cursor-pointer mb-6" id="kt_beneficiary_button">
                                    <div class="d-flex align-items-center p-3">
                                        <div class="symbol symbol-40px me-4">
                                            <div class="symbol-label fs-6 text-dark bg-white rounded-5">
                                                <i class="fal fa-university text-dark"></i>
                                            </div>
                                        </div>
                                        <div class="ps-1">
                                            <p class="fs-6 text-dark text-hover-primary fw-bolder mb-0">{{__('Add Bank account')}}</p>
                                        </div>
                                    </div>
                                </div>
                                <p class="fs-5 fw-bolder mb-0">{{__('Loan Calculator')}}</p>
                                <p>{{__('This shows estimates on payback plan if loan application is approved today. Note that application can\'t be cancelled after submitted')}}</p>
                                <div class="timeline mt-6">
                                    @if($plan->installment == 1)
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
                                                <p class="text-dark fw-bolder fs-6 mb-0">{{__('Pay Before')}}: {{$date->addMonths(1)->format('M j, Y')}}</span></p>
                                                <p class="text-dark fw-bold fs-6 mb-0"><span class="interest"></span> @ {{$plan->interest}}% Interest</p>
                                                <p class="text-dark fw-bold fs-6 mb-0"><span class="failed_interest"></span> @ {{$plan->failed_interest}}% after {{$date->format('M j, Y')}}</p>
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
                                                <p class="text-dark fw-bolder fs-6 mb-0">{{__('Pay Before')}}: {{$month->endDate->format('M j, Y')}}</span></p>
                                                <p class="text-dark fw-bold fs-6 mb-0"><span class="interest"></span> @ {{$plan->interest}}% Interest</p>
                                                <p class="text-dark fw-bold fs-6 mb-0"><span class="failed_interest"></span> @ {{$plan->failed_interest}}% after {{$month->endDate->format('M j, Y')}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="form-check form-check-custom form-check-solid mb-6">
                                    <input class="form-check-input" type="checkbox" id="flexCheckDefault" wire:model.defer="terms" required />
                                    <label class="form-check-label" for="flexCheckDefault">{{__('I agree to our')}} <a target="_blank" href="{{route('terms')}}" class="text-info">{{__('terms & conditions')}}</a></label>
                                </div>
                                <div class="text-center mt-10">
                                    <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                                        <span wire:loading.remove wire:target="apply">{{__('Submit application')}}</span>
                                        <span wire:loading wire:target="apply">{{__('Processing Request...')}}</span>
                                    </button>
                                </div>
                            </form>
                            <div wire:ignore.self id="kt_beneficiary" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_beneficiary_button" data-kt-drawer-close="#kt_beneficiary_close" data-kt-drawer-width="{'md': '500px'}">
                                <div class="card w-100">
                                    <div class="card-header pe-5 border-0">
                                        <div class="card-title">
                                            <div class="d-flex justify-content-center flex-column me-3">
                                                <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Add Bank account')}}</div>
                                            </div>
                                        </div>
                                        <div class="card-toolbar">
                                            <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_beneficiary_close">
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
                                                    <i class="fal fa-university fa-2x text-info"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pb-5 mt-10 position-relative zindex-1">
                                            <form class="form w-100 mb-10" wire:submit.prevent="addBank" method="post">
                                                @error('added')
                                                <div class="alert alert-danger">
                                                    <div class="d-flex flex-column">
                                                        <span>{{$message}}</span>
                                                    </div>
                                                </div>
                                                @enderror
                                                <div class="fv-row mb-6">
                                                    <select class="form-select form-select-solid" wire:model.defer="user_bank" required>
                                                        <option>{{__('Select Bank')}}</option>
                                                        @foreach($getBank as $val)
                                                        <option value="{{$val->id}}">{{$val->title}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('user_bank')
                                                    <span class="form-text">{{$message}}</span>
                                                    @enderror
                                                </div>
                                                <div class="fv-row mb-6 form-floating">
                                                    <input class="form-control form-control-lg form-control-solid fs-2 fw-bold @error('acct_no') is-invalid @enderror" type="text" wire:model.defer="acct_no" required id="acct_no" />
                                                    <label class="form-label fs-6 fw-bolder text-dark" for="acct_no">{{__('Account Number')}}</label>
                                                    @error('acct_no')
                                                    <span class="form-text text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                                <div class="fv-row mb-6 form-floating">
                                                    <input class="form-control form-control-lg form-control-solid fs-2 fw-bold @error('acct_name') is-invalid @enderror" type="text" wire:model.defer="acct_name" required id="acct_name" />
                                                    <label class="form-label fs-6 fw-bolder text-dark" for="acct_name">{{__('Account Name')}}</label>
                                                    @error('acct_name')
                                                    <span class="form-text text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                                <div class="text-center mt-10">
                                                    <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                                                        <span wire:loading.remove wire:target="addBank">{{__('Submit Request')}}</span>
                                                        <span wire:loading wire:target="addBank">{{__('Processing Request...')}}</span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
<script>
    "use strict";

    document.addEventListener('livewire:load', function() {

        var loanInput = $("#loan-amount");

        loanInput.on("input", function() {
            checkAmount(loanInput);
        });

        function logSelectedValue() {
            var selectedValue = $('input[type="radio"]:checked').val();
            $("#loan-amount").val(selectedValue);
            checkAmount($("#loan-amount"));
        }

        logSelectedValue();
        $('input[type="radio"]').on('change', logSelectedValue);

        function checkAmount(amountInput) {
            var currencySymbol = '{{$currency->currency_symbol}}';
            var currencyCode = '{{$currency->currency}}';
            if (amountInput.val().trim() == "") {
                amountInput.val(null);
            } else {
                var num = amountInput.val();
                var pre = parseFloat(convertToFloat(num));
                var formatted = formatNumber(amountInput.val());
                amountInput.val(formatted);
                @this.set('amount', formatted);

                var radioValues = [];

                $('input[type="radio"]').each(function() {
                    radioValues.push($(this).val());
                });

                if (radioValues.indexOf(pre.toString()) === -1) {
                    $('.suggested_amount').prop('checked', false);
                }

                var divided = parseFloat(pre / '{{($plan->installment == 1) ? $plan->duration : 1}}');
                var interest = parseFloat((divided * '{{$plan->interest}}' / 100) + divided);
                var failed_interest = parseFloat((divided * '{{$plan->failed_interest}}' / 100) + divided);

                $('.interest').text(currencySymbol + interest.toFixed(2).replace(/(\d)(?=(\d{3})+\.\d\d$)/g, "$1,") + ' ' + currencyCode);
                $('.failed_interest').text(currencySymbol + failed_interest.toFixed(2).replace(/(\d)(?=(\d{3})+\.\d\d$)/g, "$1,") + ' ' + currencyCode);
            }
        }
    });
</script>
@endpush