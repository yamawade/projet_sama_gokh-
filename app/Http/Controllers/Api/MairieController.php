<?php

namespace App\Http\Controllers\Api;

use App\Models\Mairie;
use App\Models\Commune;
use App\Http\Requests\LoginMairie;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterMairie;
use App\Http\Requests\StoreMairieRequest;
use App\Http\Requests\UpdateMairieRequest;

class MairieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

    public function registerMairie(RegisterMairie $request){
        try {
            $mairie = new Mairie();
           // $commune=Commune::findOrFail($id);
            $mairie->email = $request->email;
            $mairie->password = $request->password;
            $mairie->matricule = $request->matricule;
            $mairie->login = $request->login;
            $mairie->commune_id=1;
            $mairie->image = $request->image;
            $mairie->save();
        
            return response()->json([
                'status_code'=>200,
                'status_message'=>'Insertion reussi',
                'data'=>$mairie
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
        
       
    }

    public function loginMairie(LoginMairie $request){
        $mairie=Auth::guard('mairie')->attempt(['login'=>$request->login,'password'=>$request->password]);
        //dd($mairie);
        if($mairie){
            $mairie=auth()->guard('mairie')->user();
            $token= $mairie->createToken('MA_CLE_SECRET_MAIRIE')->plainTextToken;

            return response()->json([
                'status_code'=>200,
                'status_message'=>'Utilisateur Connecté',
                'user'=>$mairie,
                'token'=>$token
            ]);

        }else{

            return response()->json([
                'status_code'=>403,
                'status_message'=>'Information invalide'
            ]);
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
