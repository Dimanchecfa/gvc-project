<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommercialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid' => $this->faker->uuid,
            'nom' => $this->faker->name,
            'numero' => $this->faker->phoneNumber,
            'pseudo' => $this->faker->userName,
            'logo' => $this->faker->imageUrl(),
        ];
    }
}
