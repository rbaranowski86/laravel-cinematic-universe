<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'releaseDate' => $this->releaseDate,
            'director' => $this->director,
            'boxOfficeEarnings' => $this->boxOfficeEarnings,
            'cinematicUniverse' => new CinematicUniverseResource($this->whenLoaded('cinematicUniverse')),
            'characters' => CharacterResource::collection($this->whenLoaded('characters')),
        ];
    }
}
