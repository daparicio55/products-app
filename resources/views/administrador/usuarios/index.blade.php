@extends('layouts.main')
@section('content')
    <!-- Page Heading -->
    <x-text-header label="Usuarios del Sistema"/>
    <x-btn-add-back route="administrador.users.create" type="add"/>  
    <x-alert/>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de Usuarios registrados en el sistema</h6>
        </div>
        <div class="card-body">
            <x-data-table id="dataTable">
                <x-slot name="thead">
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Empresa</th>
                    <th>Local</th>
                    <th></th>
                </x-slot>
                <x-slot name="tbody">
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->locale->empresa->company_razon_social }}</td>
                            <td>{{ $user->locale->codigo }} - {{ $user->locale->nombre }}</td>
                            <td>
                                <x-btn-edit route="administrador.users.edit" :id="$user->id"/>
                                <x-modal-delete route="administrador.users.destroy" title="Confirmar Eliminacion" :id="$user->id">
                                    ¿Estás seguro de eliminar este usuario <strong>{{ $user->name }}</strong>?
                                </x-modal-delete>
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-data-table>
        </div>
    </div>
@stop