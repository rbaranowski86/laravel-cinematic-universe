<?php

namespace Database\Seeders;

use App\Models\Actor;
use App\Models\Character;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $actorsData = [
            ['character_name' => 'Tony Stark', 'actor' => 'Robert Downey Jr.'],
            ['character_name' => 'James Rhodes', 'actor' => 'Don Cheadle'],
            ['character_name' => 'Thor Odinson', 'actor' => 'Chris Hemsworth'],
            ['character_name' => 'Loki', 'actor' => 'Tom Hiddleston'],
            ['character_name' => 'Steve Rogers', 'actor' => 'Chris Evans'],
            ['character_name' => 'Bucky Barnes', 'actor' => 'Sebastian Stan'],
            ['character_name' => 'Natasha Romanoff', 'actor' => 'Scarlett Johansson'],
            ['character_name' => 'Bruce Banner', 'actor' => 'Mark Ruffalo'],
        ];

        foreach ($actorsData as $data) {
            $character = Character::where('name', $data['character_name'])->first();

            Actor::create([
                'name' => $data['actor'],
                'character_id' => $character->id,
            ]);
        }
    }
}
