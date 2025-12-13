@extends('auth.menu')

@section('content')
<div class="py-10">
  <div class="p-10 p-lg-15 mx-auto">
    <div class="text-center">
      <a href="{{route('home')}}" class="navbar-brand pe-3">
        <img class="mb-6 text-center" src="{{asset('asset/images/logo.png')}}" width="200" alt="{{$set->site_name}}" loading="lazy">
      </a>
    </div>
    <div class="card rounded-5">
      <div class="card-body m-5">
        <h3 class="text-uppercase font-weight-bolder text-dark">{{__('Account has been suspended')}}</h3>
        <p class="text-dark">{{__('Click')}}, <a href="{{url('contact')}}">{{__('here')}}</a> {{__('to contact administrator')}}</p>
      </div>
    </div>
  </div>
  @include('partials.external')
</div>
@stop