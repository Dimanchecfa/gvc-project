<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Sell\StoreSellRequest;
use App\Http\Requests\Sell\UpdateSellRequest;
use Illuminate\Http\Request;
use App\Models\Vente;
use App\Models\Moto;
use App\Models\Sell;
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
}
