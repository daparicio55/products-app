@props([
    'name'=>'control', 
    'label'=>'Etiqueta',
    'type_button'=>'primary',
    'button_icon'=>'fas fa-search',
    'button_text'=>'',
    'value'=>''
])
<label for="{{ $name }}">
    {{ $label }}
</label>
<div class="input-group mb-3">
    <input type="text" class="form-control" id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $value) }}">
    <div class="input-group-append">
        <button class="btn btn-outline-{{ $type_button }}" type="button" id="button-{{ $name }}">
            <i class="{{ $button_icon }}"></i> {{ $button_text }}
        </button>
    </div>
</div>