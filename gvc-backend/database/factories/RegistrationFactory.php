<?php

namespace Database\Factories;

use App\Models\Lot;
use App\Models\Sell;
use Illuminate\Database\Eloquent\Factories\Factory;

class RegistrationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $withdrawing = $this->faker->randomElement(['en_cours', 'termine']);
        return [
            'uuid' => $this->faker->uuid,
            'sale_id' => Sell::all()->unique()->random()->id,
            'lot_id' => Lot::all()->unique()->random()->id,
            'statut' => $withdrawing,
            'is_withdraw' => $withdrawing == 'termine' ? true : false,
            'withdrawal_authorName' => $withdrawing == 'termine' ? $this->faker->name : null,
            'withdrawal_authorId' => $withdrawing == 'termine' ? $this->faker->creditCardNumber() : null,
    ];
    }
}
