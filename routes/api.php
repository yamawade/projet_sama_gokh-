<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\MairieController;
use App\Http\Controllers\Api\VoteController;

//recuperer la liste des votes
Route::get('votes', [VoteController::class,'index']);
//inscrire un vote
Route::post('votes/create', [VoteController::class, 'store']);

//inscrire un nouveau user
Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);

//inscrire un nouveau mairie
Route::post('/registerMairie',[MairieController::class,'registerMairie']);
Route::post('/loginMairie',[MairieController::class,'loginMairie']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
