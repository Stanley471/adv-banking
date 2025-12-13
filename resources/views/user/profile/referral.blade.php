@extends('user.menu')

@section('content')
<div class="toolbar" id="kt_toolbar">
    <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
        <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
            <h1 class="text-dark fw-bolder my-1 fs-2">{{__('Referral')}}</h1>
            <ul class="breadcrumb fw-semibold fs-base my-1 mb-9">
                <li class="breadcrumb-item text-muted">
                    <a href="{{route('user.dashboard')}}" class="text-muted text-hover-primary">{{__('Dashboard')}}</a>
                </li>
                <li class="breadcrumb-item text-dark">{{__('Referral')}}</li>
            </ul>
        </div>
    </div>
    <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
        <div class="container">
            <!--begin::Referral program-->
            <div class="card mb-6 mb-xxl-9">
                <!--begin::Body-->
                <div class="card-body">
                    <div class="row mb-10">
                        <div class="col-xl-12">
                            <h2 class="fs-3 fw-boldest text-dark m-0">Your Referral Link</h2>
                            <p class="fs-5 fw-bold text-gray-800 py-5 m-0">{{__('Earn investment waivers, anytime friends or family you refer to ').$set->site_name.'. You won\'t be charged investment fee for any investment if you have a waiver.'}}</p>
                            <div class="d-flex">
                                <input id="kt_referral_link_input" type="text" class="form-control form-control-solid me-3 flex-grow-1" name="search" value="{{route('register', ['referral' => $user->merchant_id])}}">
                                <button class="btn btn-light fw-boldest flex-shrink-0 castro-copy text-dark" data-clipboard-text="{{route('register', ['referral' => $user->merchant_id])}}">Copy Link</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!--begin::Col-->
                        <div class="col">
                            <div class="card card-dashed flex-center min-w-175px my-3 p-6 rounded-5">
                                <span class="fs-4 fw-bold text-info pb-1 px-2">Current Waivers</span>
                                <span class="fs-lg-2tx fw-boldest d-flex justify-content-center">
                                    <span data-kt-countup="true" data-kt-countup-value="{{$user->getFirstBalance()->waivers}}" class="counted">{{$user->getFirstBalance()->waivers}}</span></span>
                            </div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col">
                            <div class="card card-dashed flex-center min-w-175px my-3 p-6 rounded-5">
                                <span class="fs-4 fw-bold text-success pb-1 px-2">Used Waivers</span>
                                <span class="fs-lg-2tx fw-boldest d-flex justify-content-center">
                                    <span data-kt-countup="true" data-kt-countup-value="{{$user->getFirstBalance()->used_waivers}}" class="counted">{{$user->getFirstBalance()->used_waivers}}</span></span>
                            </div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col">
                            <div class="card card-dashed flex-center min-w-175px my-3 p-6 rounded-5">
                                <span class="fs-4 fw-bold text-danger pb-1 px-2">Total Waivers</span>
                                <span class="fs-lg-2tx fw-boldest d-flex justify-content-center">
                                    <span data-kt-countup="true" data-kt-countup-value="{{$user->referrals->sum('ref_waivers')}}" class="counted">{{$user->referrals->sum('ref_waivers')}}</span></span>
                            </div>
                        </div>
                        <!--end::Col-->
                    </div>
                </div>
            </div>
            @if($user->referrals->count())
            <div class="card">
                <!--begin::Header-->
                <div class="card-header card-header-stretch">
                    <!--begin::Title-->
                    <div class="card-title">
                        <h2 class="fw-boldest m-0">Referred Users</h2>
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
            </div>
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-row-bordered table-flush align-middle gy-6">
                    <!--begin::Thead-->
                    <thead class="border-bottom border-gray-200 fs-5 fw-bold bg-lighten">
                        <tr>
                            <th class="min-w-125px ps-9">Merchant ID</th>
                            <th class="min-w-125px px-0">User</th>
                            <th class="min-w-125px">Date</th>
                            <th class="min-w-125px">Waivers</th>
                        </tr>
                    </thead>
                    <!--end::Thead-->
                    <!--begin::Tbody-->
                    <tbody class="fs-5 fw-bold text-gray-600">
                        @foreach($user->referrals as $val)
                        <tr>
                            <td class="ps-9">{{$val->merchant_id}}</td>
                            <td class="ps-0">{{$val->business->name}}</td>
                            <td>{{\Carbon\Carbon::create($val->referred_date)->toDayDateTimeString()}}</td>
                            <td>{{$val->ref_waivers}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <!--end::Tbody-->
                </table>
                <!--end::Table-->
            </div>
            @else
            <div class="text-center mt-20">
                <img src="{{asset('asset/images/transactions.png')}}" style="height:auto; max-width:150px;" class="mb-6">
                <h3 class="text-dark">{{__('No Referral Found')}}</h3>
                <p class="text-dark">{{__('We couldn\'t find any referral to this account')}}</p>
            </div>
            @endif
            <!--end::Referred users-->
        </div>
    </div>
</div>
@stop