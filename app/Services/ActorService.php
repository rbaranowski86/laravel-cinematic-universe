<?php

namespace App\Services;

use App\Contracts\ActorContract;
use App\Models\Actor;

class ActorService implements ActorContract
{
    public function getAll()
    {
        return Actor::all();
    }

    public function findById($id)
    {
        return Actor::findOrFail($id);
    }

    public function create(array $attributes)
    {
        return Actor::create($attributes);
    }

    public function update($id, array $attributes)
    {
        $actor = Actor::findOrFail($id);
        $actor->update($attributes);
        return $actor;
    }

    public function delete($id)
    {
        $actor = Actor::findOrFail($id);
        $actor->delete();
        return $actor;
    }
}
