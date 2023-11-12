<?php

namespace Database\Seeders;

use App\Models\Character;
use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CharacterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $charactersData = [
        // Iron Man
        ['movie_title' => 'Iron Man', 'characters' => [
            ['name' => 'Tony Stark', 'alias' => 'Iron Man'],
            ['name' => 'James Rhodes', 'alias' => 'War Machine'],
        ]],
        // Thor
        ['movie_title' => 'Thor', 'characters' => [
            ['name' => 'Thor Odinson', 'alias' => 'Thor'],
            ['name' => 'Loki', 'alias' => 'Loki'],
        ]],
        // Captain America: The First Avenger
        ['movie_title' => 'Captain America: The First Avenger', 'characters' => [
            ['name' => 'Steve Rogers', 'alias' => 'Captain America'],
            ['name' => 'Bucky Barnes', 'alias' => 'Winter Soldier'],
        ]],
        // The Avengers
        ['movie_title' => 'The Avengers', 'characters' => [
            ['name' => 'Natasha Romanoff', 'alias' => 'Black Widow'],
            ['name' => 'Bruce Banner', 'alias' => 'Hulk'],
        ]],
        // ... and more for each movie
    ];

        foreach ($charactersData as $data) {
            $movie = Movie::where('title', $data['movie_title'])->first();

            foreach ($data['characters'] as $char) {
                Character::create([
                    'name' => $char['name'],
                    'alias' => $char['alias'],
                    'movie_id' => $movie->id,
                ]);
            }
        }
    }

}
