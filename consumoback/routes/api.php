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
    Route::resource('/licencia',\App\Http\Controllers\LicenciaController::class);
    Route::resource('/caso',\App\Http\Controllers\CasoController::class);
    Route::resource('/multa',\App\Http\Controllers\MultaController::class);
    Route::put('/pass/{user}',[\App\Http\Controllers\UserController::class,'pass']);
    Route::put('/updatepermisos/{user}',[\App\Http\Controllers\UserController::class,'updatepermisos']);
    Route::post('/consultar',[\App\Http\Controllers\ContribuyenteController::class,'consultar']);
    Route::post('/conregistro',[\App\Http\Controllers\ContribuyenteController::class,'conregistro']);
    Route::post('/conpagos',[\App\Http\Controllers\ContribuyenteController::class,'conpagos']);
    Route::get('/listadocontrib',[\App\Http\Controllers\ContribuyenteController::class,'listadocontrib']);
    Route::get('/listlicencia',[\App\Http\Controllers\LicenciaController::class,'listlicencia']);
    Route::get('/listactividad/{codigo}',[\App\Http\Controllers\ContribuyenteController::class,'listactividad']);
    Route::get('/listsector/{sector}',[\App\Http\Controllers\ContribuyenteController::class,'listsector']);
    Route::post('/listrequisito',[\App\Http\Controllers\RequisitoController::class,'listrequisito']);
    Route::resource('/direccion',\App\Http\Controllers\DireccionController::class);
    Route::resource('/historialmulta',\App\Http\Controllers\HistorialmultaController::class);
    Route::post('/listahistorial/{id}',[\App\Http\Controllers\HistorialmultaController::class,'listahistorial']);
    Route::get('/listregistro',[\App\Http\Controllers\TramiteController::class,'listregistro']);
    Route::post('/mistramites',[\App\Http\Controllers\DireccionController::class,'mistramites']);
    Route::get('/listactividad',[\App\Http\Controllers\NegocioController::class,'listactividad']);
    Route::get('/lsector/{id}',[\App\Http\Controllers\NegocioController::class,'lsector']);
    Route::post('/asignar',[\App\Http\Controllers\DireccionController::class,'asignar']);
    Route::post('/probar',[\App\Http\Controllers\DireccionController::class,'probar']);
    Route::post('/buscarcontrib/{cedula}',[\App\Http\Controllers\ContribuyenteController::class,'buscarcontrib']);
    Route::post('/regnegocio',[\App\Http\Controllers\NegocioController::class,'regnegocio']);
});
