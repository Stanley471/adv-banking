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
                                    {{number_format_short($admin->savings('active', 'regular')->sum('amount')).' '.$currency->currency}} [{{$admin->savings('active', 'regular')->count()}}]
                                </div>
                            </div>
                            <div class="separator separator-dashed"></div>
                            <div class="fs-6 d-flex justify-content-between my-4">
                                <div class="fw-bold">Expired</div>
                                <div class="d-flex fw-boldest">
                                    {{number_format_short($admin->savings('expired', 'regular')->sum('amount')).' '.$currency->currency}} [{{$admin->savings('expired', 'regular')->count()}}]
                                </div>
                            </div>
                            <div class="separator separator-dashed"></div>
                            <div class="fs-6 d-flex justify-content-between my-4">
                                <div class="fw-bold">Processed Returns</div>
                                <div class="d-flex fw-boldest">
                                    {{number_format_short($admin->totalSavingsReturn('regular', 'paid')->sum('amount')).' '.$currency->currency}}
                                </div>
                            </div>
                            <div class="d-flex mt-10">
                                <a id="kt_active_button" class="btn btn-info btn-sm me-3">Active Plans</a>
                                <a id="kt_expired_button" class="btn btn-secondary btn-sm">Expired Plans</a>
                                <div wire:ignore.self id="kt_active_money" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_active_button" data-kt-drawer-close="#kt_active_close" data-kt-drawer-width="{'md': '700px'}">
                                    <div class="card w-100">
                                        <div class="card-header pe-5 border-0">
                                            <div class="card-title">
                                                <div class="d-flex justify-content-center flex-column me-3">
                                                    <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Regular Savings')}}</div>
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
                                                        <input type="search" class="form-control form-control-solid text-dark" wire:model="asearch" placeholder="{{__('Search plans')}}" />
                                                    </div>
                                                </div>
                                                <div class="row mb-6">
                                                    <div class="col-6">
                                                        <select class="form-select form-select-solid" wire:model="asortBy">
                                                            <option value="created_at">{{__('Date')}}</option>
                                                            <option value="amount">{{__('Amount')}}</option>
                                                            <option value="name">{{__('Name')}}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <select class="form-select form-select-solid" wire:model="aorderBy">
                                                            <option value="asc">{{__('ASC')}}</option>
                                                            <option value="desc">{{__('DESC')}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                @forelse($aplans as $val)
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
                                                @if($aplans->count())
                                                @if($aplans->total() > 0 && $aplans->count() < $aplans->total())<button wire:click="loadMore" wire:loading.remove class="btn btn-secondary btn-block">See more</button>@endif
                                                    @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div wire:ignore.self id="kt_expired_money" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_expired_button" data-kt-drawer-close="#kt_expired_close" data-kt-drawer-width="{'md': '700px'}">
                                    <div class="card w-100">
                                        <div class="card-header pe-5 border-0">
                                            <div class="card-title">
                                                <div class="d-flex justify-content-center flex-column me-3">
                                                    <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Regular Savings')}}</div>
                                                </div>
                                            </div>
                                            <div class="card-toolbar">
                                                <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_expired_close">
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
                                                        <input type="search" class="form-control form-control-solid text-dark" wire:model="esearch" placeholder="{{__('Search plans')}}" />
                                                    </div>
                                                </div>
                                                <div class="row mb-6">
                                                    <div class="col-6">
                                                        <select class="form-select form-select-solid" wire:model="esortBy">
                                                            <option value="created_at">{{__('Date')}}</option>
                                                            <option value="amount">{{__('Amount')}}</option>
                                                            <option value="name">{{__('Name')}}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <select class="form-select form-select-solid" wire:model="eorderBy">
                                                            <option value="asc">{{__('ASC')}}</option>
                                                            <option value="desc">{{__('DESC')}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                @forelse($eplans as $val)
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
                                                @if($eplans->count())
                                                @if($eplans->total() > 0 && $eplans->count() < $eplans->total())<button wire:click="loadMore" wire:loading.remove class="btn btn-secondary btn-block">See more</button>@endif
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
                                    <input type="text" wire:model="rga" id="rga" class="form-control form-control-lg form-control-solid" placeholder="Suggested amount">
                                    <span class="form-text">This is suggested amount for users to save, but they can save any amount.</span>
                                </div>
                                @error('rga')
                                <span class="form-text text-danger mb-6">{{$message}}</span>
                                @enderror
                                <div class="fv-row mb-6">
                                    <label class="col-form-label">{{__('Minimum amount')}}</label>
                                    <div class="input-group">
                                        <span class="input-group-text border-0">{{$currency->currency_symbol}}</span>
                                        <input type="number" wire:model.defer="min_rga" steps="any" class="form-control form-control-lg form-control-solid" required placeholder="0.00">
                                    </div>
                                    @error('min_rga')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-check form-check-custom form-check-solid mb-6">
                                    <input class="form-check-input" type="checkbox" id="flexCheckDefault" wire:model.defer="rss" />
                                    <label class="form-check-label" for="flexCheckDefault">{{__('Active')}}</label>
                                </div>
                                <div class="text-start">
                                    <button type="submit" class="btn btn-lg btn-info fw-bolder me-3 my-2 mb-3">
                                        <span wire:loading.remove wire:target="save">{{__('Update Regular Savings')}}</span>
                                        <span wire:loading wire:target="save">{{__('Processing Request...')}}</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div wire:ignore.self id="kt_category" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_category_button" data-kt-drawer-close="#kt_category_close" data-kt-drawer-width="{'md': '500px'}">
                        <div class="card w-100">
                            <div class="card-header pe-5 border-0">
                                <div class="card-title">
                                    <div class="d-flex justify-content-center flex-column me-3">
                                        <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Create a Plan')}}</div>
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
                                    <form class="form w-100 mb-10" wire:submit.prevent="addPlan" method="post">
                                        <div class="fv-row mb-6">
                                            <label class="col-form-label">{{__('Duration')}}</label>
                                            <div class="input-group">
                                                <input type="number" wire:model.defer="duration" steps="any" class="form-control form-control-lg form-control-solid" required placeholder="1">
                                                <span class="input-group-text border-0">{{__('Months')}}</span>
                                            </div>
                                            @error('duration')
                                            <span class="form-text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="fv-row mb-6">
                                            <label class="col-form-label">{{__('Interest')}}</label>
                                            <div class="input-group">
                                                <input type="number" wire:model.defer="interest" steps="any" class="form-control form-control-lg form-control-solid" required placeholder="1">
                                                <span class="input-group-text border-0">%</span>
                                            </div>
                                            @error('interest')
                                            <span class="form-text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="text-center mt-10">
                                            <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                                                <span wire:loading.remove wire:target="addPlan">{{__('Create Plan')}}</span>
                                                <span wire:loading wire:target="addPlan">{{__('Processing Request...')}}</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card h-100 mb-10">
                        <div class="card-body">
                            <h3 class="mb-6">Saving Plans</h3>
                            <div class="row g-xl-8">
                                <div class="col-md-6">
                                    <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                                        <div class="input-group input-group-solid mb-5 rounded-4">
                                            <span class="input-group-text" id="basic-addon1"><i class="fal fa-search"></i></span>
                                            <input type="search" class="form-control form-control-solid text-dark" wire:model="search" placeholder="{{__('Search')}}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 text-end">
                                    <button id="kt_category_button" class="btn btn-dark me-4"><i class="fal fa-plus"></i> {{__('Interest Plan')}}</button>
                                </div>
                            </div>
                            @if($regular->count() > 0)
                            <div class="table-responsive">
                                <table id="kt_datatable_zero_configuration" class="table table-row-bordered gy-5" wire:loading.class.delay="opacity-50" wire:target="search, status, sortBy, orderBy, perPage, loadMore">
                                    <thead>
                                        <tr class="fw-semibold fs-6 text-muted">
                                            <th class="min-w-20px">{{__('S/N')}}</th>
                                            <th class="min-w-100px">{{__('Duration')}}</th>
                                            <th class="min-w-100px">{{__('Interest')}}</th>
                                            <th class="min-w-150px">{{__('Created')}}</th>
                                            <th class="scope"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($regular as $val)
                                        <tr>
                                            <td>{{$loop->iteration}}.</td>
                                            <td>{{$val->duration}} Month(s)</td>
                                            <td>{{$val->interest}}%</td>
                                            <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                                            <td class="text-center">
                                                <button id="kt_category_{{$val->id}}_button" class="btn btn-sm btn-light-info">Edit</button>
                                                <a data-bs-toggle="modal" data-bs-target="#delete{{$val->id}}" class="btn btn-sm btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <div class="text-center mt-20">
                                <img src="{{asset('asset/images/beneficiary.png')}}" style="height:auto; max-width:250px;" class="mb-6">
                                <h3 class="text-dark">{{__('No Interest Plan Found')}}</h3>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach($regular as $val)
    <livewire:admin.savings.edit-regular :val=$val :admin=$admin :wire:key="'kt_category_'. $val->id">
        @endforeach
</div>
@push('scripts')
<script>
    document.addEventListener('livewire:load', function() {
        var input = document.querySelector("#rga");
        new Tagify(input, {
            pattern: /[0-9]/,
            minTags: 2,
            maxTags: 5,
            duplicates: true
        });
        
        input.addEventListener('change', onChange)

        function onChange(e) {
            @this.set('rga', e.target.value);
        }
    });
</script>
@endpush