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
                    <button id="kt_article_button" class="btn btn-info me-4"><i class="fal fa-pie-chart"></i> {{__('Add Plan')}}</button>
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
                                            <label class="form-label fs-5 fw-bolder text-dark">{{__('Recommendation')}}</label>
                                            <select class="form-select form-select-solid" wire:model.defer="recommendation" required>
                                                <option value="0">{{__('No')}}</option>
                                                <option value="1">{{__('Yes')}}</option>
                                            </select>
                                            @error('recommendation')
                                            <span class="form-text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="fv-row mb-6">
                                            <label class="form-label fs-5 fw-bolder text-dark">{{__('Dividend')}}</label>
                                            <select class="form-select form-select-solid" wire:model.defer="dividend" required>
                                                <option value="1">{{__('Yes')}}</option>
                                                <option value="0">{{__('No')}}</option>
                                            </select>
                                            <span class="form-text">Enabling this means you will be able share dividend to your investors</span>
                                            @error('dividend')
                                            <span class="form-text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="fv-row mb-6">
                                            <label class="form-label fs-5 fw-bolder text-dark">{{__('Sell units')}}</label>
                                            <select class="form-select form-select-solid" wire:model.defer="sell_units" required>
                                                <option value="1">{{__('Yes')}}</option>
                                                <option value="0">{{__('No')}}</option>
                                            </select>
                                            <span class="form-text">Investors can sell units, remember to set claim duration incase you don't want investors to sell units immediately</span>
                                            @error('sell_units')
                                            <span class="form-text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="fv-row mb-6">
                                            <label class="form-label fs-5 fw-bolder text-dark">{{__('Unit Sale Commission')}}</label>
                                            <div class="input-group">
                                                <input type="number" step="any" wire:model.defer="sale_percent" placeholder="{{__('Sale Percent')}}" autocomplete="off" class="form-control form-control-lg form-control-solid">
                                                <span class="input-group-text border-0">%</span>
                                            </div>
                                            @error('sale_percent')
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
                                        <div class="fv-row mb-6">
                                            <label class="form-label fs-5 fw-bolder text-dark">{{__('Minimum Selling Units')}}</label>
                                            <input type="number" wire:model.defer="min_sell" placeholder="{{__('least amount of units that can be sold')}}" autocomplete="off" class="form-control form-control-lg form-control-solid">
                                            @error('min_sell')
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
                                            <textarea class="form-control form-control-lg form-control-solid" rows="3" type="text" required wire:model.defer="details" placeholder="Detailed description of mutual fund"></textarea>
                                            @error('details')
                                            <span class="form-text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="fv-row mb-6">
                                            <textarea class="form-control form-control-lg form-control-solid" rows="3" type="text" required wire:model.defer="suitability" placeholder="Suitability - Who is suitable for this plan"></textarea>
                                            @error('suitability')
                                            <span class="form-text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="fv-row mb-6">
                                            <textarea class="form-control form-control-lg form-control-solid" rows="3" type="text" required wire:model.defer="terms" placeholder="Terms of use"></textarea>
                                            @error('terms')
                                            <span class="form-text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="fv-row mb-6">
                                            <textarea class="form-control form-control-lg form-control-solid" rows="3" type="text" required wire:model.defer="how" placeholder="How to Earn"></textarea>
                                            @error('how')
                                            <span class="form-text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="fv-row mb-6">
                                            <input class="form-control form-control-lg form-control-solid" type="text" required wire:model.defer="trustee" placeholder="Trustee - Who is the Trust to this mutual fund">
                                            @error('trustee')
                                            <span class="form-text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="fv-row mb-6">
                                            <input class="form-control form-control-lg form-control-solid" type="text" required wire:model.defer="custodian" placeholder="Custodian - Fund Manager">
                                            @error('custodian')
                                            <span class="form-text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="fv-row mb-6">
                                            <label class="col-form-label">{{__('Claim Duration')}}</label>
                                            <div class="input-group">
                                                <input type="number" wire:model.defer="claim_duration" steps="any" class="form-control form-control-lg form-control-solid" placeholder="Leave empty if you want clients to sell units anytime">
                                                <span class="input-group-text border-0">{{__('Months')}}</span>
                                            </div>
                                            @error('claim_duration')
                                            <span class="form-text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="fv-row mb-6">
                                            <label class="col-form-label">{{__('Total number of units')}}</label>
                                            <input type="number" wire:model.defer="units" steps="any" class="form-control form-control-lg form-control-solid" placeholder="Leave empty if you want unlimited amount of units">
                                            @error('units')
                                            <span class="form-text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="fv-row mb-6" wire:ignore>
                                            <label class="col-form-label">{{__('Unit Price for the next 1 week')}} ({{\Carbon\Carbon::now()->toDateString()}} - {{\Carbon\Carbon::now()->addDays(7)->toDateString()}})</label>
                                            <input type="text" wire:model="price_history" id="price_history" class="form-control form-control-lg form-control-solid" placeholder="Unit Price History">
                                            <span class="form-text">If unit price expires this mutual fund won't be displayed to users. You will be sent an email reminder to add unit price ahead before it expires.</span>
                                        </div>
                                        @error('price_history')
                                        <span class="form-text text-danger mb-6">{{$message}}</span>
                                        @enderror
                                        <div class="fv-row mb-6">
                                            <input type="url" wire:model.defer="prospectus" class="form-control form-control-lg form-control-solid" placeholder="URL to Prospectus">
                                            @error('prospectus')
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
                                    <p>
                                        @if($val->recommendation == 1)<span class="badge badge-light-info">Recommended</span>@endif
                                        <span class="badge badge-light-info">{{($val->status == 1) ? 'Published' : 'Disabled'}}</span>
                                        <span class="badge badge-light-info">Sell units: {{($val->sell_units == 1) ? 'Yes' : 'No'}}</span>
                                        <span class="badge badge-light-info">Return Dividend: {{($val->dividend == 1) ? 'Yes' : 'No'}}</span>
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
                                    <div class="fs-6 fw-boldest text-gray-700">@if($val->claim_duration == null) Anytime @else {{$val->claim_duration.' Months'}}@endif</div>
                                    <div class="fw-bold text-gray-400">Claim Duration</div>
                                </div>
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="fs-6 fw-boldest text-gray-700">@if($val->units == null)<i class="fal fa-infinity"></i> @else {{number_format($val->units)}}@endif</div>
                                    <div class="fw-bold text-gray-400">Units</div>
                                </div>
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="fs-6 fw-boldest text-gray-700">{{$val->custodian}}</div>
                                    <div class="fw-bold text-gray-400">Fund Manager</div>
                                </div>
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="fs-6 fw-boldest text-gray-700">{{$val->trustee}}</div>
                                    <div class="fw-bold text-gray-400">Trustee</div>
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
                                @if($val->priceHistory->last()->date->diffInDays() <= 3 && $val->priceHistory->last()->date >= \Carbon\Carbon::today())
                                <div class="alert alert-dismissible bg-warning d-flex flex-column flex-sm-row p-5 mt-3">
                                    <i class="fal fa-clock fa-2x text-dark me-2"></i>
                                    <div class="d-flex flex-column text-dark pe-0 pe-sm-10">
                                        <h5 class="mb-1">Add more units, you have {{$val->priceHistory->last()->date->diffInDays()}} days.</h5>
                                        <span>Plan will soon be hidden from users, add more units history to keep your users updated. A reminder will be sent to your mail daily.</span>
                                    </div>
                                </div>
                                @endif
                                @if($val->priceHistory->last()->date < \Carbon\Carbon::today())
                                <div class="alert alert-dismissible bg-danger d-flex flex-column flex-sm-row p-5 mt-3">
                                    <i class="fal fa-clock fa-2x text-white me-2"></i>
                                    <div class="d-flex flex-column text-white pe-0 pe-sm-10">
                                        <h5 class="mb-1">Add more units.</h5>
                                        <span>Plan has been hidden from users, add more units history to keep your users updated.</span>
                                    </div>
                                </div>
                                @endif
                                @if($val->fundComposition->count() == 0)
                                <div class="alert alert-dismissible bg-info d-flex flex-column flex-sm-row p-5 mb-10 mt-3">
                                    <i class="fal fa-pie-chart fa-2x text-white me-2"></i>
                                    <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                                        <h5 class="mb-1">Fund composition</h5>
                                        <span>You need to add what mutual fund is being invested in for plan to be displayed to users.</span>
                                    </div>
                                </div>
                                @else
                                    <p class="mb-0 text-gray-600 fs-6">Fund Composition</p>
                                    <div class="progress w-100 h-15px mb-3">
                                        @foreach($val->fundComposition as $progress)
                                        <div class="progress-bar {{$progress->color}}" style="width: {{$progress->percent}}%;"></div>
                                        @endforeach
                                    </div>
                                    <p>
                                    @foreach($val->fundComposition as $progress)
                                    <span class="me-3"><i class="fas fa-square {{str_replace('bg', 'text', $progress->color)}}"></i> {{ucwords($progress->name)}}: {{$progress->percent}}%</span>
                                    @endforeach
                                    </p>
                                @endif
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
        document.addEventListener('livewire:load', function() {
            var input = document.querySelector("#price_history");
            new Tagify(input, {
                pattern: /[0-9]/,
                minTags: 7,
                maxTags: 7,
                duplicates: true
            });
            input.addEventListener('change', onChange)

            function onChange(e) {
                @this.set('price_history', e.target.value);
            }
        });

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