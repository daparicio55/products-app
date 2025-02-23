@if(session()->has('success'))
    <div class="alert alert-info fade" role="alert" style="display: none;">
        <span id="notificationText">
            {{ session('info') }}
        </span>
    </div>
@endif

@if(session()->has('error'))
    <div class="alert alert-info fade" role="alert" style="display: none;">
        <span id="notificationText">
            {{ session('error') }}
        </span>
    </div>
@endif