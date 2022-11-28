<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\Vente;
use App\Models\Modele;
use App\Models\Sell;
use Illuminate\Http\Request;

class DashboardController extends BaseController
{
    
    public function getTodaySellPrice()
    {
        $today = date('Y-m-d');
        $todaySell= Sell::whereDate('created_at', $today)->get();
        $todaySellPrice = 0;
        foreach($todaySell as $sell) {
            $todaySellPrice += $sell->montant_verse;
        }
        
        return $this->sendResponse($todaySellPrice, 'Montant total des ventes du jour');
    }

    public function getTodayMotoNumber()
    {
        $today = date('Y-m-d');
        $todaySell= Sell::whereDate('created_at', $today)->get();
        $todayMotoNumber = count($todaySell);
        return $this->sendResponse($todayMotoNumber, 'Nombre total des motos vendues du jour');
    }
    public function getCurrentMonthSell () 
    {
        $currentMonth = date('m');
        $currentMonthSell = Sell::whereMonth('created_at', $currentMonth)->get();
        return $this->sendResponse($currentMonthSell, 'Liste des motos vendues ');
    }


   
  

 

 

   



}
