@extends('user.menu')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
@section('content')
<div class="toolbar" id="kt_toolbar">
    <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
        <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
            <h1 class="text-dark fw-bolder my-1 fs-2">{{__('BNPL')}}</h1>
            <ul class="breadcrumb fw-semibold fs-base my-1 mb-6">
                <li class="breadcrumb-item text-muted">
                    <a href="{{route('user.dashboard')}}" class="text-muted text-hover-primary">Dashboard </a>
                </li>
                <li class="breadcrumb-item text-dark">{{__('Store')}}</li>
            </ul>
        </div>
    </div>
    <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
        <div class="container">
            <div class="row g-xl-8">
                <div class="col-xl-12">
                    <div class="card bg-transparent card-xl-stretch mb-5 mb-xl-8">
                        <div class="card-body p-0 pb-9">
                            @livewire('loan.market', ['user' => $user, 'settings' => $set])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('script')
<script>
    "use strict"
    $('#hide_balance').on('click', function() {
        $('#main_balance').text('************');
        $('#reveal_balance').show();
        $('#hide_balance').hide();
    });
    $('#reveal_balance').on('click', function() {
        $('#main_balance').text("{{currencyFormat(number_format($user->pendingLoan('product')->sum('payback'),2)).' '.$currency->currency}}");
        $('#hide_balance').show();
        $('#reveal_balance').hide();
    });

    function doc() {
        var doc_type = $("#doc_type").find(":selected");
        if (doc_type.val().trim() != "") {
            $('#doc_number').attr('type', doc_type.attr('data-type'));
            if (doc_type.attr('data-type') == 'text') {
                $('#doc_number').attr('minlength', doc_type.attr('data-min'));
                $('#doc_number').attr('maxlength', doc_type.attr('data-max'));
            }
        }
    }
    $("#doc_type").change(doc);
    doc();

    FilePond.registerPlugin(FilePondPluginFileValidateType, FilePondPluginFileValidateSize, FilePondPluginImageCrop);
    const inputextements = document.querySelectorAll('input.filepond');
    Array.from(inputextements).forEach(inputextement => {
        const pond = FilePond.create(inputextement, {
            labelIdle: (inputextement.id == 'g_doc_front') ? 'Document Front, <span class="filepond--label-action"> Browse </span>' : ((inputextement.id == 'g_doc_back') ? 'Document Back, <span class="filepond--label-action"> Browse </span>' : 'Add a file, <span class="filepond--label-action"> Browse </span>'),
            onaddfilestart(file) {
                $("#filepond-upload").attr('disabled', true);
            },
            onprocessfilestart(file) {
                $("#filepond-upload").attr('disabled', true);
            },
            onerror(error, file, status) {
                console.log(error)
                $("#filepond-upload").attr('disabled', true);
            },
            onprocessfile(error, file) {
                if (!error) {
                    toastr.options.positionClass = 'toast-bottom-right';
                    toastr.options.closeButton = true;
                    toastr.success("Document uploaded");
                    $("#filepond-upload").attr('disabled', false);
                }
            }
        });
        FilePond.setOptions({
            server: {
                process: {
                    url: "{{route('kyc.image.upload')}}",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    method: 'POST',
                    onerror: (response) => {
                        pond.setOptions({
                            labelFileProcessingError: JSON.parse(response).error
                        });
                    }
                }
            }
        });
    })
</script>
@endsection