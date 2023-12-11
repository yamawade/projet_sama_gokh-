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
            'lieu_residence'=>'required',

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

            'nom.required'=>'Le nom doit etre fourni',
            'prenom.required'=>'le prenom doit etre fourni',
            'date_naiss.required' =>'la date de naissnace doit etre fourni',
            'email.required' => 'le email doit etre fourni',
            'lieu_residence.required' => 'le lieu de residence doit etre fourni',
        ];
    }
}
