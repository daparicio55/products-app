@extends('layouts.main')
@section('content')
    <!-- Page Heading -->
    <x-text-header label="Típos de Comprobantes"/>
    <x-btn-add-back route="dashboard.tiposcomprobantes.index" type="back"/>  

    <form action="{{ route('dashboard.tiposcomprobantes.store') }}" method="POST">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Registrar Datos</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <x-input-text label="Nombre" name="nombre" />
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <x-input-text label="Código" name="codigo" />
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Guardar
                </button>
            </div>
        </div>
    </form>
@stop