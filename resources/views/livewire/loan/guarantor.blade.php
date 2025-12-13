<div>
    @if(in_array($user->business->loan_status, ['pending', 'processing', 'declined']))
    <div class="row g-8 row-cols-1 row-cols-sm-1 mb-6">
        <div class="col mb-3">
            <a href="#" id="kt_guarantor_button">
                <div class="text-start bg-white shadow-xs rounded-5 p-7">
                    <div class="symbol symbol-75px mt-1 mb-3">
                        <span class="symbol-label bg-light-info rounded-4">
                            <i class="fal fa-fingerprint fa-3x text-info"></i>
                        </span>
                    </div>
                    <p class="text-dark fw-boldest fs-3 mt-4 d-block mb-0">{{__('Get Loan Approval')}}</p>
                    <p class="text-dark">{{__('You are required to provide guarantor information & financial statement between ').(date('Y') - 1).' & '.date('Y')}}</p>
                    <span class="badge badge-info mb-3">{{ucwords($user->business->loan_status)}}</span>
                    @if($user->business->loan_status == 'declined' && $user->business->decline_reason != null)
                    <div class="alert alert-danger">
                        <div class="d-flex flex-column">
                            <p class="mb-0 text-dark fs-6"><i class="fal fa-note"></i> {{$user->business->decline_reason}}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </a>
            <div wire:ignore.self id="kt_guarantor" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_guarantor_button" data-kt-drawer-close="#kt_guarantor_close" data-kt-drawer-width="{'md': '600px'}">
                <div class="card w-100">
                    <div class="card-header pe-5 border-0">
                        <div class="card-title">
                            <div class="d-flex justify-content-center flex-column me-3">
                                <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Loan Application')}}</div>
                            </div>
                        </div>
                        <div class="card-toolbar">
                            <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_guarantor_close">
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
                                    <i class="fal fa-fingerprint fa-2x text-info"></i>
                                </div>
                            </div>
                        </div>
                        <div class="pb-5 mt-10 position-relative zindex-1">
                            @if($user->business->loan_status == 'pending' || $user->business->loan_status == 'declined')
                            <form class="form w-100 mb-10" wire:submit.prevent="addGuarantor" method="post">
                                @error('added')
                                <div class="alert alert-danger">
                                    <div class="d-flex flex-column">
                                        <span>{{$message}}</span>
                                    </div>
                                </div>
                                @enderror
                                <p class="fw-bolder fs-5">{{__('Financial statement between ').(date('Y') - 1).' & '.date('Y')}}</p>
                                <div class="form-group" wire:ignore>
                                    <input type="file" class="filepond mb-1 mt-2" name="financial_statement" id="financial_statement" data-max-file-size="10MB" data-max-files="1" allow-multiple="false" accepted-file-types="application/pdf">
                                    <p class="form-text text-muted">{{__('The document must show exactly this information; legal name -')}} {{$user->business->name}}</p>
                                </div>
                                @error('financial_statement')
                                <span class="form-text text-muted">{{$message}}</span>
                                @enderror
                                @livewire('individual-compliance', ['user' => $user, 'type' => 'financial_statement'])
                                <hr class="bg-secondary">
                                <p class="fw-bolder fs-5">{{__('Guarantor Information')}}</p>
                                <div class="row fv-row">
                                    <div class="col-xl-6 mb-6">
                                        <input class="form-control form-control-lg form-control-solid" type="text" wire:model.defer="g_first_name" autocomplete="off" placeholder="Legal first name" required />
                                        @error('g_first_name')
                                        <span class="form-text">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col-xl-6 mb-6">
                                        <input class="form-control form-control-lg form-control-solid" type="text" wire:model.defer="g_last_name" autocomplete="off" placeholder="Legal last name" required />
                                        @error('g_last_name')
                                        <span class="form-text">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="fv-row mb-6">
                                    <input class="form-control form-control-lg form-control-solid" type="email" wire:model.defer="g_email" autocomplete="email" placeholder="Email address" required />
                                    @error('g_email')
                                    <span class="form-text">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6" wire:ignore>
                                    <input type="hidden" wire:model="g_mobile_code" id="code" class="text-uppercase">
                                    <input type="tel" id="phone" wire:model.defer="g_mobile" class="form-control form-control-lg form-control-solid border-light" required>
                                </div>
                                @error('g_mobile')
                                <p class="form-text mb-6 mt-n6">{{$message}}</p>
                                @enderror
                                <div class="fv-row mb-6">
                                    <input class="form-control form-control-lg form-control-solid" type="text" wire:model.defer="g_address" autocomplete="address" placeholder="Address" required />
                                    @error('g_address')
                                    <span class="form-text">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6">
                                    <select class="form-select form-select-solid" required wire:model.defer="g_doc_type" id="doc_type" required>
                                        <option value="">{{__('Select Document type')}}</option>
                                        @foreach($kyc as $val)
                                        <option value="{{$val->id}}" data-type="{{$val->type}}" data-min="{{$val->min}}" data-max="{{$val->max}}" @if($user->business->doc_type==$val->id || old('doc_type')==$val->id) selected @endif>{{$val->title}}</option>
                                        @endforeach
                                    </select>
                                    @error('g_doc_type')
                                    <span class="form-text">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6">
                                    <input type="text" wire:model.defer="g_doc_number" id="doc_number" required class="form-control form-control-lg form-control-solid" placeholder="Document Number">
                                    @error('g_doc_number')
                                    <span class="form-text">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-6">
                                    <p class="form-text text-dark mb-3">{{__('Document front must show exactly this information; legal name of guarantor & Document ID')}}</p>
                                    <div class="row" wire:ignore>
                                        <div class="col-md-6">
                                            <input type="file" class="filepond mb-2 mt-2" name="g_doc_front" id="g_doc_front" data-max-file-size="10MB" data-max-files="1" allow-multiple="false" accepted-file-types="image/jpeg, image/png, image/jpg">
                                            @livewire('individual-compliance', ['user' => $user, 'type' => 'g_doc_front'])
                                        </div>
                                        <div class="col-md-6">
                                            <input type="file" class="filepond mb-2 mt-2" name="g_doc_back" id="g_doc_back" data-max-file-size="10MB" data-max-files="1" allow-multiple="false" accepted-file-types="image/jpeg, image/png, image/jpg">
                                            @livewire('individual-compliance', ['user' => $user, 'type' => 'g_doc_back'])
                                        </div>
                                    </div>
                                    @if ($errors->has('g_doc_front'))
                                    <span class="form-text">{{$errors->first('g_doc_front')}}</span>
                                    @endif
                                    @if ($errors->has('g_doc_back'))
                                    <span class="form-text">{{$errors->first('g_doc_back')}}</span>
                                    @endif
                                </div>
                                <div class="form-group" wire:ignore>
                                    <label class="form-label fw-bolder text-dark fs-6 col-xl-12 required">{{__('Proof of address')}}</label>
                                    <input type="file" class="filepond mb-1 mt-2" name="g_proof_of_address" id="g_proof_of_address" data-max-file-size="10MB" data-max-files="1" allow-multiple="false" accepted-file-types="image/jpeg, image/png, image/jpg">
                                    <p class="form-text text-dark">{{__('The document must show exactly this information; legal name of guarantor & address')}}</p>
                                </div>
                                @if ($errors->has('g_proof_of_address'))
                                <p class="form-text mb-6 mt-n6">{{$errors->first('g_proof_of_address')}}</p>
                                @endif
                                @livewire('individual-compliance', ['user' => $user, 'type' => 'g_proof_of_address'])
                                <div class="text-center mt-10">
                                    <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                                        <span wire:loading.remove wire:target="addGuarantor">{{__('Submit Request')}}</span>
                                        <span wire:loading wire:target="addGuarantor">{{__('Processing Request...')}}</span>
                                    </button>
                                </div>
                            </form>
                            @elseif($user->business->loan_status == 'processing')
                            <p class="text-center fs-2 fw-bolder text-dark">{{__('Loan Guarantor information is under review')}}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@push('scripts')
<script src="{{asset('front/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script>
    function initPhoneToggle() {
        const phoneInputField = document.querySelector("#phone");
        const phoneInput = window.intlTelInput(phoneInputField, {
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });
        var old = "{{$user->business->g_mobile}}";
        if (old.trim() != '') {
            phoneInput.setCountry(old)
        }
        $('#code').val(phoneInput.getSelectedCountryData().iso2);
        @this.set('g_mobile_code', phoneInput.getSelectedCountryData().iso2);
        phoneInputField.addEventListener("countrychange", function() {
            $('#code').val(phoneInput.getSelectedCountryData().iso2);
            @this.set('g_mobile_code', phoneInput.getSelectedCountryData().iso2);
        });
    }
    document.addEventListener('livewire:load', function() {
        initPhoneToggle();
    });
    $(document).ready(function() {
        initPhoneToggle();
    });
</script>
@endpush