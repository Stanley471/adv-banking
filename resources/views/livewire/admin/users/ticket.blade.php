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
                    <button data-bs-toggle="modal" data-bs-target="#filter" class="btn btn-white text-dark me-4"><i class="fal fa-filter-list"></i> {{__('Filter')}}</button>
                </div>
            </div>
            <div wire:ignore.self class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">{{__('Filter Ticket')}}</h3>
                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <span class="svg-icon svg-icon-1">
                                    <i class="fal fa-times"></i>
                                </span>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="fv-row mb-6">
                                <label class="form-label fs-6 fw-bolder text-dark">{{__('Type')}}</label>
                                <select class="form-select form-select-solid" wire:model="status">
                                    <option value="">{{__('All')}}</option>
                                    <option value="0">{{__('Open')}}</option>
                                    <option value="1">{{__('Closed')}}</option>
                                </select>
                            </div>
                            <div class="fv-row mb-6">
                                <label class="form-label fs-6 fw-bolder text-dark">{{__('Priority')}}</label>
                                <select class="form-select form-select-solid" wire:model="priority">
                                    <option value="">{{__('All')}}</option>
                                    <option value="low">{{__('Low')}}</option>
                                    <option value="medium">{{__('Medium')}}</option>
                                    <option value="high">{{__('High')}}</option>
                                </select>
                            </div>
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
            @if($ticket->count() > 0)
            <div class="card-body" wire:loading.class.delay="opacity-50" wire:target="search, status, orderBy, perPage">
                @foreach($ticket as $tt)
                <div class="d-flex flex-stack cursor-pointer" id="kt_message_{{$tt->id}}_button">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-45px symbol-circle me-4">
                            <div class="symbol-label fs-2 fw-bolder text-dark">
                                <i class="fal fa-clipboard-list-check"></i>
                            </div>
                        </div>
                        <div class="ps-1">
                            <p href="#" class="fs-6 text-dark text-hover-primary fw-bolder mb-0">{{$tt->ticket_id}}</p>
                            <p href="#" class="fs-6 text-dark mb-0">{{$tt->subject}}</p>
                            <p href="#" class="fs-6 text-dark mb-2">{{date("Y/m/d h:i:A", strtotime($tt->created_at))}}</p>
                            @if($tt->status == 0)
                            <span class="badge badge-sm badge-info">{{__('Open')}} </span>
                            @else
                            <span class="badge badge-sm badge-danger">{{__('Closed')}} </span>
                            @endif
                            <span class="badge badge-sm badge-secondary">{{__('Priority: ').ucwords($tt->priority)}}</span>
                            @if($tt->files != null)
                            <span class="badge badge-sm badge-secondary"><i class="fal fa-paperclip"></i> Attachment</span>
                            @endif
                        </div>
                    </div>
                    <button class="btn btn-white text-dark fw-bolder btn-sm px-5">{{__('Details')}}</button>
                </div>
                @if(!$loop->last)
                <hr class="bg-light-border">
                @endif
                @endforeach
                @if($ticket->total() > 0 && $ticket->count() < $ticket->total())<button wire:click="loadMore" wire:loading.remove class="btn btn-secondary btn-block">{{__('See more')}}</button>@endif
            </div>
            @else
            <div class="text-center mt-20">
                <img src="{{asset('asset/images/transactions.png')}}" style="height:auto; max-width:200px;" class="mb-6">
                <h3 class="text-dark">{{__('No Ticket')}}</h3>
                <p class="text-dark">{{__('We couldn\'t find any ticket to this account')}}</p>
            </div>
            @endif

        </div>
    </div>
    @foreach($ticket as $val)
    <livewire:ticket.admin-reply :val=$val :admin=$admin :settings=$set :wire:key="'kt_message_'. $val->id">
        @endforeach
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