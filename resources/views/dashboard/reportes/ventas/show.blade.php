@extends('layouts.main')
@section('content')
    <!-- Page Heading -->
    <x-text-header label="Reportes de Ventas" />
    <x-btn-add-back route="dashboard.reportes.ventas.index" type="back" />


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
                    <th>Vendidos</th>
                    <th>Ordenado</th>
                </x-slot>
                <x-slot name="tbody">
                    @foreach ($datos as $catalogos)
                        @foreach ($catalogos as $catalogo)
                            @if ($catalogo['cantidad_ventas'] != 0)
                                <tr>
                                    <td>
                                        @if ($loop->first)
                                            <span class="badge badge-pill badge-primary">Superior</span>
                                        @else
                                            <span class="badge badge-pill badge-secondary">Inferior</span>
                                        @endif
                                    </td>
                                    <td>{{ $catalogo['codigo'] }}</td>
                                    <td>{{ $catalogo['nombre'] }}</td>
                                    <td>{{ $catalogo['descripcion'] }}</td>
                                    <td>{{ $catalogo['marca'] }}</td>
                                    <td>{{ $catalogo['medida'] }}</td>
                                    <td>{{ $catalogo['contiene'] }}</td>
                                    <td>{{ $catalogo['cantidad_ventas'] }}</td>
                                    <td>{{ $catalogo['cantidad_redondeado'] }}</td>
                                </tr>
                            @endif
                        @endforeach
                    @endforeach
                </x-slot>
            </x-data-table>
        </div>


    @stop
