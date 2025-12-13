@extends('admin.menu')
@section('content')
@livewire('admin.blog.header', ['type' => $type, 'admin' => $admin])
@livewire('admin.blog.'.$type, ['type' => $type, 'admin' => $admin])
@stop