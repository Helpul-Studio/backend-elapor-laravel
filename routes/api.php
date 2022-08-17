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
   
    Route::get('/profile', [\App\Http\Controllers\API\AuthController::class, 'profile']);
    Route::put('/update-profile', [\App\Http\Controllers\API\AuthController::class, 'update']);
    Route::post('/logout', [\App\Http\Controllers\API\AuthController::class, 'logout']);

    Route::get('/jobtask-result/{id}', [\App\Http\Controllers\API\JobtaskResultController::class, 'show']);
    Route::post('/jobtask-result/{id}', [\App\Http\Controllers\API\JobtaskResultController::class, 'store']);



    Route::controller(\App\Http\Controllers\API\Principal\JobtaskController::class)->group(function(){
        Route::get('/getAllJobtask', 'getAllJobtask');
        Route::get('/getSubordinate', 'getSubordinate'); 
        Route::post('/jobtask/add-jobtask', 'store');
        Route::get('/jobtask/get-jobtask/{id}', 'show');
        Route::put('/jobtask/update-jobtask/{id}', 'update');
        Route::delete('/jobtask/delete-jobtask/{id}', 'destroy');
    });

    Route::controller(\App\Http\Controllers\API\Principal\ReportController::class)->group(function(){
        Route::get('/getAllReport', 'getAllReport');
        Route::post('/jobtask/add-jobtask', 'store');
        Route::get('/report-view/{id}', 'show');
        Route::put('/report-update/{id}', 'update');
    });

    Route::controller(\App\Http\Controllers\API\Principal\NewsController::class)->group(function(){
        Route::get('/getAllNews', 'getAllNews');
        Route::post('/news/add-news', 'store');
        Route::get('/news-view/{id}', 'show');
        Route::put('/news-update/{id}', 'update');
        Route::delete('/news/delete-news/{id}', 'destroy');
    });



    Route::controller(\App\Http\Controllers\API\ReportController::class)->group(function(){
        Route::get('/report-data', 'index');
        Route::post('/report-data', 'store');
        Route::get('/report-detail/{id}', 'show');
    });
});
