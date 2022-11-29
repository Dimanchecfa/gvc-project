<?php

namespace Database\Factories;

use App\Models\Commercial;
use App\Models\Moto;
use Illuminate\Database\Eloquent\Factories\Factory;

class SellFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $statut = $this->faker->randomElement(['en_cours', 'termine']);
        return [
            'uuid' => $this->faker->uuid,
            'nom_client' => $this->faker->name,
            'prenom_client' => $this->faker->firstName,
            'numero_client' => $this->faker->phoneNumber,
            'adresse_client' => $this->faker->address,
            'identifiant_client' => $this->faker->creditCardNumber(),
            'commercial_id' => Commercial::all()->random()->id,
            'moto_id' => Moto::all()->random()->id,
            'prix_vente' => $this->faker->numberBetween(100000, 1000000),
            'montant_verse' => $this->faker->numberBetween(100000, 1000000),
            'montant_restant' => array_rand([0, $this->faker->numberBetween(100000, 1000000)]),
            'statut_payement' => $statut,
            'date_versement' => $this->faker->date(),
            'is_certificat' => $this->faker->boolean,
            'penalite' => $statut == 'en_cours' ? $this->faker->numberBetween(100000, 1000000) : null,
            'numero_facture' => $this->faker->unique()->numberBetween(100000, 1000000),
            'registration_statut' => $this->faker->randomElement(['pas_enregistre', 'enregistre', 'termine']),
        ];
    }
}
