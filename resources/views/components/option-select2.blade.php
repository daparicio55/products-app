@props(['name','label','value'=>''])
<label for="{{ $name }}">{{ $label }}</label>
<select name="{{ $name }}" id="{{ $name }}" class="form-control">
    <option value="" selected disabled>Seleccione una opcion</option>
    {{ $slot }}
</select>
@error($name)
    <small class="text-danger">{{ $message }}</small>
@enderror
@push('scripts')
    <script>
        $(document).ready(function() {
            /* $('.js-example-basic-multiple').select2(); */
            $("#{{ $name }}").select2({
                theme: 'bootstrap4',
            });
        });
    </script>
    
@endpush