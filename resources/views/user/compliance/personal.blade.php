@extends('auth.menu')

@section('content')
<div class="toolbar" id="kt_toolbar">
    <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
        <div class="container">
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
                                    <li class="active" style="width:33%;">{{__('Personal Information')}}</li>
                                    <li class="" style="width:33%;">{{__('Physical Documents')}}</li>
                                    <li class="" style="width:33%;">{{__('Selfie')}}</li>
                                </ul>
                            </div>
                        </div>
                    </form>
                    <form action="{{route('compliance.setup', ['type' => 'personal'])}}" method="post">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row fv-row mb-6">
                                    <label class="form-label fw-bolder text-dark fs-6 col-xl-12 required">{{__('Date of Birth')}}</label>
                                    <div class="col-xl-12">
                                        <div class="row">
                                            <div class="col-xl-4 mb-3">
                                                <select class="form-select form-select-solid" required name="b_month" required>
                                                    <option value="01" @if($user->business->b_month=="01" || old('b_month')=="01") selected @endif>Jan</option>
                                                    <option value="02" @if($user->business->b_month=="02" || old('b_month')=="02") selected @endif>Feb</option>
                                                    <option value="03" @if($user->business->b_month=="03" || old('b_month')=="03") selected @endif>Mar</option>
                                                    <option value="04" @if($user->business->b_month=="04" || old('b_month')=="04") selected @endif>Apr</option>
                                                    <option value="05" @if($user->business->b_month=="05" || old('b_month')=="05") selected @endif>May</option>
                                                    <option value="06" @if($user->business->b_month=="06" || old('b_month')=="06") selected @endif>Jun</option>
                                                    <option value="07" @if($user->business->b_month=="07" || old('b_month')=="07") selected @endif>Jul</option>
                                                    <option value="08" @if($user->business->b_month=="08" || old('b_month')=="08") selected @endif>Aug</option>
                                                    <option value="09" @if($user->business->b_month=="09" || old('b_month')=="09") selected @endif>Sep</option>
                                                    <option value="10" @if($user->business->b_month=="10" || old('b_month')=="10") selected @endif>Oct</option>
                                                    <option value="11" @if($user->business->b_month=="11" || old('b_month')=="11") selected @endif>Nov</option>
                                                    <option value="12" @if($user->business->b_month=="12" || old('b_month')=="12") selected @endif>Dec</option>
                                                </select>
                                            </div>
                                            <div class="col-xl-4 mb-3">
                                                <select class="form-select form-select-solid" required name="b_day">
                                                    <option value="">{{ __('Day') }}</option>
                                                    @for($i=1; $i<=31; $i++) <option value="{{($i < 10 ? 0 : '').$i}}" @if(old('b_day')==($i < 10 ? 0 : '' ).$i || $user->business->b_day==($i < 10 ? 0 : '' ).$i){{ __('selected') }} @endif>{{($i < 10 ? 0 : '').$i}}</option>
                                                            $i++
                                                            @endfor
                                                </select>
                                            </div>
                                            <div class="col-xl-4 mb-3">
                                                <select class="form-select form-select-solid" required name="b_year">
                                                    <option value="">{{ __('Year') }}</option>
                                                    @for($i=1950; $i<=(date('Y') - 16); $i++) <option value="{{$i}}" @if($user->business->b_year==$i || old('b_year') == $i){{ __('selected') }} @endif>{{$i}}</option>
                                                        $i++
                                                        @endfor
                                                </select>
                                            </div>
                                        </div>
                                        @if ($errors->has('b_month'))
                                        <span class="form-text">{{$errors->first('b_month')}}</span>
                                        @endif
                                        @if ($errors->has('b_day'))
                                        <span class="form-text">{{$errors->first('b_day')}}</span>
                                        @endif
                                        @if ($errors->has('b_year'))
                                        <span class="form-text">{{$errors->first('b_year')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="form-label fw-bolder text-dark fs-6 col-xl-12 required">{{__('Source of funds')}}</label>
                                    <select class="form-select form-select-solid" required name="source_of_funds" required>
                                        <option value="PERSONAL_SAVINGS" @if($user->business->source_of_funds=="PERSONAL_SAVINGS" || old('source_of_funds')=="PERSONAL_SAVINGS") selected @endif>PERSONAL SAVINGS</option>
                                        <option value="FAMILY_SAVINGS" @if($user->business->source_of_funds=="FAMILY_SAVINGS" || old('source_of_funds')=="FAMILY_SAVINGS") selected @endif>FAMILY SAVINGS</option>
                                        <option value="LABOUR_CONTRACT" @if($user->business->source_of_funds=="LABOUR_CONTRACT" || old('source_of_funds')=="LABOUR_CONTRACT") selected @endif>LABOUR CONTRACT</option>
                                        <option value="CIVIL_CONTRACT" @if($user->business->source_of_funds=="CIVIL_CONTRACT" || old('source_of_funds')=="CIVIL_CONTRACT") selected @endif>CIVIL CONTRACT</option>
                                        <option value="RENT" @if($user->business->source_of_funds=="RENT" || old('source_of_funds')=="RENT") selected @endif>RENT</option>
                                        <option value="FUNDS_FROM_OTHER_AUXILIARY_SOURCES" @if($user->business->source_of_funds=="FUNDS_FROM_OTHER_AUXILIARY_SOURCES" || old('source_of_funds')=="FUNDS_FROM_OTHER_AUXILIARY_SOURCES") selected @endif>FUNDS FROM OTHER AUXILIARY SOURCES</option>
                                        <option value="SALE_OF_MOVABLE_ASSETS" @if($user->business->source_of_funds=="SALE_OF_MOVABLE_ASSETS" || old('source_of_funds')=="SALE_OF_MOVABLE_ASSETS") selected @endif>SALE OF MOVABLE ASSETS</option>
                                        <option value="SALE_OF_REAL_ESTATE" @if($user->business->source_of_funds=="SALE_OF_REAL_ESTATE" || old('source_of_funds')=="SALE_OF_REAL_ESTATE") selected @endif>SALE OF REAL ESTATE</option>
                                        <option value="ORDINARY_BUSINESS_ACTIVITY" @if($user->business->source_of_funds=="ORDINARY_BUSINESS_ACTIVITY" || old('source_of_funds')=="ORDINARY_BUSINESS_ACTIVITY") selected @endif>ORDINARY BUSINESS ACTIVITY</option>
                                        <option value="DIVIDENDS" @if($user->business->source_of_funds=="DIVIDENDS" || old('source_of_funds')=="DIVIDENDS") selected @endif>DIVIDENDS</option>
                                        <option value="LOAN_FROM_FINANCIAL_INSTITUTIONS_CREDIT_UNIONS" @if($user->business->source_of_funds=="LOAN_FROM_FINANCIAL_INSTITUTIONS_CREDIT_UNIONS" || old('source_of_funds')=="LOAN_FROM_FINANCIAL_INSTITUTIONS_CREDIT_UNIONS") selected @endif>LOAN FROM FINANCIAL INSTITUTIONS CREDIT UNIONS</option>
                                        <option value="LOAN_FROM_THIRD_PARTIES" @if($user->business->source_of_funds=="LOAN_FROM_THIRD_PARTIES" || old('source_of_funds')=="LOAN_FROM_THIRD_PARTIES") selected @endif>LOAN FROM THIRD PARTIES</option>
                                        <option value="INHERITANCE" @if($user->business->source_of_funds=="INHERITANCE" || old('source_of_funds')=="INHERITANCE") selected @endif>INHERITANCE</option>
                                        <option value="SALE_OF_COMPANY_SHARES_BUSINESS" @if($user->business->source_of_funds=="SALE_OF_COMPANY_SHARES_BUSINESS" || old('source_of_funds')=="SALE_OF_COMPANY_SHARES_BUSINESS") selected @endif>SALE OF COMPANY SHARES BUSINESS</option>
                                    </select>
                                    @if ($errors->has('source_of_funds'))
                                    <span class="form-text">{{$errors->first('source_of_funds')}}</span>
                                    @endif
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="form-label fw-bolder text-dark fs-6 col-xl-12 required">{{__('Identity Document')}}</label>
                                    <select class="form-select form-select-solid" required name="doc_type" id="doc_type" required>
                                        <option value="">{{__('Select Document type')}}</option>
                                        @foreach($kyc as $val)
                                        <option value="{{$val->id}}" data-type="{{$val->type}}" data-min="{{$val->min}}" data-max="{{$val->max}}" @if($user->business->doc_type==$val->id || old('doc_type')==$val->id) selected @endif>{{$val->title}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('doc_type'))
                                    <span class="form-text">{{$errors->first('doc_type')}}</span>
                                    @endif
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="form-label fw-bolder text-dark fs-6 col-xl-12 required">{{__('ID Document Number')}}</label>
                                    <input type="text" name="doc_number" id="doc_number" required class="form-control form-control-lg form-control-solid" placeholder="Document Number" value="{{($user->business->doc_number != null) ? $user->business->doc_number : old('doc_number')}}">
                                    @if ($errors->has('doc_number'))
                                    <span class="form-text">{{$errors->first('doc_number')}}</span>
                                    @endif
                                </div>
                                <div class="row fv-row mb-6">
                                    <label class="form-label fw-bolder text-dark fs-6 col-xl-12 required">{{__('Address')}}</label>
                                    <div class="col-xl-12">
                                        <div class="fv-row mb-6">
                                            <input type="text" name="line_1" required class="form-control form-control-lg form-control-solid" placeholder="Line 1" value="{{($user->business->line_1 != null) ? $user->business->line_1 : old('line_1')}}">
                                            @if ($errors->has('line_1'))
                                            <span class="form-text">{{$errors->first('line_1')}}</span>
                                            @endif
                                        </div>
                                        <div class="fv-row mb-6">
                                            <input type="text" name="line_2" class="form-control form-control-lg form-control-solid" placeholder="Line 2 (Optional)" value="{{($user->business->line_2 != null) ? $user->business->line_2 : old('line_2')}}">
                                            @if ($errors->has('line_2'))
                                            <span class="form-text">{{$errors->first('line_2')}}</span>
                                            @endif
                                        </div>
                                        <div class="fv-row mb-6">
                                            <select class="form-select form-select-solid" data-control="select2" data-placeholder="Select Country" name="country" required>
                                                <option></option>
                                                @foreach(validCountries() as $val)
                                                <option value="{{$val->real->name}}" @if($user->business->country == old('country'))selected @endif>{{$val->real->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('country'))
                                            <span class="form-text">{{$errors->first('country')}}</span>
                                            @endif
                                        </div>
                                        <div class="fv-row mb-6">
                                            <input type="text" name="state" required class="form-control form-control-lg form-control-solid" value="{{($user->business->state != null) ? $user->business->state : old('state')}}" placeholder="State">
                                            @if ($errors->has('state'))
                                            <span class="form-text">{{$errors->first('state')}}</span>
                                            @endif
                                        </div>
                                        <div class="fv-row mb-6">
                                            <input type="text" name="city" required class="form-control form-control-lg form-control-solid" value="{{($user->business->city != null) ? $user->business->city : old('city')}}" placeholder="City">
                                            @if ($errors->has('city'))
                                            <span class="form-text">{{$errors->first('city')}}</span>
                                            @endif
                                        </div>
                                        <div class="fv-row mb-6">
                                            <input type="text" name="postal_code" required class="form-control form-control-lg form-control-solid" value="{{($user->business->postal_code != null) ? $user->business->postal_code : old('postal_code')}}" placeholder="Postal code">
                                            @if ($errors->has('postal_code'))
                                            <span class="form-text">{{$errors->first('postal_code')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2" id="kt_sign_up_submit">
                                        <span class="indicator-label">{{__('Next')}}</span>
                                    </button>
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
</script>
@endsection