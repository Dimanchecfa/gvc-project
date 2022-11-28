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

     }
    }