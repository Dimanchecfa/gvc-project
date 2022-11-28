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
        Modele::factory(7)->create();
    }
}
