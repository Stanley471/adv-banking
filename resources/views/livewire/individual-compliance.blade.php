<div>
    <div wire:poll>
        @if($type == "financial_statement")
        @if($user->business->financial_statement != null)
        <div class="alert alert-success">
            <div class="d-flex flex-column">
                <a class="mb-0 text-dark fs-6" href="{{url('/').'/storage/app/'.$user->business->financial_statement}}"><i class="fal fa-file-pdf"></i> {{__('Financial statement, uploaded')}}</a>
            </div>
        </div>
        @endif
        @endif

        @if($type == "g_doc_front")
        @if($user->business->g_doc_front != null)
        <div class="alert alert-success">
            <div class="d-flex flex-column">
                <p class="mb-0 text-dark fs-6"><i class="fal fa-id-badge"></i> {{__('Document front uploaded')}}</p>
            </div>
        </div>
        @endif
        @endif

        @if($type == "g_doc_back")
        @if($user->business->g_doc_back != null)
        <div class="alert alert-success">
            <div class="d-flex flex-column">
                <p class="mb-0 text-dark fs-6"><i class="fal fa-id-badge"></i> {{__('Document back uploaded')}}</p>
            </div>
        </div>
        @endif
        @endif
        @if($type == "g_proof_of_address")
        @if($user->business->g_proof_of_address != null)
        <div class="alert alert-success">
            <div class="d-flex flex-column">
                <p class="mb-0 text-dark fs-6"><i class="fal fa-home"></i> {{__('Proof of address uploaded')}}</p>
            </div>
        </div>
        @endif
        @endif

        @if($type == "doc_front")
        @if($user->business->doc_front != null)
        <div class="modal fade" id="document_modal" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="mb-0 fw-bold">{{__('ID Document')}}</h3>
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <span class="svg-icon svg-icon-1">
                                <i class="fal fa-times"></i>
                            </span>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <img src="{{url('/').'/storage/app/'.$user->business->doc_front}}" style="max-width:100%; height:auto;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-3 text-left bg-secondary rounded mb-2 cursor-pointer">
            <p class="mb-0 text-dark fs-6" data-bs-toggle="modal" data-bs-target="#document_modal"><i class="fal fa-check-circle fs-3"></i> {{__('Document Front, click here to view uploaded file')}}</p>
        </div>
        @endif
        @endif

        @if($type == "doc_back")
        @if($user->business->doc_back != null)
        <div class="modal fade" id="doc_back_modal" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="mb-0 fw-bold">{{__('ID Document Back')}}</h3>
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <span class="svg-icon svg-icon-1">
                                <i class="fal fa-times"></i>
                            </span>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <img src="{{url('/').'/storage/app/'.$user->business->doc_back}}" style="max-width:100%; height:auto;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-3 text-left bg-secondary  rounded mb-2 cursor-pointer">
            <p class="mb-0 text-dark fs-6" data-bs-toggle="modal" data-bs-target="#doc_back_modal"><i class="fal fa-check-circle fs-3"></i> {{__('Document Back, click here to view uploaded file')}}</p>
        </div>
        @endif
        @endif
        @if($type == "proof_of_address")
        @if($user->business->proof_of_address != null)
        <div class="modal fade" id="proof_of_address_modal" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="mb-0 fw-bold">{{__('Proof of Address')}}</h3>
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <span class="svg-icon svg-icon-1">
                                <i class="fal fa-times"></i>
                            </span>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <img src="{{url('/').'/storage/app/'.$user->business->proof_of_address}}" style="max-width:100%; height:auto;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-3 text-left bg-secondary rounded mb-2 cursor-pointer">
            <p class="mb-0 text-dark fs-6" data-bs-toggle="modal" data-bs-target="#proof_of_address_modal"><i class="fal fa-check-circle fs-3"></i> {{__('Proof of Address Document, click here to view uploaded file')}}</p>
        </div>
        @endif
        @endif

        @if($type == "selfie")
        @if($user->business->selfie != null)
        <div class="modal fade" id="selfie_modal" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="mb-0 fw-bold">{{__('Selfie & ID Document')}}</h3>
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <span class="svg-icon svg-icon-1">
                                <i class="fal fa-times"></i>
                            </span>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <img src="{{url('/').'/storage/app/'.$user->business->selfie}}" style="max-width:100%; height:auto;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-3 text-left bg-secondary  rounded mb-2 cursor-pointer">
            <p class="mb-0 text-dark fs-6" data-bs-toggle="modal" data-bs-target="#selfie_modal"><i class="fal fa-check-circle fs-3"></i> {{__('Selfie & ID, click here to view uploaded file')}}</p>
        </div>
        @endif
        @endif
    </div>
</div>