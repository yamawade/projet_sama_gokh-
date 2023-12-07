<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreProjetRequest extends FormRequest
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
            'nom_projet' => 'required',
            'description_projet' => 'required',
            'date_projet' => 'required|date',
            'date_limite_vote' => 'required|date',
            'image' => 'required|image',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'status_code' => 422,
            'error' => true,
            'message' => 'Erreur de validation',
            'errorsList' => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'nom_projet.required' => 'Un nom de projet doit etre fourni',
            'description_projet.required' => 'Une description du projet doit etre fourni',
            'date_projet.required' => 'Une date de projet doit etre fourni',
            'date_limite_vote.required' => 'Une date limite de vote doit etre fourni',
            'image.required' => 'Une image doit etre fourni',
            'image.image' => 'Une image doit etre une image',
        ];
    }
}
