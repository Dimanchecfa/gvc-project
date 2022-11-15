<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Moto;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(StockSeeder::class);
        $this->call(MotoSeeder::class);
        $this->call(ModeleSeeder::class);
        $this->call(MarqueSeeder::class);
        $this->call(CommercialeSeeder::class);
        $this->call(VenteSeeder::class);
    }
}
