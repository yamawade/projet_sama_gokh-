<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterMairie extends FormRequest
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
            'email'=>'required|unique:users,email',
            'password'=>'required',
            'matricule'=>'required',
            // 'image'=>'required|image',
            'nom_maire'=>'required|string',
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'success'=>false,
            'status_code'=>422,
            'error'=>true,
            'message'=>'Erreur de validation',
            'errorsList'=> $validator->errors()
        ]));
    }

    public function messages(){
        return[
            'email.required'=>'Un email doit etre fourni',
            'email.unique'=>'L\'adresse mail existe deja',
            'password.required'=>'Un mot de passe doit etre fourni',
            // 'image.required'=>'Un image doit etre fourni',
            'nom.required'=>'Un nom doit etre fourni',
        ];
    }
}
