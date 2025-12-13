@extends('auth.menu')

@section('content')
<div class="py-10">
  <div class="p-10 p-lg-15 mx-auto">
    <div class="card rounded-5">
      <div class="card-body m-5">
        <a href="{{route('home')}}" class="navbar-brand pe-3">
          <img class="mb-6" src="{{asset('asset/images/logo.png')}}" width="100" alt="{{$set->site_name}}" loading="lazy">
        </a>
        <h2 class="text-dark font-weight-bolder mb-6">{{__('Unlock Software') }}</h2>
        <p>{{__('How to unlock Bespoke, add a valid license key to .env by updating PURCHASECODE & DOMAIN') }}</p>
        <p>
          <?php
          session_start();
          echo $_SESSION["error"];
          session_destroy()
          ?></p>
        <a href="{{url('/')}}" class="text-info"><i class="fal fa-sync"></i> Refresh</a>
      </div>
    </div>
  </div>
  @include('partials.external')
</div>
@stop

<script>
  window.history.replaceState({}, document.title, "/" + "zebra");
</script>