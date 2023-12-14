<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use App\Models\Vote;
use App\Models\Projet;
use App\Notifications\VoteMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreVoteRequest;
use App\Http\Requests\UpdateVoteRequest;


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
    public function store(StoreVoteRequest $request,$id)
    {
        try {
            $projet =Projet::findOrFail($id);
            $user = Auth::user();
            // $vote = Vote::where('user_id', $user->id)
            // ->where('projet_id', $projet->id)
            // ->first();

            // if(isset($vote)){
            //     return response()->json([
            //         'status_code'=>600,
            //         'status_message'=>'Vous avez deja voté'
            //     ]);
            // }else{
                $avis = new Vote();

                $avis->reponse = $request->reponse;
                $avis->projet_id = $projet->id;
                $avis->user_id = $user->id;
                if($avis->save()){
                    $userMail=User::find($user->id);
                    $userMail->notify(new VoteMail());
                    return response()->json([
                        'status_code'=>200,
                        'status_message'=>'Le vote a été effectué',
                        'data'=>$avis
                    ]);
                }
            // }



        } catch (Exception $e) {
            return response()->json($e);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show($projet)
    {
        $vote=Vote::where('projet_id',$projet)->get();
        return response()->json([
            'status_code'=>200,
            'status_message'=>'Les votes du projet',
            'data'=>$vote
        ]);
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
