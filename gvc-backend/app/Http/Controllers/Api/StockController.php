<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Stock\StoreStockRequest;
use App\Http\Requests\Stock\UpdateStockRequest;
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
            $stock_response = Stock::find($stock->id)->load('moto');
            return $this->sendResponse($stock_response, 'Stock ajouté avec succès');
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
     * @param  Stock $stock $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStockRequest $request, Stock $stock)
    {
        try {
            $stock->update($request->all());
            $stock_response = Stock::find($stock->id)->load('moto');
            return $this->sendResponse($stock_response, 'Stock modifié avec succès');
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
