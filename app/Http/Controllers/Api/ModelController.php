<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Modele;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Marque\UpdateModelRequest;
use App\Http\Requests\Model\StoreModelRequest;
use App\Http\Requests\Model\UpdateModelRequest as ModelUpdateModelRequest;
use Illuminate\Support\Facades\Validator;

class ModelController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $modeles = Modele::all();
            return $this -> sendResponse($modeles, 'Liste des modèles récupérés avec succès');
        } catch (\Throwable $th) {
            return  $this -> sendError('Une erreur est survenue', $th->getMessage());
        }
    }

    /**
     * Model List Paginate and search
     * @param  \Illuminate\Http\Request $request
     */
    public function ModelListPaginate(Request $request , $marque_id , $page)
    {
        try {
            $search = $request->search;
            $model = Modele::where('marque_id', $marque_id)->where('nom', 'like', '%' . $search . '%')->paginate(10, ['*'], 'page', $page);
            return $this -> sendResponse($model, 'Liste des modèles récupérés avec succès');
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
    public function store(StoreModelRequest $request)
    {
        try {
            $modele = Modele::create($request->all());
            return $this -> sendResponse( $modele ,'Modèle ajouté avec succès',);
        } catch (\Throwable $th) {
            return $this -> sendError('Une erreur est survenue', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Modele  $modele $id
     * @return \Illuminate\Http\Response
     */
    public function show(Modele $modele)
    {
        try {
            return $this -> sendResponse($modele, 'Modèle récupéré avec succès');
        } catch (\Throwable $th) {
            return $this -> sendError('Une erreur est survenue', $th->getMessage());
        }
    }
  
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   Modele  $modele $id
     * @return \Illuminate\Http\Response
     */
    public function update(ModelUpdateModelRequest $request, Modele $modele)
    {
        try {
            $modele->update($request->all());
            return $this -> sendResponse($modele, 'Modèle modifié avec succès');
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Une erreur est survenue',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Modele  $modele 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Modele $modele)
    {
        try {
            $modele->delete();
            return $this -> sendResponse($modele, 'Modèle supprimé avec succès');
        } catch (\Throwable $th) {
            return $this -> sendError('Une erreur est survenue', $th->getMessage());
        }
    }

  

 
}
