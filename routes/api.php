<?php

use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\MairieController;
use App\Http\Controllers\Api\RegionController;
use App\Http\Controllers\Api\CommuneController;
use App\Http\Controllers\Api\ProjetController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//inscrire un nouveau user

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('ajout/projet', [ProjetController::class, 'store']);
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
Route::put('regions/edit/{region}',[RegionController::class,'update']);

// Suppression de la region
// Route::delete('regions/{region}',[RegionController::class,'delete']);


//gestion des commune
// Modification d'une commune 
Route::put('communes/edit/{commune}',[CommuneController::class,'update']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
