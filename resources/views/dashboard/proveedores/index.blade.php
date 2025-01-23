@extends('layouts.main')
@section('content')
    <!-- Page Heading -->
    <x-text-header label="Proveedores"/>
    <x-btn-add-back route="dashboard.proveedores.create" type="add"/>
    <p class="mb-4">
        Proveedores registrados en el sistema.
    </p>
    

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de Proveedores</h6>
        </div>

        <div class="card-body">
            <x-data-table id="dataTable">
                <x-slot name="thead">
                    <th>RUC</th>
                    <th>Razón Social</th>
                    <th style="width: 110px">Acciones</th>
                </x-slot>
                <x-slot name="tbody">
                    @foreach ($proveedores as $proveedore)
                    
                        <tr>
                            <td>{{ $proveedore->ruc }}</td>
                            <td>{{ $proveedore->razon_social }}</td>
                            <td  class="text-center">
                                <x-btn-edit route="dashboard.proveedores.edit" :id="$proveedore->id"/>
                                <x-modal-delete route="dashboard.proveedores.destroy" title="Confirmar Eliminacion" :id="$proveedore->id">
                                    ¿Estás seguro de eliminar la medida <strong>{{ $proveedore->razon_social }}</strong>?
                                </x-modal-delete>
                            </td>
                        </tr>

                    @endforeach
                </x-slot>
            </x-data-table>

        </div>       
    </div>
@stop