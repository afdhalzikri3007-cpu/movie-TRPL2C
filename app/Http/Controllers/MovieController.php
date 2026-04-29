<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MovieService;
use App\Models\Category;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;

class MovieController extends Controller
{
    protected MovieService $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    public function index()
    {
        $movies = $this->movieService->getMoviesForHomepage();
        return view('movies.homepage', compact('movies'));
    }

    public function detail(string $id)
    {
        $movie = $this->movieService->findMovie($id);
        return view('movies.detail', compact('movie'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('movies.input', compact('categories'));
    }

    public function store(StoreMovieRequest $request)
    {
        $this->movieService->storeMovie($request->validated(), $request);
        return redirect('/')->with('success', 'Data berhasil disimpan');
    }

    public function data()
    {
        $movies = $this->movieService->getMoviesForDataTable();
        return view('movies.data-movies', compact('movies'));
    }

    public function formEdit(string $id)
    {
        $movie = $this->movieService->findMovie($id);
        $categories = Category::all();
        return view('movies.form-edit', compact('movie', 'categories'));
    }

    public function update(UpdateMovieRequest $request, string $id)
    {
        $this->movieService->updateMovie($id, $request->validated(), $request);
        return redirect('/movies/data')->with('success', 'Data berhasil diperbarui');
    }

    public function delete(string $id)
    {
        $this->movieService->deleteMovie($id);
        return redirect('/movies/data')->with('success', 'Data berhasil dihapus');
    }
}