@extends('layouts.main')
@section('content')
    <!-- Page Heading -->
    <x-text-header label="Local Comerciales"/>
    <x-btn-add-back route="administrador.locales.create" type="add"/>  
    <x-alert/>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de locales comerciales registradas en el sistema</h6>
        </div>
        <div class="card-body">
            <x-data-table id="dataTable">
                <x-slot name="thead">
                    <th>Empresa</th>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Serie</th>
                    <th></th>
                </x-slot>
                <x-slot name="tbody">
                    @foreach ($locales as $locale)
                        <tr>
                            <td>{{ $locale->empresa->company_razon_social }}</td>
                            <td>{{ $locale->codigo }}</td>
                            <td>{{ $locale->nombre }}</td>
                            <td>{{ $locale->telefono }}</td>
                            <td>{{ $locale->direccion }}</td>
                            <td>{{ $locale->serie }}</td>
                            <td>
                                <x-btn-edit route="administrador.locales.edit" :id="$locale->id"/>
                                <x-modal-delete route="administrador.locales.destroy" title="Confirmar Eliminacion" :id="$locale->id">
                                    ¿Estás seguro de eliminar este local <strong>{{ $locale->nombre }}</strong>?
                                </x-modal-delete>
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-data-table>
        </div>
    </div>
@stop