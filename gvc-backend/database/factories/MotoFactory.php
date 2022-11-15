<?php

namespace Database\Factories;

use App\Models\Marque;
use App\Models\Modele;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

class MotoFactory extends Factory
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
            'stock_id' => $this->faker->numberBetween(1, 4),
            'numero_serie' => $this->faker->randomNumber(8),
            'marque' => $this->faker->randomElement([ 'HONDA', 'YAMAHA', 'SUZUKI', 'KAWASAKI', 'BMW', 'DUCATI']),
            'modele' => $this->faker->randomElement([ 'CBR', 'R1', 'GSX-R', 'Ninja', 'S1000RR', 'Panigale']),
            'couleur' => $this->faker->colorName,
            'statut' => $this->faker->randomElement(['en_stock', 'vendue']),
        
        
        ];
    }
}
