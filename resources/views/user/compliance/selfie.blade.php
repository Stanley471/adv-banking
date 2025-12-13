@extends('auth.menu')

@section('content')
<div class="toolbar" id="kt_toolbar">
    <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
        <div class="container">
            <div class="modal fade" id="sample" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="mb-0 font-weight-bolder">{{__('Sample')}}</h3>
                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <span class="svg-icon svg-icon-1">
                                    <i class="fal fa-times"></i>
                                </span>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                                <img src="{{asset('asset/images/selfie.jpg')}}" style="max-width:100%; height:auto;">
                            </div>
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
                                    <li class="" style="width:33%;">{{__('Physical Documents')}}</li>
                                    <li class="active" style="width:33%;">{{__('Selfie')}}</li>
                                </ul>
                            </div>
                        </div>
                    </form>
                    <form action="{{route('compliance.setup', ['type' => 'selfie'])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <p class="text-dark fs-5">{{__('Take a photo of yourself while holding your ID')}}, <a href="" data-bs-toggle="modal" data-bs-target="#sample">{{__('Click here')}}</a> {{__('to see example')}}</p>
                                <div class="row justify-content-center align-items-center">
                                    <div class="col-md-6">
                                        <div id="my_camera" class="py-3 mb-6" style="position: relative;"></div>
                                        <input type="hidden" name="image" class="image-tag">
                                        <div class="text-center mt-6">
                                            <a href="javascript:void" class="btn btn-danger btn-block my-5" onClick="take_snapshot()"><i class="fad fa-camera fs-1"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <div id="results">{{__('Your captured image will appear here...')}}</div>
                                        <div id="submit"></div>
                                        <div class="my-5"></div>
                                    </div>
                                </div>
                                @livewire('individual-compliance', ['user' => $user, 'type' => 'selfie'])
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>

<script>
    Webcam.set({
        height: 350,
        image_format: 'jpeg',
        jpeg_quality: 100
    });
    Webcam.attach('#my_camera');
    Webcam.on('error', function(err) {
        let message = err.message;
        if (message == "Could not access webcam") {
            message = "We recommend using a laptop or mobile device that has a webcam";
        }
        toastr.warning(message);
    });
</script>
<script>
    function take_snapshot() {
        Webcam.snap(function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="' + data_uri + '" style="max-widht:100%; height:auto; border-radius:.675rem;"/><p class="my-3 text-xs text-uppercase">Image Captured</p><button type="submit" class="btn btn-info btn-block" id="filepond-upload">Submit</button></div>';
        });
    }
</script>

@endsection