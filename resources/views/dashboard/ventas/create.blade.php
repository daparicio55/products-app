@extends('layouts.main')
@section('content')

    <x-text-header label="Ventas (Nuevo)" />
    <x-btn-add-back route="dashboard.ventas.index" type="back" />

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('dashboard.ventas.store') }}" method="post">
        @csrf
        <x-cliente-buscar />

        <div class="card shadow mt-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Datos del la Venta</h6>
            </div>

            <div class="card-body">

                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <label for="tipo_comprobante_id">T. Comprobante</label>
                        <select name="tipo_comprobante_id" class="form-control">
                            @foreach ($comprobantes as $comprobante)
                                <option value="{{ $comprobante->id }}">{{ $comprobante->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-12 col-md-3">
                        <label for="metodo_pago_id">M. Pago</label>
                        <select name="metodo_pago_id" class="form-control">
                            @foreach ($pagos as $pago)
                                <option value="{{ $pago->id }}">{{ $pago->nombre }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-sm-12 col-md-3 ">
                        <x-input-date label="Fecha" name="fecha" today />
                    </div>

                    <div class="col-sm-12 col-md-3  d-flex justify-content-center align-items-end">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="checkigv" name="checkigv">
                            <label class="form-check-label" for="checkigv">
                                Calcular IGV.
                            </label>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <x-venta-productos :catalogos="$catalogos">

            <x-slot name="footer">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar venta
                    </button>
                </div>
            </x-slot>

        </x-venta-productos>
        
    </form>

@stop
