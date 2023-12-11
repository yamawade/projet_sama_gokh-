<?php

namespace App\Http\Controllers\Api;

use App\Models\Projet;
use App\Models\Commentaire;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCommentaireRequest;
use App\Http\Requests\UpdateCommentaireRequest;

class CommentaireController extends Controller
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
    public function store(StoreCommentaireRequest $request,$id)
    {
        try {
            $projet=Projet::findOrFail($id);
            $comment= new Commentaire();
            $comment->description=$request->description;
            $comment->projet_id=$projet->id;
            $user = auth()->user();
            $comment->user_id=$user->id;
            $comment->save();

            return response()->json([
                'status_code'=>200,
                'status_message'=>'Le commentaire a ete ajouté',
                'data'=>$comment
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Commentaire $commentaire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commentaire $commentaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentaireRequest $request, $id)
    {
        try {
            $commentaire=Commentaire::findOrFail($id);
            $commentaire->description=$request->description;
            if($commentaire->user_id==auth()->user()->id){
                $commentaire->save();
            }else{

                return response()->json([
                    'status_code'=>422,
                    'status_message'=>'Vous n\'etes pas l\'auteur de ce commentaire'
                ]);
            }
            return response()->json([
                'status_code'=>200,
                'status_message'=>'Le commentaire a ete modifié',
                'data'=>$commentaire
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $commentaire=Commentaire::findOrFail($id);
            if($commentaire->user_id==auth()->user()->id){
                $commentaire->delete();
            }else{
    
                return response()->json([
                    'status_code'=>422,
                    'status_message'=>'Vous n\'etes pas l\'auteur de ce commentaire'
                ]);
            }
            
    
            return response()->json([
                'status_code'=>200,
                'status_message'=>'Le commentaire a ete supprimé',
                'data'=>$commentaire
            ]);
           }catch (Execption $e) {
                return response()->json($e);
           }
    }
}
