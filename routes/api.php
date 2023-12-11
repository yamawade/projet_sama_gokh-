<?php

use App\Http\Controllers\Api\CommuneController;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\MairieController;
use App\Http\Controllers\Api\ProjetController;
use App\Http\Controllers\Api\RegionController;
use App\Http\Controllers\Api\VoteController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\Api\CommentaireController;

//inscrire un nouveau user
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('newsletter/mail', [NewsletterController::class, 'store']);

//inscrire un nouveau mairie
Route::post('/registerMairie', [MairieController::class, 'registerMairie']);
Route::post('/loginMairie', [MairieController::class, 'loginMairie']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('ajout/projet', [ProjetController::class, 'store']);
    Route::post('details/projet/{projet}', [ProjetController::class, 'show']);
    Route::post('modifier/projet/{projet}', [ProjetController::class, 'edit']);
    Route::post('supprimer/projet/{projet}', [ProjetController::class, 'destroy']);
    Route::post('commentaires/create/{projet}',[CommentaireController::class,'store']);
    Route::post('commentaires/edit/{id}',[CommentaireController::class,'update']);
    Route::delete('commentaires/{id}',[CommentaireController::class,'destroy']);
    //recuperer la liste des votes
    Route::get('votes', [VoteController::class,'index']);
    //inscrire un vote
    Route::post('votes/create/{projet}', [VoteController::class, 'store']);
    //Deconnexion Utilisateur
    Route::post('deconnexion',[UserController::class,'logout']);
    Route::post('deconnexionMairie',[MairieController::class,'logout']);

    //Desactiver compte utilisateur
    Route::post('desactiverCompte/{user}',[UserController::class,'desactiverCompte']);
    //listes des projets
    Route::get('projets', [ProjetController::class, 'index']);
    //listes des projets par commune
    Route::get('projetsParCommune/{communeId}', [ProjetController::class, 'projetsParCommune']);
});

//Verification email
Route::post('verifMail',[UserController::class,'verifMail']);
Route::post('resetPassword/{user}',[UserController::class,'resetPassword']);
//gestion des regions

//Recuperer la liste des regions

Route::get('regions', [RegionController::class, 'index']);

// Ajout d'une region |POST|PUT|PATCH
Route::post('regions/create', [RegionController::class, 'store']);


// Modification d'une region 
Route::put('regions/edit/{region}', [RegionController::class, 'update']);


//gestion des commune
// Modification d'une commune 
Route::put('communes/edit/{commune}', [CommuneController::class, 'update']);
Route::delete('communes/{commune}', [CommuneController::class, 'delete']);
//listages des communes
Route::get('communes',[CommuneController::class,'index']);
//ajout communes
Route::post('communes/create',[CommuneController::class,'store']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    // dd(Auth::guard('mairie')->check());
    return $request->user();
});
//liste des mairies
Route::get('mairies', [MairieController::class, 'index']);
