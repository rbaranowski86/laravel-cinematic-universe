<?php

namespace App\Services;

use App\Contracts\CharacterContract;
use App\Models\Character;

class CharacterService implements CharacterContract
{
    public function getAll()
    {
        return Character::all();
    }

    public function findById($id)
    {
        return Character::findOrFail($id);
    }

    public function create(array $attributes)
    {
        $movieIds = $attributes['movie_ids'] ?? null;
        unset($attributes['movie_ids']);

        $character = Character::create($attributes);

        if ($movieIds) {
            $character->movies()->attach($movieIds);
        }

        return $character;
    }


    public function update($id, array $attributes)
    {
        $character = Character::findOrFail($id);

        $movieIds = $attributes['movie_ids'] ?? null;
        unset($attributes['movie_ids']);

        $character->update($attributes);

        if ($movieIds) {
            $character->movies()->sync($movieIds);
        }

        return $character;
    }


    public function delete($id)
    {
        $character = Character::findOrFail($id);
        $character->delete();
        return $character;
    }

    public function getCharactersByMovie($movieId)
    {
        return Character::whereHas('movies', function ($query) use ($movieId) {
            $query->where('movies.movie_id', '=', $movieId);
        })->get();
    }

    public function searchCharacters($movieId, $searchTerm)
    {
        $query = Character::query();

        if ($movieId) {
            $query->whereHas('movies', function ($q) use ($movieId) {
                $q->where('id', $movieId);
            });
        }

        if (!empty($searchTerm)) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('alias', 'like', '%' . $searchTerm . '%')
                    ->orWhereHas('actor', function ($q) use ($searchTerm) {
                        $q->where('name', 'like', '%' . $searchTerm . '%');
                    });
            });
        }

        return $query->get();
    }


}
