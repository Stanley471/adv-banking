@extends('admin.menu')
@section('content')
<div class="toolbar" id="kt_toolbar">
    <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
        <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
            <h1 class="text-dark fw-bolder my-1 fs-2 mb-10">{{__('Settings')}}</h1>
            <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-6 border-gray-300" id="tabs-icons-text" role="tablist">
                <li class="nav-item">
                    <a class="nav-link text-dark @if(route('admin.settings', ['type' => 'system'])==url()->current()) active @endif" id="tabs-icons-text-1-tab" href="{{route('admin.settings', ['type' => 'system'])}}" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">{{__('System Settings')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark @if(route('admin.settings', ['type' => 'payout'])==url()->current()) active @endif" id="tabs-icons-text-2-tab" href="{{route('admin.settings', ['type' => 'payout'])}}" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">{{__('Withdrawal')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark @if(route('admin.settings', ['type' => 'country'])==url()->current()) active @endif" id="tabs-icons-text-1-tab" href="{{route('admin.settings', ['type' => 'country'])}}" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">{{__('Country supported')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark @if(route('admin.settings', ['type' => 'money_transfer'])==url()->current()) active @endif" id="tabs-icons-text-2-tab" href="{{route('admin.settings', ['type' => 'money_transfer'])}}" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">{{__('P2P Transfer')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark @if(route('admin.settings', ['type' => 'bank_deposit'])==url()->current()) active @endif" id="tabs-icons-text-2-tab" href="{{route('admin.settings', ['type' => 'bank_deposit'])}}" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">{{__('Bank Deposit')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark @if(route('admin.settings', ['type' => 'kyc'])==url()->current()) active @endif" id="tabs-icons-text-1-tab" href="{{route('admin.settings', ['type' => 'kyc'])}}" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">{{__('KYC Documents')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark @if(route('admin.settings', ['type' => 'payment_gateway'])==url()->current()) active @endif" id="tabs-icons-text-2-tab" href="{{route('admin.settings', ['type' => 'payment_gateway'])}}" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">{{__('Payment Gateway')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark @if(route('admin.settings', ['type' => 'security'])==url()->current()) active @endif" id="tabs-icons-text-2-tab" href="{{route('admin.settings', ['type' => 'security'])}}" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">{{__('Security')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark @if(route('admin.settings', ['type' => 'recaptcha'])==url()->current()) active @endif" id="tabs-icons-text-2-tab" href="{{route('admin.settings', ['type' => 'recaptcha'])}}" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">{{__('Recaptcha')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark @if(route('admin.settings', ['type' => 'twilio'])==url()->current()) active @endif" id="tabs-icons-text-2-tab" href="{{route('admin.settings', ['type' => 'twilio'])}}" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">{{__('Twilio')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark @if(route('admin.settings', ['type' => 'policies'])==url()->current()) active @endif" id="tabs-icons-text-2-tab" href="{{route('admin.settings', ['type' => 'policies'])}}" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">{{__('Policies')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark @if(route('admin.settings', ['type' => 'social'])==url()->current()) active @endif" id="tabs-icons-text-2-tab" href="{{route('admin.settings', ['type' => 'social'])}}" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">{{__('Social Media')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark @if(route('admin.settings', ['type' => 'brands'])==url()->current()) active @endif" id="tabs-icons-text-2-tab" href="{{route('admin.settings', ['type' => 'brands'])}}" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">{{__('Brands')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark @if(route('admin.settings', ['type' => 'review'])==url()->current()) active @endif" id="tabs-icons-text-2-tab" href="{{route('admin.settings', ['type' => 'review'])}}" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">{{__('Reviews')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark @if(route('admin.settings', ['type' => 'services'])==url()->current()) active @endif" id="tabs-icons-text-2-tab" href="{{route('admin.settings', ['type' => 'services'])}}" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">{{__('Services')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark @if(route('admin.settings', ['type' => 'logo'])==url()->current()) active @endif" id="tabs-icons-text-2-tab" href="{{route('admin.settings', ['type' => 'logo'])}}" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">{{__('Logos & favicon')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark @if(route('admin.settings', ['type' => 'page'])==url()->current()) active @endif" id="tabs-icons-text-2-tab" href="{{route('admin.settings', ['type' => 'page'])}}" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">{{__('Custom Pages')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark @if(route('admin.settings', ['type' => 'home'])==url()->current()) active @endif" id="tabs-icons-text-2-tab" href="{{route('admin.settings', ['type' => 'home'])}}" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">{{__('About us & Home Page')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark @if(route('admin.settings', ['type' => 'team'])==url()->current()) active @endif" id="tabs-icons-text-2-tab" href="{{route('admin.settings', ['type' => 'team'])}}" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">{{__('Team')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark @if(route('admin.settings', ['type' => 'social_login'])==url()->current()) active @endif" id="tabs-icons-text-2-tab" href="{{route('admin.settings', ['type' => 'social_login'])}}" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">{{__('Social Login')}}</a>
                </li>
            </ul>
        </div>
        <div class="d-flex align-items-center flex-nowrap text-nowrap py-1 mb-6">
            <a href="{{route('run.migration')}}" class="btn btn-white text-dark me-4"><i class="fal fa-database"></i> {{__('Run migrations')}}</a>
            <a href="{{route('optimize.system')}}" class="btn btn-warning text-dark me-4"><i class="fal fa-bolt"></i> {{__('Optimize system')}}</a>
        </div>
    </div>
    <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
        <div class="container">
            <div class="tab-content" id="myTabContent">
                @if(route('admin.settings', ['type' => 'system'])==url()->current())
                <div class="tab-pane fade @if(route('admin.settings', ['type' => 'system'])==url()->current())show active @endif" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                    <div class="card mb-10">
                        <div class="card-body">
                            <form action="{{route('admin.settings.update', ['type' => 'system'])}}" method="post">
                                @csrf
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Website name')}}</label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="site_name" value="{{$set->site_name}}" required />
                                    @error('site_name')
                                    <span class="form-text">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Website email')}}</label>
                                    <input class="form-control form-control-lg form-control-solid" type="email" name="email" value="{{$set->email}}" required />
                                    <span class="form-text">Displayed on homepage</span>
                                    @error('email')
                                    <span class="form-text">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Support email')}}</label>
                                    <input class="form-control form-control-lg form-control-solid" type="email" name="support_email" value="{{$set->support_email}}" required />
                                    <span class="form-text">For ticket</span>
                                    @error('support_email')
                                    <span class="form-text">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Mobile')}}</label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="mobile" value="{{$set->mobile}}" required />
                                    @error('mobile')
                                    <span class="form-text">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Website title')}}</label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="title" value="{{$set->title}}" required />
                                    @error('title')
                                    <span class="form-text">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Short description')}}</label>
                                    <textarea class="form-control form-control-lg form-control-solid" type="text" name="site_desc" required rows="3">{{$set->site_desc}}</textarea>
                                    @error('site_desc')
                                    <span class="form-text">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Address')}}</label>
                                    <textarea class="form-control form-control-lg form-control-solid" type="text" name="address" required rows="3">{{$set->address}}</textarea>
                                    @error('address')
                                    <span class="form-text">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Livechat snippet code')}}</label>
                                    <textarea class="form-control form-control-lg form-control-solid" type="text" name="livechat" rows="3">{{$set->livechat}}</textarea>
                                    @error('livechat')
                                    <span class="form-text">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Analytics snippet code')}}</label>
                                    <textarea class="form-control form-control-lg form-control-solid" type="text" name="analytic_snippet" rows="3">{{$set->analytic_snippet}}</textarea>
                                    @error('analytic_snippet')
                                    <span class="form-text">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Currency Format')}}</label>
                                    <select class="form-select form-select-solid" name="currency_format" required>
                                        <option value="normal" @if($set->currency_format=="normal") selected @endif</option>{{__('Normal - 1,000.00')}}</option>
                                        <option value="reversed" @if($set->currency_format=="reversed") selected @endif</option>{{__('Reveresd - 1.000,00')}}</option>
                                    </select>
                                    @error('currency_format')
                                    <span class="form-text">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Default Website Font')}}</label>
                                    <select class="form-select form-select-solid" name="default_font" required>
                                        <option value="Graphik" @if($set->default_font=="Graphik") selected @endif</option>{{__('Graphik')}}</option>
                                        <option value="HKGroteskPro" @if($set->default_font=="HKGroteskPro") selected @endif</option>{{__('HKGroteskPro')}}</option>
                                        <option value="Roboto" @if($set->default_font=="Roboto") selected @endif</option>{{__('Roboto')}}</option>
                                        <option value="STIX Two Text" @if($set->default_font=="STIX Two Text") selected @endif</option>{{__('STIX Two Text')}}</option>
                                        <option value="Atkinson Hyperlegible" @if($set->default_font=="Atkinson Hyperlegible") selected @endif</option>{{__('Atkinson Hyperlegible')}}</option>
                                        <option value="Open Sans" @if($set->default_font=="Open Sans") selected @endif</option>{{__('Open Sans')}}</option>
                                        <option value="Noto Sans JP" @if($set->default_font=="Noto Sans JP") selected @endif</option>{{__('Noto Sans JP')}}</option>
                                        <option value="Roboto Condensed" @if($set->default_font=="Roboto Condensed") selected @endif</option>{{__('Roboto Condensed')}}</option>
                                        <option value="Source Sans Pro" @if($set->default_font=="Source Sans Pro") selected @endif</option>{{__('Source Sans Pro')}}</option>
                                        <option value="Noto Sans" @if($set->default_font=="Noto Sans") selected @endif</option>{{__('Noto Sans')}}</option>
                                        <option value="PT Sans" @if($set->default_font=="PT Sans") selected @endif</option>{{__('PT Sans')}}</option>
                                        <option value="Georama" @if($set->default_font=="Georama") selected @endif>{{__('Georama')}}</option>
                                        <option value="Lato" @if($set->default_font=="Lato") selected @endif>{{__('Lato')}}</option>
                                        <option value="Montserrat" @if($set->default_font=="Montserrat") selected @endif>{{__('Montserrat')}}</option>
                                        <option value="Hahmlet" @if($set->default_font=="Hahmlet") selected @endif>{{__('Hahmlet')}}</option>
                                        <option value="Poppins" @if($set->default_font=="Poppins") selected @endif>{{__('Poppins')}}</option>
                                        <option value="Oswald" @if($set->default_font=="Oswald") selected @endif>{{__('Oswald')}}</option>
                                        <option value="Raleway" @if($set->default_font=="Raleway") selected @endif>{{__('Raleway')}}</option>
                                        <option value="Nunito" @if($set->default_font=="Nunito") selected @endif>{{__('Nunito')}}</option>
                                        <option value="Merriweather" @if($set->default_font=="Merriweather") selected @endif>{{__('Merriweather')}}</option>
                                        <option value="Ubuntu" @if($set->default_font=="Ubuntu") selected @endif>{{__('Ubuntu')}}</option>
                                        <option value="Rubik" @if($set->default_font=="Rubik") selected @endif>{{__('Rubik')}}</option>
                                        <option value="Lora" @if($set->default_font=="Lora") selected @endif>{{__('Lora')}}</option>
                                        <option value="Mukta" @if($set->default_font=="Mukta") selected @endif>{{__('Mukta')}}</option>
                                        <option value="Inter" @if($set->default_font=="Inter") selected @endif>{{__('Inter')}}</option>
                                        <option value="Quicksand" @if($set->default_font=="Quicksand") selected @endif>{{__('Quickand')}}</option>
                                        <option value="Heebo" @if($set->default_font=="Heebo") selected @endif>{{__('Karla')}}</option>
                                        <option value="Martel Sans" @if($set->default_font=="Martel Sans") selected @endif>{{__('Martel Sans')}}</option>
                                        <option value="Oxygen" @if($set->default_font=="Oxygen") selected @endif>{{__('Oxygen')}}</option>
                                        <option value="Cern" @if($set->default_font=="Cern") selected @endif>{{__('Cern')}}</option>
                                    </select>
                                    @error('default_font')
                                    <span class="form-text">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Default Country & Currency')}}</label>
                                    <select class="form-select form-select-solid" data-control="select2" data-placeholder="Select Currency" name="currency">
                                        <option></option>
                                        @foreach(getAllCountry() as $val)
                                        <option value="{{$val->id}}" @if($admin->currency()->real->iso2 == $val->iso2)selected @endif>{{$val->name.' '.$val->emoji.' '.$val->currency}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Admin URL')}}</label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="admin_url" value="{{$set->admin_url}}" required />
                                    @error('admin_url')
                                    <span class="form-text">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Career URL')}}</label>
                                    <input class="form-control form-control-lg form-control-solid" type="url" name="career_url" value="{{$set->career_url}}" />
                                    <span class="form-text">Available job positions link</span>
                                    @error('career_url')
                                    <span class="form-text">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-check form-check-custom form-check-solid mb-6">
                                    <input class="form-check-input" type="checkbox" id="registration" name="registration" value="1" @if($set->registration==1)checked @endif />
                                    <label class="form-check-label" for="registration">{{__('Registration')}}</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid mb-6">
                                    <input class="form-check-input" type="checkbox" id="maintenance" name="maintenance" value="1" @if($set->maintenance==1)checked @endif />
                                    <label class="form-check-label" for="maintenance">{{__('Maintenance mode')}}</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid mb-6">
                                    <input class="form-check-input" type="checkbox" id="phone_verify" name="phone_verify" value="1" @if($set->phone_verify==1)checked @endif />
                                    <label class="form-check-label" for="phone_verify">{{__('Require Phone Verification')}}</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid mb-6">
                                    <input class="form-check-input" type="checkbox" id="email_verify" name="email_verify" value="1" @if($set->email_verify==1)checked @endif />
                                    <label class="form-check-label" for="email_verify">{{__('Require Email Verification')}}</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid mb-6">
                                    <input class="form-check-input" type="checkbox" id="language" name="language" value="1" @if($set->language==1)checked @endif />
                                    <label class="form-check-label" for="language">{{__('Language translation')}}</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid mb-6">
                                    <input class="form-check-input" type="checkbox" id="referral" name="referral" value="1" @if($set->referral==1)checked @endif />
                                    <label class="form-check-label" for="referral">{{__('Referral - Investment fee waiver (active if mutual fund or project investment is active)')}}</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid mb-6">
                                    <input class="form-check-input" type="checkbox" id="loan" name="loan" value="1" @if($set->loan==1)checked @endif />
                                    <label class="form-check-label" for="loan">{{__('Loan')}}</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid mb-6">
                                    <input class="form-check-input" type="checkbox" id="buy_now_pay_later" name="buy_now_pay_later" value="1" @if($set->buy_now_pay_later==1)checked @endif />
                                    <label class="form-check-label" for="buy_now_pay_later">{{__('Buy now pay later')}}</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid mb-6">
                                    <input class="form-check-input" type="checkbox" id="savings" name="savings" value="1" @if($set->savings==1)checked @endif />
                                    <label class="form-check-label" for="savings">{{__('Savings')}}</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid mb-6">
                                    <input class="form-check-input" type="checkbox" id="mutual_fund" name="mutual_fund" value="1" @if($set->mutual_fund==1)checked @endif />
                                    <label class="form-check-label" for="mutual_fund">{{__('Mutual Fund')}}</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid mb-6">
                                    <input class="form-check-input" type="checkbox" id="project_investment" name="project_investment" value="1" @if($set->project_investment==1)checked @endif />
                                    <label class="form-check-label" for="project_investment">{{__('Project Investment')}}</label>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-lg btn-info fw-bolder me-3 my-2">{{__('Update')}}</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
                @if(route('admin.settings', ['type' => 'payment_gateway'])==url()->current())
                <div class="tab-pane fade @if(route('admin.settings', ['type' => 'payment_gateway'])==url()->current())show active @endif" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    @foreach($admin->allGateway() as $val)
                    <div id="edit{{$val->id}}" class="modal fade" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{$val->name}}</h5>
                                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                        <span class="svg-icon svg-icon-1">
                                            <i class="fal fa-times"></i>
                                        </span>
                                    </div>
                                </div>
                                <form action="{{route('gateway.update', ['gateway' => $val->id])}}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label">{{__('Name of gateway for users')}}</label>
                                                    <input value="{{$val->id}}" type="hidden" name="id">
                                                    <input type="text" value="{{$val->name}}" name="name" class="form-control form-control-lg form-control-solid">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="col-form-label">{{__('Minimum Amount')}}</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text border-0">{{$currency->currency_symbol}}</span>
                                                        <input type="number" name="minamo" maxlength="10" class="form-control form-control-lg form-control-solid" value="{{$val->minamo}}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="col-form-label">{{__('Maximum Amount')}}</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text border-0">{{$currency->currency_symbol}}</span>
                                                        <input type="number" name="maxamo" maxlength="10" class="form-control form-control-lg form-control-solid" value="{{$val->maxamo}}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label class="col-form-label">{{__('Fiat Charge [Not Required]')}}</label>
                                                <div class="input-group">
                                                    <span class="input-group-text border-0">{{$currency->currency_symbol}}</span>
                                                    <input type="number" step="any" name="fiat_charge" value="{{$val->fiat_charge}}" class="form-control form-control-lg form-control-solid">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="col-form-label">{{__('Percent Charge [Not Required]')}}</label>
                                                <div class="input-group">
                                                    <input type="number" step="any" name="percent_charge" value="{{$val->percent_charge}}" class="form-control form-control-lg form-control-solid">
                                                    <span class="input-group-text border-0">%</span>
                                                </div>
                                            </div>
                                        </div>
                                        @if($val->id==101)
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label">{{__('PAYPAL Client Id')}}</label>
                                                    <input type="text" value="{{$val->val1}}" class="form-control form-control-lg form-control-solid" id="val1" name="val1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label">{{__('Secret key')}}</label>
                                                    <input type="text" value="{{$val->val2}}" class="form-control form-control-lg form-control-solid" id="val2" name="val2">
                                                </div>
                                            </div>
                                        </div>
                                        @elseif($val->id==102)
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label">{{__('Perfect Money USD account')}}</label>
                                                    <input type="text" value="{{$val->val1}}" class="form-control form-control-lg form-control-solid" id="val1" name="val1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label">{{__('Alternate passphrase')}}</label>
                                                    <input type="text" value="{{$val->val2}}" class="form-control form-control-lg form-control-solid" id="val2" name="val2">
                                                </div>
                                            </div>
                                        </div>
                                        @elseif($val->id==103)
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label">{{__('Secret key')}}</label>
                                                    <input type="text" value="{{$val->val1}}" class="form-control form-control-lg form-control-solid" id="val1" name="val1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label">{{__('Publishable key')}}</label>
                                                    <input type="text" value="{{$val->val2}}" class="form-control form-control-lg form-control-solid" id="val2" name="val2">
                                                </div>
                                            </div>
                                        </div>
                                        @elseif($val->id==104)
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label">{{__('Merchant email')}}</label>
                                                    <input type="text" value="{{$val->val1}}" class="form-control form-control-lg form-control-solid" id="val1" name="val1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label">{{__('Secret key')}}</label>
                                                    <input type="text" value="{{$val->val2}}" class="form-control form-control-lg form-control-solid" id="val2" name="val2">
                                                </div>
                                            </div>
                                        </div>
                                        @elseif($val->id==107)
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label">{{__('Public key')}}</label>
                                                    <input type="text" value="{{$val->val1}}" class="form-control form-control-lg form-control-solid" id="val1" name="val1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label">{{__('Secret key')}}</label>
                                                    <input type="text" value="{{$val->val2}}" class="form-control form-control-lg form-control-solid" id="val2" name="val2">
                                                </div>
                                            </div>
                                        </div>
                                        @elseif($val->id==108)
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label">{{__('Public key')}}</label>
                                                    <input type="text" value="{{$val->val1}}" class="form-control form-control-lg form-control-solid" id="val1" name="val1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label">{{__('Secret key')}}</label>
                                                    <input type="text" value="{{$val->val2}}" class="form-control form-control-lg form-control-solid" id="val2" name="val2">
                                                </div>
                                            </div>
                                        </div>
                                        @elseif($val->id==501)
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label">{{__('Api key')}}</label>
                                                    <input type="text" value="{{$val->val1}}" class="form-control form-control-lg form-control-solid" id="val1" name="val1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label">{{__('Xpub code')}}</label>
                                                    <input type="text" value="{{$val->val2}}" class="form-control form-control-lg form-control-solid" id="val2" name="val2">
                                                </div>
                                            </div>
                                        </div>
                                        @elseif($val->id==505)
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label">{{__('Public key')}}</label>
                                                    <input type="text" value="{{$val->val1}}" class="form-control form-control-lg form-control-solid" id="val1" name="val1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label">{{__('Private key')}}</label>
                                                    <input type="text" value="{{$val->val2}}" class="form-control form-control-lg form-control-solid" id="val2" name="val2">
                                                </div>
                                            </div>
                                        </div>
                                        @elseif($val->id==506)
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label">{{__('Public key')}}</label>
                                                    <input type="text" value="{{$val->val1}}" class="form-control form-control-lg form-control-solid" id="val1" name="val1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label">{{__('Private key')}}</label>
                                                    <input type="text" value="{{$val->val2}}" class="form-control form-control-lg form-control-solid" id="val2" name="val2">
                                                </div>
                                            </div>
                                        </div>
                                        @elseif($val->id==507)
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label">{{__('API key')}}</label>
                                                    <input type="text" value="{{$val->val1}}" class="form-control form-control-lg form-control-solid" id="val1" name="val1">
                                                </div>
                                            </div>
                                        </div>
                                        @elseif($val->id==508)
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label">{{__('Api Key')}}</label>
                                                    <input type="text" value="{{$val->val1}}" class="form-control form-control-lg form-control-solid" id="val1" name="val1">
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @if($val->type == 1)
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label">{{__('Instructions')}}</label>
                                                    <textarea type="text" class="form-control form-control-lg form-control-solid" name="instructions">{{$val->instructions}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label">{{__('Payment Details')}}</label>
                                                    <input type="text" value="{{$val->val1}}" class="form-control form-control-lg form-control-solid" id="val1" name="val1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-12">{{__('Crypto')}}</label>
                                            <div class="col-lg-12">
                                                <select class="form-select form-select-solid" name="crypto">
                                                    <option value="1" @if($val->crypto==1)
                                                        selected
                                                        @endif>{{__('Yes')}}
                                                    </option>
                                                    <option value="0" @if($val->crypto==0)
                                                        selected
                                                        @endif>{{__('No')}}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label">{{__('Wallet address')}}</label>
                                                    <input type="text" value="{{$val->val2}}" class="form-control form-control-lg form-control-solid" id="val2" name="val2">
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="form-group">
                                            <label class="col-form-label">{{__('Status')}}</label>
                                            <select class="form-select form-select-solid" name="status">
                                                <option value="1" @if($val->status==1)
                                                    selected
                                                    @endif
                                                    >{{__('Active')}}
                                                </option>
                                                <option value="0" @if($val->status==0)
                                                    selected
                                                    @endif
                                                    >{{__('Deactive')}}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-neutral" data-dismiss="modal">{{__('Close')}}</button>
                                        <button type="submit" class="btn btn-info">{{__('Save changes')}}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div wire:ignore.self class="modal fade" id="delete{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">{{__('Delete Gateway')}}</h3>
                                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                        <span class="svg-icon svg-icon-1">
                                            <i class="fal fa-times"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this gateway?, you can't restore it after this</p>
                                    <div class="text-center">
                                        <a href="{{route('gateway.delete', ['gateway'=>$val->id])}}" class="btn btn-danger btn-block">{{__('Delete gateway')}}</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="card mb-6">
                        <div class="card-header card-header-stretch">
                            <div class="card-title">
                                <h2 class="fw-boldest m-0">Automated Gateways</h2>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-bordered table-row-solid gy-5 gs-7" id="kt_api_keys_table">
                                    <thead>
                                        <tr class="text-start text-dark fw-bolder fs-7 text-uppercase px-7">
                                            <th class="w-250px min-w-100px ps-9">Main Name</th>
                                            <th class="w-275px min-w-100px px-0">Name for users</th>
                                            <th class="w-125px min-w-125px">Limit</th>
                                            <th class="w-125px min-w-50px">Charge</th>
                                            <th class="w-125px min-w-50px">Status</th>
                                            <th class="w-125px min-w-50px">Updated</th>
                                            <th class="w-100px"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="fs-6 fw-bold text-dark">
                                        @foreach($admin->automatedGateway() as $val)
                                        <tr>
                                            <td>{{$val->main_name}}</td>
                                            <td>{{$val->name}}</td>
                                            <td>{{$currency->currency_symbol.$val->minamo.' - '.$currency->currency_symbol.number_format($val->maxamo)}}</td>
                                            <td>@if($val->percent_charge!=null){{$val->percent_charge}}% @else 0% @endif + @if($val->fiat_charge!=null){{$val->fiat_charge.' '.$currency->currency}} @else 0 {{$currency->currency_symbol}} @endif</td>
                                            <td>
                                                @if($val->status==0)
                                                <span class="badge badge-danger badge-pill">{{__('Disabled')}}</span>
                                                @elseif($val->status==1)
                                                <span class="badge badge-success badge-pill">{{__('Active')}}</span>
                                                @endif
                                            </td>
                                            <td>{{date("Y/m/d h:i:A", strtotime($val->updated_at))}}</td>
                                            <td class="text-center">
                                                <a data-bs-toggle="modal" data-bs-target="#edit{{$val->id}}" class="btn btn-info btn-sm text-white">
                                                    {{__('Edit')}}
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="add" class="modal fade" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Create Gateway</h5>
                                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                        <span class="svg-icon svg-icon-1">
                                            <i class="fal fa-times"></i>
                                        </span>
                                    </div>
                                </div>
                                <form action="{{route('gateway.store')}}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label">{{__('Name of gateway for users')}}</label>
                                                    <input type="text" name="name" class="form-control form-control-lg form-control-solid">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="col-form-label">{{__('Minimum Amount')}}</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text border-0">{{$currency->currency_symbol}}</span>
                                                        <input type="number" name="minamo" maxlength="10" class="form-control form-control-lg form-control-solid" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="col-form-label">{{__('Maximum Amount')}}</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text border-0">{{$currency->currency_symbol}}</span>
                                                        <input type="number" name="maxamo" maxlength="10" class="form-control form-control-lg form-control-solid" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <label class="col-form-label">{{__('Fiat Charge [Not Required]')}}</label>
                                                <div class="input-group">
                                                    <span class="input-group-text border-0">{{$currency->currency_symbol}}</span>
                                                    <input type="number" step="any" name="fiat_charge" class="form-control form-control-lg form-control-solid">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="col-form-label">{{__('Percent Charge [Not Required]')}}</label>
                                                <div class="input-group">
                                                    <input type="number" step="any" name="percent_charge" class="form-control form-control-lg form-control-solid">
                                                    <span class="input-group-text border-0">%</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label">{{__('Instructions')}}</label>
                                                    <textarea type="text" class="form-control form-control-lg form-control-solid" name="instructions"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label">{{__('Payment Details')}}</label>
                                                    <input type="text" class="form-control form-control-lg form-control-solid" id="val1" name="val1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-12">{{__('Crypto')}}</label>
                                            <div class="col-lg-12">
                                                <select class="form-select form-select-solid" name="crypto">
                                                    <option value="1">{{__('Yes')}}
                                                    </option>
                                                    <option value="0">{{__('No')}}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label">{{__('Wallet address')}}</label>
                                                    <input type="text" value="{{$val->val2}}" class="form-control form-control-lg form-control-solid" id="val2" name="val2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-neutral" data-bs-dismiss="modal">{{__('Close')}}</button>
                                        <button type="submit" class="btn btn-info">{{__('Save changes')}}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header card-header-stretch">
                            <div class="card-title">
                                <h2 class="fw-boldest me-6">Manual Gateways</h2>
                                <a data-bs-toggle="modal" data-bs-target="#add" class="btn btn-info btn-sm text-white">
                                    {{__('Add')}}
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-bordered table-row-solid gy-5 gs-7" id="kt_api_keys_table">
                                    <thead>
                                        <tr class="text-start text-dark fw-bolder fs-7 text-uppercase px-7">
                                            <th class="w-275px min-w-100px px-0">Name</th>
                                            <th class="w-125px min-w-125px">Limit</th>
                                            <th class="w-125px min-w-50px">Charge</th>
                                            <th class="w-125px min-w-50px">Status</th>
                                            <th class="min-w-150px">Updated</th>
                                            <th class="w-200px"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="fs-6 fw-bold text-dark">
                                        @foreach($admin->manualGateway() as $val)
                                        <tr>
                                            <td>{{$val->name}}</td>
                                            <td>{{$currency->currency_symbol.$val->minamo.' - '.$currency->currency_symbol.number_format($val->maxamo)}}</td>
                                            <td>@if($val->percent_charge!=null){{$val->percent_charge}}% @else 0% @endif + @if($val->fiat_charge!=null){{$val->fiat_charge.' '.$currency->currency}} @else 0 {{$currency->currency_symbol}} @endif</td>
                                            <td>
                                                @if($val->status==0)
                                                <span class="badge badge-danger badge-pill">{{__('Disabled')}}</span>
                                                @elseif($val->status==1)
                                                <span class="badge badge-success badge-pill">{{__('Active')}}</span>
                                                @endif
                                            </td>
                                            <td>{{date("Y/m/d h:i:A", strtotime($val->updated_at))}}</td>
                                            <td class="text-center">
                                                <a data-bs-toggle="modal" data-bs-target="#edit{{$val->id}}" class="btn btn-info btn-sm text-white">
                                                    {{__('Edit')}}
                                                </a>
                                                <a data-bs-toggle="modal" data-bs-target="#delete{{$val->id}}" class="btn btn-danger btn-sm text-white">
                                                    {{__('Delete')}}
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if(route('admin.settings', ['type' => 'payout'])==url()->current())
                <div class="tab-pane fade @if(route('admin.settings', ['type' => 'payout'])==url()->current())show active @endif" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    <div class="card mb-10">
                        <div class="card-body">
                            <h4 class="mb-6">Bank Account Settings</h4>
                            <form action="{{route('admin.settings.update', ['type' => 'payout'])}}" method="post">
                                @csrf
                                <div class="row">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Payout limit')}}</label>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-6">
                                            <div class="input-group">
                                                <span class="input-group-text border-0">{{$currency->currency_symbol}}</span>
                                                <input type="number" step="any" name="min_pl" placeholder="{{__('Minimum amount')}}" value="{{$set->min_pl}}" autocomplete="off" class="form-control form-control-lg form-control-solid">
                                                <span class="input-group-text border-0">{{$currency->currency}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-6">
                                            <div class="input-group">
                                                <span class="input-group-text border-0">{{$currency->currency_symbol}}</span>
                                                <input type="number" step="any" name="max_pl" placeholder="{{__('Maximum amount')}}" value="{{$set->max_pl}}" autocomplete="off" class="form-control form-control-lg form-control-solid">
                                                <span class="input-group-text border-0">{{$currency->currency}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Account number length')}}</label>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-6">
                                            <input type="number" name="min_account" placeholder="{{__('Minimum amount')}}" value="{{$set->min_account}}" autocomplete="off" class="form-control form-control-lg form-control-solid">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-6">
                                            <input type="number" name="max_account" placeholder="{{__('Maximum length')}}" value="{{$set->max_account}}" autocomplete="off" class="form-control form-control-lg form-control-solid">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Payout charge type')}}</label>
                                    <select class="form-select form-select-solid" name="pct" id="pct" required>
                                        <option value="both" @if($set->pct=="both") selected @endif>Percentage & Fiat</option>
                                        <option value="percent" @if($set->pct=="percent") selected @endif>Percentage</option>
                                        <option value="fiat" @if($set->pct=="fiat") selected @endif>Fiat</option>
                                        <option value="none" @if($set->pct=="none") selected @endif>No fees</option>
                                        <option value="min" @if($set->pct=="min") selected @endif>Below</option>
                                        <option value="max" @if($set->pct=="max") selected @endif>Above</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-6">
                                            <div class="input-group">
                                                <input type="number" step="any" name="percent_pc" id="percent_pc" readonly placeholder="{{__('percent charge')}}" value="{{$set->percent_pc}}" autocomplete="off" class="form-control form-control-lg form-control-solid">
                                                <span class="input-group-text border-0">%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-6">
                                            <div class="input-group">
                                                <span class="input-group-text border-0">{{$currency->currency_symbol}}</span>
                                                <input type="number" step="any" name="fiat_pc" id="fiat_pc" placeholder="{{__('fiat charge')}}" value="{{$set->fiat_pc}}" autocomplete="off" class="form-control form-control-lg form-control-solid">
                                                <span class="input-group-text border-0">{{$currency->currency}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-check form-check-custom form-check-solid mb-6">
                                    <input class="form-check-input" type="checkbox" id="payout" name="payout" value="1" @if($set->payout==1)checked @endif />
                                    <label class="form-check-label" for="payout">{{__('Bank Payout')}}</label>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-lg btn-info fw-bolder me-3 my-2">{{__('Update')}}</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    @livewire('admin.banks.index', ['admin' => $admin])
                    @livewire('admin.withdraw.index', ['admin' => $admin])
                </div>
                @endif
                @if(route('admin.settings', ['type' => 'money_transfer'])==url()->current())
                <div class="tab-pane fade @if(route('admin.settings', ['type' => 'money_transfer'])==url()->current())show active @endif" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    <div class="card mb-10">
                        <div class="card-body">
                            <form action="{{route('admin.settings.update', ['type' => 'money_transfer'])}}" method="post">
                                @csrf
                                <div class="row">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Transfer limit')}}</label>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-6">
                                            <div class="input-group">
                                                <span class="input-group-text border-0">{{$currency->currency_symbol}}</span>
                                                <input type="number" step="any" name="min_tl" placeholder="{{__('Minimum amount')}}" value="{{$set->min_tl}}" autocomplete="off" class="form-control form-control-lg form-control-solid" required>
                                                <span class="input-group-text border-0">{{$currency->currency}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-6">
                                            <div class="input-group">
                                                <span class="input-group-text border-0">{{$currency->currency_symbol}}</span>
                                                <input type="number" step="any" name="max_tl" placeholder="{{__('Maximum amount')}}" value="{{$set->max_tl}}" autocomplete="off" class="form-control form-control-lg form-control-solid" required>
                                                <span class="input-group-text border-0">{{$currency->currency}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Transfer charge type')}}</label>
                                    <select class="form-select form-select-solid" name="tct" id="pct" required>
                                        <option value="both" @if($set->tct=="both") selected @endif>Percentage & Fiat</option>
                                        <option value="percent" @if($set->tct=="percent") selected @endif>Percentage</option>
                                        <option value="fiat" @if($set->tct=="fiat") selected @endif>Fiat</option>
                                        <option value="none" @if($set->tct=="none") selected @endif>No fees</option>
                                        <option value="min" @if($set->tct=="min") selected @endif>Below</option>
                                        <option value="max" @if($set->tct=="max") selected @endif>Above</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-6">
                                            <div class="input-group">
                                                <input type="number" step="any" name="percent_tc" id="percent_pc" readonly placeholder="{{__('percent charge')}}" value="{{$set->percent_tc}}" autocomplete="off" class="form-control form-control-lg form-control-solid">
                                                <span class="input-group-text border-0">%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-6">
                                            <div class="input-group">
                                                <span class="input-group-text border-0">{{$currency->currency_symbol}}</span>
                                                <input type="number" step="any" name="fiat_tc" id="fiat_pc" placeholder="{{__('fiat charge')}}" value="{{$set->fiat_tc}}" autocomplete="off" class="form-control form-control-lg form-control-solid">
                                                <span class="input-group-text border-0">{{$currency->currency}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-check form-check-custom form-check-solid mb-6">
                                    <input class="form-check-input" type="checkbox" id="money_transfer" name="money_transfer" value="1" @if($set->money_transfer==1)checked @endif />
                                    <label class="form-check-label" for="money_transfer">{{__('P2P transfer between users')}}</label>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-lg btn-info fw-bolder me-3 my-2">{{__('Update')}}</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
                @if(route('admin.settings', ['type' => 'kyc'])==url()->current())
                <div class="tab-pane fade @if(route('admin.settings', ['type' => 'kyc'])==url()->current())show active @endif" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    @livewire('admin.kyc.index', ['admin' => $admin])
                </div>
                @endif
                @if(route('admin.settings', ['type' => 'country'])==url()->current())
                <div class="tab-pane fade @if(route('admin.settings', ['type' => 'country'])==url()->current())show active @endif" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    @livewire('admin.country.index', ['admin' => $admin])
                </div>
                @endif
                @if(route('admin.settings', ['type' => 'bank_deposit'])==url()->current())
                <div class="tab-pane fade @if(route('admin.settings', ['type' => 'bank_deposit'])==url()->current())show active @endif" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    <div class="card mb-10">
                        <div class="card-body">
                            <form action="{{route('admin.settings.update', ['type' => 'bank_deposit'])}}" method="post">
                                @csrf
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Bank name')}}</label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="dp_bank_name" value="{{$set->dp_bank_name}}" required />
                                    @error('dp_bank_name')
                                    <span class="form-text">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Routing Code')}}</label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="bk_routing_code" value="{{$set->bk_routing_code}}" required />
                                    @error('bk_routing_code')
                                    <span class="form-text">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Account Number')}}</label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="bk_acct_no" value="{{$set->bk_acct_no}}" required />
                                    @error('bk_acct_no')
                                    <span class="form-text">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Account Name')}}</label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="bk_acct_name" value="{{$set->bk_acct_name}}" required />
                                    @error('bk_acct_name')
                                    <span class="form-text">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-check form-check-custom form-check-solid mb-6">
                                    <input class="form-check-input" type="checkbox" id="bk_status" name="bk_status" value="1" @if($set->bk_status==1)checked @endif />
                                    <label class="form-check-label" for="bk_status">{{__('Bank Deposit')}}</label>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-lg btn-info fw-bolder me-3 my-2">{{__('Update')}}</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
                @if(route('admin.settings', ['type' => 'recaptcha'])==url()->current())
                <div class="tab-pane fade @if(route('admin.settings', ['type' => 'recaptcha'])==url()->current())show active @endif" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                    <div class="card mb-10">
                        <div class="card-body">
                            <form action="{{route('admin.settings.update', ['type' => 'recaptcha'])}}" method="post">
                                @csrf
                                <p class="fs-5 text-dark fw-bold">{{__('Google Recaptcha V3, this will be enabled on registration and contact us page to prevent spamming and bots')}}</p>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('NOCAPTCHA SECRET')}}</label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="NOCAPTCHA_SECRET" value="{{$set->NOCAPTCHA_SECRET}}" required />
                                    @error('NOCAPTCHA_SECRET')
                                    <span class="form-text">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('NOCAPTCHA SITEKEY')}}</label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="NOCAPTCHA_SITEKEY" value="{{$set->NOCAPTCHA_SITEKEY}}" required />
                                    @error('NOCAPTCHA_SITEKEY')
                                    <span class="form-text">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-check form-check-custom form-check-solid mb-6">
                                    <input class="form-check-input" type="checkbox" id="recaptcha" name="recaptcha" value="1" @if($set->recaptcha==1)checked @endif />
                                    <label class="form-check-label" for="recaptcha">{{__('Recaptcha')}}</label>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-lg btn-info fw-bolder me-3 my-2">{{__('Update')}}</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
                @if(route('admin.settings', ['type' => 'twilio'])==url()->current())
                <div class="tab-pane fade @if(route('admin.settings', ['type' => 'twilio'])==url()->current())show active @endif" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                    <div class="card mb-10">
                        <div class="card-body">
                            <form action="{{route('admin.settings.update', ['type' => 'twilio'])}}" method="post">
                                @csrf
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Twilio account sid')}}</label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="twilio_account_sid" value="{{$set->twilio_account_sid}}" required />
                                    @error('twilio_account_sid')
                                    <span class="form-text">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Twilio auth token')}}</label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="twilio_auth_token" value="{{$set->twilio_auth_token}}" required />
                                    @error('twilio_auth_token')
                                    <span class="form-text">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Twilio number')}}</label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="twilio_number" value="{{$set->twilio_number}}" required />
                                    @error('twilio_number')
                                    <span class="form-text">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-lg btn-info fw-bolder me-3 my-2">{{__('Update')}}</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
                @if(route('admin.settings', ['type' => 'security'])==url()->current())
                <div class="tab-pane fade @if(route('admin.settings', ['type' => 'security'])==url()->current())show active @endif" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                    <div class="card mb-10">
                        <div class="card-body">
                            <p class="text-dark fs-5 fw-bold">{{__('Change admin login credentials')}}</p>
                            <form action="{{route('admin.settings.update', ['type' => 'security'])}}" method="post">
                                @csrf
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Username')}}</label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="username" value="{{$admin->username}}" />
                                    @error('username')
                                    <span class="form-text">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Password')}}</label>
                                    <input class="form-control form-control-lg form-control-solid" type="password" name="password" required />
                                    @error('password')
                                    <span class="form-text">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-lg btn-info fw-bolder me-3 my-2">{{__('Update')}}</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card mb-10">
                        <div class="card-body">
                            <p class="text-dark fs-5 fw-bold">{{__('Admin Recovery')}}</p>
                            <form action="{{route('admin.settings.update', ['type' => 'settings'])}}" method="post">
                                @csrf
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Recovery email')}}</label>
                                    <input class="form-control form-control-lg form-control-solid" type="email" name="recovery_email" value="{{$set->recovery_email}}" />
                                    @error('recovery_email')
                                    <span class="form-text">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-lg btn-info fw-bolder me-3 my-2">{{__('Update')}}</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
                @if(route('admin.settings', ['type' => 'policies'])==url()->current())
                <div class="tab-pane fade @if(route('admin.settings', ['type' => 'policies'])==url()->current())show active @endif" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    <div class="card mb-10">
                        <div class="card-body">
                            <form action="{{route('admin.settings.update', ['type' => 'policies'])}}" method="post">
                                @csrf
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Privacy policy')}}</label>
                                    <textarea class="form-control form-control-lg form-control-solid tinymce" rows="20" name="privacy">{{$set->privacy}}</textarea>
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Terms & Conditions')}}</label>
                                    <textarea class="form-control form-control-lg form-control-solid tinymce" rows="20" name="terms">{{$set->terms}}</textarea>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-lg btn-info fw-bolder me-3 my-2">{{__('Update')}}</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
                @if(route('admin.settings', ['type' => 'social'])==url()->current())
                <div class="tab-pane fade @if(route('admin.settings', ['type' => 'social'])==url()->current())show active @endif" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    <div class="card mb-10">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-row-bordered gy-5">
                                    <thead>
                                        <tr class="fw-semibold fs-6 text-muted">
                                            <th>{{__('S/N')}}</th>
                                            <th>{{__('Name')}}</th>
                                            <th>{{__('Link')}}</th>
                                            <th class="scope"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($admin->socialLinks() as $k=>$val)
                                        <tr>
                                            <td>{{++$k}}.</td>
                                            <td>{{$val->type}}</td>
                                            <td>{{($val->value) ? $val->value : 'No link'}}</td>
                                            <td class="text-right">
                                                <a class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#update{{$val->id}}" href=""><i class="fal fa-pencil"></i> {{__('Edit')}}</a>
                                            </td>
                                        </tr>
                                        <div id="update{{$val->id}}" class="modal fade" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title">{{ucwords($val->type)}}</h3>
                                                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                            <span class="svg-icon svg-icon-1">
                                                                <i class="fal fa-times"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <form action="{{route('social-links.update', ['social' => $val->id])}}" method="post">
                                                        <div class="modal-body">
                                                            @csrf
                                                            <div class="form-group row">
                                                                <div class="col-lg-12">
                                                                    <input type="url" name="link" class="form-control form-control-solid form-control-lg" placeholder="Enter link" value="{{$val->value}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-info">{{__('Update')}}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if(route('admin.settings', ['type' => 'brands'])==url()->current())
                <div class="tab-pane fade @if(route('admin.settings', ['type' => 'brands'])==url()->current())show active @endif" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    @livewire('admin.brand.index', ['admin' => $admin])
                </div>
                @endif
                @if(route('admin.settings', ['type' => 'review'])==url()->current())
                <div class="tab-pane fade @if(route('admin.settings', ['type' => 'review'])==url()->current())show active @endif" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    @livewire('admin.review.index', ['admin' => $admin])
                </div>
                @endif
                @if(route('admin.settings', ['type' => 'services'])==url()->current())
                <div class="tab-pane fade @if(route('admin.settings', ['type' => 'services'])==url()->current())show active @endif" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    @livewire('admin.services.index', ['admin' => $admin])
                </div>
                @endif
                @if(route('admin.settings', ['type' => 'logo'])==url()->current())
                <div class="tab-pane fade @if(route('admin.settings', ['type' => 'logo'])==url()->current())show active @endif" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    @livewire('admin.logo.index', ['admin' => $admin])
                </div>
                @endif
                @if(route('admin.settings', ['type' => 'page'])==url()->current())
                <div class="tab-pane fade @if(route('admin.settings', ['type' => 'page'])==url()->current())show active @endif" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    @livewire('admin.page.index', ['admin' => $admin])
                </div>
                @endif
                @if(route('admin.settings', ['type' => 'home'])==url()->current())
                <div class="tab-pane fade @if(route('admin.settings', ['type' => 'home'])==url()->current())show active @endif" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    @livewire('admin.home.index', ['admin' => $admin])
                </div>
                @endif
                @if(route('admin.settings', ['type' => 'team'])==url()->current())
                <div class="tab-pane fade @if(route('admin.settings', ['type' => 'team'])==url()->current())show active @endif" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    @livewire('admin.team.index', ['admin' => $admin])
                </div>
                @endif
                @if(route('admin.settings', ['type' => 'social_login'])==url()->current())
                <div class="tab-pane fade @if(route('admin.settings', ['type' => 'social_login'])==url()->current())show active @endif" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    <div class="card mb-10">
                        <div class="card-body">
                            <form action="{{route('admin.settings.update', ['type' => 'social_login'])}}" method="post">
                                @csrf
                                <p>Redirect route => {{route('callback.login', ['type' => 'google'])}}</p>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Google Client ID')}}</label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="google_ci" value="{{$set->google_ci}}" />
                                    @error('google_ci')
                                    <span class="form-text">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Google Client Secret')}}</label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="google_cs" value="{{$set->google_cs}}" />
                                    @error('google_cs')
                                    <span class="form-text">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-check form-check-custom form-check-solid mb-6">
                                    <input class="form-check-input" type="checkbox" id="google_sl" name="google_sl" value="1" @if($set->google_sl==1)checked @endif />
                                    <label class="form-check-label" for="google_sl">{{__('Google login')}}</label>
                                </div>
                                <p>Redirect route => {{route('callback.login', ['type' => 'facebook'])}}</p>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Facebook Client ID')}}</label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="facebook_ci" value="{{$set->facebook_ci}}" />
                                    @error('facebook_ci')
                                    <span class="form-text">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Facebook Client Secret')}}</label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="facebook_cs" value="{{$set->facebook_cs}}" />
                                    @error('facebook_cs')
                                    <span class="form-text">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-check form-check-custom form-check-solid mb-6">
                                    <input class="form-check-input" type="checkbox" id="facebook_sl" name="facebook_sl" value="1" @if($set->facebook_sl==1)checked @endif />
                                    <label class="form-check-label" for="facebook_sl">{{__('Facebook login')}}</label>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-lg btn-info fw-bolder me-3 my-2">{{__('Update')}}</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@stop
@section('script')
@if(route('admin.settings', ['type' => 'policies'])==url()->current())
<script src="{{asset('asset/tinymce/tinymce.min.js')}}"></script>
<script src="{{asset('asset/tinymce/init-tinymce.js')}}"></script>
@endif
<script>
    function pct() {
        var pct = $("#pct").find(":selected").val();
        var myarr = pct;
        if (myarr == "both") {
            $("#fiat_pc").attr({
                required: true,
                readonly: false,
                placeholder: 'Fiat charge'
            });
            $("#percent_pc").attr({
                required: true,
                readonly: false,
                placeholder: 'Percent charge'
            });
        } else if (myarr == "fiat") {
            $("#fiat_pc").attr({
                required: true,
                readonly: false,
                placeholder: 'Fiat charge'
            });
            $("#percent_pc").attr({
                required: false,
                readonly: true,
                placeholder: 'Percent charge'
            });
        } else if (myarr == "percent") {
            $("#fiat_pc").attr({
                required: false,
                readonly: true,
                placeholder: 'Fiat charge'
            });
            $("#percent_pc").attr({
                required: true,
                readonly: false,
                placeholder: 'Percent charge'
            });
        } else if (myarr == "none") {
            $("#fiat_pc").attr({
                required: false,
                readonly: true,
                placeholder: 'Fiat charge'
            });
            $("#percent_pc").attr({
                required: false,
                readonly: true,
                placeholder: 'Percent charge'
            });
        } else {
            $("#fiat_pc").attr({
                required: true,
                readonly: false,
                placeholder: 'Amount'
            });
            $("#percent_pc").attr({
                required: false,
                readonly: true
            });
        }
    }
    $("#pct").change(pct);
    pct();
</script>
@endsection