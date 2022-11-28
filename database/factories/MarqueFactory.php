<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MarqueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $value = ['HONDA', 'YAMAHA', 'SUZUKI', 'KAWASAKI', 'BMW', 'DUCATI'];
        return [
            'uuid' => $this->faker->uuid,
            'nom' => $this->faker->unique()->randomElement($value),
        ];
    }
}
