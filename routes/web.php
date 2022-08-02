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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('getAllUser', [App\Http\Controllers\Admin\UserController::class, 'getAllUser'])->name('getAllUser');
Route::get('getAllStructural', [App\Http\Controllers\Admin\StructuralController::class, 'getAllStructural'])->name('getAllStructural');


Route::prefix('admin')->middleware('auth')->group(function(){

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
});