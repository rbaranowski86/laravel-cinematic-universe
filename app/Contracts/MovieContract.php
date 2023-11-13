<?php

namespace App\Contracts;

interface MovieContract
{
    public function getAll();
    public function findById($id);
    public function create(array $attributes);
    public function update($id, array $attributes);
    public function delete($id);
    public function getMoviesByUniverse($universeId = null);
}
