<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stock;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stock = array(
            [  
                'uuid' => '1',
                'numero' => 'STOCK-1237',
                'nom_fournisseur' => 'Honda',
                'numero_fournisseur' => 'CBR',
                'nombre_moto' => '10',
            ], 
            [
                'uuid' => '2',
                'numero' => 'STOCK-1240',
                'nom_fournisseur' => 'Yamaha',
                'numero_fournisseur' => 'R1',
                'nombre_moto' => '10',
            ]  ,
            [
                'uuid' => '3',
                'numero' => 'STOCK-2022-01-01/03',
                'nom_fournisseur' => 'Suzuki',
                'numero_fournisseur' => 'GSX-R',
                'nombre_moto' => '10',
            ]  ,
            [
                'uuid' => '4',
                'numero' => 'STOCK-2022-01-01/04',
                'nom_fournisseur' => 'Kawasaki',
                'numero_fournisseur' => 'Ninja',
                'nombre_moto' => '10',
            ]  ,
            [
                'uuid' => '5',
                'numero' => 'STOCK-2022-01-01/05',
                'nom_fournisseur' => 'BMW',
                'numero_fournisseur' => 'S1000RR',
                'nombre_moto' => '10',
            ]  ,
            [
                'uuid' => '6',
                'numero' => 'STOCK-2022-01-01/06',
                'nom_fournisseur' => 'Ducati',
                'numero_fournisseur' => 'Panigale',
                'nombre_moto' => '10',
            ]  ,
            [
                'uuid' => '7',
                'numero' => 'STOCK-2022-01-01/071',
                'nom_fournisseur' => 'Aprilia',
                'numero_fournisseur' => 'RSV4',
                'nombre_moto' => '10',
            ]  ,
            [
                'uuid' => '8',
                'numero' => 'STOCK-2022-01-01/0118',
                'nom_fournisseur' => 'Triumph',
                'numero_fournisseur' => 'Speed Triple',
                'nombre_moto' => '10',
            ]  ,
            [
                'uuid' => '9',
                'numero' => 'STOCK-2022-01-01/1108',
                'nom_fournisseur' => 'Triumph',
                'numero_fournisseur' => 'Speed Triple',
                'nombre_moto' => '10',
            ],
            [
                'uuid' => '10',
                'numero' => 'STOCK-2022-01-01/0008',
                'nom_fournisseur' => 'Triumph',
                'numero_fournisseur' => 'Speed Triple',
                'nombre_moto' => '10',
            ],
            [
                'uuid' => '11',
                'numero' => 'STOCK-2022-01-01/008',
                'nom_fournisseur' => 'Triumph',
                'numero_fournisseur' => 'Speed Triple',
                'nombre_moto' => '10',
            ] 
           
           
        

       
        );
        foreach ($stock as $value) {
            Stock::create($value);
        }

    }
}
