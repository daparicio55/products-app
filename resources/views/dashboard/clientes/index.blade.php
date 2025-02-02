@extends('layouts.main')
@section('content')
    <!-- Page Heading -->
    <x-text-header label="Clientes"/>
    <x-btn-add-back route="dashboard.clientes.create" type="add"/>  

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de Clientes</h6>
        </div>

        <div class="card-body">
            <x-data-table id="dataTable">
                <x-slot name="thead">
                    <th>T. Documento</th>
                    <th>N° Documento</th>
                    <th>APELLIDOS, Nombres / Razon Social</th>
                    <th>Teléfono</th>
                    <th style="width: 110px">Acciones</th>
                </x-slot>
                <x-slot name="tbody">
                    @foreach ($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->tipoDocumento->nombre }}</td>
                            <td>{{ $cliente->numero_documento }}</td>
                            <td>
                                @if($cliente->tipoDocumento->nombre == "REGISTRO ÚNICO DE CONTRIBUYENTES (RUC)")
                                    {{ Str::upper($cliente->nombre) }}
                                @else
                                    {{ Str::upper($cliente->apellido_paterno) }} {{ Str::upper($cliente->apellido_materno) }}, {{ Str::title($cliente->nombre) }}
                                @endif
                            </td>
                            <td>{{ $cliente->telefono }}</td>
                            <td  class="text-center">
                                <x-btn-edit route="dashboard.clientes.edit" :id="$cliente->id"/>
                                <x-modal-delete route="dashboard.clientes.destroy" title="Confirmar Eliminacion" :id="$cliente->id">
                                    ¿Estás seguro de eliminar el cliente <strong>{{ $cliente->nombre }}</strong>?
                                </x-modal-delete>
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-data-table>

        </div>       
    </div>
@stop