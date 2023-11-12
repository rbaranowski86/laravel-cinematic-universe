<?php

namespace Database\Factories;

use App\Models\Actor;
use App\Models\Character;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Actor>
 */
class ActorFactory extends Factory
{
    protected $model = Actor::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'dateOfBirth' => $this->faker->date,
            'nationality' => $this->faker->country,
            'character_id' => Character::factory()->create()->id,
        ];
    }
}
