<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Interfaces\MovieRepositoryInterface;

class MovieService
{
    protected MovieRepositoryInterface $movieRepository;

    public function __construct(MovieRepositoryInterface $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function getMoviesForHomepage()
    {
        $keyword = request('search');
        if ($keyword) {
            return $this->movieRepository->searchPaginated($keyword, 6);
        }
        return $this->movieRepository->getLatestPaginated(6);
    }

    public function getMoviesForDataTable()
    {
        return $this->movieRepository->getAllPaginated(10);
    }

    public function findMovie(string $id)
    {
        return $this->movieRepository->findById($id);
    }

    public function storeMovie(array $validatedData, Request $request)
    {
        $validatedData = $this->handleImageUpload($validatedData, $request);
        return $this->movieRepository->create($validatedData);
    }

    public function updateMovie(string $id, array $validatedData, Request $request)
    {
        $movie = $this->movieRepository->findById($id);
        $validatedData = $this->handleImageUpload($validatedData, $request, $movie->foto_sampul);
        return $this->movieRepository->update($id, $validatedData);
    }

    public function deleteMovie(string $id)
    {
        $movie = $this->movieRepository->findById($id);
        $this->deleteImageFile($movie->foto_sampul);
        return $this->movieRepository->delete($id);
    }

    private function handleImageUpload(array $data, Request $request, ?string $oldImage = null): array
    {
        if ($request->hasFile('foto_sampul')) {
            $file = $request->file('foto_sampul');
            $fileName = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $fileName);
            if ($oldImage) {
                $this->deleteImageFile($oldImage);
            }
            $data['foto_sampul'] = $fileName;
        }
        return $data;
    }

    private function deleteImageFile(?string $fileName): void
    {
        if ($fileName && File::exists(public_path('images/' . $fileName))) {
            File::delete(public_path('images/' . $fileName));
        }
    }
}