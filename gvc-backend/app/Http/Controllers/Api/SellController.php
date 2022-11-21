<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Sell\StoreSellRequest;
use App\Http\Requests\Sell\UpdateSellRequest;
use Illuminate\Http\Request;
use App\Models\Vente;
use App\Models\Moto;
use App\Models\Sell;
use Carbon\Carbon;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Str;
//validator
use Illuminate\Support\Facades\Validator;

class SellController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $ventes = Sell::with('moto' , 'commerciale')->get();
            return $this->sendResponse(
                $ventes,
                'Liste des ventes récupérées avec succès'
            );
        } catch (\Throwable $th) {
            return $this->sendError(
                'Une erreur est survenue',
                $th->getMessage()
            );
        }
    }


   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSellRequest $request)
    {
        $input = $request->all();
        $numero = Moto::where('id', $input['moto_id'])->first();
        if ($numero) {
            if ($numero->statut == 'vendue') {
                return $this->sendResponse (
                    $numero,
                    'Cette moto a déjà été vendue'
                );
            }
            try {
                if (Sell::all()->count() < 1) {
                    $facture = 'FAC-0001';
                } else {
                    $lastFacture = Sell::orderBy('id', 'desc')->first();
                    $facture = 'FAC-' . '000' . ($lastFacture->id + 1);
                }
                $input['numero_facture'] = $facture;

                $sell = Sell::create($input);
                $moto = Moto::where(
                    'id',
                    $request->input('moto_id')
                )->first();
                $moto->statut = 'vendue';
                $moto->save();
                return $this->sendResponse($sell, 'Vente ajoutée avec succès');
            } catch (\Throwable $th) {
                return $this->sendError(
                    'Une erreur est survenue',
                    $th->getMessage()
                );
            }
        } else {
            return $this->sendResponse(
                $numero,
                'Cette moto n\'existe pas'
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sell  $vente
     * @return \Illuminate\Http\Response
     */
    public function show(Sell $vente)
    {
        try {
            return $this->sendResponse($vente, 'Vente récupérée avec succès');
        } catch (\Throwable $th) {
            return $this->sendError(
                'Une erreur est survenue',
                $th->getMessage()
            );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSellRequest $request, Sell $sell)
    {
        try {
            $input = $request->all();
            $sell->update($input);
            return $this->sendResponse($sell, 'Vente mise à jour avec succès');
        } catch (\Throwable $th) {
            return $this->sendError(
                'Une erreur est survenue',
                $th->getMessage()
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sell $sell)
    {
        try {
            $moto = Moto::where('id', $sell->moto_id)->first();
            $moto->statut = 'en_stock';
            $moto->save();
            $sell->delete();
            return $this->sendResponse($sell, 'Vente supprimée avec succès');
        } catch (\Throwable $th) {
            return $this->sendError(
                'Une erreur est survenue',
                $th->getMessage()
            );
        }
    }
    /**
     * get all sell statut -non_paye-
     * @return \Illuminate\Http\Response
     */

    public function  getInprogressSales(){
        try {
            $ventes = Sell::with('moto' , 'commerciale')->where('statut' , 'en_cours')->get();
            if(count($ventes) > 0) {
                return $this->sendResponse($ventes, 'Ventes avec statut non payé');
            } else {
                return $this->sendResponse($ventes, 'Aucune vente non payée');
            }
        } catch (\Throwable $th) {
            return  $this->sendError('Une erreur est survenue', $th->getMessage());
        }
    }
     /**
     * get all sell statut -paye-
     * @return \Illuminate\Http\Response
     */

    public function  getFinishedSalesAndNoRegistredAndMotoCertificat(){
        try {
            $ventes = Sell::with('moto' , 'commerciale')->where('statut' , 'paye')->where('is_registred' , 0)->where('is_certificat' , 1)->get();
            if(count($ventes) > 0) {
                return $this->sendResponse($ventes, 'Ventes avec statut non payé');
            } else {
                return $this->sendResponse($ventes, 'Aucune vente non payée');
            }
        } catch (\Throwable $th) {
            return  $this->sendError('Une erreur est survenue', $th->getMessage());
        }
    }

    /**
     * update inprogress sell to finished
     * @return \Illuminate\Http\Response
     * @param \App\Models\Sell $sell $uuid
     */

     public function updateSellPayement(Request $request, $uuid) {
        $validate = Validator::make($request->all(), [
            'amount' => 'required|numeric',
        ]);
        if($validate->fails()) {
            return $this->sendError('Une erreur est survenue', $validate->errors());
        }
          
        try {
            $input = $request->all();
             $sell = Sell::where('uuid', $uuid)->first();
             $date = $sell->date_limite;
             $now = Carbon::now();
             $penality = 0;
             $penalite_permonth = 25000;
                if($now > $date) {
                    $time = $now->diffInDays($date);
                    $time_month = $time / 30;
                    $penality_time = ceil($time_month);
                    $day_rest = $penality_time - $time_month * 10;
                    $day_rest_penality = ($day_rest * $penalite_permonth ) / 30;
                    $penality = $penality_time * $penalite_permonth + $day_rest_penality;
                    $sell->montant_restant = $sell->montant_restant + $penality;
                }



        } catch (\Throwable $th) {
            return $this->sendError(
                'Une erreur est survenue',
                $th->getMessage()
            );
        }
     }
     
}
