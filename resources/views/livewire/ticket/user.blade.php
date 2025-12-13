<div>
    <div class="toolbar" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <h1 class="text-dark fw-bolder my-1 fs-2">{{__('Support Ticket')}}</h1>
                <ul class="breadcrumb fw-semibold fs-base my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('user.dashboard')}}" class="text-muted text-hover-primary">{{__('Dashboard')}}</a>
                    </li>
                    <li class="breadcrumb-item text-dark">{{__('Tickets')}}</li>
                </ul>
            </div>
            <div class="d-flex align-items-center flex-nowrap text-nowrap py-1">
                <button data-bs-toggle="modal" data-bs-target="#filter" class="btn btn-white text-dark me-4"><i class="fal fa-filter-list"></i> {{__('Filter')}}</button>
                <button id="kt_ticket_button" class="btn btn-dark me-4"><i class="fal fa-plus"></i> {{__('Open Ticket')}}</button>
                <div wire:ignore.self id="kt_ticket" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_ticket_button" data-kt-drawer-close="#kt_ticket_close" data-kt-drawer-width="{'md': '500px'}">
                    <div class="card w-100">
                        <div class="card-header pe-5 border-0">
                            <div class="card-title">
                                <div class="d-flex justify-content-center flex-column me-3">
                                    <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Open Ticket')}}</div>
                                </div>
                            </div>
                            <div class="card-toolbar">
                                <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_ticket_close">
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
                                        <i class="fal fa-clipboard-list-check fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="pb-5 mt-10 position-relative zindex-1">
                                <form class="form w-100 mb-10" wire:submit.prevent="addTicket" method="post">
                                    <div class="fv-row mb-6">
                                        <label class="form-label fs-6 fw-bolder text-dark">{{__('Title')}}</label>
                                        <input class="form-control form-control-lg form-control-solid" type="text" wire:model="subject" required placeholder="Title of complaint" />
                                        @error('subject')
                                        <span class="form-text text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="fv-row mb-6">
                                        <label class="form-label fs-6 fw-bolder text-dark">{{__('Priority')}}</label>
                                        <select class="form-select form-select-solid" wire:model="selectPriority" required>
                                            <option value="low">{{__('Low')}}</option>
                                            <option value="medium">{{__('Medium')}}</option>
                                            <option value="high">{{__('High')}}</option>
                                        </select>
                                        @error('selectPriority')
                                        <span class="form-text text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="fv-row mb-6">
                                        <label class="form-label fs-6 fw-bolder text-dark">{{__('Description')}}</label>
                                        <textarea class="form-control form-control-lg form-control-solid preserveLines" rows="6" type="text" wire:model="details" required placeholder="Whats your complaint?"></textarea>
                                        @error('details')
                                        <span class="form-text text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="fv-row mb-6">
                                        <label class="form-label fs-6 fw-bolder text-dark">{{__('Attachment - Optional')}}</label>
                                        <input class="form-control form-control-lg form-control-solid" type="file" wire:model="files" multiple />
                                        @error('files.*')
                                        <span class="form-text text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="text-center mt-10">
                                        <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                                            <span wire:loading.remove wire:target="addTicket">{{__('Submit Ticket')}}</span>
                                            <span wire:loading wire:target="addTicket">{{__('Processing Request...')}}</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
        <div class="container">
            <div class="row g-xl-8">
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
                <div class="col-lg-12 col-md-12">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <div class="col-md-12">
                            <div class="input-group input-group-solid mb-5 rounded-4">
                                <span class="input-group-text" id="basic-addon1"><i class="fal fa-search"></i></span>
                                <input type="search" class="form-control form-control-solid text-dark" wire:model="search" placeholder="{{__('Search ticket')}}" />
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
        </div>
    </div>
    @foreach($ticket as $val)
    <livewire:ticket.user-reply :val=$val :user=$user :settings=$set :wire:key="'kt_message_'. $val->id">
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