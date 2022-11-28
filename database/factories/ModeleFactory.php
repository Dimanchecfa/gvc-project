<?php

namespace Database\Factories;

use App\Models\Marque;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModeleFactory extends Factory
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
            'nom' => $this->faker->unique()->randomElement(['Sirius' , '115-Sirius','Scooter Mio', 'Winner 150' , 'MX King','Scooter-Aerox', 'Scooter-AirBlade' ,'Finn-115']),
            'marque_id'=> Marque::all()->random()->id
        ];
    }
}
