@extends('layouts.main')
@section('content')
    <!-- Page Heading -->
    <x-text-header label="Marcas"/>
    <x-btn-add-back route="dashboard.marcas.create" type="add"/>  

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de Marcas</h6>
        </div>

        <div class="card-body">
            <x-data-table id="dataTable">
                <x-slot name="thead">
                    <th>ID</th>
                    <th>Nombre</th>
                    <th style="width: 220px">Acciones</th>
                </x-slot>
                <x-slot name="tbody">
                    @foreach ($marcas as $marca)
                        <tr>
                            <td>{{ $marca->id }}</td>
                            <td>{{ $marca->nombre }}</td>
                            <td  class="text-center">
                                <x-btn-edit route="dashboard.marcas.edit" :id="$marca->id" text="Editar"/>
                                <x-modal-delete route="dashboard.marcas.destroy" title="Confirmar Eliminacion" :id="$marca->id" btntext="Eliminar">
                                    ¿Estás seguro de eliminar la marca <strong>{{ $marca->nombre }}</strong>?
                                </x-modal-delete>
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-data-table>

        </div>       
    </div>
@stop