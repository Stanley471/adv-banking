@extends('admin.menu')
@section('content')
@livewire('admin.helpcenter.article', ['topic' => $topic]);
@stop