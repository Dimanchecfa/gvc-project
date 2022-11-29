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
            'prenom' => $this->faker->name,
            'numero' => $this->faker->phoneNumber,
            'numero2' => $this->faker->phoneNumber,
            'identifiant' => $this->faker->name,
            'numero_ifu' => $this->faker->phoneNumber,
            'pseudo' => $this->faker->userName,
            'adresse' => $this->faker->address,
            'logo' => $this->faker->imageUrl(),
        ];
    }
}
