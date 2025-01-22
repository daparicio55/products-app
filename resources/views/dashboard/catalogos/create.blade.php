@extends('layouts.main')
@section('content')
    <!-- Page Heading -->
    <x-text-header label="Catálogos"/>
    <x-btn-add-back route="dashboard.catalogos.index" type="back"/>  
    <form action="{{ route('dashboard.catalogos.store') }}" method="POST" id="frm">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Registrar Datos</h6>
            </div>

            <div class="card-body">
                
                    <div class="row">

                        <div class="col-sm-12 col-md-3">
                            <x-input-text label="Código" name="codigo"/>
                        </div>

                        <div class="col-sm-12 col-md-5">
                            <x-input-text label="Nombre" name="nombre"/>
                        </div>
                        
                        <div class="col-sm-12 col-md-2">
                            <x-input-text label="Precio" name="precio"/>
                        </div>

                        <div class="col-sm-12 col-md-2">
                            <x-input-text label="Contiene" name="contiene"/>
                        </div>

                        <div class="col-sm-12 mt-2">
                            <x-text-area label="Descripcion" name="descripcion"></x-text-area>
                        </div>

                        <div class="col-sm-12 col-md-4 mt-2">

                            <x-option-select2 name="marca_id" label="Marca">
                                @foreach ($marcas as $marca)
                                    <option value="{{ $marca->id }}" @if(old('marca_id') == $marca->id) selected  @endif>{{ $marca->nombre }}</option>
                                @endforeach
                            </x-option-select2>

                        </div>

                        <div class="col-sm-12 col-md-4 mt-2">

                            <x-option-select2 name="categoria_id" label="Categoria">
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" @if(old('categoria_id') == $categoria->id) selected  @endif>{{ $categoria->nombre }}</option>
                                @endforeach
                            </x-option-select2>

                        </div>

                        <div class="col-sm-12 col-md-4 mt-2">

                            <x-option-select2 name="medida_id" label="U. Medida">
                                @foreach ($medidas as $medida)
                                    <option value="{{ $medida->id }}" @if(old('medida_id') == $medida->id) selected  @endif>{{ $medida->nombre }}</option>
                                @endforeach
                            </x-option-select2>

                        </div>

                        <div class="col-sm-12 mt-2">
                            <x-option-select2 name="catalogo_id" label="Catalogo Padre o Superior">
                                @foreach ($catalogos as $catalogo)
                                    <option value="{{ $catalogo->id }}" @if(old('catalogo_id') == $catalogo->id) selected  @endif>
                                        {{ $catalogo->codigo }} - {{ $catalogo->nombre }} {{ $catalogo->descripcion }} MARCA:  {{ $catalogo->marca->nombre }} CATEGORIA: {{ $catalogo->categoria->nombre }} x {{ $catalogo->medida->nombre }} ({{ $catalogo->contiene }}) Precio: {{ $catalogo->precio }}
                                    </option>
                                @endforeach
                            </x-option-select2>
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