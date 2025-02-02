@extends('layouts.main')
@section('content')
    
    <x-text-header label="Clientes (Nuevo)" />
    <x-btn-add-back route="dashboard.clientes.index" type="back" />
    <form action="{{ route('dashboard.clientes.store') }}" method="POST">
        @csrf
        <x-cliente-buscar btnSave />
    </form>

@stop
