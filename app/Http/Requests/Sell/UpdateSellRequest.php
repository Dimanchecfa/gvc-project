<?php

namespace App\Http\Requests\Sell;


use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateSellRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nom_client' => 'required|string|max:255',
            'prenom_client' => 'required|string|max:255',
            'numero_client' => 'required|string|max:255',
            'adresse_client' => 'required|string|max:255',
            'identifiant_client' => 'required|string|max:255',
            'prix_vente' => 'required|string|max:255',
            'montant_verse' => 'required|string|max:255',

         ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'errors'      => $validator->errors()
        ], 400));
    }
}
