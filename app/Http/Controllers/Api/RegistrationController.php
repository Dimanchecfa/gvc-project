<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\Lot;
use App\Models\Registration;
use App\Models\Sell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegistrationController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $registration = Registration::all()->load('sales');
            return $this->sendResponse(
                $registration,
                'Liste des immatriculations'
            );
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }
    public function getFinishedRegistration()
    {
        try {
            $registration = Registration::with(
                'sales',
                'sales.moto',
                'sales.commerciale'
            )
                ->where('statut', 'termine')->where('is_withdraw', false)
                ->get();
            return $this->sendResponse(
                $registration,
                'Liste des immatriculations terminées'
            );
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    public function getInProgressRegistration()
    {
        try {
            $registration = Registration::with(
                'sales',
                'sales.moto',
                'sales.commerciale'
            )
                ->where('statut', 'en_cours')
                ->get();
            return $this->sendResponse(
                $registration,
                'Liste des immatriculations en cours'
            );
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }
    /**
     * withDraw a registration.
     * @param  Registration $registration , $uuid
     * @param  \Illuminate\Http\Request  $request
     */

    public function withDrawRegistration(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'withdrawal_authorName' => 'required',
            'withdrawal_authorNumber' => 'required',
            'withdrawal_authorId' => 'required',
        ]);
        if ($validate->fails()) {
            return $this->sendError('Validation Error', $validate->errors());
        }

        try {
            $registration = Registration::where('id', $id)->first();
            if ($registration) {
                if ($registration->statut == 'termine') {
                    $registration->update([
                        'statut' => 'termine',
                        'is_withdraw' => true,
                        'withdrawal_authorName' => $request->withdrawal_authorName,
                        'withdrawal_authorNumber' => $request->withdrawal_authorId,
                        'withdrawal_authorId' => $request->withdrawal_authorId,
                    ]);
                    return $this->sendResponse(
                        $registration,
                        'Immatriculation retirée avec succès'
                    );
                }


                return $this->sendError(
                    'Cette immatriculation n\'est pas terminée'
                );
            } else {
                return $this->sendError('Immatriculation non trouvée');
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }
    /**
     * update is_registred of a moto to true.
     * @param  Registration $registration , $uuid
     * @param  \Illuminate\Http\Request  $request
     */

    /**
     * Add a registration.
     * @param  \Illuminate\Http\Request  $request
     */
    public function addRegistration(Request $request, $lot_id)
    {
        $input = $request->all();

        try {
            foreach ($input as $key => $value) {
                $register = Registration::where('sale_id', $value)->first();
                $sell = Sell::where('id', $value)->first();
                if ($register) {
                    return $this->sendError(
                        'Cette immatriculation existe déjà'
                    );
                }
                if ($sell) {
                    $registration = Registration::create([
                        'uuid' => Str::uuid(),
                        'sale_id' => $value,
                        'lot_id' => $lot_id,
                        'statut' => 'en_cours',
                        'is_withdraw' => false,
                    ]);
                    $sell->registration_statut = 'enregistre';
                    $sell->save();
                } else {
                    return $this->sendError(
                        $value . ' n\'existe pas dans     {
                            //
                        }la liste des ventes'
                    );
                }
            }
            $regis = Registration::where('lot_id', $lot_id)->count();
            $lot = Lot::where('id', $lot_id)->first();
            $lot->nombre_registrations = $regis;
            $lot->save();


            return $this->sendResponse(
                $registration,
                'Toute  les immatriculations ont été ajoutées'
            );
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }


    public function fetchRegistrationByLot($lot_id)
    {
        try {
            $registration = Registration::with(
                'sales',
                'sales.moto',
                'sales.commerciale'
            )
                ->where('lot_id', $lot_id)
                ->get();
            return $this->sendResponse(
                $registration,
                'Liste des immatriculations par lot'
            );
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Registration $registration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registration $registration)
    {
        try {
            $registration->update($request->all());
            return $this->sendResponse(
                $registration,
                'Immatriculation mise à jour'
            );
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updateRegistration(Request $request)
    {

        try {
            $input = $request->all();
            foreach ($input as $key => $value) {
                $registration = Registration::where('id', $value)->first();
                if ($registration) {
                    $registration->update([
                        'statut' => 'termine',
                        'is_withdraw' => false,
                        'withdrawal_authorName' => null,
                        'withdrawal_authorNumber' => null,
                        'withdrawal_authorId' => null,
                    ]);
                } else {
                    return $this->sendError(
                        $value . ' n\'existe pas dans la liste des immatriculations'
                    );
                }
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    public function fetchRegisteredRegistration()
    {
        try {
            $registration = Registration::with('sales', 'sales.moto', 'sales.commerciale')
                ->where('statut', 'en_cours')
                ->whereHas('sales', function ($query) {

                    $query->where('registration_statut', 'enregistre');
                })->get();
            return $this->sendResponse($registration, 'Liste d\'immatriculation enregistrée');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }
}
