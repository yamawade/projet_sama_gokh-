<?php

use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VoteController;
use App\Http\Controllers\Api\MairieController;
use App\Http\Controllers\Api\ProjetController;
use App\Http\Controllers\Api\RegionController;
use App\Models\Commune;

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



//gestion des regions

//Recuperer la liste des posts 
Route::get('regions',[RegionController::class,'index']);
// Ajout d'une region |POST|PUT|PATCH
Route::post('regions/create',[RegionController::class,'store']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('newsletter/mail', [NewsletterController::class, 'store']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('ajout/projet', [ProjetController::class, 'store']);
    Route::post('details/projet/', [ProjetController::class, 'show']);
    Route::post('modifier/projet/{projet}', [ProjetController::class, 'edit']);
    Route::post('supprimer/projet/{projet}', [ProjetController::class, 'destroy']);
    Route::post('details/projet/', [ProjetController::class, 'details']);
    Route::post('modifier/projet/{projet}', [ProjetController::class, 'edit']);
    Route::post('supprimer/projet/{projet}', [ProjetController::class, 'destroy']);
});
//inscrire un nouveau mairie
Route::post('/registerMairie', [MairieController::class, 'registerMairie']);
Route::post('/loginMairie', [MairieController::class, 'loginMairie']);


//gestion des regions

//Recuperer la liste des posts 

Route::get('regions',[RegionController::class,'index']);

// Ajout d'une region |POST|PUT|PATCH
Route::post('regions/create',[RegionController::class,'store']);


// Modification d'une region 
Route::put('regions/edit/{region}', [RegionController::class, 'update']);

// Suppression de la region
// Route::delete('regions/{region}',[RegionController::class,'delete']);


//gestion des commune
// Modification d'une commune 
Route::put('communes/edit/{commune}', [CommuneController::class, 'update']);
Route::delete('communes/{commune}', [CommuneController::class, 'delete']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    // dd(Auth::guard('mairie')->check());
    return $request->user();
});
// Route::middleware('maire')->group(
//     function () {
//         Route::post('ajout/projet', [ProjetController::class, 'store']);
//     }
// );
