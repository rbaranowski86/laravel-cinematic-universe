<?php

namespace Database\Factories;

use App\Models\Character;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Character>
 */
class CharacterFactory extends Factory
{
    protected $model = Character::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'alias' => $this->faker->word,
            'superpowers' => $this->faker->words(3, true),
            'firstAppearance' => $this->faker->word,
        ];
    }
}
