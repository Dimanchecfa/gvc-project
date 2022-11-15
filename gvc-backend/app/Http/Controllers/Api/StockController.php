<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Stock\StoreStockRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StockController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $stocks = Stock::all()->load('moto');
            return $this->sendResponse($stocks, 'Liste des stocks récupérés avec succès');
        } catch (\Throwable $th) {
            return $this->sendError('Une erreur est survenue', $th->getMessage());
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStockRequest $request)
    {
        try {
            if (Stock::all()->count() === 0) {
                $stockNumber = 'STOCK' . '-' . '000';
            } else {
                $lastStock = Stock::orderBy('created_at', 'desc')->first();
                $stockNumber = 'STOCK' . '-' . ($lastStock->id + 000);
            }
            $input = $request->all();
            $input['numero'] = $stockNumber;
            $input['nombre_moto'] = 0;
            $stock = Stock::create($input);
            return $this->sendResponse($stock, 'Stock ajouté avec succès');
        } catch (\Throwable $th) {
            return $this->sendError('Une erreur est survenu', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Stock $stock $id
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        try {
            return $this->sendResponse($stock, 'Stock récupéré avec succès');
        } catch (\Throwable $th) {
            return $this->sendError('Une erreur est survenue', $th->getMessage());
        }
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'nom_fournisseur' => 'required',
            'numero_fournisseur' => 'required',
        ]);
        if ($validate->fails()) {
            return $this->sendError('Veuillez remplir tous les champs', $validate->errors(), 400);
        }
        try {
            $stock = Stock::find($id);
            if (is_null($stock)) {
                return $this->sendError('Stock non trouvé');
            }
            $stock->update($request->all());
            return $this->sendResponse($stock, 'Stock modifié avec succès');
        } catch (\Throwable $th) {
            return $this->sendError('Une erreur est survenue', $th->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $stock = Stock::find($id);
            if (is_null($stock)) {
                return $this->sendError('Stock non trouvé');
            }
            $stock->delete();
            return $this->sendResponse($stock, 'Stock supprimé avec succès');
        } catch (\Throwable $th) {
            return $this->sendError('Une erreur est survenue', $th->getMessage());
        }
    }
}
