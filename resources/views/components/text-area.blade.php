@props(['name','label','value'=>'','rows'=>3])
<label for="{{ $name }}">{{ $label }}</label>
<textarea class="form-control" name="{{ $name }}" id="{{ $name }}" rows="{{ $rows }}">{{ old($name,$value) }}</textarea>
@error($name)
    <small class="text-danger">{{ $message }}</small>
@enderror
