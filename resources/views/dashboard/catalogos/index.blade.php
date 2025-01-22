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
                    <th></th>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Marca</th>
                    <th>Unidad</th>
                    <th>Contiene</th>
                    <th>Precio</th>
                    <th style="width: 110px">Acciones</th>
                </x-slot>
                <x-slot name="tbody">
                    @foreach ($catalogos as $catalogo)
                        <tr>
                            <th>
                                <span class="badge badge-pill badge-primary">Superior</span>
                            </th>
                            <td>{{ $catalogo->codigo }}</td>
                            <td>{{ $catalogo->nombre }}</td>
                            <td>{{ $catalogo->descripcion }}</td>
                            <td>{{ $catalogo->marca->nombre }}</td>
                            <td>{{ $catalogo->medida->nombre }}</td>
                            <td class="text-right">{{ number_format($catalogo->contiene,2) }}</td>
                            <td class="text-right">{{ number_format($catalogo->precio,2) }}</td>
                            <td  class="text-center">
                                <x-btn-edit route="dashboard.catalogos.edit" :id="$catalogo->id"/>
                                <x-modal-delete route="dashboard.catalogos.destroy" title="Confirmar Eliminacion" :id="$catalogo->id">
                                    ¿Estás seguro de eliminar la medida <strong>{{ $catalogo->nombre }}</strong>?
                                </x-modal-delete>
                            </td>
                        </tr>
                        @php
                            $cat = $catalogo;
                        @endphp
                        @while (isset($cat->inferior->id))
                            <tr>
                                <th>
                                    <span class="badge badge-pill badge-secondary">Inferior</span>
                                </th>
                                <td>{{ $cat->inferior->codigo }}</td>
                                <td>{{ $cat->inferior->nombre }}</td>
                                <td>{{ $cat->inferior->descripcion }}</td>
                                <td>{{ $cat->inferior->marca->nombre }}</td>
                                <td>{{ $cat->inferior->medida->nombre }}</td>
                                <td class="text-right">{{ number_format($cat->inferior->contiene,2) }}</td>
                                <td class="text-right">{{ number_format($cat->inferior->precio,2) }}</td>
                                <td  class="text-center">
                                    <x-btn-edit route="dashboard.catalogos.edit" :id="$cat->inferior->id"/>
                                    <x-modal-delete route="dashboard.catalogos.destroy" title="Confirmar Eliminacion" :id="$cat->inferior->id">
                                        ¿Estás seguro de eliminar la medida <strong>{{ $cat->inferior->nombre }}</strong>?
                                    </x-modal-delete>
                                </td>
                            </tr>
                            @php
                                $cat = $cat->inferior;    
                            @endphp
                        @endwhile

                    @endforeach
                </x-slot>
            </x-data-table>

        </div>       
    </div>
@stop