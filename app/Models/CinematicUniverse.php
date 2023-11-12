<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CinematicUniverse extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'foundationYear'];

    public function movies()
    {
        return $this->hasMany(Movie::class);
    }
}
