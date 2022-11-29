<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Moto;
use Illuminate\Foundation\Bootstrap\RegisterFacades;

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
        $this->call(MarqueSeeder::class);
        $this->call(ModeleSeeder::class);
        $this->call(CommercialeSeeder::class);
        $this->call(SellSeeder::class);
        $this->call(LotSeeder::class);
        $this->call(registrationSeeder::class);
    }
}
