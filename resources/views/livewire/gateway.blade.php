<div>
    <div wire:ignore.self class="modal fade" id="gateway_deposit{{$gateway->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">{{$gateway->name}}</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="fal fa-times"></i>
                        </span>
                    </div>
                </div>
                <form wire:submit.prevent="gateway">
                    <div class="modal-body">
                        @csrf
                        <div class="fv-row mb-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text border-0 fs-2">{{$currency->currency_symbol}}</span>
                                <input class="form-control form-control-lg form-control-solid fs-2 fw-bold @error('amount') is-invalid @enderror" type="text" step="any" wire:model.defer="amount" autocomplete="transaction-amount" id="amount" min="1" max="{{$user->getFirstBalance()->amount}}" value="{{old('amount')}}" required placeholder="{{__('0.00')}}" autofocus/>
                                <span class="input-group-text border-0"><span class="fi fi-{{strtolower($currency->iso2)}} fis rounded-4 me-3 fs-1"></span></span>
                            </div>
                            @error('amount')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        @if($gateway->type==1)
                        @if($gateway->val1)
                        <div class="fv-row mb-6 form-floating">
                            <input class="form-control form-control-lg form-control-solid fs-2 fw-bold @error('details') is-invalid @enderror" type="text" wire:model.defer="details" required id="details" />
                            <label class="form-label fs-6 fw-bolder text-dark" for="details">{{$gateway->val1}}</label>
                            @error('details')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        @endif
                        <div class="fv-row mb-6">
                            <label class="form-label fs-6 text-dark">{{__('Proof of payment')}}</label>
                            <input class="form-control form-control-lg form-control-solid" type="file" wire:model="image" required/>
                            @error('image')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        @if($gateway->instructions || $gateway->crypto=1)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="bg-light px-6 py-5 mb-10 rounded text-wrap" wire:ignore style="overflow-wrap: break-word;">
                                    @if($gateway->instructions)
                                    <li class="align-items-center py-1">
                                        <span>{{__('Instructions')}}: {{$gateway->instructions}}</span>
                                    </li>
                                    @endif
                                    @if($gateway->crypto=1)
                                    <li class="align-items-center py-1">
                                        <span>{{__('Wallet address')}}: {{$gateway->val2}} <i class="fal fa-clone castro-copy fs-5" data-clipboard-text="{{$gateway->val2}}" title="Copy"></i></span>
                                    </li>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-block btn-info" type="submit">
                            <span wire:loading.remove wire:target="gateway">{{__('Fund account')}}</span>
                            <span wire:loading wire:target="gateway">{{__('Submitting request...')}}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>