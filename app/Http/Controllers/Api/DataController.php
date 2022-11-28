<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\Commerciale;
use App\Models\Marque;
use App\Models\Modele;
use Illuminate\Http\Request;
use App\Models\Vente;
use App\Models\Stock;
use App\Models\Moto;


class DataController extends BaseController
{
    
    

    public function StockListPaginate ($page) {
        try {
            $stocks = Stock::with('moto')->paginate(10, ['*'], 'page', $page);
            return $this->sendResponse($stocks, 'Liste des stocks récupérés avec succès');
        } catch (\Throwable $th) {
            return $this->sendError('Une erreur est survenue', $th->getMessage());
        }
    }



public function MotoListPaginate ($page , $numero_stock) {
    try {
        $motos = Moto::where('numero_stock', $numero_stock)->paginate(10, ['*'], 'page', $page);
        if(count($motos) > 0) {
            return $this->sendResponse($motos, 'Liste des motos');
        } else {
            return $this->sendError('Aucune moto');
        }
    } catch (\Throwable $th) {
        return $this->sendError('Une erreur est survenue', $th->getMessage());
    }

}

public function TodayVenteListPaginate ($page) {
    try {
        $today = date('Y-m-d');
        $ventes = Vente::where('created_at',$today)->paginate(10, ['*'], 'page', $page);
        if(count($ventes) > 0) {
            return $this->sendResponse($ventes, 'Liste des ventes');
        } else {
            return $this->sendError('Aucune vente');
        }
    } catch (\Throwable $th) {
        return $this->sendError('Une erreur est survenue', $th->getMessage());
    }
}

public function CommercialeListpaginate($page) {
    try {
        $commerciales = Commerciale::paginate(10, ['*'], 'page', $page);
        if(count($commerciales) > 0) {
            return $this->sendResponse($commerciales, 'Liste des commerciales');
        } else {
            return $this->sendError('Aucune commerciale');
        }
    } catch (\Throwable $th) {
        return $this->sendError('Une erreur est survenue', $th->getMessage());
    }
}
public function MarqueListPaginate($page) {
    try {
        $marques = Marque::paginate(10, ['*'], 'page', $page);
        if(count($marques) > 0) {
            return $this->sendResponse($marques, 'Liste des marques');
        } else {
            return $this->sendError('Aucune marque');
        }
    } catch (\Throwable $th) {
        return $this->sendError('Une erreur est survenue', $th->getMessage());
    }
}
public function ModeleListPaginate($page) {
    try {
        $modeles = Modele::paginate(10, ['*'], 'page', $page);
        if(count($modeles) > 0) {
            return $this->sendResponse($modeles, 'Liste des modeles');
        } else {
            return $this->sendError('Aucun modele');
        }
    } catch (\Throwable $th) {
        return $this->sendError('Une erreur est survenue', $th->getMessage());
    }
}


public function getSellByStatutEnCours($page) {
    try{
        $ventes = Vente::where('statut' , 'en_cours')->paginate(10, ['*'], 'page', $page);
        if(count($ventes) > 0) {
            return $this->sendResponse($ventes, 'Liste des ventes');
        } else {
            return $this->sendError('Aucune vente');
        }
    }
    catch (\Throwable $th) {
        return $this->sendError('Une erreur est survenue', $th->getMessage());
    }
}


public function getLastVente () {
    try{
        $vente = Vente::orderBy('id', 'desc')->first();
        if($vente) {
            return $this->sendResponse($vente, 'Derniere vente');
        } else {
            return $this->sendError('Aucune vente');
        }
    }
    catch (\Throwable $th) {
        return $this->sendError('Une erreur est survenue', $th->getMessage());
    }
}

}
