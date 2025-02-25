@extends('layouts.main')
@section('content')
    <x-text-header label="Usuario del Sistema (Nuevo)" />
    <x-btn-add-back route="administrador.users.index" type="back" />
    <form action="{{ route('administrador.users.store') }}" method="POST">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Registrar Datos</h6>
            </div>
            <div class="card-body">
                <div class="row g-4">

                    <div class="col-sm-12 col-md-6 mt-2">
                        <x-input-text label="Nombre" name="name" />
                    </div>
                    
                    <div class="col-sm-12 col-md-6 mt-2">
                        <x-input-text label="Email" name="email" />
                    </div>

                    <div class="col-sm-12 col-md-6 mt-3">
                        <x-input-password label="Contraseña" name="password" />
                    </div>

                    <div class="col-sm-12 col-md-6 mt-3">
                        <x-input-password label="Repetir Contraseña" name="password_confirmation" />
                    </div>

                    <div class="col-sm-12 mt-3">
                        <x-option-select2 name="locale_id" label="Local Comercial" >
                            @foreach ($locales as $locale)
                                <option value="{{ $locale->id }}" @if(old('locale_id') == $locale->id) selected  @endif >{{ $locale->empresa->company_razon_social }} - {{ $locale->codigo }} - {{ $locale->nombre }}</option>
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