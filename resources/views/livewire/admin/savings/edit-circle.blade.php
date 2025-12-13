<div>
    <div wire:ignore.self class="modal fade" id="delete{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">{{__('Delete Circle')}}</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="fal fa-times"></i>
                        </span>
                    </div>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this circle?</p>
                    <div class="text-center">
                        <a wire:click="delete" class="btn btn-danger btn-block">{{__('Delete circle')}}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div wire:ignore.self id="kt_members_{{$val->id}}" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_members_{{$val->id}}_button" data-kt-drawer-close="#kt_members_{{$val->id}}_close" data-kt-drawer-width="{'md': '700px'}">
        <div class="card w-100">
            <div class="card-header pe-5 border-0">
                <div class="card-title">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Leader Board')}}</div>
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_members_{{$val->id}}_close">
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
                    @forelse($nplans as $cval)
                    <div class="d-flex flex-stack mb-6 bg-light p-3 rounded-3">
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-40px symbol-circle" data-bs-toggle="tooltip">
                                @if($cval->user->avatar == null)
                                <span class="symbol-label bg-info text-inverse-info fw-boldest">{{substr(ucwords($cval->user->business->name), 0, 1)}}</span>
                                @else
                                <div class="symbol-label" style="background-image:url({{url('/').'/storage/app/'.$cval->user->avatar}})"></div>
                                @endif
                            </div>
                            <div class="ps-2">
                                <p class="fs-6 text-dark mb-0"><a href="{{route('user.manage', ['client' => $cval->user->id, 'type' => 'details'])}}">{{$cval->user->business->name}}</a></p>
                                <p class="fs-6 text-info mb-0">{{$currency->currency_symbol.currencyFormat(number_format($cval->amount, 2)).' '.$currency->currency}}</p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-600 text-center">{{__('No Plans')}}</p>
                    @endforelse
                    
                    @if($nplans->count())
                    @if($nplans->total() > 0 && $nplans->count() < $nplans->total())<button wire:click="loadMore" wire:loading.remove class="btn btn-secondary btn-block">See more</button>@endif
                        @endif
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self id="kt_edit_{{$val->id}}" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_edit_{{$val->id}}_button" data-kt-drawer-close="#kt_edit_{{$val->id}}_close" data-kt-drawer-width="{'md': '900px'}">
        <div class="card w-100">
            <div class="card-header pe-5 border-0">
                <div class="card-title">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Edit Product')}}</div>
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_edit_{{$val->id}}_close">
                        <span class="svg-icon svg-icon-2">
                            <i class="fal fa-times"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body text-wrap">
                <div class="pb-5 mt-10 position-relative zindex-1">
                    <form class="form w-100 mb-10" wire:submit.prevent="update" method="post">
                        <div class="row">
                            <div class="col-md-4">
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
                                                <input type="file" wire:model="image" id="image" accept=".png, .jpg, .jpeg, .webp">
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
                                        @error('val.image')
                                        <span class="form-text text-danger">{{$message}}</span>
                                        @enderror
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-5 fw-bolder text-dark">{{__('Category')}}</label>
                                    <select class="form-select form-select-solid" wire:model.defer="val.cat_id" required>
                                        <option value="">Select Category</option>
                                        @foreach($categoryAll as $val)
                                        <option value="{{$val->id}}">{{$val->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('val.cat_id')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-5 fw-bolder text-dark">{{__('Status')}}</label>
                                    <select class="form-select form-select-solid" wire:model.defer="val.status" required>
                                        <option value="1">{{__('Published')}}</option>
                                        <option value="0">{{__('Disabled')}}</option>
                                    </select>
                                    @error('val.status')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="fv-row mb-6">
                                    <input class="form-control form-control-lg form-control-solid" type="text" wire:model.defer="val.name" required placeholder="Name of Circle" />
                                    @error('val.name')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="col-form-label">{{__('Amount')}}</label>
                                    <div class="input-group">
                                        <span class="input-group-text border-0">{{$currency->currency_symbol}}</span>
                                        <input type="number" wire:model.defer="val.amount" steps="any" class="form-control form-control-lg form-control-solid" required placeholder="0.00">
                                    </div>
                                    @error('val.amount')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="col-form-label">{{__('Interest')}}</label>
                                    <div class="input-group">
                                        <input type="number" wire:model.defer="val.interest" steps="any" class="form-control form-control-lg form-control-solid" required placeholder="1">
                                        <span class="input-group-text border-0">%</span>
                                    </div>
                                    @error('val.interest')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-5 fw-bolder text-dark">{{__('Duration')}}</label>
                                    <select class="form-select form-select-solid" wire:model.defer="val.circle_duration" required>
                                        <option value="weekly">{{__('Weekly')}}</option>
                                        <option value="monthly">{{__('Monthly')}}</option>
                                    </select>
                                    @error('val.circle_duration')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6">
                                    <textarea class="form-control form-control-lg form-control-solid" rows="10" type="text" wire:model.defer="val.description" placeholder="Detailed description of Circle"></textarea>
                                    @error('val.description')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="text-center mt-10">
                                    <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                                        <span wire:loading.remove wire:target="update">{{__('Update Circle')}}</span>
                                        <span wire:loading wire:target="update">{{__('Processing Request...')}}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>