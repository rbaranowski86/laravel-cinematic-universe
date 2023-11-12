<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Actor extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'dateOfBirth', 'nationality', 'character_id'];

    public function character()
    {
        return $this->belongsTo(Character::class);
    }
}
