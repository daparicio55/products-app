@extends('layouts.main')
@section('content')
    <!-- Page Heading -->
    <x-text-header label="Empresas"/>
    <x-btn-add-back route="administrador.empresas.create" type="add"/>  
    <x-alert/>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de Empresas Registradas en el sistema</h6>
        </div>
        <div class="card-body">
            <x-data-table id="dataTable">
                <x-slot name="thead">
                    <th>RUC</th>
                    <th>Razon Social</th>
                    <th>Correo</th>
                    <th></th>
                </x-slot>
                <x-slot name="tbody">
                    @foreach ($empresas as $empresa)
                        <tr>
                            <td>{{ $empresa->company_ruc }}</td>
                            <td>{{ $empresa->company_razon_social }}</td>
                            <td>{{ $empresa->company_email }}</td>
                            <td>
                                <x-btn-edit route="administrador.empresas.edit" :id="$empresa->id"/>
                                <x-modal-delete route="administrador.empresas.destroy" title="Confirmar Eliminacion" :id="$empresa->id">
                                    ¿Estás seguro de eliminar esta empresa <strong>{{ $empresa->razon_social }}</strong>?
                                </x-modal-delete>
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-data-table>
        </div>
    </div>
@stop