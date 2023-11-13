<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CharacterResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'alias' => $this->alias,
            'superpowers' => $this->superpowers,
            'firstAppearance' => $this->firstAppearance,
            'movie_id' => $this->movie_id,
        ];
    }
}
