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
            ['character_name' => 'Steve Rogers', 'actor' => 'Chris Evans'],
            ['character_name' => 'Bruce Banner', 'actor' => 'Mark Ruffalo'],
            ['character_name' => 'Thor Odinson', 'actor' => 'Chris Hemsworth'],
            ['character_name' => 'Natasha Romanoff', 'actor' => 'Scarlett Johansson'],
            ['character_name' => 'Clint Barton', 'actor' => 'Jeremy Renner'],
            ['character_name' => 'James Rhodes', 'actor' => 'Don Cheadle'],
            ['character_name' => 'Scott Lang', 'actor' => 'Paul Rudd'],
            ['character_name' => 'Stephen Strange', 'actor' => 'Benedict Cumberbatch'],
            ['character_name' => 'Carol Danvers', 'actor' => 'Brie Larson'],
            ['character_name' => 'Peter Parker', 'actor' => 'Tom Holland'],
            ['character_name' => 'T\'Challa', 'actor' => 'Chadwick Boseman'],
            ['character_name' => 'Sam Wilson', 'actor' => 'Anthony Mackie'],
            ['character_name' => 'Bucky Barnes', 'actor' => 'Sebastian Stan'],
            ['character_name' => 'Loki', 'actor' => 'Tom Hiddleston'],
            ['character_name' => 'Nebula', 'actor' => 'Karen Gillan'],
            ['character_name' => 'Thanos', 'actor' => 'Josh Brolin'],
            ['character_name' => 'Wanda Maximoff', 'actor' => 'Elizabeth Olsen'],
            ['character_name' => 'Vision', 'actor' => 'Paul Bettany'],
            ['character_name' => 'Valkyrie', 'actor' => 'Tessa Thompson'],
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
