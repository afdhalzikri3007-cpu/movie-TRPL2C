@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-2">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif