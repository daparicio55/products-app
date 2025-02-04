@extends('layouts.main')
@section('content')
    <!-- Page Heading -->
    <x-text-header label="Ventas"/>
    <x-btn-add-back route="dashboard.ventas.create" type="add"/>

    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de Ventas</h6>
        </div>

        <div class="card-body">

            <x-data-table id="dataTable">
                
                <x-slot name="thead">
                    <th>N°</th>
                    <th>Comprobante</th>
                    <th>M. Pago</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th style="width: 110px">Acciones</th>
                </x-slot>

                <x-slot name="tbody">
                    @foreach ($ventas as $venta)
                        <tr>
                            <td>{{ Str::padLeft($venta->numero,4,'0') }}</td>
                            <td>{{ $venta->tipoComprobante->nombre }}</td>
                            <td>{{ $venta->metodoPago->nombre }}</td>
                            <td>{{ date('d-m-Y',strtotime($venta->fecha)) }}</td>
                            <td>
                                @if($venta->cliente->tipo_documento_id == 2)
                                    {{ $venta->cliente->nombre }}
                                @else
                                    {{ Str::upper($venta->cliente->apellido_paterno) }} {{ Str::upper($venta->cliente->apellido_materno) }}, {{ Str::title($venta->cliente->nombre) }}
                                @endif
                            </td>
                            <td class="text-right">S/ {{ number_format($venta->total,2) }}</td>
                            <td>
                                <x-btn-show route="dashboard.ventas.show" :id="$venta->id"/>
                                <x-modal-delete :id="$venta->id" title="Confirmar eliminación" route="dashboard.ventas.destroy">
                                    ¿Esta seguro que desea eliminar esta venta? Este procedimiento es irreversible.
                                </x-modal-delete>
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-data-table>

        </div>       
    </div>
@stop