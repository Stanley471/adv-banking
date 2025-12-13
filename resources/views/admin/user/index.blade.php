@extends('admin.menu')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
@section('content')
@if($type == 'users')
@livewire('admin.users.index', ['admin' => $admin, 'settings' => $set, 'type' => 'users'])
@else
@livewire('admin.users.index', ['admin' => $admin, 'settings' => $set, 'type' => 'kyc'])
@endif
@stop