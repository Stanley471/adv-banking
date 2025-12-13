@extends('admin.menu')
@section('content')
@livewire('admin.message.header', ['type' => $type, 'admin' => $admin])
@livewire('admin.message.'.$type, ['type' => $type, 'admin' => $admin])
@stop