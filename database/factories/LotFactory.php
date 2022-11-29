<?php

namespace Database\Factories;

use App\Models\Registration;
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
            'nom_depositaire' => $this->faker->name(),
            'numero_depositaire' => $this->faker->phoneNumber(),
            'nombre_registrations' => $this->faker->randomNumber(1, Registration::all()->count()),
        ];
    }
}
