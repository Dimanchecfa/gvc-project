<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LotFactory extends Factory
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
            'numero_lot' => $this->faker->numberBetween(1, 100),
            'nom_depositeur' => $this->faker->name(),
            'numero_depositeur' => $this->faker->phoneNumber(),
            'nombre_registrations' => $this->faker->randomNumber(2),
        ];
        
    }
}
