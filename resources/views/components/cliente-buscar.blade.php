@props([
    'buscar' => null,
    'cliente' => null,
    'btnSave' => null
])
{{-- obtenemos los tipos de documentos --}}
@php
    $tipoDocumentos = \App\Models\Dashboard\TipoDocumento::get();
@endphp

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Consultar Documento</h6>
    </div>

    <div class="card-body">

        <div class="row">
            <div class="col-sm-12 col-md-6">
                <x-option-select2 name="tipo_documento" label="Tipo Documento">
                    @foreach ($tipoDocumentos as $tipoDocumento)
                        <option value="{{ $tipoDocumento->id }}" @if (old('tipo_documento',$cliente->tipo_documento_id ?? null) == $tipoDocumento->id) selected @endif>
                            {{ $tipoDocumento->nombre }}
                        </option>
                    @endforeach
                </x-option-select2>
            </div>
            <div class="col-sm-12 col-md-6">
                <x-input-text label="Número Documento" name="numero_documento" :value="$cliente->numero_documento ?? null" />
            </div>
        </div>

    </div>
    <div class="card-footer d-flex justify-content-end">
        <button class="btn btn-primary" type="button" id="btn_buscar">
            <i class="fas fa-search"></i> Buscar
        </button>
    </div>
</div>

<div class="card shadow md-4">

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Datos del Cliente</h6>
    </div>

    <div class="card-body">
        <input type="hidden" name="cliente_id" id="cliente_id" value="{{ old('cliente_id',$cliente->id ?? null) }}">
        <div class="row">

            <div class="col-sm-12">
                <x-input-text label="Nombre / Razon Social" name="nombre" :value="$cliente->nombre ?? null" />
            </div>

            <div class="col-sm-12 col-md-6 mt-2">
                <x-input-text label="Apellido Paterno" name="apellido_paterno" :value="$cliente->apellido_paterno ?? null" />
            </div>

            <div class="col-sm-12 col-md-6 mt-2">
                <x-input-text label="Apellido Materno" name="apellido_materno" :value="$cliente->apellido_materno ?? null" />
            </div>

            <div class="col-sm-12 mt-2">
                <x-input-text label="Dirección" name="direccion" :value="$cliente->direccion ?? null"/>
            </div>

            <div class="col-sm-12 col-md-6 mt-2">
                <x-input-text label="Teléfono" name="telefono" :value="$cliente->telefono ?? null" />
            </div>

            <div class="col-sm-12 col-md-6 mt-2">
                <x-input-text label="Email" name="email" :value="$cliente->email ?? null" />
            </div>

        </div>

    </div>
    @if($btnSave)
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Guardar
            </button>
        </div>
    @endif
</div>

@push('scripts')
    <script>
        // a la espera del click del boton buscar
        document.getElementById('btn_buscar').addEventListener('click', function() {
            console.log('click');
            let numero = document.getElementById('numero_documento').value;
            let tipo = document.getElementById('tipo_documento').value;
            let url = getData(tipo, numero);

        });

        function validarDocumento(numero, tipo) {
            // comprobacion que los campos no esten vacios            
            if (numero && tipo) {
                return true;
            } else {
                alert('Debe ingresar el número de documento y seleccionar el tipo de documento');
                return false;
            }
        }

        function getUrl(tipo, numero) {
            let baseUrl = `{{ asset('') }}`;
            let url = `${baseUrl}dashboard/clientes/${numero}/numero/${tipo}/tipo`;
            return url;
        }

        function getData(tipo, numero) {
            let url = getUrl(tipo, numero);
            console.log(url);
            if (!validarDocumento(numero, tipo)) {
                return;
            }
            showOverlay();
            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data);
                    // Aquí puedes usar los datos como necesites
                    document.getElementById('cliente_id').value = data.cliente_id;
                    document.getElementById('nombre').value = data.nombre;
                    document.getElementById('apellido_paterno').value = data.apellido_paterno;
                    document.getElementById('apellido_materno').value = data.apellido_materno;
                    document.getElementById('telefono').value = data.telefono;
                    document.getElementById('email').value = data.email;
                    document.getElementById('direccion').value = data.direccion;
                })
                .catch(error => {
                    console.error('Error fetching JSON:', error);
                }).finally(() => {
                    hideOverlay();
                });
        }
    </script>
@endpush
