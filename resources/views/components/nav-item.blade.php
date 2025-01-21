@props(['route','icon'=>'fas fa-fw fa-tachometer-alt','label'=>'Dashboard'])

@if(request()->routeIs($route))
    @php
        $attributes['class'] = 'nav-item active';
    @endphp
@endif

<li {{ $attributes->merge(['class'=>'nav-item']) }} >
    <a class="nav-link" href="{{ route($route) }}">
        <i class="{{ $icon }}"></i>
        <span>{{ $label }}</span>
    </a>
</li>