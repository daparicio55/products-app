@props(['icon'=>null,'label'=>'Collapsive','name'])
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#{{ $name }}"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="{{ $icon }}"></i>
        <span>{{ $label }}</span>
    </a>
    <div id="{{ $name }}" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            {{-- <h6 class="collapse-header">Custom Components:</h6>
            <a class="collapse-item" href="buttons.html">Buttons</a>
            <a class="collapse-item" href="cards.html">Cards</a> --}}
            {{ $slot }}
        </div>
    </div>
</li>