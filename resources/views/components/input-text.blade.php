@props(['name','label','value'=>''])
<label for="{{ $name }}">{{ $label }}</label>
<input type="text" name="{{ $name }}" id="{{ $name }}" class="form-control" value="{{ old($name, $value) }}">
@error($name)
    <small class="text-danger">{{ $message }}</small>
@enderror
