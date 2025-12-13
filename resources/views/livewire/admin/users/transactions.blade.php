<div>
    <div wire:ignore.self id="kt_filter" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_filter_button" data-kt-drawer-close="#kt_filter_close" data-kt-drawer-width="{'md': '500px'}">
        <div class="card w-100">
            <div class="card-header pe-5 border-0">
                <div class="card-title">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Filter')}}</div>
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_filter_close">
                        <span class="svg-icon svg-icon-2">
                            <i class="fal fa-times"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body text-wrap">
                <div class="fv-row mb-6">
                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Date Range')}}</label>
                    <input class="form-control form-control-lg form-control-solid" placeholder="{{__('Pick date rage')}}" value="{{$first.' - '.$last}}" name="date" id="range" onchange="this.dispatchEvent(new InputEvent('input'))" wire:model="date">
                </div>
                <div class="fv-row mb-6">
                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Type')}}</label>
                    <select class="form-select form-select-solid" wire:model="base">
                        <option value="">{{__('Select type')}}</option>
                        <option value="bank_transfer">{{__('Bank Transfer')}}</option>
                        <option value="investment_fee">{{__('Investment Fee')}}</option>
                        <option value="investment_returns">{{__('Investment Returns')}}</option>
                        <option value="debit_transfer">{{__('Debit Transfer')}}</option>
                        <option value="credit_transfer">{{__('Credit Transfer')}}</option>
                        <option value="unit_purchase">{{__('Unit Purchase')}}</option>
                        <option value="unit_sale">{{__('Unit Sale')}}</option>
                        <option value="loan_payment">{{__('Loan Payment')}}</option>
                        <option value="deposit">{{__('Deposit')}}</option>
                        <option value="payout">{{__('Payout')}}</option>
                    </select>
                </div>
                <div class="fv-row mb-6">
                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Status')}}</label>
                    <select class="form-select form-select-solid" wire:model="status">
                        <option value="">{{__('Select status')}}</option>
                        <option value="success">{{__('Completed')}}</option>
                        <option value="pending">{{__('Pending')}}</option>
                        <option value="failed">{{__('Failed/Cancelled')}}</option>
                        <option value="declined">{{__('Declined')}}</option>
                    </select>
                </div>
                <div class="fv-row mb-6">
                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Credit / Debit')}}</label>
                    <select class="form-select form-select-solid" wire:model="trx_type">
                        <option value="">{{__('Select type')}}</option>
                        <option value="credit">{{__('Credit')}}</option>
                        <option value="debit">{{__('Debit')}}</option>
                    </select>
                </div>
                <div class="fv-row mb-6">
                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Sort by')}}</label>
                    <select class="form-select form-select-solid" wire:model="sortBy">
                        <option value="created_at">{{__('Date')}}</option>
                        <option value="amount">{{__('Amount')}}</option>
                    </select>
                </div>
                <div class="fv-row mb-6">
                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Order by')}}</label>
                    <select class="form-select form-select-solid" wire:model="orderBy">
                        <option value="asc">{{__('ASC')}}</option>
                        <option value="desc">{{__('DESC')}}</option>
                    </select>
                </div>
                <div class="fv-row mb-6">
                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Per page')}}</label>
                    <select class="form-select form-select-solid" wire:model="perPage">
                        <option value="10">{{__('10')}}</option>
                        <option value="25">{{__('25')}}</option>
                        <option value="50">{{__('50')}}</option>
                        <option value="100">{{__('100')}}</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
        <div class="container">
            <div class="row g-xl-8">
                <div class="col-md-6">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <div class="col-md-12">
                            <div class="input-group input-group-solid mb-5 rounded-4">
                                <span class="input-group-text" id="basic-addon1"><i class="fal fa-search"></i></span>
                                <input type="search" class="form-control form-control-solid text-dark" wire:model="search" placeholder="{{__('Transaction reference')}}" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <button id="kt_filter_button" class="btn btn-white text-dark me-4"><i class="fal fa-filter-list"></i> {{__('Filter')}}</button>
                    <button data-bs-toggle="modal" data-bs-target="#export" class="btn btn-dark"><i class="fal fa-file-export"></i> {{__('Export')}}</button>
                </div>
            </div>
            <div wire:ignore.self class="modal fade" id="export" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">{{__('Export Transactions')}}</h3>
                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <span class="svg-icon svg-icon-1">
                                    <i class="fal fa-times"></i>
                                </span>
                            </div>
                        </div>
                        <form wire:submit.prevent="save(Object.fromEntries(new FormData($event.target)))">
                            <div class="modal-body">
                                @csrf
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('File Format')}}</label>
                                    <select class="form-select form-select-solid" name="exportType" required>
                                        <option value="">{{__('Select file type')}}</option>
                                        <option value="csv">{{__('CSV')}}</option>
                                        <option value="excel">{{__('Excel')}}</option>
                                    </select>
                                </div>
                                @error('exportType')<span class="form-text">{{ $message }}</span>@enderror
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Export as')}}</label>
                                    <select class="form-select form-select-solid" name="exportAs" required>
                                        <option value="">{{__('How do you want to receive this file?')}}</option>
                                        <option value="download">{{__('Download file')}}</option>
                                        <option value="email">{{__('Send file to email')}}</option>
                                    </select>
                                </div>
                                @error('exportAs')<span class="form-text">{{ $message }}</span>@enderror
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-block btn-info" type="submit"><i class="fal fa-file-export"></i>
                                    <span wire:loading.remove wire:target="save">{{__('Export')}}</span>
                                    <span wire:loading wire:target="save">{{__('Exporting file...')}}</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @if($transactions->count() > 0)
            <div class="" wire:loading.class.delay="opacity-50" wire:target="search, status, orderBy, perPage, date, loadMore">
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-bordered table-row-gray-300 gy-5 gs-7" id="kt_datatable_example_5">
                            <thead>
                                <tr class="text-start text-dark fw-bolder fs-7 text-uppercase px-7">
                                    <th></th>
                                    <th class="min-w-150px">{{__('Amount')}}</th>
                                    <th class="min-w-150px">{{__('Fee')}}</th>
                                    <th class="min-w-150px">{{__('Type')}}</th>
                                    <th class="min-w-50px">{{__('Status')}}</th>
                                    <th class="min-w-50px">{{__('Reference ID')}}</th>
                                    <th class="min-w-200px">{{__('Created')}}</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <tbody class="fw-semibold text-dark fs-6">
                                @foreach($transactions as $k=>$val)
                                <tr class="cursor-pointer" id="kt_trx_{{$val->id}}_button">
                                    <td>
                                        <div class="symbol symbol-40px symbol-circle me-5">
                                            <div class="symbol-label fs-3 fw-bolder text-dark">
                                                @if($val->trx_type == 'debit')
                                                <i class="fal fa-minus"></i>
                                                @else
                                                <i class="fal fa-plus"></i>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{$currency->currency_symbol.currencyFormat(number_format($val->amount, 2)).' '.$currency->currency}}</td>
                                    <td>{{$currency->currency_symbol.currencyFormat(number_format($val->charge, 2)).' '.$currency->currency}}</td>
                                    <td>{{ucwords(str_replace('_', ' ', $val->type))}}</td>
                                    <td><span class="badge badge-pill badge-secondary badge-sm">{{ucwords($val->status)}}</span></td>
                                    <td>{{$val->ref_id}}</td>
                                    <td>{{$val->created_at->toDayDateTimeString()}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if($transactions->total() > 0 && $transactions->count() < $transactions->total())<button wire:click="loadMore" wire:loading.remove class="btn btn-secondary btn-block">See more</button>@endif
                    </div>
                </div>
            </div>
            @else
            <div class="text-center mt-20">
                <img src="{{asset('asset/images/transactions.png')}}" style="height:auto; max-width:150px;" class="mb-6">
                <h3 class="text-dark">{{__('No Transactions Found')}}</h3>
                <p class="text-dark">{{__('We couldn\'t find any transactions to this account')}}</p>
            </div>
            @endif
        </div>
        @foreach($transactions as $val)
        <livewire:admin.users.trx-details :val=$val :admin=$admin :wire:key="'kt_trx_'. $val->id">
            @endforeach
    </div>
</div>