<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use App\Models\Vente;
use App\Models\Modele;
use App\Models\Marque;


class HistoricalController extends BaseController
{
    
    public function getSellByDate($date , $page) {
        $motos = Vente::whereDate('created_at', $date)->paginate(10 , ['*'] ,'page' , $page);

        if(count($motos) > 0) {
            return $this->sendResponse($motos, 'Liste des ventes');
        } else {
            return $this->sendResponse($motos , 'Aucune vente');
        }
        
    }
    public function getSellMotoNumberByDate($date) {
        $motos = Vente::whereDate('created_at', $date)->get();
        $motoNumber = count($motos);
        return $this->sendResponse($motoNumber, 'Nombre des motos vendues le '.$date);
            
    }


    public function getLastMonthSell () {
       $currentMonth = date('m');
       $lastMonth = $currentMonth - 1;
       $lastMonthSell = Vente::whereMonth('created_at', $lastMonth)->get();
        if(count($lastMonthSell) > 0) {
            return $this->sendResponse($lastMonthSell, 'Liste des ventes du mois dernier');
        } else {
            return $this->sendResponse($lastMonthSell , 'Aucune vente');
        }

    }
    public function getLastMonthSellPrice () {
        $currentMonth = date('m');
        $lastMonth = $currentMonth - 1;
        $lastMonthSell = Vente::whereMonth('created_at', $lastMonth)->get();
        $lastMonthSellPrice = 0;
        foreach($lastMonthSell as $sell) {
            $lastMonthSellPrice += $sell->montant_verse;
        }
        return $this->sendResponse($lastMonthSellPrice, 'Montant total des ventes du mois dernier');
    }

    public function getLastMonthSellMotoNumber () {
        $currentMonth = date('m');
        $lastMonth = $currentMonth - 1;
        $lastMonthSell = Vente::whereMonth('created_at', $lastMonth)->get();
        $lastMonthMotoNumber = count($lastMonthSell);
        return $this->sendResponse($lastMonthMotoNumber, 'Nombre total des motos vendues du mois dernier');
    }
   
    public function getSellPricebyDate($date) {
        $motos = Vente::whereDate('created_at', $date)->get();
        $total = 0;
        foreach($motos as $moto) {
            $total += $moto->montant_verse;
        }
        return $this->sendResponse($total, 'Montant total des ventes du '.$date);
    }

    public function getSellNumberbyDate($date) {
        $motos = Vente::whereDate('created_at', $date)->get();
        $total = count($motos);
        return $this->sendResponse($total, 'Nombre total des motos vendues du '.$date);
    }
    public function getCurrentMonthSellMotoNumber () {
        $currentMonth = date('m');
        $currentMonthSell = Vente::whereMonth('created_at', $currentMonth)->get();
        $currentMonthMotoNumber = count($currentMonthSell);
        return $this->sendResponse($currentMonthMotoNumber, 'Nombre total des motos vendues ce mois-ci');
    }
    public function getCurrentMonthSellPrice () {
        $currentMonth = date('m');
        $currentMonthSell = Vente::whereMonth('created_at', $currentMonth)->get();
        $currentMonthSellPrice = 0;
        foreach($currentMonthSell as $sell) {
            $currentMonthSellPrice += $sell->montant_verse;
        }
        return $this->sendResponse($currentMonthSellPrice, 'Montant total des ventes ');
    }
  

    public function TodayVenteListPaginate ($page) {
        try {
            $today = date('Y-m-d');
            $motos = Vente::whereDate('created_at', $today)->paginate(10, ['*'], 'page', $page);
            return $this->sendResponse($motos, 'Liste des motos vendues');
          
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        } catch (\Throwable $th) {
            return $this->sendError('Une erreur est survenue', $th->getMessage());
        }
    }

    
    
}
