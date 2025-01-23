@extends('layouts.main')
@section('content')
    <!-- Page Heading -->
    <x-text-header label="Proveedores"/>
    <x-btn-add-back route="dashboard.proveedores.index" type="back"/>  
    <form action="{{ route('dashboard.proveedores.update',$proveedore->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Editar Datos</h6>
            </div>

            <div class="card-body">
                
                    <div class="row">
                        <div class="col-sm-12 col-md-3">
                            <x-input-text label="Nombre" name="ruc" :value="$proveedore->ruc"/>
                        </div>
                        <div class="col-sm-12 col-md-9">
                            <x-input-text label="Código" name="razon_social" :value="$proveedore->razon_social"/>
                        </div>
                        <div class="col-sm-12 mt-2">
                            <x-input-text label="Dirección" name="direccion" :value="$proveedore->direccion"/>
                        </div>
                    </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Actualizar
                </button>
            </div>
        </div>
    </form>

@stop