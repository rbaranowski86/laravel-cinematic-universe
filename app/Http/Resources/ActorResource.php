<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ActorResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'dateOfBirth' => $this->dateOfBirth,
            'nationality' => $this->nationality,
            'character' => new CharacterResource($this->whenLoaded('character')),
        ];
    }
}
