<div>

    <button id="kt_mass_email_button" class="btn btn-info me-4"><i class="fal fa-envelope"></i> {{__('Email Followers & Investors')}}</button>
    <div wire:ignore.self id="kt_mass_email" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_mass_email_button" data-kt-drawer-close="#kt_mass_email_close" data-kt-drawer-width="{'md': '500px'}">
        <div class="card w-100">
            <div class="card-header pe-5 border-0">
                <div class="card-title">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Send Email')}}</div>
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_mass_email_close">
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
                            <i class="fal fa-envelope fa-2x"></i>
                        </div>
                    </div>
                    <p class="text-dark fs-6 fw-bold">Send Emails to only followers & investors</p>
                </div>
                <div class="pb-5 mt-10 position-relative zindex-1">
                    <form class="form w-100 mb-10" wire:submit.prevent="sendEmail" method="post">
                        <div class="fv-row mb-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" wire:model.defer="subject" required placeholder="Subject" />
                            @error('subject')
                            <span class="form-text">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="fv-row mb-6">
                            <textarea class="form-control form-control-lg form-control-solid" rows="8" type="text" wire:model.defer="message" required placeholder="Message"></textarea>
                            @error('message')
                            <span class="form-text">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="text-center mt-10">
                            <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2" id="filepond-upload">
                                <span wire:loading.remove wire:target="sendEmail">{{__('Add to Queue')}}</span>
                                <span wire:loading wire:target="sendEmail">{{__('Processing Request...')}}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if($plan->type == 'mutual')
    @if($plan->dividend == 1)
    <button id="kt_dividend_button" class="btn btn-dark me-4"><i class="fal fa-users"></i> {{__('Share Dividend')}}</button>
    <div wire:ignore.self id="kt_dividend" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_dividend_button" data-kt-drawer-close="#kt_dividend_close" data-kt-drawer-width="{'md': '500px'}">
        <div class="card w-100">
            <div class="card-header pe-5 border-0">
                <div class="card-title">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Share Dividend')}}</div>
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_mass_email_close">
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
                    <p class="text-dark fs-6 fw-bold">Dividend will be shared among investors according to units owned</p>
                </div>
                <div class="pb-5 mt-10 position-relative zindex-1">
                    <form class="form w-100 mb-10" wire:submit.prevent="dividend" method="post">
                        <div class="fv-row mb-6">
                            <label class="form-label fs-5 fw-bolder text-dark">Amount</label>
                            <div class="input-group">
                                <span class="input-group-text border-0 fs-2">{{$currency->currency_symbol}}</span>
                                <input type="number" step="any" wire:model.defer="amount" placeholder="{{__('0.00')}}" autocomplete="off" class="form-control form-control-lg form-control-solid fs-2 fw-bold">
                                <span class="input-group-text border-0"><span class="fi fi-{{strtolower($currency->iso2)}} fis rounded-4 me-3 fs-1"></span></span>
                            </div>
                            @error('amount')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="fv-row mb-6">
                            <label class="form-label fs-5 fw-bolder text-dark">Super Admin Password</label>
                            <input class="form-control form-control-lg form-control-solid" type="password" wire:model.defer="password" required placeholder="Password"/>
                            @error('password')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="text-center mt-10">
                            <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2" id="filepond-upload">
                                <span wire:loading.remove wire:target="dividend">{{__('Add to Queue')}}</span>
                                <span wire:loading wire:target="dividend">{{__('Processing Request...')}}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endif
</div>