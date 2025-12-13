<div>
    <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
        <div class="container">
            <div class="row g-6 g-xl-9">
                <div class="col-md-4">
                    <div class="card h-100 mb-6">
                        <div class="card-body p-9">
                            <div class="row mb-10">
                                <div class="col-md-12">
                                    <div class="fs-3 fw-boldest">Statistics</div>
                                </div>
                            </div>
                            <div class="fs-6 d-flex justify-content-between mb-4">
                                <div class="fw-bold">Active</div>
                                <div class="d-flex fw-boldest">
                                    {{number_format_short($admin->savings('active', 'emergency')->sum('amount')).' '.$currency->currency}} [{{$admin->savings('active', 'emergency')->count()}}]
                                </div>
                            </div>
                            <div class="separator separator-dashed"></div>
                            <div class="fs-6 d-flex justify-content-between my-4">
                                <div class="fw-bold">Processed Returns</div>
                                <div class="d-flex fw-boldest">
                                    {{number_format_short($admin->totalSavingsReturn('emergency', 'paid')->sum('amount')).' '.$currency->currency}}
                                </div>
                            </div>
                            <div class="d-flex mt-10">
                                <a id="kt_active_button" class="btn btn-info btn-sm me-3">All Plans</a>
                                <div wire:ignore.self id="kt_active_money" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_active_button" data-kt-drawer-close="#kt_active_close" data-kt-drawer-width="{'md': '700px'}">
                                    <div class="card w-100">
                                        <div class="card-header pe-5 border-0">
                                            <div class="card-title">
                                                <div class="d-flex justify-content-center flex-column me-3">
                                                    <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Emergency Savings')}}</div>
                                                </div>
                                            </div>
                                            <div class="card-toolbar">
                                                <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_active_close">
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
                                                        <i class="fal fa-sync fa-2x text-info"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pb-5 mt-10 position-relative zindex-1">
                                                <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                                                    <div class="input-group input-group-solid mb-5 rounded-4">
                                                        <span class="input-group-text" id="basic-addon1"><i class="fal fa-search"></i></span>
                                                        <input type="search" class="form-control form-control-solid text-dark" wire:model="search" placeholder="{{__('Search plans')}}" />
                                                    </div>
                                                </div>
                                                <div class="row mb-6">
                                                    <div class="col-6">
                                                        <select class="form-select form-select-solid" wire:model="sortBy">
                                                            <option value="created_at">{{__('Date')}}</option>
                                                            <option value="amount">{{__('Amount')}}</option>
                                                            <option value="name">{{__('Name')}}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <select class="form-select form-select-solid" wire:model="orderBy">
                                                            <option value="asc">{{__('ASC')}}</option>
                                                            <option value="desc">{{__('DESC')}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                @forelse($plans as $val)
                                                <div class="d-flex flex-stack mb-6 bg-light p-3 rounded-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="symbol symbol-40px symbol-circle" data-bs-toggle="tooltip">
                                                            <span class="symbol-label bg-info text-inverse-info fw-boldest"><i class="fal fa-layer-group"></i></span>
                                                        </div>
                                                        <div class="ps-2">
                                                            <p class="fs-6 text-dark fw-bolder mb-0">{{$val->name}}</p>
                                                            <p class="fs-6 text-dark mb-0">{{$val->user->business->name}}</p>
                                                            <p class="fs-6 text-info mb-0">{{$currency->currency_symbol.currencyFormat(number_format($val->amount, 2)).' '.$currency->currency}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <a href="{{route('admin.save.manage', ['plan' => $val->id])}}" class="btn btn-sm btn-light-info me-3"><i class="fal fa-check-circle"></i> {{__('Manage')}}</a>
                                                    </div>
                                                </div>
                                                @empty
                                                <p class="text-gray-600 text-center">{{__('No Plans')}}</p>
                                                @endforelse
                                                @if($plans->count())
                                                @if($plans->total() > 0 && $plans->count() < $plans->total())<button wire:click="loadMore" wire:loading.remove class="btn btn-secondary btn-block">See more</button>@endif
                                                    @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card h-100 mb-10">
                        <div class="card-body">
                            <form wire:submit.prevent="save" method="post">
                                @csrf
                                <div class="fv-row mb-6" wire:ignore>
                                    <label class="col-form-label">{{__('Suggested amount')}}</label>
                                    <input type="text" wire:model="ega" id="ega" class="form-control form-control-lg form-control-solid" placeholder="Suggested amount">
                                    <span class="form-text">This is suggested amount for users to save, but they can save any amount.</span>
                                </div>
                                @error('ega')
                                <span class="form-text text-danger mb-6">{{$message}}</span>
                                @enderror
                                <div class="fv-row mb-6">
                                    <label class="col-form-label">{{__('Minimum amount')}}</label>
                                    <div class="input-group">
                                        <span class="input-group-text border-0">{{$currency->currency_symbol}}</span>
                                        <input type="number" wire:model.defer="min_ega" steps="any" class="form-control form-control-lg form-control-solid" required placeholder="0.00">
                                    </div>
                                    @error('min_ega')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="col-form-label">{{__('Interest per annum')}}</label>
                                    <div class="input-group">
                                        <input type="number" steps="any" wire:model.defer="egi" steps="any" class="form-control form-control-lg form-control-solid" placeholder="0.00">
                                        <span class="input-group-text border-0">%</span>
                                    </div>
                                    @error('egi')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-check form-check-custom form-check-solid mb-6">
                                    <input class="form-check-input" type="checkbox" id="flexCheckDefault" wire:model.defer="egg" />
                                    <label class="form-check-label" for="flexCheckDefault">{{__('Restrict interest earning to user reaching their goals')}}</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid mb-6">
                                    <input class="form-check-input" type="checkbox" id="flexCheckDefault" wire:model.defer="ess" />
                                    <label class="form-check-label" for="flexCheckDefault">{{__('Active')}}</label>
                                </div>
                                <div class="text-start">
                                    <button type="submit" class="btn btn-lg btn-info fw-bolder me-3 my-2 mb-3">
                                        <span wire:loading.remove wire:target="save">{{__('Update Emergency Savings')}}</span>
                                        <span wire:loading wire:target="save">{{__('Processing Request...')}}</span>
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
@push('scripts')
<script>
    document.addEventListener('livewire:load', function() {
        var input = document.querySelector("#ega");
        new Tagify(input, {
            pattern: /[0-9]/,
            minTags: 2,
            maxTags: 5,
            duplicates: true
        });
        input.addEventListener('change', onChange)

        function onChange(e) {
            @this.set('ega', e.target.value);
        }
    });
</script>
@endpush