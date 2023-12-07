<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Mairie;
use App\Models\Commune;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommuneRequest;
use App\Http\Requests\UpdateCommuneRequest;

class CommuneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{

            return response()->json([
              'status_code' =>200,
              'status_message' => 'la liste des communes a été recuperé',
              'data'=> Commune::all()
          ]);

        } catch(Exception $e){
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
    public function store(StoreCommuneRequest $request)
    {
          
        try {
            $communes = new Commune();
            
            $communes->nom = $request->nom;
            $communes->region_id = $request->region_id;
        
    
            $communes->save();
    
            return response()->json([
                'status_code' =>200,
                'status_message' => 'la commune a été ajouté',
                'data'=>$communes
            ]);
    
           } catch (Exception $e) {
             
             return response()->json($e);
           }

    }

    /**
     * Display the specified resource.
     */
    public function show(Commune $commune)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commune $commune)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommuneRequest $request, Commune $commune)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commune $commune)
    {
        //
    }
}
