@extends('layouts.main')
@section('content')
    <!-- Page Heading -->
    <x-text-header label="Catálogos"/>
    <x-btn-add-back route="dashboard.catalogos.create" type="add"/>
    <p class="mb-4">
        Catálogos registrados en el sistema.
    </p>
    

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de Catálogos</h6>
        </div>

        <div class="card-body">
            <x-data-table id="dataTable">
                <x-slot name="thead">
                    <th>ID</th>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th style="width: 220px">Acciones</th>
                </x-slot>
                <x-slot name="tbody">
                    @foreach ($catalogos as $catalogo)
                        <tr>
                            <td>{{ $catalogo->id }}</td>
                            <td>{{ $catalogo->codigo }}</td>
                            <td>{{ $catalogo->nombre }}</td>
                            <td  class="text-center">
                                <x-btn-edit route="dashboard.catalogos.edit" :id="$catalogo->id" text="Editar"/>
                                <x-modal-delete route="dashboard.catalogos.destroy" title="Confirmar Eliminacion" :id="$catalogo->id" btntext="Eliminar">
                                    ¿Estás seguro de eliminar la medida <strong>{{ $catalogo->nombre }}</strong>?
                                </x-modal-delete>
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-data-table>

        </div>       
    </div>
@stop