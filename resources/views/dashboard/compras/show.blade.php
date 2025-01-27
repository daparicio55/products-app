@extends('layouts.main')
@section('content')
    <!-- Page Heading -->
    <x-text-header label="Compras" />
    <x-btn-add-back route="dashboard.compras.index" type="back" />
    <form action="{{ route('dashboard.compras.store') }}" method="POST">
        @csrf
        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Mostrar Datos</h6>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <x-option-select2 name="proveedore_id" label="Seleccione un Proveedor" disabled="true">
                            <option selected>{{ $compra->proveedore->ruc }} - {{ $compra->proveedore->razon_social }}
                            </option>
                        </x-option-select2>
                    </div>

                    <div class="col-sm-12 col-md-4 mt-2">
                        <x-input-text label="Número" name="numero" :value="$compra->numero" />
                    </div>

                    <div class="col-sm-12 col-md-4 mt-2">
                        <x-input-date label="Fecha" name="fecha" :value="$compra->fecha" />
                    </div>

                    <div class="col-sm-12 col-md-4 mt-2 d-flex justify-content-center align-items-end">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="checkigv" name="checkigv"
                                @if ($compra->igv_status == 1) checked @endif>
                            <label class="form-check-label" for="gridCheck1">
                                Calcular IGV.
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row border-top mt-3">
                    <div class="col-sm-12 mt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Cant.</th>
                                    <th>Descripcion</th>
                                    <th>P. Unitario</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($compra->catalogos as $catalogo)
                                    <tr>
                                        <td>{{ $catalogo->pivot->cantidad }}</td>
                                        <td>{{ $catalogo->codigo }} - {{ $catalogo->nombre }} {{ $catalogo->descripcion }}
                                            - {{ $catalogo->marca->nombre }} x {{ $catalogo->medida->nombre }}</td>
                                        <td>{{ $catalogo->pivot->precio }}</td>
                                        @php
                                            $subtotal = number_format($catalogo->pivot->precio * $catalogo->pivot->cantidad,2);
                                        @endphp
                                        <td>{{ $subtotal }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-right pt-1 pb-1">SUB TOTAL</td>
                                    <td class="pt-1 pb-1" id="subtotal">{{ number_format($compra->subtotal,2) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right pt-1 pb-1">IGV</td>
                                    <td class="pt-1 pb-1" id="igv">{{ number_format($compra->igv,2) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right pt-1 pb-1">TOTAL</td>
                                    <td class="pt-1 pb-1" id="total">{{ number_format($compra->total,2) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </form>
@stop
