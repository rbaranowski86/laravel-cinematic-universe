<?php

use App\Http\Controllers\API\ActorController;
use App\Http\Controllers\API\CharacterController;
use App\Http\Controllers\API\CinematicUniverseController;
use App\Http\Controllers\API\MovieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('cinematic-universes', CinematicUniverseController::class);
Route::apiResource('movies', MovieController::class);
Route::apiResource('characters', CharacterController::class);
Route::apiResource('actors', ActorController::class);
