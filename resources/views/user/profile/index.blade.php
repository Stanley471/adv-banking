@extends('user.menu')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
@section('content')
<div class="toolbar" id="kt_toolbar">
  <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
    <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
      <h1 class="text-dark fw-bolder my-1 fs-2 mb-6">{{__('Settings')}}</h1>
      <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-5 border-gray-300" id="tabs-icons-text" role="tablist">
        <li class="nav-item">
          <a class="nav-link text-dark @if(route('user.profile', ['type' => 'profile'])==url()->current()) active @endif" id="tabs-icons-text-1-tab" href="{{route('user.profile', ['type' => 'profile'])}}" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">{{__('Profile')}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark @if(route('user.profile', ['type' => 'bank'])==url()->current()) active @endif" id="tabs-icons-text-2-tab" href="{{route('user.profile', ['type' => 'bank'])}}" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">{{__('Bank accounts')}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark @if(route('user.profile', ['type' => 'beneficiary'])==url()->current()) active @endif" id="tabs-icons-text-2-tab" href="{{route('user.profile', ['type' => 'beneficiary'])}}" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">{{__('Beneficiary')}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark @if(route('user.profile', ['type' => 'security'])==url()->current()) active @endif" id="tabs-icons-text-2-tab" href="{{route('user.profile', ['type' => 'security'])}}" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">{{__('Security')}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark @if(route('user.profile', ['type' => 'notifications'])==url()->current()) active @endif" id="tabs-icons-text-2-tab" href="{{route('user.profile', ['type' => 'notifications'])}}" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">{{__('Notifications')}}</a>
        </li>
      </ul>
    </div>
  </div>
  @livewire('settings.options', ['user' => $user, 'set' => $set, 'secret' => $secret, 'image' => $image])
  <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
    <div class="container">
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade @if(route('user.profile', ['type' => 'profile'])==url()->current())show active @endif" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
          <div class="row">
            <div class="col-md-8">
              @livewire('settings.kin', ['user' => $user, 'type' => 'profile'])
            </div>
            <div class="col-md-4">
              @livewire('settings.avatar', ['user' => $user])
            </div>
            <div class="col-md-12">
              @livewire('settings.kin', ['user' => $user, 'type' => 'kin'])
            </div>
          </div>
        </div>
        <div class="tab-pane fade @if(route('user.profile', ['type' => 'security'])==url()->current())show active @endif" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
          @if($user->social == 0)
          <div class="d-flex flex-stack cursor-pointer mt-6" data-bs-toggle="modal" data-bs-target="#resetpassword">
            <div class="d-flex align-items-center">
              <div class="symbol symbol-45px symbol-circle me-4">
                <div class="symbol-label fs-2 fw-bolder bg-light-info">
                  <i class="fal fa-lock text-info"></i>
                </div>
              </div>
              <div class="ps-1">
                <p href="#" class="fs-6 text-gray-800 text-hover-primary fw-bolder mb-0">{{__('Reset Password')}}</p>
              </div>
            </div>
          </div>
          @endif
          <hr class="bg-light-border">
          <div class="d-flex flex-stack cursor-pointer" data-bs-toggle="modal" data-bs-target="#resetpin">
            <div class="d-flex align-items-center">
              <div class="symbol symbol-45px symbol-circle me-4">
                <div class="symbol-label fs-2 fw-bolder bg-light-info">
                  <i class="fal fa-arrow-up-from-bracket text-info"></i>
                </div>
              </div>
              <div class="ps-1">
                <p href="#" class="fs-6 text-gray-800 text-hover-primary fw-bolder mb-0">{{__('Change your PIN')}}</p>
              </div>
            </div>
          </div>
          <hr class="bg-light-border">
          <div class="d-flex flex-stack cursor-pointer" id="kt_fasecurity_button">
            <div class="d-flex align-items-center">
              <div class="symbol symbol-45px symbol-circle me-4">
                <div class="symbol-label fs-2 fw-bolder bg-light-info">
                  <i class="fal fa-shield text-info"></i>
                </div>
              </div>
              <div class="ps-1">
                <p href="#" class="fs-6 text-gray-800 text-hover-primary fw-bolder mb-0">{{__('Two Factor Authentication')}}</p>
              </div>
            </div>
          </div>
          <hr class="bg-light-border">
          <div class="d-flex flex-stack cursor-pointer" id="kt_devices_button">
            <div class="d-flex align-items-center">
              <div class="symbol symbol-45px symbol-circle me-4">
                <div class="symbol-label fs-2 fw-bolder bg-light-info">
                  <i class="fal fa-laptop text-info"></i>
                </div>
              </div>
              <div class="ps-1">
                <p href="#" class="fs-6 text-gray-800 text-hover-primary fw-bolder mb-0">{{__('Devices & Sessions')}}</p>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade @if(route('user.profile', ['type' => 'notifications'])==url()->current())show active @endif" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
          @livewire('settings.notifications', ['user' => $user])
        </div>
        <div class="tab-pane fade @if(route('user.profile', ['type' => 'bank'])==url()->current())show active @endif" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
          @livewire('bank.index', ['user' => $user, 'settings' => $set])
        </div>
        <div class="tab-pane fade @if(route('user.profile', ['type' => 'beneficiary'])==url()->current())show active @endif" id="tabs-icons-text-4" role="tabpanel" aria-labelledby="tabs-icons-text-4-tab">
          @livewire('beneficiary.index', ['user' => $user])
        </div>
      </div>
    </div>
  </div>
</div>
@stop