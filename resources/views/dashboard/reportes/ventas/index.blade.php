@extends('layouts.main')
@section('content')
    <!-- Page Heading -->
    <x-text-header label="Reportes de Ventas" />

    <div class="card shadow mb-4">
        <form action="{{ route('dashboard.reportes.ventas.show') }}" method="get">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Seleccione parámetros</h6>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <x-input-date label="Fecha Inicio" name="fecha_inicio" />
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <x-input-date label="Fecha Inicio" name="fecha_fin" />
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-eye mr-1"></i>Mostrar Reporte
                </button>
            </div>
        </form>
    </div>
@stop
