@extends('layouts.main')
@section('content')
    <!-- Page Heading -->
    <x-text-header label="Métodos de Pagos"/>
    <x-btn-add-back route="dashboard.metodospagos.create" type="add"/>  

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de Métodos de Pagos</h6>
        </div>

        <div class="card-body">
            <x-data-table id="dataTable">
                <x-slot name="thead">
                    <th>ID</th>
                    <th>Nombre</th>
                    <th style="width: 220px">Acciones</th>
                </x-slot>
                <x-slot name="tbody">
                    @foreach ($metodospagos as $metodospago)
                        <tr>
                            <td>{{ $metodospago->id }}</td>
                            <td>{{ $metodospago->nombre }}</td>
                            <td  class="text-center">
                                <x-btn-edit route="dashboard.metodospagos.edit" :id="$metodospago->id" text="Editar"/>
                                <x-modal-delete route="dashboard.metodospagos.destroy" title="Confirmar Eliminacion" :id="$metodospago->id" btntext="Eliminar">
                                    ¿Estás seguro de eliminar este método de pago <strong>{{ $metodospago->nombre }}</strong>?
                                </x-modal-delete>
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-data-table>

        </div>       
    </div>
@stop