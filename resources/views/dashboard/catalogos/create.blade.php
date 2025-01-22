@extends('layouts.main')
@section('content')
    <!-- Page Heading -->
    <x-text-header label="Catálogos"/>
    <x-btn-add-back route="dashboard.catalogos.index" type="back"/>  
    <form action="{{ route('dashboard.catalogos.store') }}" method="POST">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Registrar Datos</h6>
            </div>

            <div class="card-body">
                
                    <div class="row">

                        <div class="col-sm-12 col-md-5">
                            <x-input-text label="Código" name="codigo"/>
                        </div>

                        <div class="col-sm-12 col-md-5">
                            <x-input-text label="Nombre" name="nombre"/>
                        </div>
                        
                        <div class="col-sm-12 col-md-2">
                            <x-input-text label="Contiene" name="contiene"/>
                        </div>

                        <div class="col-sm-12 mt-2">
                            <x-text-area label="Descripcion" name="descripcion"></x-text-area>
                        </div>

                        <div class="col-sm-12 col-md-4">
                            
                        </div>

                        <div class="col-sm-12 col-md-4">

                        </div>

                        <div class="col-sm-12 col-md-4">

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