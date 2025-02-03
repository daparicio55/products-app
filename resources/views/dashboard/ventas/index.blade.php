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

                </x-slot>
            </x-data-table>

        </div>       
    </div>
@stop