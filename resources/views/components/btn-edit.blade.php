@props(['route','id','text'])
<a href="{{ route($route,$id) }}" class="btn btn-warning">
    <i class="fas fa-edit"></i> {{ $text ?? null}} 
</a>