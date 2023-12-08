<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use App\Models\Commune;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\LogUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function register(RegisterUser $request)
    {
        try {
            $user = new User();
            $user->nom = $request->nom;
            $user->prenom = $request->prenom;
            $user->lieu_residence = $request->lieu_residence;
            $user->date_naiss = $request->date_naiss;
            $user->email = $request->email;
            $user->commune_id = 1;
            $user->password = $request->password;
            $user->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Insertion reussi',
                'data' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }

    public function login(LogUserRequest $request)
    {
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = auth()->user();
            $token = $user->createToken('MA_CLE_SECRET')->plainTextToken;
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Utilisateur Connecté',
                'user' => $user,
                'token' => $token
            ]);
        } else {

            return response()->json([
                'status_code' => 403,
                'status_message' => 'Information invalide'
            ]);
        }
    }

    public function update(UpdateUserRequest $request, User $user){
        try {
            $user->nom = $request->nom;
            $user->prenom = $request->prenom;
            $user->date_naiss = $request->date_naiss;
            $user->email = $request->email;
            $user->lieu_residence = $request->lieu_residence;

            $user->save();
            return response()->json([
                'status_code' =>200,
                'status_message' => 'l/utilisateur a été modifié',
                'data'=>$user
            ]);
    
           } catch (Exception $e) {
             
             return response()->json($e);
           }
          }
}
