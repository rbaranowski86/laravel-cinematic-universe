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
        return Character::create($attributes);
    }

    public function update($id, array $attributes)
    {
        $character = Character::findOrFail($id);
        $character->update($attributes);
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
        return Character::where('movie_id', $movieId)->get();
    }

    public function searchCharacters($movieId, $searchTerm)
    {
        $query = Character::query();

        if ($movieId) {
            $query->where('movie_id', $movieId);
        }

        if (!empty($searchTerm)) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('alias', 'like', '%' . $searchTerm . '%')
                    // Assuming you have a relation with Actor to search by actor name
                    ->orWhereHas('actor', function ($q) use ($searchTerm) {
                        $q->where('name', 'like', '%' . $searchTerm . '%');
                    });
            });
        }

        return $query->get();
    }

}
