<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('getAllUser', [App\Http\Controllers\Admin\UserController::class, 'getAllUser'])->name('getAllUser');
Route::get('getAllStructural', [App\Http\Controllers\Admin\StructuralController::class, 'getAllStructural'])->name('getAllStructural');
Route::get('getAllJobtask', [App\Http\Controllers\Admin\JobtaskController::class, 'getAllJobtask'])->name('getAllJobtask');
Route::get('getAllNews', [App\Http\Controllers\Admin\NewsController::class, 'getAllNews'])->name('getAllNews');
Route::get('getAllReport', [App\Http\Controllers\Admin\ReportController::class, 'getAllReport'])->name('getAllReport');
Route::get('getAllSector', [App\Http\Controllers\Admin\SectorController::class, 'getAllSector'])->name('getAllSector');




Route::prefix('manage')->middleware('auth')->group(function(){

    Route::controller(\App\Http\Controllers\Admin\DashboardController::class)->group(function(){
        Route::get('/dashboard', 'index')->name('dashboard');
    });

    Route::controller(\App\Http\Controllers\Admin\UserController::class)->group(function(){
        Route::get('/user', 'index')->name('user.index');
        Route::post('/user/add-user', 'store')->name('user.store');
        Route::get('/user/get-user/{id}', 'edit')->name('user.edit');
        Route::put('/user/update-user/{id}', 'update')->name('user.update');
        Route::delete('/user/delete-user/{id}', 'destroy')->name('user.destroy');
    });

    Route::controller(\App\Http\Controllers\Admin\StructuralController::class)->group(function(){
        Route::get('/structural', 'index')->name('structural.index');
        Route::post('/structural/add-structural', 'store')->name('structural.store');
        Route::get('/structural/get-structural/{id}', 'edit')->name('structural.edit');
        Route::put('/structural/update-structural/{id}', 'update')->name('structural.update');
        Route::delete('/structural/delete-structural/{id}', 'destroy')->name('structural.destroy');
    });


    Route::controller(\App\Http\Controllers\Admin\JobtaskController::class)->group(function(){
        Route::get('/jobtask', 'index')->name('jobtask.index');
        Route::post('/jobtask/add-jobtask', 'store')->name('jobtask.store');
        Route::get('/jobtask/get-jobtask/{id}', 'edit')->name('jobtask.edit');
        Route::put('/jobtask/update-jobtask/{id}', 'update')->name('jobtask.update');
        Route::delete('/jobtask/delete-jobtask/{id}', 'destroy')->name('jobtask.destroy');
    });

    Route::controller(\App\Http\Controllers\Admin\ReportController::class)->group(function(){
        Route::get('/report', 'index')->name('report.index');
        Route::get('/report-result/{id}', 'show')->name('report.show');
    });

    Route::controller(\App\Http\Controllers\Admin\NewsController::class)->group(function(){
        Route::get('/news', 'index')->name('news.index');
        Route::post('/news/add-news', 'store')->name('news.store');
        Route::get('/news/get-news/{id}', 'edit')->name('news.edit');
        Route::put('/news/update-news/{id}', 'update')->name('news.update');
        Route::delete('/news/delete-news/{id}', 'destroy')->name('news.destroy');
    });

    Route::controller(\App\Http\Controllers\API\JobtaskResultController::class)->group(function(){
        Route::get('/jobtask-result/{id}', 'showreport')->name('jobtaskresult.showreport');
    });
});