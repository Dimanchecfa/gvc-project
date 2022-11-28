<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Commerciale;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Commercial\StoreCommercialRequest;
use App\Models\Commercial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommercialController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $commerciales = Commercial::all();
           return $this->sendResponse($commerciales, 'Liste des commerciales récupérées avec succès');
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
    public function store(StoreCommercialRequest $request)
    {
        $validate = Validator::make($request->all(), [
           'nom' => 'required',
           'numero' => 'required',
            'pseudo' => 'required',
        ]);
        if($validate->fails()) {
            return $this->sendError('Veuillez remplir tous les champs', $validate->errors() , 400);
        }
        try {
          $input = $request->all();
          
              $commerciale = Commercial::create($input);
                return $this->sendResponse($commerciale, 'Commerciale créée avec succès');
        } catch (\Throwable $th) {
            return $this->sendError('Une erreur est survenue', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $commerciale = Commercial::find($id);
            return $this->sendResponse($commerciale, 'Commerciale récupérée avec succès');
        } catch (\Throwable $th) {
           return $this->sendError('Une erreur est survenue', $th->getMessage());
        }
    }
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commercial  $commercial
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCommercialRequest $request, Commercial $commercial)
    {
        try {
            $input = $request->all();
            $commercial->update($input);
            return $this->sendResponse($commercial, 'Commerciale mise à jour avec succès');
        } catch (\Throwable $th) {
            return $this->sendError('Une erreur est survenue', $th->getMessage());
        }
         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commercial  $commercial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commercial $commercial)
    {
        try {
            $commercial->delete();
            return $this->sendResponse($commercial, 'Commerciale supprimée avec succès');
        } catch (\Throwable $th) {
            return $this->sendError('Une erreur est survenue', $th->getMessage());
        }
    }
  
}
