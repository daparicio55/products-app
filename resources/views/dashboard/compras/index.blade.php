@extends('layouts.main')
@section('content')
    <!-- Page Heading -->
    <x-text-header label="Compras" />
    <x-btn-add-back route="dashboard.compras.create" type="add" />

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de Compras</h6>
        </div>

        <div class="card-body">

            <x-data-table id="dataTable">
                <x-slot name="thead">
                    <th>Proveedor</th>
                    <th>Numero</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th style="width: 120px">Acciones</th>
                </x-slot>
                <x-slot name="tbody">
                    @foreach ($compras as $compra)
                        <tr>
                            <td>{{ $compra->proveedore->razon_social }}</td>
                            <td>{{ $compra->numero }}</td>
                            <td>{{ date('d-m-Y', strtotime($compra->fecha)) }}</td>
                            <td>{{ $compra->total }}</td>
                            <td>
                                <x-btn-show route="dashboard.compras.show" :id="$compra->id" />
                                <x-btn-edit route="dashboard.compras.show" :id="$compra->id" />
                                <x-modal-delete route="dashboard.compras.destroy" title="Confirmar Eliminacion"
                                    :id="$compra->id">
                                    ¿Estás seguro de eliminar la categoria <strong>{{ $compra->numero }} {{ $compra->proveedore->razon_social }}</strong>?
                                </x-modal-delete>
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-data-table>

        </div>
    </div>
@stop
