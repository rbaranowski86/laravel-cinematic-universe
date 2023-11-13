<?php

namespace App\Contracts;

interface CharacterContract
{
    public function getAll();
    public function findById($id);
    public function create(array $attributes);
    public function update($id, array $attributes);
    public function delete($id);
    public function getCharactersByMovie($movieId);
    public function searchCharacters($movieId, $searchTerm);
}
