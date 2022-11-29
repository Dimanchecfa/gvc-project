<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\Lot;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LotController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $lots = Lot::all()->load('registrations', 'registrations.sales', 'registrations.sales.moto', 'registrations.sales.commerciale');
            return $this->sendResponse(
                $lots,
                'Liste des lots récupérés avec succès'
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
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [

            'nom_depositaire' => 'required',
            'numero_depositaire' => 'required',

        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        try {
            if (Lot::all()->count() === 0) {
                $lotNumber = 'LOT' . '-' . '000';
            } else {
                $lastLot = Lot::orderBy('created_at', 'desc')->first();
                $lotNumber = 'LOT' . '-' . ($lastLot->id + 000);
            }
            $input['uuid'] = Str::uuid();
            $input['numero_lot'] = $lotNumber;
            $input['nombre_registrations'] = 0;
            $lots = Lot::create($input);
            return $this->sendResponse(
                $lots,
                'Lot ajouté avec succès'
            );
        } catch (\Throwable $th) {
            return $this->sendError(
                'Une erreur est survenue',
                $th->getMessage()
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Lot $lot $id
     * @return \Illuminate\Http\Response
     */
    public function show(Lot $lot)
    {
        try {
            return $this->sendResponse(
                $lot,
                'Lot récupéré avec succès'
            );
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
     * @param  Lot $lot $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lot $lot)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'numero_lot' => 'required',
            'nom_depositaire' => 'required',
            'numero_depositaire' => 'required',

        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        try {
            $lot->update($input);
            return $this->sendResponse(
                $lot,
                'Lot modifié avec succès'
            );
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
     * @param  Lot $lot $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $lot = Lot::find($id);
            $registrations = $lot->registrations;
            foreach ($registrations as $registration) {

                $registration->delete();
            }

            $lot->delete();

            return $this->sendResponse(
                $lot,
                'Lot supprimé avec succès'
            );
        } catch (\Throwable $th) {
            return $this->sendError(
                'Une erreur est survenue',
                $th->getMessage()
            );
        }
    }
}
