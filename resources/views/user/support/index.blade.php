@extends('user.menu')

@section('content')
@livewire('ticket.user', ['user' => $user, 'settings' => $set])
@stop