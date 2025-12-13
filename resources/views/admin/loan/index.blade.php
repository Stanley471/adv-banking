@extends('admin.menu')
@section('content')
@livewire('admin.loan.header', ['type' => $type, 'admin' => $admin])
@if($type == 'loanplans')
@livewire('admin.loan.loanplans', ['type' => $type, 'admin' => $admin])
@elseif($type == 'bnplplans')
@livewire('admin.loan.products', ['type' => $type, 'admin' => $admin])
@elseif($type == 'category')
@livewire('admin.loan.category', ['type' => $type, 'admin' => $admin])
@elseif($type == 'shipping')
@livewire('admin.loan.shipping', ['type' => $type, 'admin' => $admin])
@else
@livewire('admin.loan.others', ['type' => $type, 'admin' => $admin])
@endif
@stop