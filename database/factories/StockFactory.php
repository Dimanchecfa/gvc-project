<?php

namespace Database\Factories;

use App\Models\Moto;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockFactory extends Factory
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
            'numero' => $this->faker->unique()->numberBetween(100000, 1000000),
            'nom_fournisseur' => $this->faker->name,
            'numero_fournisseur' => $this->faker->phoneNumber,
            'nombre_moto' => $this->faker->numberBetween(1, 10),
        ];
    }
}
