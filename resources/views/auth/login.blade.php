@extends('auth.menu')

@section('content')
<div class="py-10">
  <div class="p-10 p-lg-15 mx-auto">
    @livewire('auth.login', ['set' => $set])
  </div>
</div>
@include('partials.external')
@stop

