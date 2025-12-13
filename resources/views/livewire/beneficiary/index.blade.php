<div>
    <div class="row g-xl-8 mb-6">
        <div wire:ignore.self class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">{{__('Filter Beneficiary')}}</h3>
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
        <div class="col-md-8">
            <div class="d-flex justify-content-center flex-column me-3">
                <div class="input-group input-group-solid mb-5 rounded-4">
                    <span class="input-group-text" id="basic-addon1"><i class="fal fa-search"></i></span>
                    <input type="search" class="form-control form-control-solid text-dark" wire:model="search" placeholder="{{__('Search Beneficiary')}}" />
                </div>
            </div>
        </div>
        <div class="col-md-4 text-md-end">
            <button data-bs-toggle="modal" data-bs-target="#filter" class="btn btn-white text-dark me-4"><i class="fal fa-filter-list"></i> {{__('Filter')}}</button>
            <button id="kt_beneficiary_button" class="btn btn-dark me-4"><i class="fal fa-plus"></i> {{__('Add Beneficiary')}}</button>
            <div wire:ignore.self id="kt_beneficiary" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_beneficiary_button" data-kt-drawer-close="#kt_beneficiary_close" data-kt-drawer-width="{'md': '500px'}">
                <div class="card w-100">
                    <div class="card-header pe-5 border-0">
                        <div class="card-title">
                            <div class="d-flex justify-content-center flex-column me-3">
                                <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Add Beneficiary')}}</div>
                            </div>
                        </div>
                        <div class="card-toolbar">
                            <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_beneficiary_close">
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
                                    <i class="fal fa-users fa-2x text-info"></i>
                                </div>
                            </div>
                        </div>
                        <div class="pb-5 mt-10 position-relative zindex-1">
                            <form class="form w-100 mb-10" wire:submit.prevent="addBeneficiary" method="post">
                                @error('added')
                                <div class="alert alert-danger">
                                    <div class="d-flex flex-column">
                                        <span>{{$message}}</span>
                                    </div>
                                </div>
                                @enderror
                                <div class="fv-row mb-6 form-floating">
                                    <input class="form-control form-control-lg form-control-solid fs-2 fw-bold @error('merchantId') is-invalid @enderror" type="text" wire:model.defer="merchantId" id="tag" />
                                    <label class="form-label fs-6 fw-bolder text-dark" for="merchant_id">{{__('Merchant ID')}}</label>
                                    @error('merchantId')
                                    <span class="form-text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="bg-light-primary px-6 py-5 mb-10 rounded">
                                    <p class="text-dark fw-bold fs-6 mb-0">{{__('Recipient')}}: <span id="recipient">-</span></p>
                                </div>
                                <div class="text-center mt-10">
                                    <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                                        <span wire:loading.remove wire:target="addBeneficiary">{{__('Submit Request')}}</span>
                                        <span wire:loading wire:target="addBeneficiary">{{__('Processing Request...')}}</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($beneficiary->count() > 0)
    <div class="" wire:loading.class.delay="opacity-50" wire:target="search, status, orderBy, perPage, date">
        @foreach($beneficiary as $val)
        <div class="d-flex flex-stack">
            <div class="d-flex align-items-center">
                <div class="symbol symbol-40px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="{{$val->recipient->business->name}}">
                    @if($val->recipient->avatar == null)
                    <span class="symbol-label bg-info text-inverse-info fw-boldest">{{substr(ucwords($val->recipient->business->name), 0, 1)}}</span>
                    @else
                    <div class="symbol-label" style="background-image:url({{url('/').'/storage/app/'.$val->recipient->avatar}})"></div>
                    @endif
                </div>
                <div class="ps-1">
                    <p class="fs-6 text-dark text-hover-primary fw-bolder mb-0">{{$val->recipient->business->name}}</p>
                    <p class="fs-6 text-gray-800 text-hover-primary mb-0">{{$val->merchant_id}}</p>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <a id="kt_transfer_{{$val->id}}_button" href="" class="btn btn-sm btn-secondary me-3"><i class="fal fa-arrow-up-from-bracket"></i> {{__('Send Money')}}</a>
                <a data-bs-toggle="modal" data-bs-target="#delete{{$val->id}}" href="" class="btn btn-sm btn-danger">{{__('Delete')}}</a>
            </div>
        </div>
        @if(!$loop->last)
        <hr class="bg-light-border">
        @endif
        <livewire:beneficiary.edit :val=$val :user=$user :settings=$set :wire:key="'kt_edit_'. $val->id">
            @endforeach
            @if($beneficiary->total() > 0 && $beneficiary->count() < $beneficiary->total())<button wire:click="loadMore" wire:loading.remove class="btn btn-secondary btn-block">{{__('See more')}}</button>@endif
    </div>
    @else
    <div class="text-center mt-20">
        <img src="{{asset('asset/images/beneficiary.png')}}" style="height:auto; max-width:200px;" class="mb-6">
        <h3 class="text-dark">{{__('No Beneficiary')}}</h3>
        <p class="text-dark">{{__('We couldn\'t find any beneficiary to this account')}}</p>
    </div>
    @endif
</div>
</div>
@push('scripts')
<script>
    function checkTag() {
        var valName = $("#tag").val();
        if (valName.trim() != '') {
            var url = "{{route('tag.check')}}";
            $.post(url, {
                tag: valName,
                "_token": "{{ csrf_token() }}"
            }, function(json) {
                if (json.st == 1) {
                    $("#message").show().text('Recipient doesn\'t exist');
                    $('button').attr('disabled', true);
                } else {
                    $("#recipient").text(json.user.first_name + ' ' + json.user.last_name);
                    $('button').attr('disabled', false);
                    $("#message").show().text('Recipient Exists');
                }
            }, 'json');
        }
    }
    $("#tag").keyup(checkTag);
    checkTag();
</script>
@endpush