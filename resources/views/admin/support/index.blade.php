@extends('admin.menu')
@section('content')
@livewire('ticket.header', ['type' => $type, 'admin' => $admin])
@livewire('ticket.'.$type, ['type' => $type, 'admin' => $admin])
@stop