<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Commercial;

class CommercialeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Commercial::factory(10)->create();
        $commercial = array(
            [
                'nom' => 'Doe',
                'prenom' => 'John',
                'numero' => '0606060606',
                'numero2' => '0606060606',
                'pseudo' => 'JohnDoe',
                'numero_cnib' => '123456789',
                'numero_ifu' => '123456789',
            ],
            [
                'nom' => 'Doe',
                'prenom' => 'Jane',
                'numero' => '0606060606',
                'numero2' => '0606060606',
                'pseudo' => 'JaneDoe',
                'numero_cnib' => '123456789',
                'numero_ifu' => '123456789',

            ],

        )

     }
    }
