@extends('user.menu')

@section('content')

@livewire('savings.manage', ['user' => $user, 'settings' => $set, 'plan' => $plan])

@stop