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
        $commerciale = array(
            [
            'uuid' => '1',
            'pseudo'=> 'EBIZAF',
            'nom' => 'BIKIENGA Zackaria',
            'numero' => '0022999999999',
            'logo' => 'logo.png',
            ],
            [
             'uuid' => '2',
            'pseudo'=> 'EKIENGA',
            'nom' => 'BIKIENGA ',
            'numero' => '0022999999999',
            'logo' => 'logo.png',
            ],
            
        
        );
        foreach ($commerciale as $key => $value) {
            Commercial::create($value);
       }


        }
    }