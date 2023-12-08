<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Commune;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\LogUserRequest;
use App\Notifications\UserRegisterMail;
use Illuminate\Support\Facades\Session;

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
            $user->commune_id = 2;
            $user->password = $request->password;
            if($user->save()){
                $user->notify(new UserRegisterMail());
            }

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
    public function logout(Request $request)
    {
       $user=auth()->user();
       if($user->tokens()->delete()){
        Session::invalidate();
        return response()->json([
            'status_code' => 200,
            'status_message' => 'Utilisateur déconnecté'
        ]);
       }
    }

    public function verifMail(Request $request){
        $user=User::where('email',$request->email)->first();
       // dd($user);
        if($user){
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Utilisateur trouvé',
                'user' => $user,
            ]);
        }

    }
    public function resetPassword(Request $request,User $user){
        $user->password=$request->password;
        $user->save();
       //dd($user);
        if($user){
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Votre mot de passe a été modifier',
                'user' => $user,
            ]);
        }

    }

    public function desactiverCompte(Request $request,User $user){
        $user=auth()->user();
        if($user->etat_compte=='activer'){
            $user->etat_compte='desactiver';
            $user->save();
            if($user->tokens()->delete()){
                Session::invalidate();
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Votre compte a ete supprimer'
                ]);
            }
        }
        
    }
}
