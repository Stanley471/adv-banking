@extends('admin.menu')
@section('content')
@livewire('admin.language.edit', ['admin' => $admin, 'set' => $set, 'lang' => $lang])
@stop