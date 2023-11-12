<?php

namespace Database\Seeders;

use App\Models\CinematicUniverse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CinematicUniverseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CinematicUniverse::create([
            'name' => 'Marvel Cinematic Universe',
            'description' => 'American media franchise and shared universe centered on a series of superhero films produced by Marvel Studios.',
            'foundationYear' => 2008,
        ]);
    }
}
