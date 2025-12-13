<div>
    @if($type == "kin")
    <div class="card mb-10" id="kin">
        <div class="card-body">
            <form wire:submit.prevent="save" method="post">
                @csrf
                <p class="fw-bolder fs-3 text-dark">Next of Kin</p>
                <div class="row fv-row">
                    <div class="col-xl-6 mb-6">
                        <label class="form-label fw-bolder text-dark fs-6">{{__('First Name')}}</label>
                        <input class="form-control form-control-lg form-control-solid" type="text" wire:model.defer="kin_first_name" autocomplete="off" placeholder="Legal first name" required />
                        @error('kin_first_name')
                        <span class="form-text">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-xl-6 mb-6">
                        <label class="form-label fw-bolder text-dark fs-6">{{__('Last Name')}}</label>
                        <input class="form-control form-control-lg form-control-solid" type="text" wire:model.defer="kin_last_name" autocomplete="off" placeholder="Legal last name" required />
                        @error('kin_last_name')
                        <span class="form-text">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="fv-row mb-6">
                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Email')}}</label>
                    <input class="form-control form-control-lg form-control-solid" type="email" wire:model.defer="kin_email" autocomplete="email" placeholder="Email address" required />
                    @error('kin_email')
                    <span class="form-text">{{$message}}</span>
                    @enderror
                </div>
                <div class="fv-row mb-6" wire:ignore>
                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Phone')}}</label>
                    <input type="hidden" wire:model="kin_mobile_code" id="code" class="text-uppercase">
                    <input type="tel" id="phone" wire:model.defer="kin_mobile" class="form-control form-control-lg form-control-solid border-light" required>
                </div>
                @error('kin_mobile')
                <p class="form-text mb-6 mt-n6">{{$message}}</p>
                @enderror
                <div class="fv-row mb-6">
                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Address')}}</label>
                    <input class="form-control form-control-lg form-control-solid" type="text" wire:model.defer="kin_address" autocomplete="address" placeholder="Next of Kin Address" required />
                    @error('kin_address')
                    <span class="form-text">{{$message}}</span>
                    @enderror
                </div>
                <div class="text-center mt-10">
                    <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                        <span wire:loading.remove wire:target="save">{{__('Update Next of Kin')}}</span>
                        <span wire:loading wire:target="save">{{__('Processing Request...')}}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    @else
    <div class="card mb-10">
        <div class="card-body">
            <form wire:submit.prevent="profile" method="post">
                @csrf
                <div class="row fv-row">
                    <div class="col-xl-6 mb-6">
                        <label class="form-label fw-bolder text-dark fs-6">{{__('First Name')}}</label>
                        <input class="form-control form-control-lg form-control-solid" type="text" name="first_name" autocomplete="off" value="{{$user->first_name}}" required readonly />
                        @error('first_name')
                        <span class="form-text">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-xl-6 mb-6">
                        <label class="form-label fw-bolder text-dark fs-6">{{__('Last Name')}}</label>
                        <input class="form-control form-control-lg form-control-solid" type="text" name="last_name" autocomplete="off" value="{{$user->last_name}}" required readonly />
                        @error('last_name')
                        <span class="form-text">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="fv-row mb-6">
                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Email')}}</label>
                    <input class="form-control form-control-lg form-control-solid" type="email" name="email" autocomplete="email" value="{{$user->email}}" required readonly />
                    @error('email')
                    <span class="form-text">{{$message}}</span>
                    @enderror
                </div>
                <div class="fv-row mb-6">
                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Phone')}}</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text border-0"><span class="fi fi-{{strtolower($user->mobile_code)}} fis rounded-4 me-3 fs-1"></span></span>
                        <input class="form-control form-control-lg form-control-solid" type="tel" name="phone" autocomplete="phone" value="{{$user->phone}}" required placeholder="123456789" readonly />
                    </div>
                    @error('phone')
                    <span class="form-text">{{$message}}</span>
                    @enderror
                </div>
                @if($set->language == 1)
                <div class="fv-row mb-6">
                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Language')}}</label>
                    <select class="form-select form-select-solid" wire:model="language" required>
                        <option value="">Select a Language...</option>
                        @foreach(getLang() as $lang)
                        <option value="{{$lang->code}}">{{$lang->name}}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                <div class="text-start">
                    <button type="submit" class="btn btn-lg btn-info fw-bolder me-3 my-2">
                        <span wire:loading.remove wire:target="profile">{{__('Update Account')}}</span>
                        <span wire:loading wire:target="profile">{{__('Processing Request...')}}</span>
                    </button>
                    <a data-bs-toggle="modal" data-bs-target="#delaccount" class="btn btn-lg btn-light-danger fw-bolder me-3 my-2">{{__('Deactivate Account')}}</a>
                </div>
            </form>
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
        var old = "{{$user->business->kin_mobile}}";
        if (old.trim() != '') {
            phoneInput.setCountry(old)
        }
        $('#code').val(phoneInput.getSelectedCountryData().iso2);
        @this.set('kin_mobile_code', phoneInput.getSelectedCountryData().iso2);
        phoneInputField.addEventListener("countrychange", function() {
            $('#code').val(phoneInput.getSelectedCountryData().iso2);
            @this.set('kin_mobile_code', phoneInput.getSelectedCountryData().iso2);
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