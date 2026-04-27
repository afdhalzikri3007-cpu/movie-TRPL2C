<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
// ✅ Hapus: use Illuminate\Validation\Rule;
// ✅ Hapus: use Illuminate\Support\Facades\Validator;
// ✅ Tambah dua baris ini:
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;

class MovieController extends Controller
{
    public function index()
    {
        $query = Movie::latest();
        if (request('search')) {
            $query->where('judul', 'like', '%' . request('search') . '%')
                ->orWhere('sinopsis', 'like', '%' . request('search') . '%');
        }
        $movies = $query->paginate(6)->withQueryString();
        return view('homepage', compact('movies'));
    }

    public function detail($id)
    {
        $movie = Movie::find($id);
        return view('detail', compact('movie'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('input', compact('categories'));
    }

    // ✅ SETELAH: Ganti Request dengan StoreMovieRequest
    public function store(StoreMovieRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('foto_sampul')) {
            $file = $request->file('foto_sampul');
            $fileName = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $fileName);
            $validated['foto_sampul'] = $fileName;
        }

        Movie::create($validated);

        return redirect('/')->with('success', 'Data berhasil disimpan');
    }

    public function data()
    {
        $movies = Movie::latest()->paginate(10);
        return view('data-movies', compact('movies'));
    }

    public function form_edit($id)
    {
        $movie = Movie::find($id);
        $categories = Category::all();
        return view('form-edit', compact('movie', 'categories'));
    }

    // ✅ SETELAH: Ganti Request dengan UpdateMovieRequest
    public function update(UpdateMovieRequest $request, $id)
    {
        $movie = Movie::findOrFail($id);
        $validated = $request->validated();

        if ($request->hasFile('foto_sampul')) {
            $file = $request->file('foto_sampul');
            $fileName = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $fileName);

            if (File::exists(public_path('images/' . $movie->foto_sampul))) {
                File::delete(public_path('images/' . $movie->foto_sampul));
            }

            $validated['foto_sampul'] = $fileName;
        }

        $movie->update($validated);

        return redirect('/movies/data')->with('success', 'Data berhasil diperbarui');
    }

    public function delete($id)
    {
        $movie = Movie::findOrFail($id);

        if (File::exists(public_path('images/' . $movie->foto_sampul))) {
            File::delete(public_path('images/' . $movie->foto_sampul));
        }

        $movie->delete();

        return redirect('/movies/data')->with('success', 'Data berhasil dihapus');
    }
}
