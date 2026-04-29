<div class="mb-3">
    <label for="judul" class="form-label">Judul:</label>
    <input type="text" class="form-control" id="judul" name="judul"
        value="{{ old('judul', $movie->judul ?? '') }}" required>
</div>
<div class="mb-3">
    <label for="category_id" class="form-label">Kategori:</label>
    <select name="category_id" id="category_id" class="form-select" required>
        <option value="">Pilih Kategori</option>
        @forelse ($categories as $category)
            <option value="{{ $category->id }}"
                {{ old('category_id', $movie->category_id ?? '') == $category->id ? 'selected' : '' }}>
                {{ $category->nama_kategori }}
            </option>
        @empty
            <option disabled>Tidak ada kategori tersedia</option>
        @endforelse
    </select>
</div>
<div class="mb-3">
    <label for="sinopsis" class="form-label">Sinopsis:</label>
    <textarea class="form-control" id="sinopsis" name="sinopsis" rows="4" required>
        {{ old('sinopsis', $movie->sinopsis ?? '') }}
    </textarea>
</div>
<div class="mb-3">
    <label for="tahun" class="form-label">Tahun:</label>
    <input type="number" class="form-control" id="tahun" name="tahun"
        value="{{ old('tahun', $movie->tahun ?? '') }}" required>
</div>
<div class="mb-3">
    <label for="pemain" class="form-label">Pemain:</label>
    <input type="text" class="form-control" id="pemain" name="pemain"
        value="{{ old('pemain', $movie->pemain ?? '') }}" required>
</div>
@isset($movie)
    <div class="mb-3">
        <label class="form-label">Foto Sebelumnya:</label><br>
        <img src="/images/{{ $movie->foto_sampul }}" class="img-thumbnail" width="100px">
    </div>
@endisset
<div class="mb-3">
    <label for="foto_sampul" class="form-label">Foto Sampul:</label>
    <input type="file" class="form-control" id="foto_sampul" name="foto_sampul"
        {{ isset($movie) ? '' : 'required' }}>
</div>