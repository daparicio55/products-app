@props(['name','label','value'=>''])

    <label for="{{ $name }}">{{ $label }}</label>
    <div class="input-group">
        <input type="password" name="{{ $name }}" id="{{ $name }}" class="form-control" value="{{ old($name, $value) }}">

        <div class="input-group-append">
            <button  type="button" class="input-group-text" onclick="togglePassword('{{ $name }}')">
                <i id="eyeIcon-{{ $name }}" class="fas fa-eye"></i>
            </button>
        </div>
    </div>


@error($name)
    <small class="text-danger">{{ $message }}</small>
@enderror
@push('scripts')
    <script>
        function togglePassword(name) {
            let inputPassword = document.getElementById(name);
            let eyeIcon = document.getElementById('eyeIcon-' + name);

            if (inputPassword.type === 'password') {
                inputPassword.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                inputPassword.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
    
@endpush