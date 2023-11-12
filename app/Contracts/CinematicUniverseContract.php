<?php

namespace App\Contracts;

interface CinematicUniverseContract
{
    public function getAll();
    public function create(array $details);
    public function findById($id);
    public function update($id, array $details);
    public function delete($id);
}
