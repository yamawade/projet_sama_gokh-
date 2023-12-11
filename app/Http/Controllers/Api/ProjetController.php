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
        try {
       $projets = Projet::with(['mairie:id,nom_maire,commune_id', 'mairie.commune:id,nom', 'user:id,nom,prenom,commune_id','user.commune:id,nom'])
       ->get(['id', 'nom', 'description', 'date_projet', 'date_limite_vote', 'image', 'etat_projet', 'mairie_id','user_id']);
       $infoprojets = $projets->map(function ($projet) {
        $auteur = $projet->user ? $projet->user->nom.' ' .$projet->user->prenom : $projet->mairie->nom_maire;
        $nomCommune = $projet->user ? $projet->user->commune->nom : $projet->mairie->commune->nom;

            return [
                'Nom du Projet' => $projet->nom,
                'Description' => $projet->description,
                'Date du Projet' => $projet->date_projet,
                'Date Limite de Vote' => $projet->date_limite_vote,
                'Image' => $projet->image,
                'État du Projet' => $projet->etat_projet,
                'Auteur du Projet' => $auteur,
                'Nom de la Commune' => $nomCommune,
            ];
        });
        return response()->json([
            'status_code' => 200,
            'status_message' => 'Liste de tous les projets',
            'data' => $infoprojets
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
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
    public function store(StoreProjetRequest $request)
    {
        try {
            $projet = new Projet();
            $user = Auth::user();
            $mairie = Auth::guard('mairie')->user();
            $projet->nom = $request->nom_projet;
            $projet->description = $request->description_projet;
            $projet->date_projet = $request->date_projet;
            $projet->date_limite_vote = $request->date_limite_vote;
            if ($request->file('image')) {
                $file = $request->file('image');
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('images'), $filename);
                $projet->image = $filename;
            }
            if ($mairie) {
                $projet->mairie_id = $mairie->id;
                $projet->user_id = null;
            } else if ($user) {
                $projet->user_id = $user->id;
                $projet->mairie_id = null;
            } else {
                abort('403');
            }
            if($user = Auth::user()){
                $maireTable = $user->getTable();
                if ($maireTable === "mairies") {
                    $maireid = $user->id;
                    $userid = null;
                } elseif ($maireTable === "users") {
                    $userid = $user->id;
                    $maireid = null;
                }

                $projet->nom = $request->nom_projet;
                $projet->description = $request->description_projet;
                $projet->date_projet = $request->date_projet;
                $projet->date_limite_vote = $request->date_limite_vote;
                if ($request->file('image')) {
                    $file = $request->file('image');
                    $filename = date('YmdHi') . $file->getClientOriginalName();
                    $file->move(public_path('images'), $filename);
                    $projet->image = $filename;
                }

                $projet->mairie_id = $maireid;
                $projet->user_id = $userid;
            }

            if ($projet->save()) {
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Insertion reussi',
                    'data' => $projet
                ]);
            } else {
                dd('error');
            }



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
        
        try {
           
            if ($projet->user_id == auth()->user()->id) {
                $projet->nom = $request->nom_projet;
                $projet->description = $request->description_projet;
                $projet->date_projet = $request->date_projet;
                $projet->date_limite_vote = $request->date_limite_vote;
                if ($request->file('image')) {
                    $file = $request->file('image');
                    $filename = date('YmdHi') . $file->getClientOriginalName();
                    $file->move(public_path('images'), $filename);
                    $projet->image = $filename;
                }
                if ($projet->save()) {
                    return response()->json([
                        'status_code' => 200,
                        'status_message' => 'Projet modifier avec succes',
                        'data' => $projet
                    ]);
                } else {
                    dd('error');
                }
            }else{
                return response()->json([
                    'status_code' => 403,
                    'status_message' => 'Vous n\'etes pas l\'auteur de ce projet.'
                ]);
            }
            if ($projet->mairie_id == Auth::guard('mairie')->user()->id) {
                $projet->nom = $request->nom_projet;
                $projet->description = $request->description_projet;
                $projet->date_projet = $request->date_projet;
                $projet->date_limite_vote = $request->date_limite_vote;
                if ($request->file('image')) {
                    $file = $request->file('image');
                    $filename = date('YmdHi') . $file->getClientOriginalName();
                    $file->move(public_path('images'), $filename);
                    $projet->image = $filename;
                }
                if ($projet->save()) {
                    return response()->json([
                        'status_code' => 200,
                        'status_message' => 'Projet modifier avec succes',
                        'data' => $projet
                    ]);
                } else {
                    dd('error');
                }
            }else{
                return response()->json([
                    'status_code' => 403,
                    'status_message' => 'Vous n\'etes pas l\'auteur de ce projet.'
                ]);
            }


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

    public function projetsParCommune($communeId)
{
    try {
        $projets = Projet::with(['mairie:id,nom_maire,commune_id', 'mairie.commune:id,nom,commune_desc', 'user:id,nom,prenom,commune_id','user.commune:id,nom,commune_desc'])
            ->whereHas('mairie.commune', function ($query) use ($communeId) {
                $query->where('id', $communeId);
            })
            ->orWhereHas('user.commune', function ($query) use ($communeId) {
                $query->where('id', $communeId);
            })
            ->get(['id', 'nom', 'description', 'date_projet', 'date_limite_vote', 'image', 'etat_projet', 'mairie_id','user_id']);

        $infoprojets = $projets->map(function ($projet) {
            $auteur = $projet->user ? $projet->user->nom . ' ' . $projet->user->prenom : $projet->mairie->nom_maire;
            $nomCommune = $projet->user ? $projet->user->commune->nom : $projet->mairie->commune->nom;
            $descCommune = $projet->user ? $projet->user->commune->commune_desc : $projet->mairie->commune->commune_desc;

            return [
                'Nom du Projet' => $projet->nom,
                'Description' => $projet->description,
                'Date du Projet' => $projet->date_projet,
                'Date Limite de Vote' => $projet->date_limite_vote,
                'Image' => $projet->image,
                'État du Projet' => $projet->etat_projet,
                'Auteur du Projet' => $auteur,
                'Nom de la Commune' => $nomCommune,
                'Description de la Commune' => $descCommune,
            ];
        });

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Liste de projets pour la commune donnée',
            'data' => $infoprojets
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

}
