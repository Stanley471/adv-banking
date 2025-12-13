<div>
    <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
        <div class="container">
            <div class="card mb-6">
                <div class="card-body">
                    <p class="mb-0">Clear browser cache after uploading logo & favicon</p>
                </div>
            </div>
            <div class="row mb-6">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-6">{{ __('Light Logo')}}</h4>
                            <form action="{{route('logo.upload', ['type' => 'light'])}}" enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="fv-row mb-6">
                                    <input type="file" class="form-control form-control-solid form-control-md" name="image" lang="en" required>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-info">{{ __('Upload')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="card-img-actions d-inline-block mb-3">
                                <img class="img-fluid" src="{{asset('asset/images/logo.png')}}" style="max-width:50%;height:auto;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-6">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-6">{{ __('Dark Logo')}}</h4>
                            <form action="{{route('logo.upload', ['type' => 'dark'])}}" enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="fv-row mb-6">
                                    <input type="file" class="form-control form-control-solid form-control-md" name="image" lang="en" required>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-info">{{ __('Upload')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-dark">
                        <div class="card-body text-center">
                            <div class="card-img-actions d-inline-block mb-3">
                                <img class="img-fluid" src="{{asset('asset/images/dark_logo.png')}}" style="max-width:50%;height:auto;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-6">{{ __('Favicon')}}</h4>
                            <form action="{{route('logo.upload', ['type' => 'favicon'])}}" enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="fv-row mb-6">
                                    <input type="file" class="form-control form-control-solid form-control-md" name="image" lang="en" required>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-info">{{ __('Upload')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="card-img-actions d-inline-block mb-3">
                                <img class="img-fluid" src="{{asset('asset/images/favicon.png')}}" style="max-width:50%;height:auto;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>