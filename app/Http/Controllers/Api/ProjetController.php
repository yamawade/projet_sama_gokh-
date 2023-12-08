<?php

namespace App\Http\Controllers\Api;

use App\Models\Projet;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProjetRequest;
use App\Http\Requests\UpdateProjetRequest;

class ProjetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
    public function store(StoreProjetRequest $request)
    {
        try {
            $projet = new Projet();
            $user = Auth::user();
            //dd($user);
            $mairie = Auth::guard('mairie')->user();
            //$mairie = auth()->guard('mairie')->user();
            //dd($mairie);
            // $projet->nom = $request->nom_projet;
            // $projet->description = $request->description_projet;
            // $projet->date_projet = $request->date_projet;
            // $projet->date_limite_vote = $request->date_limite_vote;
            // if ($request->hasFile('image')) {
            //     $path = $request->file('image')->store('images', 'public');
            //     $projet->image = $path;
            // }
            // if ($mairie) {
            //     $projet->mairie_id = $mairie->id;
            //     $projet->user_id = null;
            // } else if ($user) {
            //     $projet->user_id = $user->id;
            //     $projet->mairie_id = null;
            // } else {
            //     abort('403');
            // }
            if($user = Auth::user()){
                $maireTable = $user->getTable();
                if ($maireTable === "mairies") {
                    $maireid = $user->id;
                    $userid = null;
                } elseif ($maireTable === "users") {
                    $userid = $user->id;
                    $maireid = null;
                    //dd($userid);
                }

                $projet->nom = $request->nom_projet;
                $projet->description = $request->description_projet;
                $projet->date_projet = $request->date_projet;
                $projet->date_limite_vote = $request->date_limite_vote;
                if ($request->hasFile('image')) {
                    $path = $request->file('image')->store('images', 'public');
                    $projet->image = $path;
                }

                $projet->mairie_id = $maireid;
                $projet->user_id = $userid;
            }

            // } else if ($user) {
            //     $projet->user_id = $user->id;
            //     // dd('ooo');
            //     $projet->mairie_id = 1;
            // } else {

            //     abort('403');
            // }

            if ($projet->save()) {
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Insertion reussi',
                    'data' => $projet
                ]);
            } else {
                dd('error');
            }

            // dd($user);


        } catch (\Exception $e) {
            return response()->json($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Projet $projet)
    {
        try {
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Details Projet',
                'data' => $projet
            ]);
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Projet $projet, UpdateProjetRequest $request)
    {
        dd('ok');
        try {
            dd('leye');
            if ($projet->user_id == auth()->user()->id) {
                $projet->nom = $request->nom_projet;
                $projet->description = $request->description_projet;
                $projet->date_projet = $request->date_projet;
                $projet->date_limite_vote = $request->date_limite_vote;
                if ($request->hasFile('image')) {
                    $path = $request->file('image')->store('images', 'public');
                    $projet->image = $path;
                }
                if ($projet->save()) {
                    return response()->json([
                        'status_code' => 200,
                        'status_message' => 'Projet successfully update',
                        'data' => $projet
                    ]);
                } else {
                    dd('error');
                }
            }
            if ($projet->mairie_id == Auth::guard('mairie')->user()->id) {
                $projet->nom = $request->nom_projet;
                $projet->description = $request->description_projet;
                $projet->date_projet = $request->date_projet;
                $projet->date_limite_vote = $request->date_limite_vote;
                if ($request->hasFile('image')) {
                    $path = $request->file('image')->store('images', 'public');
                    $projet->image = $path;
                }
                if ($projet->save()) {
                    return response()->json([
                        'status_code' => 200,
                        'status_message' => 'Projet successfully update',
                        'data' => $projet
                    ]);
                } else {
                    dd('error');
                }
            }




            // dd($user);


        } catch (\Exception $e) {
            return response()->json($e);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjetRequest $request, Projet $projet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Projet $projet)
    {
        if ($projet->user_id == auth()->user()->id) {
            $projet->status = 'deleted';
        }
        if ($projet->mairie_id == Auth::guard('mairie')->user()->id) {
            $projet->status = 'deleted';
        }
    }
}
