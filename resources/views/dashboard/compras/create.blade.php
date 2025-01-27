@extends('layouts.main')
@section('content')
    <!-- Page Heading -->
    <x-text-header label="Compras" />
    <x-btn-add-back route="dashboard.compras.index" type="back" />
    <form action="{{ route('dashboard.compras.store') }}" method="POST">
        @csrf
        <div class="card shadow mb-4">
            
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Registrar Datos</h6>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <x-option-select2 name="proveedore_id" label="Seleccione un Proveedor">
                            @foreach ($proveedores as $proveedore)
                                <option value="{{ $proveedore->id }}" @if(old('proveedore_id') == $proveedore->id) selected  @endif>{{ $proveedore->ruc }} - {{ $proveedore->razon_social }}</option>
                            @endforeach
                        </x-option-select2>
                    </div>

                    <div class="col-sm-12 col-md-4 mt-2">
                        <x-input-text label="Número" name="numero"/>
                    </div>

                    <div class="col-sm-12 col-md-4 mt-2">
                        <x-input-date label="Fecha" name="fecha"/>
                    </div>

                    <div class="col-sm-12 col-md-4 mt-2 d-flex justify-content-center align-items-end">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="checkigv" name="checkigv" checked>
                            <label class="form-check-label" for="gridCheck1">
                              Calcular IGV.
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row border-top mt-3">
                    <div class="col-sm-12">
                        <x-compra-productos :catalogos="$catalogos"/>
                    </div>
                </div>
            </div>

            <div class="card-footer d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Guardar
                </button>
            </div>
        </div>
    </form>
@stop
