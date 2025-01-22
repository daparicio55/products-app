@props(['route','text'=>null,'type'])
<a href="{{ route($route) }}" class="btn btn-primary mb-4">
    @if($type == 'back')
        <i class="fas fa-arrow-left"></i> {{ $text ?? 'Regresar' }}
    @endif
    @if($type == 'add')
        <i class="fas fa-plus-circle"></i> {{ $text ?? 'Registrar' }}    
    @endif
</a>