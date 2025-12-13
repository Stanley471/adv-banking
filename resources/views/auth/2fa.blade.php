@extends('auth.menu')

@section('content')
<div class="py-10">
  <div class="p-10 p-lg-15 mx-auto">
    <div class="card rounded-5">
      <div class="card-body m-5">
        @livewire('auth.security', ['set' => $set, 'user' => $user])
      </div>
    </div>
  </div>
  @include('partials.external')
</div>
@stop