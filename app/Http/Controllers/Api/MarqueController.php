<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Marque;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Marque\StoreMarqueRequest;
use App\Http\Requests\Marque\UpdateMarqueRequest;
use Illuminate\Http\Request;

class MarqueController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $marques = Marque::all()->load('modeles');
            return $this -> sendResponse($marques, 'Liste des marques récupérées avec succès');
        } catch (\Throwable $th) {
            return  $this -> sendError('Une erreur est survenue', $th->getMessage());
        }
    }
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMarqueRequest $request)
    {
        try {
            $marque = Marque::create($request->all());
            return $this -> sendResponse( $marque ,'Marque ajoutée avec succès',);
        } catch (\Throwable $th) {
            return $this -> sendError('Une erreur est survenue', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param   Marque $marque $id
     * @return \Illuminate\Http\Response
     */
    public function show(Marque $marque)
    {
        try {
            return $this -> sendResponse($marque, 'Marque récupérée avec succès');
        } catch (\Throwable $th) {
            return $this -> sendError('Une erreur est survenue', $th->getMessage());
        }
    }
   
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Marque $marque $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMarqueRequest $request, Marque $marque)
    {
        try {
            $marque->update($request->all());


                return $this->sendResponse($marque ,'Marque modifiée avec succès');
        } catch (\Throwable $th) {
            return $this->sendError('Une erreur est survenue', $th->getMessage());
        }
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  Marque  $marque $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marque $marque)
    {
        try {
            $marque->delete();
            return $this->sendResponse($marque, 'Marque supprimée avec succès');
        } catch (\Throwable $th) {
            return $this->sendError('Une erreur est survenue', $th->getMessage());
        }
    }



}
