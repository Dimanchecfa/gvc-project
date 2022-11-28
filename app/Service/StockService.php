<?php 

namespace App\Services;


Class StockService 
{

    public function generateStockNumber()
    {
       $number = Stock::all()->count();
         $time = time();
         $stockNumber = $number . $time;
      
    }


}