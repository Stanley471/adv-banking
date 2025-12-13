<div>
    <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
        <div class="container">
            <div class="row g-xl-8">
                <div class="col-md-8">
                    <div class="input-group input-group-solid mb-5 rounded-4">
                        <span class="input-group-text" id="basic-addon1"><i class="fal fa-search"></i></span>
                        <input type="search" class="form-control form-control-solid text-dark" wire:model="search" placeholder="{{__('Search ticket')}}" />
                    </div>
                </div>
                <div class="col-md-4 text-end">
                    <button data-bs-toggle="modal" data-bs-target="#filter" class="btn btn-white text-dark me-4"><i class="fal fa-filter-list"></i> {{__('Audit')}}</button>
                </div>
            </div>
            <div wire:ignore.self class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">{{__('Filter Audit')}}</h3>
                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <span class="svg-icon svg-icon-1">
                                    <i class="fal fa-times"></i>
                                </span>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="fv-row mb-6">
                                <label class="form-label fs-6 fw-bolder text-dark">{{__('Sort by')}}</label>
                                <select class="form-select form-select-solid" wire:model="orderBy">
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
            @if($audit->count() > 0)
            <div class="card-body" wire:loading.class.delay="opacity-50" wire:target="search, status, orderBy, perPage">
                @foreach($audit as $tt)
                <div class="d-flex flex-stack cursor-pointer" id="kt_message_{{$tt->id}}_button">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-45px symbol-circle me-4">
                            <div class="symbol-label fs-2 fw-bolder text-dark">
                                <i class="fal fa-clipboard-list-check"></i>
                            </div>
                        </div>
                        <div class="ps-1">
                            <p href="#" class="fs-6 text-dark mb-2">{{$tt->log}}</p>
                            <p href="#" class="fs-6 text-dark mb-2">{{date("Y/m/d h:i:A", strtotime($tt->created_at))}}</p>
                        </div>
                    </div>
                </div>
                @if(!$loop->last)
                <hr class="bg-light-border">
                @endif
                @endforeach
                @if($audit->total() > 0 && $audit->count() < $audit->total())<button wire:click="loadMore" wire:loading.remove class="btn btn-secondary btn-block">{{__('See more')}}</button>@endif
            </div>
            @else
            <div class="text-center mt-20">
                <img src="{{asset('asset/images/transactions.png')}}" style="height:auto; max-width:200px;" class="mb-6">
                <h3 class="text-dark">{{__('No Audit')}}</h3>
                <p class="text-dark">{{__('We couldn\'t find any audit to this account')}}</p>
            </div>
            @endif

        </div>
    </div>
</div>
@push('scripts')
<script>
    var element = $('#scrollToBottom');
    element.scrollTop(element[0].scrollHeight);

    window.livewire.on('newChat', function() {
        var element = $('#scrollToBottom');
        element.scrollTop(element[0].scrollHeight);
    });
</script>
@endpush