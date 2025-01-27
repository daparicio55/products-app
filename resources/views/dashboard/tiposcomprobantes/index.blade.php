@extends('layouts.main')
@section('content')
    <!-- Page Heading -->
    <x-text-header label="Típos de Comprobantes"/>
    <x-btn-add-back route="dashboard.tiposcomprobantes.create" type="add"/>  

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de Tipos de Comprobantes</h6>
        </div>

        <div class="card-body">
            <x-data-table id="dataTable">
                <x-slot name="thead">
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Código</th>
                    <th style="width: 220px">Acciones</th>
                </x-slot>
                <x-slot name="tbody">
                    @foreach ($tiposcomprobantes as $tiposcomprobante)
                        <tr>
                            <td>{{ $tiposcomprobante->id }}</td>
                            <td>{{ $tiposcomprobante->nombre }}</td>
                            <td>{{ $tiposcomprobante->codigo }}</td>
                            <td  class="text-center">
                                <x-btn-edit route="dashboard.tiposcomprobantes.edit" :id="$tiposcomprobante->id" text="Editar"/>
                                <x-modal-delete route="dashboard.tiposcomprobantes.destroy" title="Confirmar Eliminacion" :id="$tiposcomprobante->id" btntext="Eliminar">
                                    ¿Estás seguro de eliminar este comprobante <strong>{{ $tiposcomprobante->nombre }}</strong>?
                                </x-modal-delete>
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-data-table>

        </div>       
    </div>
@stop