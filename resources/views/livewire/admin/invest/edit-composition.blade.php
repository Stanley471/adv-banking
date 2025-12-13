<div>
    <div wire:ignore.self id="kt_category_{{$val->id}}" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_category_{{$val->id}}_button" data-kt-drawer-close="#kt_category_{{$val->id}}_close" data-kt-drawer-width="{'md': '500px'}">
        <div class="card w-100">
            <div class="card-header pe-5 border-0">
                <div class="card-title">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Edit Item')}}</div>
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_category_{{$val->id}}_close">
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
                    <form class="form w-100 mb-10" wire:submit.prevent="update" method="post">
                        <div class="fv-row mb-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" wire:model.defer="val.name" required placeholder="Name" />
                            @error('val.name')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="fv-row mb-6">
                            <div class="input-group">
                                <input class="form-control form-control-lg form-control-solid" type="number" step="any" wire:model.defer="val.percent" required placeholder="Percent" />
                                <span class="input-group-text border-0">%</span>
                            </div>
                            @error('val.percent')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="fv-row mb-6">
                            <label class="form-label fs-6 fw-bolder text-dark">{{__('Colors')}}</label>
                            <select class="form-select form-select-solid" wire:model.defer="val.color" required>
                                <option value="bg-warning">Yellow</option>
                                <option value="bg-info">Blue</option>
                                <option value="bg-success">Green</option>
                                <option value="bg-secondary">Gray</option>
                                <option value="bg-danger">Red</option>
                                <option value="bg-dark">Black</option>
                                <option value="bg-info">Purple</option>
                            </select>
                            @error('val.color')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="text-center mt-10">
                            <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                                <span wire:loading.remove wire:target="update">{{__('Update')}}</span>
                                <span wire:loading wire:target="update">{{__('Processing Request...')}}</span>
                            </button>
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
                    <h3 class="modal-title">{{__('Delete Item')}}</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="fal fa-times"></i>
                        </span>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <a wire:click="delete" class="btn btn-danger btn-block">{{__('Delete item')}}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>