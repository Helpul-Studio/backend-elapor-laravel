<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/login', [\App\Http\Controllers\API\AuthController::class, 'login']);


Route::middleware(['auth:sanctum'])->group(function(){

    Route::get('/jobtask-data', [\App\Http\Controllers\API\JobtaskController::class, 'index']);
    Route::get('/jobtask-detail/{id}', [\App\Http\Controllers\API\JobtaskController::class, 'show']);
    Route::post('/logout', [\App\Http\Controllers\API\AuthController::class, 'logout']);
});
