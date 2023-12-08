<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Vote;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVoteRequest;
use App\Http\Requests\UpdateVoteRequest;
use App\Models\Projet;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
        public function index()
    {
        try{

            return response()->json([
              'status_code' =>200,
              'status_message' => 'la liste des votes a été recuperé',
              'data'=>Vote::all()
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
    public function store(StoreVoteRequest $request, $id)
    {


        try{
            $projet =Projet::findOrFail($id);
        $user = Auth::user();
        $avis = new Vote();

        $avis->reponse = $request->reponse;
       $avis->projet_id = $projet->id;
       $avis->user_id = $user->id;
        $avis->save();
        return response()->json([
            'status_code' => 200,
            'status_message' => 'vote effectué avec succes',
            'data' => $avis
        ]);

        } catch(Exception $e){
            return response()->json($e);
        }
         }

    /**
     * Display the specified resource.
     */
    public function show(Vote $vote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vote $vote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVoteRequest $request, Vote $vote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vote $vote)
    {
        //
    }
}
