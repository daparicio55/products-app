@extends('layouts.main')
@section('content')
    
    <x-text-header label="Empresas (Nuevo)" />
    <x-btn-add-back route="administrador.empresas.index" type="back" />
    <form action="{{ route('administrador.empresas.store') }}" method="POST">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Registrar Datos</h6>
            </div>

            <div class="card-body">
                <div class="row g-4">
                    <div class="col-sm-12 col-md-4 mt-3">
                        <x-input-text label="Correo" name="company_email" />
                    </div>

                    <div class="col-sm-12 col-md-4 mt-3">
                        <x-input-password label="Contraseña" name="company_password" />
                    </div>

                    <div class="col-sm-12 col-md-4 mt-3">
                        <x-input-password label="Repetir Contraseña" name="company_password_confirmation" />
                    </div>

                    <div class="col-sm-12 mt-3">
                        <x-input-group label="RUC" name="company_ruc" button_text="Buscar" />
                    </div>

                    <div class="col-sm-12 col-md-6 mt-3">
                        <x-input-text label="Razón Social" name="company_razon_social" />
                    </div>

                    <div class="col-sm-12 col-md-6 mt-3">
                        <x-input-text label="Nombre Comercial" name="company_nombre_comercial"  />
                    </div>

                    <div class="col-sm-12 col-md-3 mt-3">
                        <x-input-text label="Provincia" name="company_departamento" />
                    </div>

                    <div class="col-sm-12 col-md-3 mt-3">
                        <x-input-text label="Departamento" name="company_provincia" />
                    </div>

                    <div class="col-sm-12 col-md-3 mt-3">
                        <x-input-text label="Distrito" name="company_distrito" />
                    </div>

                    <div class="col-sm-12 col-md-3 mt-3">
                        <x-input-text label="Urbanización" name="company_urbanizacion" />
                    </div>

                    <div class="col-sm-12 col-md-8 mt-3">
                        <x-input-text label="Dirección" name="company_direccion" />
                    </div>

                    <div class="col-sm-12 col-md-4 mt-3">
                        <x-input-text label="Ubigeo" name="company_ubigeo" />
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

@push('scripts')
    <script>
        const button = document.getElementById('button-company_ruc');
        button.addEventListener('click', () => {
            if (validate()) {
                let ruc = document.getElementById('company_ruc').value;
                console.log(ruc);
                getData(2, ruc);
            }
        });
        function validate(){
            let ruc = document.getElementById('company_ruc').value;
            if (ruc.length != 11) {
                alert('El RUC debe tener 11 dígitos');
                return false;
            }
            return true;
        }
        function getUrl(tipo, numero) {
            let baseUrl = `{{ asset('') }}`;
            let url = `${baseUrl}dashboard/clientes/${numero}/numero/${tipo}/tipo`;
            return url;
        }
        function getData(tipo, numero) {
            let url = getUrl(tipo, numero);
            console.log(url);
            showOverlay();
            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    // Aquí puedes usar los datos como necesites
                    console.log(data);
                    document.getElementById('company_razon_social').value = data.nombre;
                    document.getElementById('company_nombre_comercial').value = data.nombre_comercial;
                    document.getElementById('company_departamento').value = data.departamento;
                    document.getElementById('company_provincia').value = data.provincia;
                    document.getElementById('company_distrito').value = data.distrito;
                    document.getElementById('company_direccion').value = data.direccion;
                })
                .catch(error => {
                    console.error('Error fetching JSON:', error);
                }).finally(() => {
                    hideOverlay();
                });
        }
    </script>
@endpush