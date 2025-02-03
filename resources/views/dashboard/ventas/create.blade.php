@extends('layouts.main')
@section('content')

    <x-text-header label="Ventas (Nuevo)" />
    <x-btn-add-back route="dashboard.ventas.index" type="back" />

   

    <x-cliente-buscar />

@stop