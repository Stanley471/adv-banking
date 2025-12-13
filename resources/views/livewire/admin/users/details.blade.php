<div>
    <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post" wire:loading.class.delay="opacity-50" wire:target="approveKYC">
        <div class="container">
            <div class="row g-6 g-xl-9">
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card h-100">
                            <div class="card-body p-9">
                                <div class="fs-2hx fw-boldest">{{number_format_short_nc($client->userFunds()).' '.$currency->currency}}</div>
                                <div class="fs-6 fw-bold text-gray-800 mb-7">User Funds</div>
                                <div class="fs-6 d-flex justify-content-between mb-4">
                                    <div class="fw-bold">Account</div>
                                    <div class="d-flex fw-boldest">
                                        {{number_format_short_nc($client->userFunds('account')).' '.$currency->currency}}
                                    </div>
                                </div>
                                <div class="separator separator-dashed"></div>
                                <div class="fs-6 d-flex justify-content-between my-4 mb-10">
                                    <div class="fw-bold">Purchased Units</div>
                                    <div class="d-flex fw-boldest">
                                        {{number_format_short_nc($client->userFunds('units')).' '.$currency->currency}}
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <button id="kt_balance_button" class="btn btn-secondary btn-block me-3">Edit Balance</button>
                                    <div wire:ignore.self id="kt_balance" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_balance_button" data-kt-drawer-close="#kt_balance_close" data-kt-drawer-width="{'md': '500px'}">
                                        <div class="card w-100">
                                            <div class="card-header pe-5 border-0">
                                                <div class="card-title">
                                                    <div class="d-flex justify-content-center flex-column me-3">
                                                        <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Edit Balance')}}</div>
                                                    </div>
                                                </div>
                                                <div class="card-toolbar">
                                                    <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_balance_close">
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
                                                    <form class="form w-100 mb-10" wire:submit.prevent="editBalance" method="post">
                                                        <div class="fv-row mb-6">
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text border-0 fs-2">{{$currency->currency_symbol}}</span>
                                                                <input class="form-control form-control-lg form-control-solid fs-2 fw-bold @error('amount') is-invalid @enderror" type="text" step="any" wire:model.defer="amount" autocomplete="transaction-amount" id="payout-amount" required placeholder="{{__('0.00')}}" />
                                                                <span class="input-group-text border-0"><span class="fi fi-{{strtolower($currency->iso2)}} fis rounded-4 me-3 fs-1"></span></span>
                                                            </div>
                                                            @error('amount')
                                                            <span class="form-text text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="fv-row mb-6">
                                                            <label class="form-label fs-5 fw-bolder text-dark">Super Admin Password</label>
                                                            <input class="form-control form-control-lg form-control-solid" type="password" wire:model.defer="password" required placeholder="Password"/>
                                                            @error('password')
                                                            <span class="form-text text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="text-center mt-10">
                                                            <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                                                                <span wire:loading.remove wire:target="editBalance">{{__('Submit Request')}}</span>
                                                                <span wire:loading wire:target="editBalance">{{__('Processing Request...')}}</span>
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
                    <!--end::Budget-->
                </div>
                <div class="col-md-8">
                    <div class="card h-100">
                        <div class="card-body p-9">
                            <div class="fs-2hx fw-boldest">#{{$client->merchant_id}}</div>
                            <div class="fs-6 fw-bold text-gray-800 mb-7">Merchant ID</div>
                            <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11">
                                <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                    <div class="bullet bg-info me-3"></div>
                                    <div class="text-gray-800">Email address</div>
                                    <div class="ms-auto fw-boldest text-dark">{{$client->email}} @if($client->email_verify == 1) <span class="badge badge-info badge-sm">Verified</span> @else <span class="badge badge-danger badge-sm">Unverified</span> @endif</div>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11">
                                <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                    <div class="bullet bg-info me-3"></div>
                                    <div class="text-gray-800">Mobile</div>
                                    <div class="ms-auto fw-boldest text-dark">{{$client->phone}} @if($client->phone_verify == 1) <span class="badge badge-info badge-sm">Verified</span> @else <span class="badge badge-danger badge-sm">Unverified</span> @endif</div>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11">
                                <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                    <div class="bullet bg-info me-3"></div>
                                    <div class="text-gray-800">DOB</div>
                                    <div class="ms-auto fw-boldest text-dark">{{$client->business->b_day.'/'.$client->business->b_month.'/'.$client->business->b_year}} </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11">
                                <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                    <div class="bullet bg-info me-3"></div>
                                    <div class="text-gray-800">2FA Security</div>
                                    <div class="ms-auto fw-boldest text-dark"> @if($client->fa_status == 1) <span class="badge badge-info badge-sm">Enabled</span> @else <span class="badge badge-danger badge-sm">Disabled</span> @endif</div>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11">
                                <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                    <div class="bullet bg-info me-3"></div>
                                    <div class="text-gray-800">KYC Status</div>
                                    <div class="ms-auto fw-boldest text-dark"> @if($client->business->kyc_status == 'APPROVED') <span class="badge badge-info badge-sm">APPROVED</span> @else <span class="badge badge-danger badge-sm">{{$client->business->kyc_status}}</span> @endif</div>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11">
                                <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                    <div class="bullet bg-info me-3"></div>
                                    <div class="text-gray-800">Guarantor Status</div>
                                    <div class="ms-auto fw-boldest text-dark"> @if($client->business->loan_status == 'approved') <span class="badge badge-info badge-sm">APPROVED</span> @else <span class="badge badge-danger badge-sm">{{strtoupper($client->business->loan_status)}}</span> @endif</div>
                                </div>
                            </div>
                            @if($client->business->line_1 != null)
                            <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11">
                                <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                    <div class="bullet bg-primary me-3"></div>
                                    <div class="text-gray-800">Address</div>
                                    @php $state = (isset($client->business->myState)) ? $client->business->myState->name : $client->business->state; @endphp
                                    @php $country = ($client->business->country == null) ? $client->getCountry()->name : $client->business->country; @endphp
                                    <div class="ms-auto fw-boldest text-dark"> {{$client->business->line_1.', '.$state.', '.$client->business->city.', '.$client->business->postal_code.', '.$country}}</div>
                                </div>
                            </div>
                            @endif
                            @if($client->business->line_2 != null)
                            <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11">
                                <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                    <div class="bullet bg-primary me-3"></div>
                                    <div class="text-gray-800">Address</div>
                                    @php $state = (isset($client->business->myState)) ? $client->business->myState->name : $client->business->state; @endphp
                                    @php $country = ($client->business->country == null) ? $client->getCountry()->name : $client->business->country; @endphp
                                    <div class="ms-auto fw-boldest text-dark"> {{$client->business->line_2.', '.$state.', '.$client->business->city.', '.$client->business->postal_code.', '.$country}}</div>
                                </div>
                            </div>
                            @endif
                            <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11">
                                <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                    <div class="bullet bg-info me-3"></div>
                                    <div class="text-gray-800">Source of funds</div>
                                    <div class="ms-auto fw-boldest text-dark"> {{$client->business->source_of_funds}}</div>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11">
                                <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                    <div class="bullet bg-info me-3"></div>
                                    <div class="text-gray-800">Doc Type</div>
                                    <div class="ms-auto fw-boldest text-dark"> @if($client->business->doc_type != null) {{$client->business->kyctype->title}} @endif</div>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11">
                                <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                    <div class="bullet bg-info me-3"></div>
                                    <div class="text-gray-800">Doc Number</div>
                                    <div class="ms-auto fw-boldest text-dark"> @if($client->business->doc_number != null) {{$client->business->doc_number}} @endif</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <!--begin::Budget-->
                    <div class="card h-100">
                        <div class="card-body p-9">
                            <div class="fs-2hx fw-boldest">{{number_format_short($client->loanProfit()[0]).' '.$currency->currency}}</div>
                            <div class="fs-6 fw-bold text-gray-800 mb-7">Loan Profit</div>
                            <div class="fs-6 d-flex justify-content-between my-4">
                                <div class="fw-bold">Today ({{$client->loanProfit('today')[1]}})</div>
                                <div class="d-flex fw-boldest">
                                    {{number_format_short($client->loanProfit('today')[0]).' '.$currency->currency}}
                                </div>
                            </div>
                            <div class="separator separator-dashed"></div>
                            <div class="fs-6 d-flex justify-content-between my-4">
                                <div class="fw-bold">This Week ({{$client->loanProfit('week')[1]}})</div>
                                <div class="d-flex fw-boldest">
                                    {{number_format_short($client->loanProfit('week')[0]).' '.$currency->currency}}
                                </div>
                            </div>
                            <div class="separator separator-dashed"></div>
                            <div class="fs-6 d-flex justify-content-between my-4">
                                <div class="fw-bold">This Month ({{$client->loanProfit('month')[1]}})</div>
                                <div class="d-flex fw-boldest">
                                    {{number_format_short($client->loanProfit('month')[0]).' '.$currency->currency}}
                                </div>
                            </div>
                            <div class="separator separator-dashed"></div>
                            <div class="fs-6 d-flex justify-content-between my-4">
                                <div class="fw-bold">This Year ({{$client->loanProfit('year')[1]}})</div>
                                <div class="d-flex fw-boldest">
                                    {{number_format_short($client->loanProfit('year')[0]).' '.$currency->currency}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Budget-->
                </div>
                <div class="col-lg-6">
                    <div class="card h-100">
                        <div class="card-body p-9">
                            <div class="fs-2hx fw-boldest">{{number_format_short($client->userLoan()).' '.$currency->currency}}</div>
                            <div class="fs-6 fw-bold text-gray-800 mb-7">Loan Processed</div>
                            <div class="fs-6 d-flex justify-content-between my-4">
                                <div class="fw-bold">Paid Back</div>
                                <div class="d-flex fw-boldest">
                                    {{number_format_short($client->userLoan('completed')).' '.$currency->currency}}
                                </div>
                            </div>
                            <div class="separator separator-dashed"></div>
                            <div class="fs-6 d-flex justify-content-between my-4">
                                <div class="fw-bold">Active</div>
                                <div class="d-flex fw-boldest">
                                    {{number_format_short($client->userLoan('active')).' '.$currency->currency}}
                                </div>
                            </div>
                            <div class="separator separator-dashed"></div>
                            <div class="fs-6 d-flex justify-content-between my-4">
                                <div class="fw-bold">Defaulters</div>
                                <div class="d-flex fw-boldest">
                                    {{number_format_short($client->userLoan('defaulters')).' '.$currency->currency}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <!--begin::Budget-->
                    <div class="card h-100">
                        <div class="card-body p-9">
                            <div class="fs-2hx fw-boldest">{{number_format_short($client->userCharges()[0]).' '.$currency->currency}}</div>
                            <div class="fs-6 fw-bold text-gray-800 mb-7">Charges</div>
                            <div class="fs-6 d-flex justify-content-between my-4">
                                <div class="fw-bold">Deposit ({{$client->userCharges('deposit')[1]}})</div>
                                <div class="d-flex fw-boldest">
                                    {{number_format_short($client->userCharges('deposit')[0]).' '.$currency->currency}}
                                </div>
                            </div>
                            <div class="separator separator-dashed"></div>
                            <div class="fs-6 d-flex justify-content-between my-4">
                                <div class="fw-bold">Payout ({{$client->userCharges('payout')[1]}})</div>
                                <div class="d-flex fw-boldest">
                                    {{number_format_short($client->userCharges('payout')[0]).' '.$currency->currency}}
                                </div>
                            </div>
                            <div class="separator separator-dashed"></div>
                            <div class="fs-6 d-flex justify-content-between my-4">
                                <div class="fw-bold">Unit Sale ({{$client->userCharges('unit_sale')[1]}})</div>
                                <div class="d-flex fw-boldest">
                                    {{number_format_short($client->userCharges('unit_sale')[0]).' '.$currency->currency}}
                                </div>
                            </div>
                            <div class="separator separator-dashed"></div>
                            <div class="fs-6 d-flex justify-content-between my-4">
                                <div class="fw-bold">Purchased Units ({{$client->userCharges('unit_purchase')[1]}})</div>
                                <div class="d-flex fw-boldest">
                                    {{number_format_short($client->userCharges('unit_purchase')[0]).' '.$currency->currency}}
                                </div>
                            </div>
                            <div class="separator separator-dashed"></div>
                            <div class="fs-6 d-flex justify-content-between my-4">
                                <div class="fw-bold">Today ({{$client->userCharges(null, 'today')[1]}})</div>
                                <div class="d-flex fw-boldest">
                                    {{number_format_short($client->userCharges(null, 'today')[0]).' '.$currency->currency}}
                                </div>
                            </div>
                            <div class="separator separator-dashed"></div>
                            <div class="fs-6 d-flex justify-content-between my-4">
                                <div class="fw-bold">This Week ({{$client->userCharges(null, 'week')[1]}})</div>
                                <div class="d-flex fw-boldest">
                                    {{number_format_short($client->userCharges(null, 'week')[0]).' '.$currency->currency}}
                                </div>
                            </div>
                            <div class="separator separator-dashed"></div>
                            <div class="fs-6 d-flex justify-content-between my-4">
                                <div class="fw-bold">This Month ({{$client->userCharges(null, 'month')[1]}})</div>
                                <div class="d-flex fw-boldest">
                                    {{number_format_short($client->userCharges(null, 'month')[0]).' '.$currency->currency}}
                                </div>
                            </div>
                            <div class="separator separator-dashed"></div>
                            <div class="fs-6 d-flex justify-content-between my-4">
                                <div class="fw-bold">This Year ({{$client->userCharges(null, 'year')[1]}})</div>
                                <div class="d-flex fw-boldest">
                                    {{number_format_short($client->userCharges(null, 'year')[0]).' '.$currency->currency}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Budget-->
                </div>
                <div class="col-md-12">
                    <div class="card h-100">
                        <div class="card-body p-9">
                            <div class="fs-2 fw-boldest mb-6">Next of Kin</div>
                            <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11">
                                <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                    <div class="bullet bg-info me-3"></div>
                                    <div class="text-gray-800">Name</div>
                                    <div class="ms-auto fw-boldest text-dark">{{$client->business->kin_first_name.' '.$client->business->kin_last_name}} </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11">
                                <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                    <div class="bullet bg-info me-3"></div>
                                    <div class="text-gray-800">Mobile</div>
                                    <div class="ms-auto fw-boldest text-dark">{{$client->business->kin_mobile}} </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11">
                                <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                    <div class="bullet bg-info me-3"></div>
                                    <div class="text-gray-800">Email address</div>
                                    <div class="ms-auto fw-boldest text-dark">{{$client->business->kin_email}} </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11">
                                <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                    <div class="bullet bg-info me-3"></div>
                                    <div class="text-gray-800">Address</div>
                                    <div class="ms-auto fw-boldest text-dark">{{$client->business->kin_address}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card h-100">
                        <div class="card-body p-9">
                            <div class="row mb-6">
                                <div class="col-md-6">
                                    <p class="fs-2 fw-boldest">Guarantor Information</p>
                                    @if($client->business->g_expiry)<p class="fs-4">ID Expires: {{$client->business->g_expiry->format('M j, Y')}}</p>@endif
                                </div>
                                <div class="col-md-6 text-end">
                                    @if($client->business->loan_status == 'processing')
                                    <a class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#approve-Guarantor"><i class="fal fa-check"></i> {{__('Approve')}}</a>
                                    <div wire:ignore.self class="modal fade" id="approve-Guarantor" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="mb-0">{{__('Provide ID Expiry Date')}}</h3>
                                                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                        <span class="svg-icon svg-icon-1">
                                                            <i class="fal fa-times"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <form wire:submit.prevent="approveGuarantor" method="post">
                                                        <div class="form-group mb-6">
                                                            <input type="date" wire:model.defer="g_expiry" class="form-control form-control-lg form-control-solid" rows="5" placeholder="{{__('Provide ID expiry date')}}" required>
                                                            @error('g_expiry')
                                                            {{$message}}
                                                            @enderror
                                                        </div>
                                                        <div class="text-right">
                                                            <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2" id="filepond-upload">
                                                                <span wire:loading.remove wire:target="approveGuarantor">{{__('Submit')}}</span>
                                                                <span wire:loading wire:target="approveGuarantor">{{__('Processing Request...')}}</span>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if($client->business->loan_status == 'processing' || $client->business->loan_status == 'approved')
                                    <a class='btn btn-sm btn-danger' data-bs-toggle="modal" data-bs-target="#decline-guarantor"><i class="fal fa-ban"></i> {{__('Resubmit Guarantor')}}</a>
                                    <div class="modal fade" id="decline-guarantor" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="mb-0">{{__('Decline')}}</h3>
                                                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                        <span class="svg-icon svg-icon-1">
                                                            <i class="fal fa-times"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <form wire:submit.prevent="declineGuarantor" method="post">
                                                        <div class="form-group mb-6">
                                                            <textarea type="text" wire:model.defer="guarantor_reason" class="form-control form-control-lg form-control-solid" rows="5" placeholder="{{__('Provide Reason')}}" required></textarea>
                                                            @error('guarantor_reason')
                                                            {{$message}}
                                                            @enderror
                                                        </div>
                                                        <div class="text-right">
                                                            <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2" id="filepond-upload">
                                                                <span wire:loading.remove wire:target="declineKYC">{{__('Submit')}}</span>
                                                                <span wire:loading wire:target="declineKYC">{{__('Processing Request...')}}</span>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11">
                                <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                    <div class="bullet bg-info me-3"></div>
                                    <div class="text-gray-800">Name</div>
                                    <div class="ms-auto fw-boldest text-dark">{{$client->business->g_first_name.' '.$client->business->g_last_name}} </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11">
                                <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                    <div class="bullet bg-info me-3"></div>
                                    <div class="text-gray-800">Mobile</div>
                                    <div class="ms-auto fw-boldest text-dark">{{$client->business->g_mobile}} </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11">
                                <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                    <div class="bullet bg-info me-3"></div>
                                    <div class="text-gray-800">Email address</div>
                                    <div class="ms-auto fw-boldest text-dark">{{$client->business->g_email}} </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11">
                                <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                    <div class="bullet bg-info me-3"></div>
                                    <div class="text-gray-800">Address</div>
                                    <div class="ms-auto fw-boldest text-dark">{{$client->business->g_address}}</div>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11">
                                <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                    <div class="bullet bg-info me-3"></div>
                                    <div class="text-gray-800">Doc Type</div>
                                    <div class="ms-auto fw-boldest text-dark"> @if($client->business->g_doc_type != null) {{$client->business->gkyctype->title}} @endif</div>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11">
                                <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                    <div class="bullet bg-info me-3"></div>
                                    <div class="text-gray-800">Doc Number</div>
                                    <div class="ms-auto fw-boldest text-dark"> @if($client->business->g_doc_number != null) {{$client->business->g_doc_number}} @endif</div>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11">
                                <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                    <div class="bullet bg-info me-3"></div>
                                    <div class="text-gray-800">Last Review</div>
                                    <div class="ms-auto fw-boldest text-dark"> {{$client->business->decline_reason}}</div>
                                </div>
                            </div>
                            @if($client->business->g_doc_front)
                            <div class="overflow-auto pb-5 cursor-pointer" data-bs-toggle="modal" data-bs-target="#g_doc_front_modal">
                                <div class="d-flex align-items-center border border-dashed border-gray-400 rounded p-2 mt-1">
                                    <p class="text-dark me-2 mb-0"><i class="fal fa-file-alt fs-3"></i> ID Document Front</p>
                                </div>
                            </div>
                            <div class="modal fade" id="g_doc_front_modal" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="mb-0 fw-bold">{{__('Document Front')}}</h3>
                                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                <span class="svg-icon svg-icon-1">
                                                    <i class="fal fa-times"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <div class="text-center">
                                                <img src="{{url('/').'/storage/app/'.$client->business->g_doc_front}}" style="max-width:100%; height:auto;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if($client->business->g_doc_back)
                            <div class="overflow-auto pb-5 cursor-pointer" data-bs-toggle="modal" data-bs-target="#g_doc_back_modal">
                                <div class="d-flex align-items-center border border-dashed border-gray-400 rounded p-2 mt-1">
                                    <p class="text-dark me-2 mb-0"><i class="fal fa-file-alt fs-3"></i> ID Document Back</p>
                                </div>
                            </div>
                            <div class="modal fade" id="g_doc_back_modal" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="mb-0 fw-bold">{{__('Document Back')}}</h3>
                                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                <span class="svg-icon svg-icon-1">
                                                    <i class="fal fa-times"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <div class="text-center">
                                                <img src="{{url('/').'/storage/app/'.$client->business->g_doc_back}}" style="max-width:100%; height:auto;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if($client->business->g_proof_of_address)
                            <div class="overflow-auto pb-5 cursor-pointer" data-bs-toggle="modal" data-bs-target="#g_proof_of_address_modal">
                                <div class="d-flex align-items-center border border-dashed border-gray-400 rounded p-2 mt-1">
                                    <p class="text-dark me-2 mb-0"><i class="fal fa-file-alt fs-3"></i> Proof of address</p>
                                </div>
                            </div>
                            <div class="modal fade" id="g_proof_of_address_modal" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="mb-0 fw-bold">{{__('Proof of Address')}}</h3>
                                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                <span class="svg-icon svg-icon-1">
                                                    <i class="fal fa-times"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <div class="text-center">
                                                <img src="{{url('/').'/storage/app/'.$client->business->g_proof_of_address}}" style="max-width:100%; height:auto;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @if($client->business->kyc_status != 'PENDING')
                <div class="col-md-12">
                    <div class="card h-100">
                        <div class="card-body p-9">
                            <div class="row mb-6">
                                <div class="col-md-6">
                                    <p class="fs-2 fw-boldest">{{__('KYC Documents')}}</p>
                                    @if($client->business->kyc_expiry)<p class="fs-4">ID Expires: {{$client->business->kyc_expiry->format('M j, Y')}}</p>@endif
                                </div>
                                <div class="col-md-6 text-end">
                                    @if($client->business->kyc_status == 'PROCESSING')
                                    <a class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#approve-kyc"><i class="fal fa-check"></i> {{__('Approve')}}</a>
                                    <div wire:ignore.self class="modal fade" id="approve-kyc" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="mb-0">{{__('Provide ID Expiry Date')}}</h3>
                                                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                        <span class="svg-icon svg-icon-1">
                                                            <i class="fal fa-times"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <form wire:submit.prevent="approveKYC" method="post">
                                                        <div class="form-group mb-6">
                                                            <input type="date" wire:model.defer="kyc_expiry" class="form-control form-control-lg form-control-solid" rows="5" placeholder="{{__('Provide ID expiry date')}}" required>
                                                            @error('kyc_expiry')
                                                            {{$message}}
                                                            @enderror
                                                        </div>
                                                        <div class="text-right">
                                                            <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2" id="filepond-upload">
                                                                <span wire:loading.remove wire:target="approveKYC">{{__('Submit')}}</span>
                                                                <span wire:loading wire:target="approveKYC">{{__('Processing Request...')}}</span>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if($client->business->kyc_status == 'APPROVED' || $client->business->kyc_status == 'PROCESSING')
                                    <a class='btn btn-sm btn-danger' data-bs-toggle="modal" data-bs-target="#decline-kyc"><i class="fal fa-ban"></i> {{__('Resubmit Compliance')}}</a>
                                    <div wire:ignore.self class="modal fade" id="decline-kyc" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="mb-0">{{__('Decline')}}</h3>
                                                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                        <span class="svg-icon svg-icon-1">
                                                            <i class="fal fa-times"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <form wire:submit.prevent="declineKYC" method="post">
                                                        <div class="form-group mb-6">
                                                            <textarea type="text" wire:model.defer="reason" class="form-control form-control-lg form-control-solid" rows="5" placeholder="{{__('Provide Reason')}}" required></textarea>
                                                            @error('reason')
                                                            {{$message}}
                                                            @enderror
                                                        </div>
                                                        <div class="text-right">
                                                            <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2" id="filepond-upload">
                                                                <span wire:loading.remove wire:target="declineKYC">{{__('Submit')}}</span>
                                                                <span wire:loading wire:target="declineKYC">{{__('Processing Request...')}}</span>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="overflow-auto pb-5 cursor-pointer" data-bs-toggle="modal" data-bs-target="#doc_front_modal">
                                <div class="d-flex align-items-center border border-dashed border-gray-400 rounded p-2 mt-1">
                                    <p class="text-dark me-2 mb-0"><i class="fal fa-file-alt fs-3"></i> ID Document Front</p>
                                </div>
                            </div>
                            <div class="modal fade" id="doc_front_modal" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="mb-0 fw-bold">{{__('Document Front')}}</h3>
                                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                <span class="svg-icon svg-icon-1">
                                                    <i class="fal fa-times"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <div class="text-center">
                                                <img src="{{url('/').'/storage/app/'.$client->business->doc_front}}" style="max-width:100%; height:auto;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="overflow-auto pb-5 cursor-pointer" data-bs-toggle="modal" data-bs-target="#doc_back_modal">
                                <div class="d-flex align-items-center border border-dashed border-gray-400 rounded p-2 mt-1">
                                    <p class="text-dark me-2 mb-0"><i class="fal fa-file-alt fs-3"></i> ID Document Back</p>
                                </div>
                            </div>
                            <div class="modal fade" id="doc_back_modal" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="mb-0 fw-bold">{{__('Document Back')}}</h3>
                                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                <span class="svg-icon svg-icon-1">
                                                    <i class="fal fa-times"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <div class="text-center">
                                                <img src="{{url('/').'/storage/app/'.$client->business->doc_back}}" style="max-width:100%; height:auto;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="overflow-auto pb-5 cursor-pointer" data-bs-toggle="modal" data-bs-target="#proof_of_address_modal">
                                <div class="d-flex align-items-center border border-dashed border-gray-400 rounded p-2 mt-1">
                                    <p class="text-dark me-2 mb-0"><i class="fal fa-file-alt fs-3"></i> Proof of address</p>
                                </div>
                            </div>
                            <div class="modal fade" id="proof_of_address_modal" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="mb-0 fw-bold">{{__('Proof of Address')}}</h3>
                                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                <span class="svg-icon svg-icon-1">
                                                    <i class="fal fa-times"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <div class="text-center">
                                                <img src="{{url('/').'/storage/app/'.$client->business->proof_of_address}}" style="max-width:100%; height:auto;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="overflow-auto pb-5 cursor-pointer" data-bs-toggle="modal" data-bs-target="#selfie_modal">
                                <div class="d-flex align-items-center border border-dashed border-gray-400 rounded p-2 mt-1">
                                    <p class="text-dark me-2 mb-0"><i class="fal fa-file-alt fs-3"></i> Selfie</p>
                                </div>
                            </div>
                            <div class="modal fade" id="selfie_modal" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="mb-0 fw-bold">{{__('Selfie')}}</h3>
                                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                <span class="svg-icon svg-icon-1">
                                                    <i class="fal fa-times"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <div class="text-center">
                                                <img src="{{url('/').'/storage/app/'.$client->business->selfie}}" style="max-width:100%; height:auto;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($client->business->financial_statement)
                            <a href="{{url('/').'/storage/app/'.$client->business->financial_statement}}" class="text-gray-400">
                                <div class="overflow-auto pb-5 cursor-pointer">
                                    <div class="d-flex align-items-center border border-dashed border-gray-400 rounded p-2 mt-1">
                                        <p class="text-dark me-2 mb-0"><i class="fal fa-file-alt fs-3"></i> Financial Statement</p>
                                    </div>
                                </div>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>