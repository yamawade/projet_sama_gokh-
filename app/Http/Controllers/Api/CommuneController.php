<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Region;
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
        $communes=Commune::where('statut','activer')->get();
        try {

            return response()->json([
                'status_code' => 200,
                'status_message' => 'la liste des communes a été recuperé',
                'data' => $communes
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
    public function store(StoreCommuneRequest $request)
    {

        try {
            $communes = new Commune();

            $communes->nom = $request->nom;
            $communes->commune_desc = $request->commune_desc;
            $communes->region_id = $request->region_id;


            $communes->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'la commune a été ajouté',
                'data' => $communes
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
        try {
            // $region=new Region();

            $commune->nom = $request->nom;
            // $commune->statut=$request->statut;
            // $commune->is_disponible=$request->is_disponible;
            // $commune->region_id=$request->$region->id;
            // dd($commune);
            $commune->update();


            return response()->json([
                "status_code" => 200,
                "status_messages" => "La commune a ete Modifier",
                "data" => $commune
            ]);
        } catch (Exception $e) {

            response()->json($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commune $commune)
    {
        //
    }
    public function delete(Commune $commune)
    {
        //
        try {

            $commune->statut = "desactiver";
            $commune->save();
            return response()->json([
                "status_code" => 200,
                "status_messages" => "La commune a ete Supprimer avec succes",
                "data" => $commune
            ]);
        } catch (Exception $e) {

            response()->json($e);
        }
    }
}
