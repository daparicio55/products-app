@extends('layouts.main')
@section('content')
    <!-- Page Heading -->
    <x-text-header label="Métodos de Pagos"/>
    <x-btn-add-back route="dashboard.metodospagos.index" type="back"/>  
    <form action="{{ route('dashboard.metodospagos.update',$metodopago->id) }}" method="post">
        @csrf
        @method('PUT') 
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Registrar Datos</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <x-input-text label="Nombre" name="nombre" :value="$metodopago->nombre" />
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