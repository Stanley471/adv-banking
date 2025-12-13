<div>
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-6">
                <div class="card-header">
                    <h3 class="card-title fw-bolder mb-0 ">{{__('Edit About Us')}}</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('homepage.update')}}" method="post">
                        @csrf
                        <p>Our vision</p>
                        <div class="fv-row mb-6">
                            <div class="col-lg-12">
                                <textarea type="text" name="mission1" rows="4" class="form-control form-control-md form-control-solid">{{$ui->mission1}}</textarea>
                            </div>
                        </div>
                        <p>Our mission</p>
                        <div class="fv-row mb-6">
                            <div class="col-lg-12">
                                <textarea type="text" name="mission2" rows="4" class="form-control form-control-md form-control-solid">{{$ui->mission2}}</textarea>
                            </div>
                        </div>
                        <p>We believe in team work</p>
                        <div class="fv-row mb-6">
                            <div class="col-lg-12">
                                <textarea type="text" name="mission3" rows="4" class="form-control form-control-md form-control-solid">{{$ui->mission3}}</textarea>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-info">{{__('Save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title fw-bolder mb-0 ">{{__('Edit Homepage')}}</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('homepage.update')}}" method="post">
                        @csrf
                        <div class="fv-row mb-6">
                            <div class="col-lg-12">
                                <input type="text" name="h1_t" class="form-control form-control-md form-control-solid" value="{{$ui->h1_t}}">
                            </div>
                        </div>
                        <div class="fv-row mb-6">
                            <div class="col-lg-12">
                                <textarea type="text" name="h1_b" rows="4" class="form-control form-control-md form-control-solid">{{$ui->h1_b}}</textarea>
                            </div>
                        </div>
                        <div class="fv-row mb-6">
                            <div class="col-lg-12">
                                <input type="text" name="h6_t" class="form-control form-control-md form-control-solid" value="{{$ui->h6_t}}">
                            </div>
                        </div>
                        <div class="fv-row mb-6">
                            <div class="col-lg-12">
                                <input type="text" name="h2_t" class="form-control form-control-md form-control-solid" value="{{$ui->h2_t}}">
                            </div>
                        </div>
                        <div class="fv-row mb-6">
                            <div class="col-lg-12">
                                <textarea type="text" name="h2_b" rows="4" class="form-control form-control-md form-control-solid">{{$ui->h2_b}}</textarea>
                            </div>
                        </div>
                        <div class="fv-row mb-6">
                            <div class="col-lg-12">
                                <input type="text" name="h3_t" class="form-control form-control-md form-control-solid" value="{{$ui->h3_t}}">
                            </div>
                        </div>
                        <div class="fv-row mb-6">
                            <div class="col-lg-12">
                                <input type="text" name="h4_t" class="form-control form-control-md form-control-solid" value="{{$ui->h4_t}}">
                            </div>
                        </div>
                        <div class="fv-row mb-6">
                            <div class="col-lg-12">
                                <textarea type="text" name="h4_b" rows="4" class="form-control form-control-md form-control-solid">{{$ui->h4_b}}</textarea>
                            </div>
                        </div>
                        <div class="fv-row mb-6">
                            <div class="col-lg-12">
                                <input type="text" name="h5_t" class="form-control form-control-md form-control-solid" value="{{$ui->h5_t}}">
                            </div>
                        </div>
                        <div class="fv-row mb-6">
                            <div class="col-lg-12">
                                <textarea type="text" name="w1_b" rows="4" class="form-control form-control-md form-control-solid">{{$ui->w1_b}}</textarea>
                            </div>
                        </div>
                        <hr class="bg-secondary">
                        <div class="fv-row mb-6">
                            <div class="col-lg-12">
                                <input type="text" name="w1_t" class="form-control form-control-md form-control-solid" placeholder="Step 1 title" value="{{$ui->w1_t}}">
                            </div>
                        </div>
                        <div class="fv-row mb-6">
                            <div class="col-lg-12">
                                <textarea type="text" name="w1_b" rows="4" class="form-control form-control-md form-control-solid" placeholder="Step 1 body">{{$ui->w1_b}}</textarea>
                            </div>
                        </div>
                        <div class="fv-row mb-6">
                            <div class="col-lg-12">
                                <input type="text" name="w2_t" class="form-control form-control-md form-control-solid" placeholder="Step 2 title" value="{{$ui->w2_t}}">
                            </div>
                        </div>
                        <div class="fv-row mb-6">
                            <div class="col-lg-12">
                                <textarea type="text" name="w2_b" rows="4" class="form-control form-control-md form-control-solid" placeholder="Step 2 body">{{$ui->w2_b}}</textarea>
                            </div>
                        </div>
                        <div class="fv-row mb-6">
                            <div class="col-lg-12">
                                <input type="text" name="w3_t" class="form-control form-control-md form-control-solid" placeholder="Step 3 title" value="{{$ui->w3_t}}">
                            </div>
                        </div>
                        <div class="fv-row mb-6">
                            <div class="col-lg-12">
                                <textarea type="text" name="w3_b" rows="4" class="form-control form-control-md form-control-solid" placeholder="Step 3 body">{{$ui->w3_b}}</textarea>
                            </div>
                        </div>
                        <hr class="bg-secondary">
                        <p>Steps</p>
                        <div class="fv-row mb-6">
                            <div class="col-lg-12">
                                <input type="text" name="step1_t" class="form-control form-control-md form-control-solid" placeholder="Step 1 title" value="{{$ui->step1_t}}">
                            </div>
                        </div>
                        <div class="fv-row mb-6">
                            <div class="col-lg-12">
                                <textarea type="text" name="step1_b" rows="4" class="form-control form-control-md form-control-solid" placeholder="Step 1 body">{{$ui->step1_b}}</textarea>
                            </div>
                        </div>
                        <div class="fv-row mb-6">
                            <div class="col-lg-12">
                                <input type="text" name="step2_t" class="form-control form-control-md form-control-solid" placeholder="Step 2 title" value="{{$ui->step2_t}}">
                            </div>
                        </div>
                        <div class="fv-row mb-6">
                            <div class="col-lg-12">
                                <textarea type="text" name="step2_b" rows="4" class="form-control form-control-md form-control-solid" placeholder="Step 2 body">{{$ui->step2_b}}</textarea>
                            </div>
                        </div>
                        <div class="fv-row mb-6">
                            <div class="col-lg-12">
                                <input type="text" name="step3_t" class="form-control form-control-md form-control-solid" placeholder="Step 3 title" value="{{$ui->step3_t}}">
                            </div>
                        </div>
                        <div class="fv-row mb-6">
                            <div class="col-lg-12">
                                <textarea type="text" name="step3_b" rows="4" class="form-control form-control-md form-control-solid" placeholder="Step 3 body">{{$ui->step3_b}}</textarea>
                            </div>
                        </div>
                        <hr class="bg-secondary">
                        <p>Addresses</p>
                        <div class="fv-row mb-6">
                            <div class="col-lg-12">
                                <input type="text" name="address1_t" class="form-control form-control-md form-control-solid" placeholder="Address 1 title" value="{{$ui->address1_t}}">
                            </div>
                        </div>
                        <div class="fv-row mb-6">
                            <select class="form-select form-select-solid" data-control="select2" data-placeholder="Select Address 1 Country" name="address1_c">
                                <option></option>
                                @foreach(getAllCountry() as $val)
                                <option value="{{$val->iso2}}" @if($ui->address1_c == $val->iso2)selected @endif>{{$val->name.' '.$val->emoji}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="fv-row mb-6">
                            <div class="col-lg-12">
                                <input type="text" name="address2_t" class="form-control form-control-md form-control-solid" placeholder="Address 2 title" value="{{$ui->address2_t}}">
                            </div>
                        </div>
                        <div class="fv-row mb-6">
                            <select class="form-select form-select-solid" data-control="select2" data-placeholder="Select Address 2  Country" name="address2_c">
                                <option></option>
                                @foreach(getAllCountry() as $val)
                                <option value="{{$val->iso2}}" @if($ui->address2_c == $val->iso2)selected @endif>{{$val->name.' '.$val->emoji}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="fv-row mb-6">
                            <div class="col-lg-12">
                                <input type="text" name="address3_t" class="form-control form-control-md form-control-solid" placeholder="Address 3 title" value="{{$ui->address3_t}}">
                            </div>
                        </div>
                        <div class="fv-row mb-6">
                            <select class="form-select form-select-solid" data-control="select2" data-placeholder="Select Address 3 Country" name="address3_c">
                                <option></option>
                                @foreach(getAllCountry() as $val)
                                <option value="{{$val->iso2}}" @if($ui->address3_c == $val->iso2)selected @endif>{{$val->name.' '.$val->emoji}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-info">{{__('Save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-6">
                <div class="card-body text-center">
                    <div class="card-img-actions d-inline-block mb-3">
                        <img style="max-width:100%; height:auto;" src="{{asset('asset/images/'.$ui->image1)}}" alt="">
                    </div>
                    <form action="{{route('section.image', ['section' => 1])}}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="fv-row mb-6">
                            <input type="file" name="image" class="form-control form-control-md form-control-solid" required>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-info">{{__('Update Image')}}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mb-6">
                <div class="card-body text-center">
                    <div class="card-img-actions d-inline-block mb-3">
                        <img style="max-width:100%; height:auto;" src="{{asset('asset/images/'.$ui->image2)}}" alt="">
                    </div>
                    <form action="{{route('section.image', ['section' => 2])}}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="fv-row mb-6">
                            <input type="file" name="image" class="form-control form-control-md form-control-solid" required>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-info">{{__('Update Image')}}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mb-6">
                <div class="card-body text-center">
                    <div class="card-img-actions d-inline-block mb-3">
                        <img style="max-width:100%; height:auto;" src="{{asset('asset/images/'.$ui->image3)}}" alt="">
                    </div>
                    <form action="{{route('section.image', ['section' => 3])}}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="fv-row mb-6">
                            <input type="file" name="image" class="form-control form-control-md form-control-solid" required>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-info">{{__('Update Image')}}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mb-6">
                <div class="card-body text-center">
                    <div class="card-img-actions d-inline-block mb-3">
                        <img style="max-width:100%; height:auto;" src="{{asset('asset/images/'.$ui->image5)}}" alt="">
                    </div>
                    <form action="{{route('section.image', ['section' => 5])}}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="fv-row mb-6">
                            <input type="file" name="image" class="form-control form-control-md form-control-solid" required>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-info">{{__('Update Image')}}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mb-6">
                <div class="card-body text-center">
                    <div class="card-img-actions d-inline-block mb-3">
                        <img style="max-width:100%; height:auto;" src="{{asset('asset/images/'.$ui->image6)}}" alt="">
                    </div>
                    <form action="{{route('section.image', ['section' => 6])}}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="fv-row mb-6">
                            <input type="file" name="image" class="form-control form-control-md form-control-solid" required>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-info">{{__('Update Image')}}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mb-6">
                <div class="card-body text-center">
                    <div class="card-img-actions d-inline-block mb-3">
                        <img style="max-width:100%; height:auto;" src="{{asset('asset/images/'.$ui->image7)}}" alt="">
                    </div>
                    <form action="{{route('section.image', ['section' => 7])}}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="fv-row mb-6">
                            <input type="file" name="image" class="form-control form-control-md form-control-solid" required>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-info">{{__('Update Image')}}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mb-6">
                <div class="card-body text-center">
                    <div class="card-img-actions d-inline-block mb-3">
                        <img style="max-width:100%; height:auto;" src="{{asset('asset/images/'.$ui->image8)}}" alt="">
                    </div>
                    <form action="{{route('section.image', ['section' => 8])}}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="fv-row mb-6">
                            <input type="file" name="image" class="form-control form-control-md form-control-solid" required>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-info">{{__('Update Image')}}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mb-6">
                <div class="card-body text-center">
                    <div class="card-img-actions d-inline-block mb-3">
                        <img style="max-width:100%; height:auto;" src="{{asset('asset/images/'.$ui->image9)}}" alt="">
                    </div>
                    <form action="{{route('section.image', ['section' => 9])}}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="fv-row mb-6">
                            <input type="file" name="image" class="form-control form-control-md form-control-solid" required>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-info">{{__('Update Image')}}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mb-6">
                <div class="card-body text-center">
                    <div class="card-img-actions d-inline-block mb-3">
                        <img style="max-width:100%; height:auto;" src="{{asset('asset/images/'.$ui->image10)}}" alt="">
                    </div>
                    <form action="{{route('section.image', ['section' => 10])}}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="fv-row mb-6">
                            <input type="file" name="image" class="form-control form-control-md form-control-solid" required>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-info">{{__('Update Image')}}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mb-6">
                <div class="card-body text-center">
                    <div class="card-img-actions d-inline-block mb-3">
                        <img style="max-width:100%; height:auto;" src="{{asset('asset/images/'.$ui->image11)}}" alt="">
                    </div>
                    <form action="{{route('section.image', ['section' => 11])}}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="fv-row mb-6">
                            <input type="file" name="image" class="form-control form-control-md form-control-solid" required>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-info">{{__('Update Image')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>