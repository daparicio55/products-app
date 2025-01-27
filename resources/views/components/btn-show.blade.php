@props(['route','id','text'])
<a href="{{ route($route,$id) }}" class="btn btn-info">
    <i class="fas fa-eye"></i> {{ $text ?? null}} 
</a>