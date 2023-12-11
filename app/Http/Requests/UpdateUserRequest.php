<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateUserRequest extends FormRequest
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
            'nom'=>'required',
            'prenom'=>'required',
            'date_naiss'=>'required',
            'email'=>'required',
            'lieu_residence'=>'required'

        ];
    }

    public function failedValidation(Validator $validator): array
    {
        throw new HttpResponseException(response()->json([

            'success'=>false,
            'error'=>true,
            'message'=>'Erreure de validation',
            'errorsListe'=> $validator->errors(),
        ]

        )); 
    }
    public function messages()
    {
        return [

            'nom.required'=>'Le nom a été modifier avec succes',
            'prenom.required'=>'le prenom a été modifier avec succes',
            'date_naiss.required' =>'la date de naissnace a été modifier avec succes',
            'email.required' => 'le email a été modifier avc succes',
            'lieu_residence.required' => 'le lieu de residence a été modifier avec succes'
        ];
    }
}
