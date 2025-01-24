@props(['name','label','value'=>''])
<label for="{{ $name }}">{{ $label }}</label>
<input type="date" name="{{ $name }}" id="{{ $name }}" class="form-control" value="{{ old($name, $value) }}">
@error($name)
    <small class="text-danger">{{ $message }}</small>
@enderror
