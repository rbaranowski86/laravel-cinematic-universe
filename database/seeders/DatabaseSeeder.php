<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CinematicUniverseSeeder::class);
        $this->call(MovieSeeder::class);
        $this->call(CharacterSeeder::class);
        $this->call(ActorSeeder::class);
    }
}
