<?php

use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\MairieController;
use App\Http\Controllers\Api\ProjetController;
use App\Http\Controllers\Api\RegionController;

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
Route::post('/registerMairie',[MairieController::class,'registerMairie']);
Route::post('/loginMairie',[MairieController::class,'loginMairie']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
