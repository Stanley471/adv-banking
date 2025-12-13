@extends('admin.menu')
@section('content')
@livewire('admin.language.index', ['admin' => $admin, 'set' => $set])
@stop