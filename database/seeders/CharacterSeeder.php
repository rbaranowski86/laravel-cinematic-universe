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
            // Avengers: Endgame
            ['movie_title' => 'Avengers: Endgame', 'characters' => [
                ['name' => 'Tony Stark', 'alias' => 'Iron Man'],
                ['name' => 'Steve Rogers', 'alias' => 'Captain America'],
                ['name' => 'Bruce Banner', 'alias' => 'Hulk'],
                ['name' => 'Thor Odinson', 'alias' => 'Thor'],
                ['name' => 'Natasha Romanoff', 'alias' => 'Black Widow'],
                ['name' => 'Clint Barton', 'alias' => 'Hawkeye'],
                ['name' => 'James Rhodes', 'alias' => 'War Machine'],
                ['name' => 'Scott Lang', 'alias' => 'Ant-Man'],
                ['name' => 'Stephen Strange', 'alias' => 'Doctor Strange'],
                ['name' => 'Carol Danvers', 'alias' => 'Captain Marvel'],
                ['name' => 'Peter Parker', 'alias' => 'Spider-Man'],
                ['name' => 'T\'Challa', 'alias' => 'Black Panther'],
                ['name' => 'Sam Wilson', 'alias' => 'Falcon'],
                ['name' => 'Bucky Barnes', 'alias' => 'Winter Soldier'],
                ['name' => 'Loki', 'alias' => 'Loki'],
                ['name' => 'Nebula', 'alias' => 'Nebula'],
                ['name' => 'Thanos', 'alias' => 'Thanos'],
                ['name' => 'Wanda Maximoff', 'alias' => 'Scarlet Witch'],
                ['name' => 'Vision', 'alias' => 'Vision'],
                ['name' => 'Valkyrie', 'alias' => 'Valkyrie'],
            ]],

        ];

        foreach ($charactersData as $data) {
            $movie = Movie::where('title', $data['movie_title'])->first();

            foreach ($data['characters'] as $char) {
                // Check if the character already exists
                $character = Character::firstOrCreate(
                    ['name' => $char['name']],
                    ['alias' => $char['alias'] ?? null]
                );

                // Attach the character to the movie, if not already attached
                if (!$character->movies->contains($movie->id)) {
                    $character->movies()->attach($movie->id);
                }
            }
        }
    }

}
