<div>
    <div wire:ignore.self id="kt_message_{{$val->id}}" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_message_{{$val->id}}_button" data-kt-drawer-close="#kt_message_{{$val->id}}_close" data-kt-drawer-width="{'md': '500px'}">
        <div class="card w-100">
            <div class="card-header pe-5 border-0">
                <div class="card-title">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Manage Ticket')}}</div>
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_message_{{$val->id}}_close">
                        <span class="svg-icon svg-icon-2">
                            <i class="fal fa-times"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body text-wrap">
                <div class="pb-5 mt-10 position-relative zindex-1">
                    <div class="bg-light px-6 py-5 mb-10 rounded">
                        <div class="row">
                            <div class="col-md-8">
                                <p class="text-dark fs-6 fw-bolder">{{__('Ticket Details')}}</p>
                            </div>
                            <div class="col-md-4 text-end">
                                @if($val->status == 0)
                                <a href="#" wire:click="close"><i class="fal fa-check"></i> {{__('Close Ticket')}}</a>
                                @else
                                <a href="#" wire:click="open"><i class="fal fa-sync"></i> {{__('Re-Open Ticket')}}</a>
                                @endif
                            </div>
                        </div>
                        <li class="d-flex align-items-center py-2">
                            <span class="bullet me-5 bg-info bullet-vertical"></span> <span>{{__('Ticket ID')}}: {{$val->ticket_id}} <i class="fal fa-clone castro-copy fs-5" data-clipboard-text="{{$val->ticket_id}}" title="Copy"></i></span>
                        </li>
                        <li class="d-flex align-items-center py-2">
                            <span class="bullet me-5 bg-info bullet-vertical"></span> <span>{{__('Subject')}}: {{$val->subject}}</span>
                        </li>
                        <li class="d-flex align-items-center py-2">
                            <span class="bullet me-5 bg-info bullet-vertical"></span> <span>{{__('Created')}}: {{date("Y/m/d h:i:A", strtotime($val->created_at))}}</span>
                        </li>
                        @if($val->files != null)
                        <div class="overflow-auto pb-5">
                            <div class="d-flex align-items-center border border-dashed border-gray-400 rounded p-3">
                                @foreach(explode(',', $val->files) as $files)
                                <a href="{{url('/').'/storage/app/'.$files}}" target="_blank" class="text-dark me-2"><i class="fal fa-file-alt fs-2"></i></a>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="card-body" id="kt_chat_messenger_body" wire:poll.visible>
                        <div class="scroll-y me-n5 pe-5 h-300px h-lg-auto" id="scrollToBottom" data-kt-element="messages" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_toolbar, #kt_footer, #kt_chat_messenger_header, #kt_chat_messenger_footer" data-kt-scroll-wrappers="#kt_content, #kt_chat_messenger_body" data-kt-scroll-offset="-2px" style="max-height: 266px;">
                            <div class="d-flex justify-content-start mb-10">
                                <div class="d-flex flex-column align-items-start">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="me-3">
                                            <span class="text-muted fs-7 mb-1">{{$val->created_at->diffForHumans()}}</span>
                                            <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1">{{$val->business->name}}</a>
                                        </div>
                                        <div class="symbol symbol-35px symbol-circle">
                                            <div class="symbol-label fs-5 fw-bolder text-dark bg-light-primary">{{strtoupper(substr($val->business->name, 0, 2))}}</div>
                                        </div>
                                    </div>
                                    <div class="p-5 rounded text-dark fw-bold mw-lg-400px text-start preserveLines bg-light-primary" data-kt-element="message-text">{{$val->message}}</div>
                                </div>
                            </div>
                            @if($val->reply->count()>0)
                            @foreach($val->reply as $reply)
                            <div class="d-flex {{($reply->status == 1) ? 'justify-content-end' : 'justify-content-start'}} mb-10">
                                <div class="d-flex flex-column {{($reply->status == 1) ? 'align-items-end' : 'align-items-start'}}">
                                    <div class="d-flex align-items-center mb-2">
                                        @if($reply->status == 0)
                                        <div class="me-3">
                                            <span class="text-muted fs-7 mb-1">{{$val->created_at->diffForHumans()}}</span>
                                            <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1">{{$val->business->name}}</a>
                                        </div>
                                        <div class="symbol symbol-35px symbol-circle">
                                            <div class="symbol-label fs-5 fw-bolder text-dark">{{strtoupper(substr($val->business->name, 0, 2))}}</div>
                                        </div>
                                        @else
                                        <div class="me-3">
                                            <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary ms-1">{{$reply->staff->first_name.' '.$reply->staff->last_name}}</a>
                                            <span class="text-muted fs-7 mb-1">{{$val->created_at->diffForHumans()}}</span>
                                        </div>
                                        <div class="symbol symbol-35px symbol-circle">
                                            <div class="symbol-label fs-5 fw-bolder text-dark bg-light-info"><i class="fal fa-university"></i></div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="p-5 rounded text-dark fw-bold mw-lg-400px preserveLines text-start {{($reply->status == 1) ? 'bg-light-info' : 'bg-light-primary'}}" data-kt-element="message-text">{{$reply->reply}}</div>
                                    @if($reply->status == 0)
                                    @if($reply->files != null)
                                    <div class="overflow-auto pb-5">
                                        <div class="d-flex align-items-center border border-dashed border-gray-400 rounded p-2 mt-1">
                                            @foreach(explode(',', $reply->files) as $files)
                                            <a href="{{url('/').'/storage/app/'.$files}}" target="_blank" class="text-dark me-2"><i class="fal fa-file-alt fs-3"></i></a>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                                    @endif
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    @if($val->status == 0)
                    <div class="card-footer pt-4" id="kt_chat_messenger_footer">
                        <form class="form w-100 mb-10" wire:submit.prevent="reply" method="post">
                            <textarea class="form-control form-control-flush mb-3 preserveLines" rows="3" wire:model.defer="message" placeholder="Type a message" required></textarea>
                            <button class="btn btn-info btn-block" type="submit">
                                <span wire:loading.remove wire:target="reply">{{__('Send')}}</span>
                                <span wire:loading wire:target="reply">{{__('Replying ticket...')}}</span>
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>