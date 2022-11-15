<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Marque;

class MarqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $marque = array(
            [
            'uuid' => '1',
                'nom' => 'Honda',
            ],
            [
                'uuid' => '2',
                'nom' => 'Yamaha',
            ],
            [
                'uuid' => '3',
                'nom' => 'Suzuki',
            ],
            [
                'uuid' => '4',
                'nom' => 'Kawasaki',
            ],
            [
                'uuid' => '5',
                'nom' => 'BMW',
            ],
            [
                'uuid' => '6',
                'nom' => 'Ducati',
            ],
            [
                'uuid' => '7',
                'nom' => 'Aprilia',
            ],
        );
        foreach ($marque as $key => $value) {
            Marque::create($value);
        }
    }
}
