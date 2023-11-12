<?php

namespace Database\Factories;

use App\Models\CinematicUniverse;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    protected $model = Movie::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'releaseDate' => $this->faker->date,
            'director' => $this->faker->name,
            'boxOfficeEarnings' => $this->faker->randomFloat(2, 1000000, 100000000),
            'cinematic_universe_id' => CinematicUniverse::factory()->create()->id,
        ];
    }
}
