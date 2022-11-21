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
                ->where('statut', 'termine')
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

    public function withDrawRegistration(Request $request, $uuid)
    {
        $validate = Validator::make($request->all(), [
            'withdrawal_authorName' => 'required',
            'withdrawal_authorId' => 'required',
        ]);
        if ($validate->fails()) {
            return $this->sendError('Validation Error', $validate->errors());
        }

        try {
            $registration = Registration::where('uuid', $uuid)->first();
            if ($registration) {
                if ($registration->statut == 'termine') {
                    return $this->sendError(
                        'Cette immatriculation est déjà retiree'
                    );
                }

                $registration->update([
                    'statut' => 'termine',
                    'is_withdraw' => true,
                    'withdrawal_authorName' => $request->withdrawal_authorName,
                    'withdrawal_authorId' => $request->withdrawal_authorId,
                ]);
                return $this->sendResponse(
                    $registration,
                    'Immatriculation retirée'
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
    public function addRegistration(Request $request , $lot_id)
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
