@extends('admin.menu')
@section('content')
@livewire('admin.invest.header', ['type' => $type, 'admin' => $admin])
@livewire('admin.invest.'.$type, ['type' => $type, 'admin' => $admin])
@stop