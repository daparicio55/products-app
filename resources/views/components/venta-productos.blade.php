@props(['catalogos'])

<div class="card shadow mt-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Registrar Productos</h6>
    </div>

    <div class="card-body">
        <div class="row mt-3">
            <div class="col-sm-12 col-md-8">
                <label for="catalogos">Catalogos</label>
                <select id="catalogos" class="form-control">
                    <option value="" selected disabled>Seleccione un Catalogo</option>
                </select>
            </div>
        
            <div class="col-sm-12 col-md-2">
                <label for="precio">Precio</label>
                <input type="text" id="precio" class="form-control" value="0.00">
            </div>
        
            <div class="col-sm-12 col-md-2">
                <label for="">Cant</label>
                <input type="text" id="cantidad" class="form-control" value="1">
            </div>
        
            <div class="col-sm-12 d-flex justify-content-end">
                <button type="button" class="btn btn-primary mt-2" id="add-producto">
                    <i class="fas fa-plus"></i> Agregar
                </button>
            </div>
        
            <div class="col-sm-12 mt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Cant.</th>
                            <th>Descripcion</th>
                            <th>P. Unitario</th>
                            <th>Sub Total</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody id="detalles">
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-right pt-1 pb-1">SUB TOTAL</td>
                            <td class="pt-1 pb-1" id="subtotal">0.00</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right pt-1 pb-1">IGV</td>
                            <td class="pt-1 pb-1" id="igv">0.00</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right pt-1 pb-1">TOTAL</td>
                            <td class="pt-1 pb-1" id="total">0.00</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
        </div>
    </div>
    @if(isset($footer))
        <div class="card-footer">
            {{ $footer }}
        </div>
    @endif
</div>
@push('scripts')
    <script>
        
        let catalogos = @json($catalogos);

        fillCatalogos(catalogos);

        $(document).ready(function() {           

            $('#catalogos').select2({
                theme: 'bootstrap4',
            });
            $('#checkigv').change(function(){
                calcularIgv();
            });
            //cuando hacemos click en el boton agregar
            $('#add-producto').click(function() {
                //obtenemos los valores de los inputs
                let catalogo_id = $('#catalogos').val();
                let catalogo_text = $('#catalogos option:selected').text();
                let precio = $('#precio').val();
                let cantidad = $('#cantidad').val();

                //validamos que los campos no esten vacios
                if (catalogo_id != null && precio != 0 && cantidad != '') {
                    //agregamos los valores a la tabla
                    $row = $('#row' + catalogo_id);
                    if ($row.length>0) {
                        let cantidad_actual = $row.find('td').eq(0).text();
                        let cantidad_nueva = parseInt(cantidad_actual) + parseInt(cantidad);
                        $row.find('td').eq(0).text(cantidad_nueva);
                        $row.find('td').eq(3).text((precio * cantidad_nueva).toFixed(2));
                        $row.find('input').eq(0).val(cantidad_nueva);
                    }else{                   
                        $('#detalles').append(`
                        <tr class="text-center" id="row${catalogo_id}">
                            <td>${cantidad}</td>
                            <td>${catalogo_text}</td>
                            <td>${precio}</td>
                            <td>${(precio * cantidad).toFixed(2)}</td>
                            <td>
                                <input type="hidden" id="cantidad${catalogo_id}" name="cantidades[]" value="${cantidad}">
                                <input type="hidden" id="catalogo${catalogo_id}" name="catalogos[]" value="${catalogo_id}">
                                <input type="hidden" id="precio${catalogo_id}" name="precios[]" value="${precio}">
                                <button type="button" class="btn btn-danger btn-sm" onclick="rowdelete(${catalogo_id})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>`);
                    }
                    //calculamos el subtotal
                    setTotales();
                } else {
                    alert('Complete los campos');
                }
            });
        });

        //cuando seleccionamos un catalogo
        $('#catalogos').change(function(){
            let row = catalogos[$(this).val()];
            $('#precio').val(row.precio);
        });

        function rowdelete(id) {
            //eliminamos la fila
            $('#row' + id).remove();
            setTotales();
        }

        function setTotales() {
            //calculamos el subtotal
            let subtotal = 0;
            $('#detalles tr').each(function() {
                subtotal += parseFloat($(this).find('td').eq(3).text());
            });
            //calculamos el igv
            let igv = 0;
            //calculamos el total
            let total = subtotal + igv;
            //mostramos los valores en la tabla
            $('#subtotal').text(subtotal.toFixed(2));
            $('#igv').text(igv.toFixed(2));
            $('#total').text(total.toFixed(2));
            calcularIgv();
        }
        function calcularIgv(){
            let checkigv = $('#checkigv').is(':checked');
            if (checkigv) {
                let subtotal = parseFloat($('#subtotal').text());
                let igv = subtotal * 0.18;
                let total = subtotal + igv;
                $('#igv').text(igv.toFixed(2));
                $('#total').text(total.toFixed(2));
            }else{
                let subtotal = parseFloat($('#subtotal').text());
                let igv = 0;
                let total = subtotal + igv;
                $('#igv').text(igv.toFixed(2));
                $('#total').text(total.toFixed(2));
            }
        }
        function fillCatalogos(catalogos) {
            Object.entries(catalogos).forEach(([key, value]) => {
                $('#catalogos').append(`
                    <option value="${key}">
                        ${value.nombre}
                    </option>
                `);
            });
        }
        
    </script>
@endpush
