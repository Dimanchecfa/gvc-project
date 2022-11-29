<?php

namespace App\Http\Requests\Commercial;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Str;

class StoreCommercialRequest extends FormRequest
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
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'uuid' => Str::uuid(),
        ]);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // dd($this);
        return [
            'nom' => 'required',
            'prenom' => 'required',
            'numero' => 'required',
            'identifiant' => 'required',
            'numero_ifu' => 'required',
            'pseudo' => 'required',
            'adresse' => 'required',
            'logo' => 'file|image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'errors'   => $validator->errors()
        ], 400));
    }
}
