@extends('layouts.main')
@section('content')
    <!-- Page Heading -->
    <x-text-header label="Categorias"/>
    <x-btn-add-back route="dashboard.categorias.create" type="add"/>  

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de Categorias</h6>
        </div>

        <div class="card-body">
            <x-data-table id="dataTable">
                <x-slot name="thead">
                    <th>ID</th>
                    <th>Nombre</th>
                    <th style="width: 220px">Acciones</th>
                </x-slot>
                <x-slot name="tbody">
                    @foreach ($categorias as $categoria)
                        <tr>
                            <td>{{ $categoria->id }}</td>
                            <td>{{ $categoria->nombre }}</td>
                            <td  class="text-center">
                                <x-btn-edit route="dashboard.categorias.edit" :id="$categoria->id" text="Editar"/>
                                <x-modal-delete route="dashboard.categorias.destroy" title="Confirmar Eliminacion" :id="$categoria->id" btntext="Eliminar">
                                    ¿Estás seguro de eliminar la categoria <strong>{{ $categoria->nombre }}</strong>?
                                </x-modal-delete>
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-data-table>

        </div>       
    </div>
@stop