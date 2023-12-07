<?php

namespace App\Http\Controllers\Api;
use Exception;
use App\Models\Region;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRegionRequest;
use App\Http\Requests\UpdateRegionRequest;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try{
            return response()->json([
                "status_code"=>200,
                "status_messages"=>"Le poste ont ete recuperer",
                "data"=>Region::all()
            ]);
        }catch(Exception $e){

            response()->json($e);

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
    public function store(StoreRegionRequest $request)
    {
        //
        try{
            // dd( $Request);
        $region=new  Region();
        $region->nom=$request->nom;
       
        $region->save();
        return response()->json([
            "status_code"=>200,
            "status_messages"=>"La region a ete Ajouter",
            "data"=>$region
        ]);

        }catch(Exception $e){

            response()->json($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Region $region)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Region $region)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRegionRequest $request, Region $region)
    {
        
        try{

            $region->nom=$request->nom;
            $region->save();
            return response()->json([
                "status_code"=>200,
                "status_messages"=>"Le nom de la region a ete Modifier",
                "data"=>$region
            ]);
        }catch(Exception $e){
    
            response()->json($e);
    
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Region $region)
    {
        //
    
    }
    
    // public function delete(Region $region)
    // {
    //     //
    //     try{

        
    //         $region->delete();
    //         return response()->json([
    //             "status_code"=>200,
    //             "status_messages"=>"La region a ete Supprimer avec succes",
    //             "data"=>$region
    //         ]);
            
    //     }catch(Exception $e){
    
    //         response()->json($e);
    
    //     }
    
    // }
}
