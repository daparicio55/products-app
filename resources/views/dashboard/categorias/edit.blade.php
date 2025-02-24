@extends('layouts.main')
@section('content')
    <!-- Page Heading -->
    <x-text-header label="Categorias"/>
    <x-btn-add-back route="dashboard.categorias.index" type="back"/>  
    <form action="{{ route('dashboard.categorias.update',$categoria->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Editar Datos</h6>
            </div>

            <div class="card-body">
                
                    <div class="row">
                        <div class="col-sm-12">
                            <x-input-text label="Nombre" name="nombre" :value="$categoria->nombre"/>
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