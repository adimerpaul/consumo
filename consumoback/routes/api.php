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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::post('/login',[\App\Http\Controllers\UserController::class,'login']);
Route::group(['middleware'=>'auth:sanctum'],function (){
    Route::post('/logout',[\App\Http\Controllers\UserController::class,'logout']);
    Route::post('/me',[\App\Http\Controllers\UserController::class,'me']);
    Route::resource('/contribuyente',\App\Http\Controllers\ContribuyenteController::class);
    Route::get('/buscarcon/{dato}',[\App\Http\Controllers\ContribuyenteController::class,'buscarcon']);
    Route::resource('/permiso',\App\Http\Controllers\PermisoController::class);
    Route::resource('/user',\App\Http\Controllers\UserController::class);
    Route::resource('/tramite',\App\Http\Controllers\TramiteController::class);
    Route::put('/pass/{user}',[\App\Http\Controllers\UserController::class,'pass']);
    Route::put('/updatepermisos/{user}',[\App\Http\Controllers\UserController::class,'updatepermisos']);
});
