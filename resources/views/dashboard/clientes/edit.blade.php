@extends('layouts.main')
@section('content')
    
    <x-text-header label="Cliente (Editar)" />
    <x-btn-add-back route="dashboard.clientes.index" type="back" />
    <form action="{{ route('dashboard.clientes.update',$cliente->id) }}" method="POST">
        @csrf
        @method('PUT')
        <x-cliente-buscar btnSave :cliente="$cliente" />
    </form>

@stop
