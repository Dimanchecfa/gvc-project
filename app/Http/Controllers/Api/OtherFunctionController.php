<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\Commercial;
use Illuminate\Http\Request;
use App\Models\Modele;
use App\Models\Moto ;
use App\Models\Commerciale ;
use App\Models\Registration;
use App\Models\Sell;
use App\Models\Stock;
use App\Models\Vente ;
use Illuminate\Support\Facades\Validator;

class OtherFunctionController extends BaseController
{



    public function addMotors( Request $request) {
        $validate = Validator::make($request->all() , [
            "numero_stock" => "required|string|max:255",
            "numero_serie" => "required|string|max:255",
            "marque" => "required|string|max:255",
            "modele" => "required|string|max:255",
            "couleur" => "required|string|max:255",
        ]);
        if($validate->fails()) {
            return $this -> sendError('Veuillez remplir tous les champs', $validate->errors() , 400);
        }
        try {
            $moto = Moto::create($request->all());
            $stock = Stock::where('numero', $request->numero_stock)->first();
            $nombre = $stock->nombre_moto + 1;
            $stock->nombre_moto = $nombre;
            $stock->save();
            return $this -> sendResponse( $moto ,'Moto ajoutée avec succès',);
        } catch (\Throwable $th) {
            return $this -> sendError('Une erreur est survenue', $th->getMessage());
        }
    }




    
    public function getMotoByStock($numero_stock)
    {
        try {
            $motos = Moto::where('numero_stock', $numero_stock)->get();
           if (count($motos) > 0) {
                return $this->sendResponse($motos, 'Motos du stock');
            } else {
                return $this->sendResponse($motos ,'Aucune moto dans ce stock');
            }
        } catch (\Throwable $th) {
           return $this->sendError('Une erreur est survenue', $th->getMessage());
        }
    }

    public function getMotoByMarque($marque)
    {
        try {
            $motos = Moto::where('marque', $marque)->get();
           if (count($motos) > 0) {
                return $this->sendResponse($motos, 'Motos de la marque');
            } else {
                return $this->sendError('Aucune moto de cette marque');
            }

        } catch (\Throwable $th) {
            return $this->senError('Une erreur est survenue', $th->getMessage(), 500);
        }
    }
     
    public function getMotoByStatut($statut)
    {
        try {
            $motos = Moto::where('statut', $statut)->get();

            if(count($motos) > 0) {
                return $this->sendResponse($motos, 'Motos du statut');
            } else {
                return $this->sendError('Aucune moto de ce statut');
            }
        } catch (\Throwable $th) {
            return $this->sendError('Une erreur est survenue', $th->getMessage());
        }
    }
    public function getModeleByMarque($marque_nom) {
        try {
            $modeles = Modele::where('marque_nom', $marque_nom)->get();
            if(count($modeles) > 0) {
                return $this->sendResponse($modeles, 'Modèles de la marque');
            } else {
                return $this->sendResponse($modeles, 'Aucun modeles de la marque');
            }
        } catch (\Throwable $th) {
            return  $this->sendError('Une erreur est survenue', $th->getMessage());
        }
    }

    public function getCommercialeByPseudo ($pseudo) {
        try {
            $commerciales = Commercial::where('pseudo', $pseudo)->get();
            if(count($commerciales) > 0) {
                return $this->sendResponse($commerciales, 'Commerciales du pseudo');
            } else {
                return $this->sendError('Aucune commerciale de ce pseudo');
            }
        } catch (\Throwable $th) {
            return  $this->sendError('Une erreur est survenue', $th->getMessage());
        }
    }

    public function getVenteByNumeroSerie($numero_serie) {
        try{
            $vente = Vente::where('numero_serie', $numero_serie)->get();
            if(count($vente) > 0) {
                return $this->sendResponse($vente, 'Vente du numéro de série');
            } else {
                return $this->sendResponse($vente, 'Aucune vente de ce numéro de série');
            }
        }
        catch (\Throwable $th) {
            return  $this->sendError('Une erreur est survenue', $th->getMessage());
        }
    }

    public function getAllSellStatutPayé () {
        try {
            $ventes = Sell::where('statut', 'payé')->get();
            if(count($ventes) > 0) {
                return $this->sendResponse($ventes, 'Ventes avec statut payé');
            } else {
                return $this->sendResponse($ventes, 'Aucune vente payée');
            }
        } catch (\Throwable $th) {
            return  $this->sendError('Une erreur est survenue', $th->getMessage());
        }
    }
    public function  getAllSellStatutNonPayé () {
        try {
            $ventes = Sell::where('statut', 'en_cours')->get();
            if(count($ventes) > 0) {
                return $this->sendResponse($ventes, 'Ventes avec statut non payé');
            } else {
                return $this->sendResponse($ventes, 'Aucune vente non payée');
            }
        } catch (\Throwable $th) {
            return  $this->sendError('Une erreur est survenue', $th->getMessage());
        }
    }


    public function getAllMotoVendue () {
        try {
            $motos = Moto::where('statut', 'vendue')->get();
            if(count($motos) > 0) {
                return $this->sendResponse($motos, 'Motos vendues');
            } else {
                return $this->sendResponse($motos, 'Aucune moto vendue');
            }
        } catch (\Throwable $th) {
            return  $this->sendError('Une erreur est survenue', $th->getMessage());
        }
    }
    public function getFinishedRegistration()
    {
        try {
            $registration = Registration::where('statut', 'terminé')->load('sales')->get();
            return $this->sendResponse($registration, 'Liste des immatriculations terminées');
        }
        catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    public function getInProgressRegistration()
    {
        try {
            $registration = Registration::where('statut', 'en_cours')->load('sales');
            return $this->sendResponse($registration, 'Liste des immatriculations en cours');
        }
        catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }
     
}
    

