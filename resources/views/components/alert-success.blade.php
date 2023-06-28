@if(session('success'))
    <div class="alert alert-success">
        {{ $slot }}
    </div>
@endif