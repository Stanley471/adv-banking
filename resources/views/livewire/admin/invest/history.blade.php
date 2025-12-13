<div>
    @include('admin.invest.header-mutual', ['plan' => $val, 'type' => $type])
    <div wire:ignore.self class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">{{__('Filter Status')}}</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="fal fa-times"></i>
                        </span>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="fv-row mb-6">
                        <label class="form-label fs-6 fw-bolder text-dark">{{__('Sort by')}}</label>
                        <select class="form-select form-select-solid" wire:model="sortBy">
                            <option value="asc">{{__('ASC')}}</option>
                            <option value="desc">{{__('DESC')}}</option>
                        </select>
                    </div>
                    <div class="fv-row mb-6">
                        <label class="form-label fs-6 fw-bolder text-dark">{{__('Order by')}}</label>
                        <select class="form-select form-select-solid" wire:model="orderBy">
                            <option value="created_at">{{__('Date')}}</option>
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
    </div>
    <div wire:ignore.self id="kt_category" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_category_button" data-kt-drawer-close="#kt_category_close" data-kt-drawer-width="{'md': '500px'}">
        <div class="card w-100">
            <div class="card-header pe-5 border-0">
                <div class="card-title">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('1 week data')}}</div>
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_category_close">
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
                            <i class="fal fa-layer-group fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="pb-5 mt-10 position-relative zindex-1">
                    <form class="form w-100 mb-10" wire:submit.prevent="addData" method="post">
                        <div class="fv-row" wire:ignore>
                            <label class="col-form-label">{{__('Unit Price for the next 1 week')}} ({{$val->priceHistory->last()->date->toDateString()}} - {{$val->priceHistory->last()->date->addDays(7)->toDateString()}})</label>
                            <input type="text" wire:model="price_history" id="price_history" class="form-control form-control-lg form-control-solid" placeholder="Unit Price History">
                        </div>
                        @error('price_history')
                        <span class="form-text text-danger mb-6">{{$message}}</span>
                        @enderror
                        <div class="text-center mt-10">
                            <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                                <span wire:loading.remove wire:target="addData">{{__('Add Data')}}</span>
                                <span wire:loading wire:target="addData">{{__('Processing Request...')}}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-xl-8 mb-6">
        <div class="col-md-6 text-start">
            <button id="kt_category_button" class="btn btn-dark me-4"><i class="fal fa-plus"></i> {{__('Data')}}</button>
        </div>
    </div>
    @if($history->count() > 0)
    @foreach($history as $data)
    <div class="d-flex flex-stack">
        <div class="d-flex align-items-center">
            <div class="symbol symbol-40px symbol-circle me-4">
                <span class="symbol-label">
                    <i class="fal fa-calendar-alt fs-3"></i>
                </span>
            </div>
            <div class="ps-1">
                <p class="fs-6 text-dark fw-bolder mb-0">{{\Carbon\Carbon::now()->setISODate($data->year, $data->week)->startOfWeek()->toDateString()}} to {{\Carbon\Carbon::now()->setISODate($data->year, $data->week)->endOfWeek()->toDateString()}}</p>
                <p class="fs-6 text-gray-600 mb-0">Week {{$data->week}} of {{$data->year}}: {{$data->count}} records</p>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <button id="kt_category_{{\Carbon\Carbon::create($data->start_date)->toDateString()}}_button" class="btn btn-sm btn-light-info me-3">Edit units</button>
        </div>
    </div>
    @if(!$loop->last)
    <hr class="bg-light-border">
    @endif
    @endforeach
    @else
    <div class="text-center mt-20">
        <img src="{{asset('asset/images/beneficiary.png')}}" style="height:auto; max-width:250px;" class="mb-6">
        <h3 class="text-dark">{{__('No Data Found')}}</h3>
        <p class="text-dark">{{__('We couldn\'t find any data')}}</p>
    </div>
    @endif
            @foreach($history as $data)
             <livewire:admin.invest.edit-history :val=$data :admin=$admin :plan=$val :wire:key="'kt_category_'. \Carbon\Carbon::create($data->start_date)->toDateString()">
            @endforeach 
</div>
@push('scripts')
<script>
    document.addEventListener('livewire:load', function() {
        var input = document.querySelector("#price_history");
        var tagify = new Tagify(input, {
            pattern: /[0-9]/,
            minTags: 7,
            maxTags: 7,
            duplicates: true
        });
        input.addEventListener('change', onChange)

        function onChange(e) {
            @this.set('price_history', e.target.value);
        }

        window.livewire.on('removeAllTags', data => {
            tagify.removeAllTags();
        });
    });
</script>
@endpush