<!-- Back Button -->
<button wire:click="resetTransferType" class="btn btn-sm btn-light mb-4">
    <i class="fas fa-arrow-left me-2"></i> {{__('Back')}}
</button>

<div class="btn-wrapper text-center mb-3">
    <div class="symbol symbol-60px symbol-circle me-5 mb-6">
        <div class="symbol-label fs-1 text-dark bg-light-primary">
            <i class="fas fa-users fa-2x text-primary"></i>
        </div>
    </div>
    <p class="text-dark fs-6">{{__('Internal Transfer - Send to ').$set->site_name.__(' users')}}</p>
</div>

@if(!$transfer_confirmed)
<!-- Step 1: Account Verification -->
<form class="form w-100 mb-10" wire:submit.prevent="verifyAccount" method="post">
    @error('account_error')
    <div class="alert alert-danger">
        <span>{{$message}}</span>
    </div>
    @enderror
    
    <div class="fv-row mb-6">
        <label class="form-label fs-6 fw-bolder text-dark">{{__('Account Number / Merchant ID')}}</label>
        <input class="form-control form-control-lg form-control-solid @error('account_number') is-invalid @enderror" 
               type="text" 
               wire:model.defer="account_number" 
               placeholder="{{__('Enter account number or @merchantID')}}" 
               required />
        @error('account_number')
        <span class="form-text text-danger">{{$message}}</span>
        @enderror
    </div>
    
    <div class="text-center mt-10">
        <button type="submit" class="btn btn-lg btn-primary btn-block fw-bolder">
            <span wire:loading.remove wire:target="verifyAccount">{{__('Verify Account')}}</span>
            <span wire:loading wire:target="verifyAccount">{{__('Verifying...')}}</span>
        </button>
    </div>
</form>

@else
<!-- Step 2: Confirmed - Enter Amount -->
<div class="card bg-light-success mb-6">
    <div class="card-body p-4">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <div class="symbol symbol-50px me-3">
                    <div class="symbol-label bg-success text-white">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
                <div>
                    <p class="fw-bold mb-0 text-dark">{{$recipient_name}}</p>
                    <p class="text-muted small mb-0">Account: {{$account_number}}</p>
                </div>
            </div>
            <button wire:click="resetTransferType" class="btn btn-sm btn-light-danger">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
</div>

<form class="form w-100" wire:submit.prevent="transferInternal" method="post">
    @error('transfer_error')
    <div class="alert alert-danger">
        <span>{{$message}}</span>
    </div>
    @enderror
    
    <div class="fv-row mb-6">
        <label class="form-label fs-6 fw-bolder text-dark">{{__('Amount')}}</label>
        <div class="input-group">
            <span class="input-group-text fs-2">{{$currency->currency_symbol}}</span>
            <input class="form-control form-control-lg form-control-solid fs-2 fw-bold" 
                   type="text" 
                   wire:model.defer="transfer_amount" 
                   placeholder="0.00" 
                   required />
        </div>
        @error('transfer_amount')
        <span class="form-text text-danger">{{$message}}</span>
        @enderror
    </div>
    
    <div class="fv-row mb-6">
        <label class="form-label fs-6 fw-bolder text-dark">{{__('Transfer PIN')}}</label>
        <input wire:model.defer="transfer_pin" 
               type="password" 
               minlength="4" 
               maxlength="6" 
               pattern="[0-9]+" 
               class="form-control form-control-lg form-control-solid" 
               required>
        @error('transfer_pin')
        <span class="form-text text-danger">{{$message}}</span>
        @enderror
    </div>
    
    <div class="text-center mt-10">
        <button type="submit" class="btn btn-lg btn-success btn-block fw-bolder">
            <span wire:loading.remove wire:target="transferInternal">
                <i class="fas fa-paper-plane me-2"></i>{{__('Send Money')}}
            </span>
            <span wire:loading wire:target="transferInternal">{{__('Processing...')}}</span>
        </button>
    </div>
</form>
@endif