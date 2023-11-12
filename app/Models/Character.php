<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Character extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'alias', 'superpowers', 'firstAppearance', 'movie_id'];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function actor()
    {
        return $this->hasOne(Actor::class);
    }
}
