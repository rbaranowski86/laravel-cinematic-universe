<?php

namespace Database\Factories;

use App\Models\CinematicUniverse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CinematicUniverse>
 */
class CinematicUniverseFactory extends Factory
{
    protected $model = CinematicUniverse::class;

    public function definition()
    {
        return [
            'name' => $this->faker->words(2, true),
            'description' => $this->faker->sentence,
            'foundationYear' => $this->faker->year,
        ];
    }
}
