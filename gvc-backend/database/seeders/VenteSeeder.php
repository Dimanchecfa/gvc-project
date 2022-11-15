<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sell;

class VenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vente = array(
            [
                'uuid' => '1',
             
                    'nom_client' => 'Moussa',
                    'numero_client' => '77 777 77 77',
                    'adresse_client' => 'Dakar',
                    'identifiant_client' => 'Moussa',
                    'commerciale_id' => '1',
                    'moto_id' => '1',
                    'prix_vente' => '500000',
                    'montant_verse' => '500000',
                    'montant_restant' => '0',
                    'statut' => 'en_cours',
                    'date_versement' => '2021-01-01',
                    'numero_facture' => 'FACTURE-001',
            ],

            [
                'uuid' => '2',
                    'nom_client' => 'Moussa',
                    'numero_client' => '77 777 77 77',
                    'adresse_client' => 'Dakar',
                    'identifiant_client' => 'Moussa',
                    'commerciale_id' => '1',
                    'moto_id' => '2',
                    'prix_vente' => '500000',
                    'montant_verse' => '500000',
                    'montant_restant' => '0',
                    'statut' => 'en_cours',
                    'date_versement' => '2021-01-01',
                    'numero_facture' => 'FACTURE-002',
            ]
               ,
               [
                'uuid' => '3',
                'nom_client' => 'Moussa',
                'numero_client' => '77 777 77 77',
                'adresse_client' => 'Dakar',
                'identifiant_client' => 'Moussa',
                'commerciale_id' => '1',
                'moto_id' => '3',
                'prix_vente' => '500000',
                'montant_verse' => '500000',
                'montant_restant' => '0',
                'statut' => 'en_cours',
                'date_versement' => '2021-01-01',
                'numero_facture' => 'FACTURE-003',
        ]
           

            );
            foreach ($vente as $key => $value) {
                Sell::create($value);
            }
    }
}
