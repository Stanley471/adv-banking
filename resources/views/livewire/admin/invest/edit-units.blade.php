<div>
    <form class="form w-100 mb-10" wire:submit.prevent="update" method="post">
        <div class="row mb-6">
            <label class="col-form-label">{{$val->date->toDateString()}}</label>
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-text border-0">{{$currency->currency_symbol}}</span>
                    <input class="form-control form-control-lg form-control-solid" type="number" step="any" wire:model.defer="val.amount" required placeholder="Unit price" />
                </div>
                @error('val.amount')
                <span class="form-text text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-lg btn-info fw-bolder me-3">
                    <span wire:loading.remove wire:target="update">{{__('Update')}}</span>
                    <span wire:loading wire:target="update">{{__('Updating...')}}</span>
                </button>
            </div>
        </div>
    </form>
</div>