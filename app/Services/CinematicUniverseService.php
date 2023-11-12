<?php

namespace App\Services;

use App\Contracts\CinematicUniverseContract;
use App\Models\CinematicUniverse;

class CinematicUniverseService implements CinematicUniverseContract
{
    public function getAll()
    {
        return CinematicUniverse::all();
    }

    public function create(array $details)
    {
        return CinematicUniverse::create($details);
    }

    public function findById($id)
    {
        return CinematicUniverse::findOrFail($id);
    }

    public function update($id, array $details)
    {
        $cinematicUniverse = CinematicUniverse::findOrFail($id);
        $cinematicUniverse->update($details);
        return $cinematicUniverse;
    }

    public function delete($id)
    {
        $cinematicUniverse = CinematicUniverse::findOrFail($id);
        $cinematicUniverse->delete();
        return $cinematicUniverse;
    }
}
