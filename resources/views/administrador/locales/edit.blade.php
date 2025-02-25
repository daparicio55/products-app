@extends('layouts.main')
@section('content')
    <x-text-header label="Locales Comerciales (Editar)" />
    <x-btn-add-back route="administrador.locales.index" type="back" />
    <form action="{{ route('administrador.locales.update',$locale->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Registrar Datos</h6>
            </div>
            <div class="card-body">
                <div class="row g-4">

                    <div class="col-sm-12 col-md-4 mt-2">
                        <x-input-text label="Codigo" name="codigo" :value="$locale->codigo" />
                    </div>

                    <div class="col-sm-12 col-md-8 mt-2">
                        <x-input-text label="Nombre" name="nombre" :value="$locale->nombre"/>
                    </div>

                    <div class="col-sm-12 col-md-2 mt-2">
                        <x-input-text label="serie" name="serie" :value="$locale->serie"/>
                    </div>

                    <div class="col-sm-12 col-md-2 mt-2">
                        <x-input-text label="Teléfono" name="telefono" :value="$locale->telefono"/>
                    </div>

                    <div class="col-sm-12 col-md-8 mt-2">
                        <x-input-text label="Direccion" name="direccion" :value="$locale->direccion"/>
                    </div>

                    <div class="col-sm-12 mt-2">
                        <x-option-select2 name="empresa_id" label="Empresa" >
                            @foreach ($empresas as $empresa)
                                <option value="{{ $empresa->id }}" @if(old('empresa_id') == $empresa->id) selected @else @if($locale->empresa_id == $empresa->id) selected @endif @endif >{{ $empresa->company_razon_social }}</option>
                            @endforeach
                        </x-option-select2>
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