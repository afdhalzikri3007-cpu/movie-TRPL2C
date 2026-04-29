@extends('layout.template')
@section('title', 'Edit Data Movie')
@section('content')
<h2 class="mb-4">Edit Movie</h2>
<form action="{{ route('movies.update', ['movie' => $movie->id]) }}"
    method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label class="form-label">ID Film:</label>
        <input type="text" class="form-control" value="{{ $movie->id }}" disabled>
    </div>
    @include('partials.movie-form-fields')
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="/movies/data" class="btn btn-secondary">Batal</a>
</form>
@endsection