@if ($errors->any())
    <div {{ $attributes }} class="alert alert-danger">
        <div class="font-weight-bold text-danger small">{{ __('¡Vaya! Algo salió mal.') }}</div>

        <ul class="mt-3 pl-3 text-danger small">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif