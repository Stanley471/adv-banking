@extends('admin.menu')

@section('content')
<div class="toolbar" id="kt_toolbar">
    <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
        <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
            <h1 class="text-dark fw-bolder my-1 fs-2 mb-6">{{__('Email')}}</h1>
            <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-6 border-gray-300" id="tabs-icons-text" role="tablist">
                <li class="nav-item">
                    <a class="nav-link text-dark @if(route('email.settings', ['type' => 'settings'])==url()->current()) active @endif" id="tabs-icons-text-1-tab" href="{{route('email.settings', ['type' => 'settings'])}}" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">{{__('Configuration')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark @if(route('email.settings', ['type' => 'template'])==url()->current()) active @endif" id="tabs-icons-text-2-tab" href="{{route('email.settings', ['type' => 'template'])}}" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">{{__('Template')}}</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
        <div class="container">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade @if(route('email.settings', ['type' => 'settings'])==url()->current())show active @endif" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                    <div class="card mb-10">
                        <div class="card-body">
                            <h5>{{__('SMTP Credentials')}}</h5>
                            <p class="mb-1">Table shows value of your env email configuration, ensure what is dispalyed here matches your email service smtp configuration, if it doesn't, navigate to .env file to edit this</p>
                            <div class="table-responsive mb-5">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>PARAMETER</th>
                                            <th>VALUE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td> 1 </td>
                                            <td> MAIL_HOST</td>
                                            <td> {{env('MAIL_HOST')}}</td>
                                        </tr>
                                        <tr>
                                            <td> 2 </td>
                                            <td> MAIL_PORT </td>
                                            <td> {{env('MAIL_PORT')}}</td>
                                        </tr>
                                        <tr>
                                            <td> 3 </td>
                                            <td> MAIL_USERNAME </td>
                                            <td> {{env('MAIL_FROM_ADDRESS')}}</td>
                                        </tr>
                                        <tr>
                                            <td> 4 </td>
                                            <td> MAIL_PASSWORD </td>
                                            <td> {{env('MAIL_PASSWORD')}}</td>
                                        </tr>
                                        <tr>
                                            <td> 5 </td>
                                            <td> MAIL_ENCRYPTION </td>
                                            <td> {{env('MAIL_ENCRYPTION')}}</td>
                                        </tr>
                                        <tr>
                                            <td> 6 </td>
                                            <td> MAIL_FROM_ADDRESS </td>
                                            <td> {{env('MAIL_FROM_ADDRESS')}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-10">
                        <div class="card-body">
                            <form action="{{route('admin.settings.update', ['type' => 'system'])}}" method="post">
                                @csrf
                                <h5>Template Configuration</h5>
                                <div class="table-responsive mb-5">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>CODE</th>
                                                <th>DESCRIPTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td> 1 </td>
                                                <td> &#123;&#123;message&#125;&#125;</td>
                                                <td> Details Text From the Script</td>
                                            </tr>
                                            <tr>
                                                <td> 2 </td>
                                                <td> &#123;&#123;logo&#125;&#125; </td>
                                                <td> Platform logo. Will be Pulled From Database</td>
                                            </tr>
                                            <tr>
                                                <td> 3 </td>
                                                <td> &#123;&#123;site_name&#125;&#125; </td>
                                                <td> Website Name. Will be Pulled From Database</td>
                                            </tr>
                                            <tr>
                                                <td> 4 </td>
                                                <td> &#123;&#123;unsubscribe&#125;&#125; </td>
                                                <td> Unsubscribe link for promotional emails. Will be Pulled From Database</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="fv-row mb-6 mb-6">
                                    <div class="col-lg-12">
                                        <textarea type="text" name="email_template" rows="4" class="form-control tinymce">{{$set->email_template}}</textarea>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-info">{{__('Save')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade @if(route('email.settings', ['type' => 'template'])==url()->current())show active @endif" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                    <div class="card mb-10">
                        <div class="card-body">
                            @foreach($admin->emailTemplate() as $val)
                            <form action="{{route('email.template.settings', ['type' => $val->type])}}" method="post">
                                @csrf
                                <p class="fs-5 text-dark fw-bold">{{$val->type}}</p>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Subject')}}</label>
                                    <input type="text" name="subject" class="form-control form-control-lg form-control-solid" value="{{$val->subject}}">
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark">{{__('Body')}}</label>
                                    <textarea type="text" name="body" rows="10" class="form-control form-control-lg form-control-solid tinymce">{{$val->body}}</textarea>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-lg btn-info fw-bolder me-3 my-2">{{__('Update')}}</a>
                                </div>
                            </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('script')
<script src="{{asset('asset/tinymce/init-tinymce.js')}}"></script>
@endsection