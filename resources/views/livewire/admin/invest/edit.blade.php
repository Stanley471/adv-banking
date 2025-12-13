<div>
    @include('admin.invest.header', ['plan' => $val, 'type' => $type])
    <div class="card mb-10">
        <div class="card-body">
            <form class="form w-100 mb-10" wire:submit.prevent="update" method="post">
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
                                        background-image: url({{asset('dashboard/media/svg/files/blank-image.svg')}})
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
                                        <input type="file" wire:model="image" id="image" accept=".png, .jpg, .jpeg">
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
                            <select class="form-select form-select-solid" wire:model.defer="val.cat_id" required>
                                <option value="">Select Category</option>
                                @foreach($categoryAll as $cat)
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
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
                            <span class="form-text text-danger">Disabling a plan that has investors will only hide it from new investors</span>
                            @error('val.status')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="fv-row mb-6">
                            <label class="form-label fs-5 fw-bolder text-dark">{{__('Insured')}}</label>
                            <select class="form-select form-select-solid" wire:model.defer="val.insurance" required>
                                <option value="0">{{__('No')}}</option>
                                <option value="1">{{__('Yes')}}</option>
                            </select>
                            @error('val.insurance')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="fv-row mb-6">
                            <label class="form-label fs-5 fw-bolder text-dark">{{__('Minimum Buying Units')}}</label>
                            <input type="number" wire:model.defer="val.min_buy" placeholder="{{__('least amount of units that can be bought')}}" autocomplete="off" class="form-control form-control-lg form-control-solid">
                            @error('val.min_buy')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div wire:ignore>
                            <div class="fv-row mb-6">
                                <label class="form-label fs-6 fw-bolder text-dark">{{__('Investment fee type')}}</label>
                                <select class="form-select form-select-solid" wire:model.defer="val.fee_type" id="fee" required>
                                    <option value="both">Percentage & Fiat</option>
                                    <option value="percent">Percentage</option>
                                    <option value="fiat">Fiat</option>
                                    <option value="none">No fees</option>
                                    <option value="min">Below</option>
                                    <option value="max">Above</option>
                                </select>
                                @error('val.fee_type')
                                <span class="form-text text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="fv-row mb-6">
                                <div class="input-group">
                                    <input type="number" step="any" wire:model.defer="val.percent_pc" id="percent_pc" placeholder="{{__('Percent charge')}}" autocomplete="off" class="form-control form-control-lg form-control-solid">
                                    <span class="input-group-text border-0">%</span>
                                </div>
                                @error('val.percent_pc')
                                <span class="form-text text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="fv-row mb-6">
                                <div class="input-group">
                                    <span class="input-group-text border-0">{{$currency->currency_symbol}}</span>
                                    <input type="number" step="any" wire:model.defer="val.fiat_pc" id="fiat_pc" placeholder="{{__('Fiat charge')}}" autocomplete="off" class="form-control form-control-lg form-control-solid">
                                </div>
                                @error('val.fiat_pc')
                                <span class="form-text text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="fv-row mb-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" wire:model.defer="val.name" required placeholder="Name of Plan" />
                            @error('val.name')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="fv-row mb-6">
                            <label class="col-form-label">{{__('Price per units')}}</label>
                            <div class="input-group">
                                <span class="input-group-text border-0">{{$currency->currency_symbol}}</span>
                                <input type="number" wire:model.defer="val.price" steps="any" class="form-control form-control-lg form-control-solid" required placeholder="0.00">
                            </div>
                            @error('val.price')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="fv-row mb-6">
                            <label class="col-form-label">{{__('Investment Interest')}}</label>
                            <div class="input-group">
                                <input type="number" wire:model.defer="val.interest" steps="any" class="form-control form-control-lg form-control-solid" required placeholder="1">
                                <span class="input-group-text border-0">%</span>
                            </div>
                            @error('val.interest')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="fv-row mb-6">
                            <label class="col-form-label">{{__('Investment duration')}}</label>
                            <div class="input-group">
                                <input type="number" wire:model.defer="val.duration" steps="any" class="form-control form-control-lg form-control-solid" required placeholder="1">
                                <span class="input-group-text border-0">{{__('Months')}}</span>
                            </div>
                            @error('val.duration')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="fv-row mb-6">
                            <label class="col-form-label">{{__('Total number of units')}}</label>
                            <input type="number" wire:model.defer="val.units" steps="any" class="form-control form-control-lg form-control-solid" required placeholder="units">
                            @error('val.units')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="fv-row mb-6">
                            <label class="col-form-label">{{__('Site Location')}}</label>
                            <input type="text" wire:model.defer="val.location" steps="any" class="form-control form-control-lg form-control-solid" required placeholder="Location of operations">
                            @error('val.location')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="fv-row mb-6">
                            <label class="col-form-label">{{__('Start - Close Date for buying units')}}</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="date" wire:model.defer="val.start_date" class="form-control form-control-lg form-control-solid" required>
                                    <span class="form-text">{{__('Investors can buy units from this day')}}</span>
                                    @error('val.start_date')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <input type="date" wire:model.defer="val.close_date" class="form-control form-control-lg form-control-solid" required>
                                    <span class="form-text">{{__('The window for investors to invest is closed on this day, it must be greater than start date')}}</span>
                                    @error('val.close_date')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="fv-row mb-6">
                            <textarea class="form-control form-control-lg form-control-solid" rows="15" type="text" wire:model.defer="val.details" placeholder="Detailed description of project"></textarea>
                            @error('val.details')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="text-center mt-10">
                            <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                                <span wire:loading.remove wire:target="update">{{__('Edit Plan')}}</span>
                                <span wire:loading wire:target="update">{{__('Processing Request...')}}</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
<script>
    window.livewire.on('closeDrawer', function() {
        KTDrawer.hideAll();
        KTDrawer.createInstances();
        fee();
    });
</script>
<script>
    document.addEventListener('livewire:load', function() {
        fee();
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
    $("#fee").change(fee);
    fee();
</script>
@endpush