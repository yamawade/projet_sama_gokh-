<?php

namespace App\Http\Controllers\Api;

use App\Models\Mairie;
use App\Models\Commune;
use Illuminate\Http\Request;
use App\Http\Requests\LoginMairie;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterMairie;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreMairieRequest;
use App\Http\Requests\UpdateMairieRequest;

class MairieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            return response()->json([
                'status_code' => 200,
                'status_message' => 'la liste des mairie a été recuperé',
                'data' => Mairie::all()
            ]);
        } catch (Exception $e) {
            return response($e)->json($e);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMairieRequest $request)
    {
        //
    }

    public function registerMairie(RegisterMairie $request)
    {
        try {
            $mairie = new Mairie();
           // $commune=Commune::findOrFail($id);
            $mairie->email = $request->email;
            $mairie->password = $request->password;
            $mairie->matricule = $request->matricule;
            $mairie->login = $request->login;
            $mairie->commune_id = $request->commune_id;
            $mairie->nom_maire = $request->nom_maire;
            //$mairie->image = $request->image;
            if ($request->file('image')) {
                $file = $request->file('image');
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('images'), $filename);
    

                $mairie->image = $filename;
            }

            $commune = Commune::find($request->commune_id);
           
            if ($commune->is_disponible=='indisponible') {
                return response()->json([
                    'status_code' => 403,
                    'status_message' => 'La commune est déjà occupée par un maire.'
                ]);
            }else{
                $commune->is_disponible = 'indisponible';
                //mettre a jour la table commune
                $commune->save();

                $mairie->save();
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Insertion reussi',
                    'data' => $mairie
                ]);
            }
    
            
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }

    public function loginMairie(LoginMairie $request)
    {
        $mairie = Auth::guard('mairie')->attempt(['login' => $request->login, 'password' => $request->password]);

        if ($mairie) {
            $mairie = auth()->guard('mairie')->user();
            // dd($mairie);
            $token = $mairie->createToken('MA_CLE_SECRET_MAIRIE')->plainTextToken;

            // dd(Auth::guard('mairie')->login($mairie));
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Utilisateur Connecté',
                'user' => $mairie,
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
    //    dd($user);
       if($user->tokens()->delete()){
        Session::invalidate();
        return response()->json([
            'status_code' => 200,
            'status_message' => 'Mairie déconnecté'
        ]);
       }else{

       }
    }
    /**
     * Display the specified resource.
     */
    public function show(Mairie $mairie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mairie $mairie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMairieRequest $request, Mairie $mairie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mairie $mairie)
    {
        //
    }
}
