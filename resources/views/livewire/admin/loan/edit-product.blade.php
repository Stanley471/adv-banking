<div>
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
                                    <label class="form-label fs-5 fw-bolder text-dark">{{__('Product type')}}</label>
                                    <select class="form-select form-select-solid" wire:model.defer="val.product_type" required>
                                        <option value="digital">{{__('Digital')}}</option>
                                        <option value="physical">{{__('Physical')}}</option>
                                    </select>
                                    @error('val.product_type')
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
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-5 fw-bolder text-dark">{{__('Installment')}}</label>
                                    <select class="form-select form-select-solid" wire:model.defer="val.installment" required>
                                        <option value="1">{{__('Yes')}}</option>
                                        <option value="0">{{__('No')}}</option>
                                    </select>
                                    @error('val.installment')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                                    <span class="form-text">User will pay loan monthly</span>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="fv-row mb-6">
                                    <input class="form-control form-control-lg form-control-solid" type="text" wire:model.defer="val.name" required placeholder="Name of Product" />
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
                                    <label class="col-form-label">{{__('Loan Interest')}}</label>
                                    <div class="input-group">
                                        <input type="number" wire:model.defer="val.interest" steps="any" class="form-control form-control-lg form-control-solid" required placeholder="1">
                                        <span class="input-group-text border-0">%</span>
                                    </div>
                                    @error('val.interest')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="col-form-label">{{__('Defaulter Loan Interest')}}</label>
                                    <div class="input-group">
                                        <input type="number" wire:model.defer="val.failed_interest" steps="any" class="form-control form-control-lg form-control-solid" required placeholder="1">
                                        <span class="input-group-text border-0">%</span>
                                    </div>
                                    @error('val.failed_interest')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="col-form-label">{{__('Loan duration')}}</label>
                                    <div class="input-group">
                                        <input type="number" wire:model.defer="val.duration" steps="any" class="form-control form-control-lg form-control-solid" required placeholder="1">
                                        <span class="input-group-text border-0">{{__('Months')}}</span>
                                    </div>
                                    @error('val.duration')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6">
                                    <input type="url" wire:model.defer="val.digital_link" class="form-control form-control-lg form-control-solid" placeholder="Product download link for digital product">
                                    @error('val.digital_link')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6">
                                    <textarea class="form-control form-control-lg form-control-solid" rows="10" type="text" wire:model.defer="val.description" placeholder="Detailed description of product"></textarea>
                                    @error('val.description')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="text-center mt-10">
                                    <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                                        <span wire:loading.remove wire:target="update">{{__('Update Product')}}</span>
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
    <div wire:ignore.self class="modal fade" id="delete{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">{{__('Delete Product')}}</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="fal fa-times"></i>
                        </span>
                    </div>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this product?</p>
                    <div class="text-center">
                        <a wire:click="delete" class="btn btn-danger btn-block">{{__('Delete product')}}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    document.addEventListener('livewire:load', function() {
        var input = document.querySelector("#suggested_amount{{$val->id}}");
        new Tagify(input, {
            pattern: /[0-9]/,
            minTags: 2,
            maxTags: 5,
            duplicates: true
        });
        input.addEventListener('change', onChange)

        function onChange(e) {
            @this.set('val.suggested_amount', e.target.value);
        }
    });
</script>
@endpush