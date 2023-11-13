<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'releaseDate', 'director', 'boxOfficeEarnings', 'cinematic_universe_id'];

    public function cinematicUniverse()
    {
        return $this->belongsTo(CinematicUniverse::class);
    }

    public function characters()
    {
        return $this->belongsToMany(Character::class);
    }
}
