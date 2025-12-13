@extends('admin.menu')
@section('content')
@livewire('admin.savings.header', ['type' => $type, 'admin' => $admin])
@livewire('admin.savings.'.$type, ['type' => $type, 'admin' => $admin, 'settings' => $set])
@stop