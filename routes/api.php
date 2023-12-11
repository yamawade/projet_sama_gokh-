<?php

use App\Http\Controllers\Api\CommuneController;
use App\Models\Region;
use App\Models\Commune;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\MairieController;
use App\Http\Controllers\Api\ProjetController;
use App\Http\Controllers\Api\RegionController;
<<<<<<< HEAD
<<<<<<< HEAD
use App\Http\Controllers\Api\CommuneController;
use App\Http\Controllers\Api\CommentaireController;

//recuperer la liste des votes
Route::get('votes', [VoteController::class,'index']);
//inscrire un vote
Route::post('votes/create', [VoteController::class, 'store']); 

// //recuperer la liste des votes
// Route::get('votes', [VoteController::class,'index']);
// //inscrire un vote
// Route::post('votes/create', [VoteController::class, 'store']);
//listages des communes
Route::post('communes',[CommuneController::class,'index']);
//ajout communes
Route::post('communes/create',[CommuneController::class,'store']);

//inscrire un nouveau user
Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);
Route::put('/update/user/{user}', [UserController::class, 'update']);

//gestion des regions

//Recuperer la liste des posts 
Route::get('regions',[RegionController::class,'index']);
// Ajout d'une region |POST|PUT|PATCH
Route::post('regions/create',[RegionController::class,'store']);
=======
=======
>>>>>>> b6c91f62d1ebdb4d2f4200399729ef209867fdcb
use App\Http\Controllers\Api\VoteController;
use App\Http\Controllers\NewsletterController;
use App\Models\Newsletter;
use App\Http\Controllers\Api\CommentaireController;

//inscrire un nouveau user
>>>>>>> 915345a4c0795383c92b54d3ecb15b3912847bc0
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
<<<<<<< HEAD
<<<<<<< HEAD
//inscrire un nouveau mairie
Route::post('/registerMairie',[MairieController::class,'registerMairie']);
Route::post('/loginMairie',[MairieController::class,'loginMairie']);
//gestion des regions

//Recuperer la liste des posts 
Route::get('regions', [RegionController::class, 'index']);
// Ajout d'une region |POST|PUT|PATCH
Route::post('regions/create', [RegionController::class, 'store']);
Route::post('/registerMairie', [MairieController::class, 'registerMairie']);
Route::post('/loginMairie', [MairieController::class, 'loginMairie']);

=======
>>>>>>> 915345a4c0795383c92b54d3ecb15b3912847bc0
=======
>>>>>>> b6c91f62d1ebdb4d2f4200399729ef209867fdcb

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


<<<<<<< HEAD
    //route pour ajout/suppression/modifier projet
Route::middleware('auth:sanctum')->group(function () {
    Route::post('ajout/projet', [ProjetController::class, 'store']);
    Route::post('modifier/projet/{projet}', [ProjetController::class, 'edit']);
    Route::post('supprimer/projet/{projet}', [ProjetController::class, 'destroy']);
    Route::post('details/projet/', [ProjetController::class, 'show']);

});





=======
>>>>>>> b6c91f62d1ebdb4d2f4200399729ef209867fdcb
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
