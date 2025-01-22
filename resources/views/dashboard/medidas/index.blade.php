@extends('layouts.main')
@section('content')
    <!-- Page Heading -->
    <x-text-header label="Medidas"/>
    <x-btn-add-back route="dashboard.medidas.create" type="add"/>
    <p class="mb-4">
        Recuerda que las medidas están codificadas según los estándares establecidos por la SUNAT.
    </p>
    

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de Medidas</h6>
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
                    @foreach ($medidas as $medida)
                        <tr>
                            <td>{{ $medida->id }}</td>
                            <td>{{ $medida->nombre }}</td>
                            <td>{{ $medida->codigo }}</td>
                            <td  class="text-center">
                                <x-btn-edit route="dashboard.medidas.edit" :id="$medida->id" text="Editar"/>
                                <x-modal-delete route="dashboard.medidas.destroy" title="Confirmar Eliminacion" :id="$medida->id" btntext="Eliminar">
                                    ¿Estás seguro de eliminar la medida <strong>{{ $medida->nombre }}</strong>?
                                </x-modal-delete>
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-data-table>

        </div>       
    </div>
@stop