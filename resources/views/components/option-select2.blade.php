@props(['name','label','value'=>'','disabled'=>'false'])
<label for="{{ $name }}">{{ $label }}</label>
<select name="{{ $name }}" id="{{ $name }}" class="form-control" @if($disabled == 'true') disabled @endif>
    <option value="" selected disabled>Seleccione una opcion</option>
    {{ $slot }}
</select>
@error($name)
    <small class="text-danger">{{ $message }}</small>
@enderror
@push('scripts')
    <script>
        $(document).ready(function() {
            $("#{{ $name }}").select2({
                theme: 'bootstrap4',
            });
        });
    </script>
@endpush