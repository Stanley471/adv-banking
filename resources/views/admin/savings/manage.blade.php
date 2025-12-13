@extends('admin.menu')

@section('content')

@livewire('admin.savings.manage', ['admin' => $admin, 'settings' => $set, 'plan' => $plan])

@stop