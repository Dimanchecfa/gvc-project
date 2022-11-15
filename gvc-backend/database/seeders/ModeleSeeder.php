<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Modele;

class ModeleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modele = array(
        
            [
                'uuid' => '5',
                'nom' => 'S1000RR',
                'marque_id' => '5',
            ],
            [
                'uuid' => '6',
                'nom' => 'Panigale',
                'marque_id' => '6',
            ],
            [
                'uuid' => '7',
                'nom' => 'RSV4',
                'marque_id' => '6',
            ],
            [
                'uuid' => '8',
                'nom' => 'ZX-10R',
                'marque_id' => '4',
            ],
            [
                'uuid' => '9',
                'nom' => 'ZX-6R',
                'marque_id' => '7',
            ],
           
            [
                'uuid' => '10',
                'nom' => 'ZX-30R',
                'marque_id' => '4',
            ],
           
            );
        foreach ($modele as $key => $value) {
            Modele::create($value);
        }
    }
}
