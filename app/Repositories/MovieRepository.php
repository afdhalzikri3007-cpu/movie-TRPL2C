<?php

namespace App\Repositories;

use App\Models\Movie;
use App\Interfaces\MovieRepositoryInterface;

class MovieRepository implements MovieRepositoryInterface
{
    public function getAllPaginated(int $perPage = 10)
    {
        return Movie::latest()->paginate($perPage)->withQueryString();
    }

    public function searchPaginated(string $keyword, int $perPage = 6)
    {
        return Movie::latest()
            ->where('judul', 'like', '%' . $keyword . '%')
            ->orWhere('sinopsis', 'like', '%' . $keyword . '%')
            ->paginate($perPage)
            ->withQueryString();
    }

    public function findById(string $id)
    {
        return Movie::findOrFail($id);
    }

    public function create(array $data)
    {
        return Movie::create($data);
    }

    public function update(string $id, array $data)
    {
        $movie = $this->findById($id);
        $movie->update($data);
        return $movie;
    }

    public function delete(string $id)
    {
        $movie = $this->findById($id);
        $movie->delete();
        return $movie;
    }

    public function getLatestPaginated(int $perPage = 6)
    {
        return Movie::latest()->paginate($perPage)->withQueryString();
    }
}