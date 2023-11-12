<?php

namespace App\Services;

use App\Contracts\MovieContract;
use App\Models\Movie;

class MovieService implements MovieContract
{
    public function getAll()
    {
        return Movie::all();
    }

    public function findById($id)
    {
        return Movie::findOrFail($id);
    }

    public function create(array $attributes)
    {
        return Movie::create($attributes);
    }

    public function update($id, array $attributes)
    {
        $movie = Movie::findOrFail($id);
        $movie->update($attributes);
        return $movie;
    }

    public function delete($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();
        return $movie;
    }
}
