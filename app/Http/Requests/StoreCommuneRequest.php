<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreCommuneRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
   
    public function rules(): array
    {
        return [
             'nom' => 'required|string',
             'commune_desc' => 'required|string'
             

        ];
    }
    public function failedValidation(validator $validator){
        throw new HttpResponseException(response()->json([
            'success'=>false,
            'error'=>true,
            'message'=> 'Erreur de validation',
            'errorsList'=> $validator->errors()
        ]));
    }
     public function messages()
     {
        return [
            'nom.required' => 'un nom doit etre fourni',
            'commune_desc.required' => 'une description doit etre fourni',
        ];
     }

}
