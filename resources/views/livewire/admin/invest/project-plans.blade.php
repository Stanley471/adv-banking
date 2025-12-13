<div>
    <div wire:ignore.self class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">{{__('Filter Messages')}}</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="fal fa-times"></i>
                        </span>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="fv-row mb-6">
                        <label class="form-label fs-5 fw-bolder text-dark">{{__('Category')}}</label>
                        <select class="form-select form-select-solid" wire:model="category" required>
                            <option value="">Select Category</option>
                            @foreach($categoryAll as $val)
                            <option value="{{$val->id}}">{{$val->name}}</option>
                            @endforeach
                        </select>
                        @error('category')
                        <span class="form-text text-danger">{{$message}}</span>
                        @enderror
                    </div>
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
                            <option value="interest">{{__('Interest')}}</option>
                            <option value="start_date">{{__('Start Date')}}</option>
                            <option value="close_date">{{__('Close Date')}}</option>
                            <option value="original">{{__('Units')}}</option>
                            <option value="duration">{{__('Duration')}}</option>
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
    <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
        <div class="container">
            <div class="row g-xl-8">
                <div class="col-md-8">
                    <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                        <div class="input-group input-group-solid mb-5 rounded-4">
                            <span class="input-group-text" id="basic-addon1"><i class="fal fa-search"></i></span>
                            <input type="search" class="form-control form-control-solid text-dark" wire:model="search" placeholder="{{__('Search plans')}}" />
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-end">
                    <button data-bs-toggle="modal" data-bs-target="#filter" class="btn btn-light text-dark me-4"><i class="fal fa-filter-list"></i> {{__('Filter')}}</button>
                    <button id="kt_article_button" class="btn btn-info me-4"><i class="fal fa-pie-chart"></i> {{__('Add plan')}}</button>
                </div>
            </div>
            <div wire:ignore.self id="kt_article" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_article_button" data-kt-drawer-close="#kt_article_close" data-kt-drawer-width="{'md': '1000px'}">
                <div class="card w-100">
                    <div class="card-header pe-5 border-0">
                        <div class="card-title">
                            <div class="d-flex justify-content-center flex-column me-3">
                                <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Create a Plan')}}</div>
                            </div>
                        </div>
                        <div class="card-toolbar">
                            <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_article_close">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fal fa-times"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-wrap">
                        <div class="pb-5 mt-10 position-relative zindex-1">
                            <form class="form w-100 mb-10" wire:submit.prevent="addPlan" method="post">
                                <div class="row">
                                    <div class="col-md-4">
                                        <!--begin::Thumbnail settings-->
                                        <div class="card card-flush py-4">
                                            <!--begin::Card body-->
                                            <div class="card-body text-center pt-0" wire:ignore>
                                                <!--begin::Image input-->
                                                <!--begin::Image input placeholder-->
                                                <style>
                                                    .image-input-placeholder {
                                                        background-image: url({{asset('dashboard/media/svg/files/blank-image.svg')
                                                    }})
                                                    }
                                                </style>
                                                <!--end::Image input placeholder-->

                                                <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                                                    <!--begin::Preview existing avatar-->
                                                    <div class="image-input-wrapper w-150px h-150px"></div>
                                                    <!--end::Preview existing avatar-->

                                                    <!--begin::Label-->
                                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" aria-label="Change avatar" data-bs-original-title="Change avatar" data-kt-initialized="1">
                                                        <i class="bi bi-pencil-fill fs-7"></i>

                                                        <!--begin::Inputs-->
                                                        <input type="file" wire:model="image" id="image" accept=".png, .jpg, .jpeg" required>
                                                        <input type="hidden" name="avatar_remove">
                                                        <!--end::Inputs-->
                                                    </label>
                                                    <!--end::Label-->

                                                    <!--begin::Cancel-->
                                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" aria-label="Cancel avatar" data-bs-original-title="Cancel avatar" data-kt-initialized="1">
                                                        <i class="bi bi-x fs-2"></i>
                                                    </span>
                                                    <!--end::Cancel-->

                                                    <!--begin::Remove-->
                                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" aria-label="Remove avatar" data-bs-original-title="Remove avatar" data-kt-initialized="1">
                                                        <i class="bi bi-x fs-2"></i>
                                                    </span>
                                                    <!--end::Remove-->
                                                </div>
                                                <!--end::Image input-->

                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">Set the thumbnail image. Only *.png, *.jpg and *.jpeg image files are accepted</div>
                                                @error('image')
                                                <span class="form-text text-danger">{{$message}}</span>
                                                @enderror
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Card body-->
                                        </div>
                                        <div class="fv-row mb-6">
                                            <label class="form-label fs-5 fw-bolder text-dark">{{__('Category')}}</label>
                                            <select class="form-select form-select-solid" wire:model.defer="selectCategory" required>
                                                <option value="">Select Category</option>
                                                @foreach($categoryAll as $val)
                                                <option value="{{$val->id}}">{{$val->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('selectCategory')
                                            <span class="form-text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="fv-row mb-6">
                                            <label class="form-label fs-5 fw-bolder text-dark">{{__('Status')}}</label>
                                            <select class="form-select form-select-solid" wire:model.defer="status" required>
                                                <option value="1">{{__('Published')}}</option>
                                                <option value="0">{{__('Disabled')}}</option>
                                            </select>
                                            @error('status')
                                            <span class="form-text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="fv-row mb-6">
                                            <label class="form-label fs-5 fw-bolder text-dark">{{__('Insured')}}</label>
                                            <select class="form-select form-select-solid" wire:model.defer="insurance" required>
                                                <option value="0">{{__('No')}}</option>
                                                <option value="1">{{__('Yes')}}</option>
                                            </select>
                                            @error('insurance')
                                            <span class="form-text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="fv-row mb-6">
                                            <label class="form-label fs-5 fw-bolder text-dark">{{__('Minimum Buying Units')}}</label>
                                            <input type="number" wire:model.defer="min_buy" placeholder="{{__('least amount of units that can be bought')}}" autocomplete="off" class="form-control form-control-lg form-control-solid">
                                            @error('min_buy')
                                            <span class="form-text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div wire:ignore>
                                            <div class="fv-row mb-6">
                                                <label class="form-label fs-6 fw-bolder text-dark">{{__('Investment fee type')}}</label>
                                                <select class="form-select form-select-solid" wire:model.defer="fee_type" id="fee" required>
                                                    <option value="both">Percentage & Fiat</option>
                                                    <option value="percent">Percentage</option>
                                                    <option value="fiat">Fiat</option>
                                                    <option value="none">No fees</option>
                                                    <option value="min">Below</option>
                                                    <option value="max">Above</option>
                                                </select>
                                                @error('fee_type')
                                                <span class="form-text text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="fv-row mb-6">
                                                <div class="input-group">
                                                    <input type="number" step="any" wire:model.defer="percent_pc" id="percent_pc" placeholder="{{__('Percent charge')}}" autocomplete="off" class="form-control form-control-lg form-control-solid">
                                                    <span class="input-group-text border-0">%</span>
                                                </div>
                                                @error('percent_pc')
                                                <span class="form-text text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="fv-row mb-6">
                                                <div class="input-group">
                                                    <span class="input-group-text border-0">{{$currency->currency_symbol}}</span>
                                                    <input type="number" step="any" wire:model.defer="fiat_pc" id="fiat_pc" placeholder="{{__('Fiat charge')}}" autocomplete="off" class="form-control form-control-lg form-control-solid">
                                                </div>
                                                @error('fiat_pc')
                                                <span class="form-text text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="fv-row mb-6">
                                            <input class="form-control form-control-lg form-control-solid" type="text" wire:model.defer="name" required placeholder="Name of Plan" />
                                            @error('name')
                                            <span class="form-text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="fv-row mb-6">
                                            <label class="col-form-label">{{__('Price per units')}}</label>
                                            <div class="input-group">
                                                <span class="input-group-text border-0">{{$currency->currency_symbol}}</span>
                                                <input type="number" wire:model.defer="price" steps="any" class="form-control form-control-lg form-control-solid" required placeholder="0.00">
                                            </div>
                                            @error('price')
                                            <span class="form-text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="fv-row mb-6">
                                            <label class="col-form-label">{{__('Investment Interest')}}</label>
                                            <div class="input-group">
                                                <input type="number" wire:model.defer="interest" steps="any" class="form-control form-control-lg form-control-solid" required placeholder="1">
                                                <span class="input-group-text border-0">%</span>
                                            </div>
                                            @error('interest')
                                            <span class="form-text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="fv-row mb-6">
                                            <label class="col-form-label">{{__('Investment duration')}}</label>
                                            <div class="input-group">
                                                <input type="number" wire:model.defer="duration" steps="any" class="form-control form-control-lg form-control-solid" required placeholder="1">
                                                <span class="input-group-text border-0">{{__('Months')}}</span>
                                            </div>
                                            @error('duration')
                                            <span class="form-text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="fv-row mb-6">
                                            <label class="col-form-label">{{__('Total number of units')}}</label>
                                            <input type="number" wire:model.defer="units" steps="any" class="form-control form-control-lg form-control-solid" required placeholder="units">
                                            @error('units')
                                            <span class="form-text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="fv-row mb-6">
                                            <label class="col-form-label">{{__('Site Location')}}</label>
                                            <input type="text" wire:model.defer="location" steps="any" class="form-control form-control-lg form-control-solid" required placeholder="Location of operations">
                                            @error('location')
                                            <span class="form-text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="fv-row mb-6">
                                            <label class="col-form-label">{{__('Start - Close Date for buying units')}}</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="date" wire:model.defer="start_date" class="form-control form-control-lg form-control-solid" required value="{{Carbon\Carbon::now()->format('d/m/Y')}}">
                                                    <span class="form-text">{{__('Investors can buy units from this day')}}</span>
                                                    @error('start_date')
                                                    <span class="form-text text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="date" wire:model.defer="close_date" class="form-control form-control-lg form-control-solid" required>
                                                    <span class="form-text">{{__('The window for investors to invest is closed on this day, it must be greater than start date')}}</span>
                                                    @error('close_date')
                                                    <span class="form-text text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="fv-row mb-6">
                                            <textarea class="form-control form-control-lg form-control-solid" rows="10" type="text" wire:model.defer="details" placeholder="Detailed description of project"></textarea>
                                            @error('details')
                                            <span class="form-text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="text-center mt-10">
                                            <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                                                <span wire:loading.remove wire:target="addPlan">{{__('Submit Plan')}}</span>
                                                <span wire:loading wire:target="addPlan">{{__('Processing Request...')}}</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @if($plans->count() > 0)
            @foreach($plans as $val)
            <div class="card mb-9 rounded-5">
                <div class="card-body pt-9 pb-0">
                    <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
                        <div class="symbol symbol-100px me-7 mb-4 symbol-circle">
                            <span class="symbol-label" style="background-image:url({{url('/').'/storage/app/'.$val->image}});"></span>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <div class="d-flex flex-column">
                                    <p class="text-dark fs-1 fw-boldest me-3 mb-0">{{substr($val->name, 0, 30)}}{{(Str::length($val->name) > 30) ? '...' : ''}}</p>
                                    <p class="text-gray-800 fs-5 me-3 mb-3">{{$val->location}}</p>
                                    <p>
                                        <span class="badge badge-light-info">{{$val->category->name}}</span>
                                        <span class="badge badge-light-info">{{$val->duration.' Months'}}</span>
                                        <span class="badge badge-light-info">{{($val->status == 1) ? 'Published' : 'Disabled'}}</span>
                                        <span class="badge badge-light-info">{{($val->insurance == 1) ? 'Insured' : 'No Insurance'}}</span>
                                    </p>
                                    @if($val->followed->count())
                                    <div class="symbol-group symbol-hover mb-3">
                                        <!--begin::User-->
                                        @foreach($val->followed->take(10) as $followers)
                                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="{{$followers->user->business->name}}">
                                            @if($followers->user->avatar == null)
                                            <span class="symbol-label bg-warning text-inverse-warning fw-boldest">{{substr(ucwords($followers->user->business->name), 0, 1)}}</span>
                                            @else
                                            <div class="symbol-label" style="background-image:url({{url('/').'/storage/app/'.$followers->user->avatar}})"></div>
                                            @endif
                                        </div>
                                        @endforeach
                                        @if($val->followed->count() > 10)
                                        <div class="symbol symbol-35px symbol-circle">
                                            <span class="symbol-label bg-warning text-dark fs-8 fw-boldest">+{{$val->followed->count() - 10}}</span>
                                        </div>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                                <div class="d-flex mb-4">
                                    <a href="{{route('admin.invest.plan', ['plan' => $val->id, 'type' => 'edit'])}}" class="btn btn-dark me-3">Manage</a>
                                    <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$val->id}}">Delete</a>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap justify-content-start">
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="fs-6 fw-boldest text-gray-700">{{\Carbon\Carbon::create($val->start_date)->format('M j, Y')}} - {{\Carbon\Carbon::create($val->close_date)->format('M j, Y')}}</div>
                                    <div class="fw-bold text-gray-400">Investment Closure</div>
                                </div>
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="fs-6 fw-boldest text-gray-700">{{\Carbon\Carbon::create($val->expiring_date)->format('M j, Y')}}</div>
                                    <div class="fw-bold text-gray-400">Matures</div>
                                </div>
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="fs-6 fw-boldest text-gray-700">{{number_format($val->original - $val->units).'/'.number_format($val->original)}} units</div>
                                    <div class="fw-bold text-gray-400">{{$currency->currency_symbol.$val->price}} per unit</div>
                                </div>
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="fs-6 fw-boldest text-gray-700">{{$val->interest}}%</div>
                                    <div class="fw-bold text-gray-400">Interest</div>
                                </div>
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="fs-6 fw-boldest text-gray-700">
                                        @if($val->fee_type == "both")
                                        {{$val->percent_pc}}% + {{$val->fiat_pc.' '.$currency->currency}}
                                        @elseif($val->fee_type == "fiat")
                                        {{$val->fiat_pc.' '.$currency->currency}}
                                        @elseif($val->fee_type == "percent")
                                        {{$val->percent_pc}}%
                                        @elseif($val->fee_type == "max")
                                        > {{$val->fiat_pc.' '.$currency->currency}} - {{$val->percent_pc}}%
                                        @elseif($val->fee_type == "min")
                                        < {{$val->fiat_pc.' '.$currency->currency}} - {{$val->percent_pc}}% @endif </div>
                                            <div class="fw-bold text-gray-400">Mtg Fee</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @if($plans->total() > 0 && $plans->count() < $plans->total())<button wire:click="loadMore" wire:loading.remove class="btn btn-secondary btn-block">{{__('See more')}}</button>@endif
                    @else
                    <div class="text-center mt-20">
                        <img src="{{asset('asset/images/beneficiary.png')}}" style="height:auto; max-width:250px;" class="mb-6">
                        <h3 class="text-dark">{{__('No Investment Plan Found')}}</h3>
                        <p class="text-dark">{{__('We couldn\'t find any investment plan ')}}</p>
                    </div>
                    @endif
            </div>
        </div>
        @foreach($plans as $val)
        <livewire:admin.invest.delete-plan :val=$val :admin=$admin :wire:key="'kt_edit_'. $val->id">
            @endforeach
    </div>
    @push('scripts')
    <script>
        function fee() {
            var fee = $("#fee").find(":selected").val();
            var myarr = fee;
            if (myarr == "both") {
                $("#fiat_pc").attr({
                    required: true,
                    readonly: false,
                    placeholder: 'Fiat charge'
                });
                $("#percent_pc").attr({
                    required: true,
                    readonly: false,
                    placeholder: 'Percent charge'
                });
            } else if (myarr == "fiat") {
                $("#fiat_pc").attr({
                    required: true,
                    readonly: false,
                    placeholder: 'Fiat charge'
                });
                $("#percent_pc").attr({
                    required: false,
                    readonly: true,
                    placeholder: 'Percent charge'
                });
            } else if (myarr == "percent") {
                $("#fiat_pc").attr({
                    required: false,
                    readonly: true,
                    placeholder: 'Fiat charge'
                });
                $("#percent_pc").attr({
                    required: true,
                    readonly: false,
                    placeholder: 'Percent charge'
                });
            } else if (myarr == "none") {
                $("#fiat_pc").attr({
                    required: false,
                    readonly: true,
                    placeholder: 'Fiat charge'
                });
                $("#percent_pc").attr({
                    required: false,
                    readonly: true,
                    placeholder: 'Percent charge'
                });
            } else {
                $("#fiat_pc").attr({
                    required: true,
                    readonly: false,
                    placeholder: 'Amount'
                });
                $("#percent_pc").attr({
                    required: false,
                    readonly: true
                });
            }
        }

        document.addEventListener('livewire:load', function() {
            fee();
        });

        $("#fee").change(fee);
    </script>
    @endpush