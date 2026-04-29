@extends('layout.template')
@section('title', $movie->judul)
@section('content')
<div class="card mb-3">
    <div class="row g-0">
        <div class="col-md-3">
            <img src="/images/{{ $movie->foto_sampul }}"
                class="img-fluid rounded-start" alt="{{ $movie->judul }}">
        </div>
        <div class="col-md-9">
            <div class="card-body">
                <h2>{{ $movie->judul }}</h2>
                <p>{{ $movie->sinopsis }}</p>
                <p>Kategori: {{ $movie->category->nama_kategori }}</p>
                <p>Tahun: {{ $movie->tahun }}</p>
                <p>Pemain: {{ $movie->pemain }}</p>
                <a href="/" class="btn btn-success">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection