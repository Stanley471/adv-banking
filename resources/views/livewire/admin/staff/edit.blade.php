<div>
    <div wire:ignore.self id="kt_staff_{{$val->id}}" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_staff_{{$val->id}}_button" data-kt-drawer-close="#kt_staff_{{$val->id}}_close" data-kt-drawer-width="{'md': '500px'}">
        <div class="card w-100">
            <div class="card-header pe-5 border-0">
                <div class="card-title">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Edit Staff')}}</div>
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_staff__{{$val->id}}_close">
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
                            <i class="fal fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="pb-5 mt-10 position-relative zindex-1">
                    <form class="form w-100 mb-10" wire:submit.prevent="update" method="post">
                        <div class="row fv-row mb-6">
                            <div class="col-xl-6">
                                <input class="form-control form-control-lg form-control-solid" type="text" wire:model="val.first_name" autocomplete="off" required placeholder="First Name" />
                                @error('val.first_name')
                                <span class="form-text">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <input class="form-control form-control-lg form-control-solid" type="text" wire:model="val.last_name" autocomplete="off" required placeholder="Last Name" />
                                @error('val.last_name')
                                <span class="form-text">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="fv-row mb-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" wire:model="val.username" required placeholder="Username" />
                            @error('val.username')
                            <span class="form-text">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input type="checkbox" wire:model="val.profile" id="customCheckLogin1" class="custom-control-input">
                                    <label class="custom-control-label" for="customCheckLogin1">
                                        <span class="text-muted">{{__('Customer')}}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input type="checkbox" wire:model="val.support" id="customCheckLogin2" class="custom-control-input">
                                    <label class="custom-control-label" for="customCheckLogin2">
                                        <span class="text-muted">{{__('Ticket')}}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input type="checkbox" wire:model="val.promo" id="customCheckLogin3" class="custom-control-input">
                                    <label class="custom-control-label" for="customCheckLogin3">
                                        <span class="text-muted">{{__('Promotion')}}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input type="checkbox" wire:model="val.message" id="customCheckLogin4" class="custom-control-input">
                                    <label class="custom-control-label" for="customCheckLogin4">
                                        <span class="text-muted">{{__('Message')}}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input type="checkbox" wire:model.defer="val.deposit" id="deposit" class="custom-control-input" value="1">
                                    <label class="custom-control-label" for="deposit">
                                        <span class="text-muted">{{__('Deposit')}}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input type="checkbox" wire:model.defer="val.payout" id="payout" class="custom-control-input" value="1">
                                    <label class="custom-control-label" for="payout">
                                        <span class="text-muted">{{__('Payout')}}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input type="checkbox" wire:model="val.knowledge_base" id="customCheckLogin12" class="custom-control-input">
                                    <label class="custom-control-label" for="customCheckLogin12">
                                        <span class="text-muted">{{__('Help Center')}}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input type="checkbox" wire:model="val.email_configuration" id="customCheckLogin14" class="custom-control-input">
                                    <label class="custom-control-label" for="customCheckLogin14">
                                        <span class="text-muted">{{__('Email Settings')}}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input type="checkbox" wire:model="val.general_settings" id="customCheckLogin15" class="custom-control-input">
                                    <label class="custom-control-label" for="customCheckLogin15">
                                        <span class="text-muted">{{__('General Settings')}}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input type="checkbox" wire:model="val.news" id="customCheckLogin16" class="custom-control-input">
                                    <label class="custom-control-label" for="customCheckLogin16">
                                        <span class="text-muted">{{__('Blog')}}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input type="checkbox" wire:model="val.language" id="language" class="custom-control-input">
                                    <label class="custom-control-label" for="language">
                                        <span class="text-muted">{{__('Language')}}</span>
                                    </label>
                                </div>
                            </div>                            
                            <div class="col-lg-4">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input type="checkbox" wire:model="val.investment" id="investment" class="custom-control-input">
                                    <label class="custom-control-label" for="investment">
                                        <span class="text-muted">{{__('Investment')}}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input type="checkbox" wire:model="val.loan" id="loan" class="custom-control-input">
                                    <label class="custom-control-label" for="loan">
                                        <span class="text-muted">{{__('Loan')}}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input type="checkbox" wire:model="val.savings" id="savings" class="custom-control-input">
                                    <label class="custom-control-label" for="savings">
                                        <span class="text-muted">{{__('Savings')}}</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-10">
                            <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                                <span wire:loading.remove wire:target="update">{{__('Update Staff')}}</span>
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
                    <h3 class="modal-title">{{__('Delete Staff')}}</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="fal fa-times"></i>
                        </span>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <a wire:click="delete" class="btn btn-danger btn-block">{{__('Delete staff')}}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>