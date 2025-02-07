@extends('layouts.main')
@section('content')
    <!-- Page Heading -->
    <x-text-header label="Típos de Comprobantes"/>
    <x-btn-add-back route="dashboard.tiposcomprobantes.index" type="back"/>  

    <form action="{{ route('dashboard.tiposcomprobantes.update',$tipocomprobante->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Editar Datos</h6>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-sm-12 col-md-6">
                        <x-input-text label="Nombre" name="nombre" :value="$tipocomprobante->nombre"/>
                    </div>

                    <div class="col-sm-12 col-md-4">
                        <x-input-text label="Código" name="codigo" :value="$tipocomprobante->codigo"/>
                    </div>

                    <div class="col-sm-12 col-md-2">
                        <x-input-text label="letra" name="letra" :value="$tipocomprobante->letra" />
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