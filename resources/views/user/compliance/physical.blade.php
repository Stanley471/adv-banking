@extends('auth.menu')

@section('content')
<div class="toolbar" id="kt_toolbar">
    <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
        <div class="container">
            <div class="modal fade" id="sample" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="mb-0 font-weight-bolder">{{__('Acceptable docs')}}</h3>
                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <span class="svg-icon svg-icon-1">
                                    <i class="fal fa-times"></i>
                                </span>
                            </div>
                        </div>
                        <div class="modal-body">
                            <ul class="text-default ml-2">
                                <li>{{__('Tax bill (not older than 3 months);')}}</li>
                                <li>{{__('Mortgage statement;')}}</li>
                                <li>{{__('Certificate of voter registration;')}}</li>
                                <li>{{__('Correspondence with a government authority regarding the receipt of benefits such as a pension, unemployment benefits, housing benefits, etc.')}}</li>
                                <li>{{__('Cable internet/TV bill (but not from satellite TV companies or for other wireless telecommunication services);')}}</li>
                                <li>{{__('Landline telephone bill;')}}</li>
                                <li>{{__('Utility bill for gas, electricity, water, internet, etc. linked to the property (the document must not be older than 3 months);')}}</li>
                                <li>{{__('Bank statement with the date of issue and the name of the person (the document must be not older than 3 months);')}}</li>
                                <li>{{__('A lease agreement that is current and has the signatures of the landlord and the tenant;')}}</li>
                                <li>{{__('Rent bills issued by a real estate rental agency;')}}</li>
                                <li>{{__('Credit card statement issued by a bank;;')}}</li>
                                <li>{{__('Letter from a recognized public authority or public servant (any government-issued correspondence not older than 3 months);')}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-10">
                <div class="p-10 p-lg-15 mx-auto">
                    <div class="text-center">
                        <a href="{{route('home')}}" class="navbar-brand pe-3">
                            <img class="mb-6 text-center" src="{{asset('asset/images/logo.png')}}" width="200" alt="{{$set->site_name}}" loading="lazy">
                        </a>
                    </div>
                    <form id="msform" class="mt-3">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <ul id="progressbar" class="text-center">
                                    <li class="" style="width:33%;">{{__('Personal Information')}}</li>
                                    <li class="active" style="width:33%;">{{__('Physical Documents')}}</li>
                                    <li class="" style="width:33%;">{{__('Selfie')}}</li>
                                </ul>
                            </div>
                        </div>
                    </form>
                    <form action="{{route('compliance.setup', ['type' => 'physical'])}}" method="post" enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-body">
                                @csrf
                                <div class="form-group mb-6">
                                    <p class="form-text text-dark mb-3">{{__('Document front must show exactly this information; legal name - ')}}{{$user->business->name}} & {{__('Document ID')}}</p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="file" class="filepond mb-2 mt-2" name="doc_front" id="doc_front" data-max-file-size="10MB" data-max-files="1" allow-multiple="false" accepted-file-types="image/jpeg, image/png, image/jpg">
                                            @livewire('individual-compliance', ['user' => $user, 'type' => 'doc_front'])
                                        </div>
                                        <div class="col-md-6">
                                            <input type="file" class="filepond mb-2 mt-2" name="doc_back" id="doc_back" data-max-file-size="10MB" data-max-files="1" allow-multiple="false" accepted-file-types="image/jpeg, image/png, image/jpg">
                                            @livewire('individual-compliance', ['user' => $user, 'type' => 'doc_back'])
                                        </div>
                                    </div>
                                    @if ($errors->has('doc_front'))
                                    <span class="form-text">{{$errors->first('doc_front')}}</span>
                                    @endif
                                    @if ($errors->has('doc_back'))
                                    <span class="form-text">{{$errors->first('doc_back')}}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-label fw-bolder text-dark fs-6 col-xl-12 required">{{__('Proof of address')}}</label>
                                    <p class="form-text text-dark mb-3">Check <a data-bs-toggle="modal" data-bs-target="#sample" class="text-indigo cursor-pointer">here</a> for the full list of acceptable docs</p>
                                    <input type="file" class="filepond mb-1 mt-2" name="proof_of_address" id="proof_of_address" data-max-file-size="10MB" data-max-files="1" allow-multiple="false" accepted-file-types="image/jpeg, image/png, image/jpg">
                                    <p class="form-text text-dark">{{__('The document must show exactly this information; legal name -')}} {{$user->business->name}} {{__('& address')}}</p>
                                    @if ($errors->has('proof_of_address'))
                                    <span class="form-text text-muted">{{$errors->first('proof_of_address')}}</span>
                                    @endif
                                </div>
                                @livewire('individual-compliance', ['user' => $user, 'type' => 'proof_of_address'])
                                <div class="text-center mt-6">
                                    <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2" id="filepond-upload">
                                        <span class="indicator-label">{{__('Next')}}</span>
                                    </button>
                                    <a href="{{route('user.compliance', ['type' => 'personal'])}}" class="btn btn-lg btn-light-info btn-block fw-bolder me-3 my-2">
                                        <span class="indicator-label"><i class="fal fa-arrow-left"></i> {{__('Back to Personal Information')}}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('script')
<script>
    FilePond.registerPlugin(FilePondPluginFileValidateType, FilePondPluginFileValidateSize, FilePondPluginImageCrop);
    const inputextements = document.querySelectorAll('input.filepond');
    Array.from(inputextements).forEach(inputextement => {
        const pond = FilePond.create(inputextement, {
            labelIdle: (inputextement.id == 'doc_front') ? 'Document Front, <span class="filepond--label-action"> Browse </span>' : ((inputextement.id == 'doc_back') ? 'Document Back, <span class="filepond--label-action"> Browse </span>' : 'Add an Image, <span class="filepond--label-action"> Browse </span>'),
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