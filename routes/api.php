<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('asignatura_api','GrupoController@asignatura_api');
// Route::get('facilitador_api','GrupoController@facilitador_api');
Route::get('grupo_api','GrupoController@grupo_api');
Route::post('ciclo_api','GrupoController@store');
Route::get('ciclo_api/{userId}','CicloController@ciclo_api');
Route::get('grupos/{userid}', '\App\Http\Controllers\API\GruposController@index');
Route::get('asignaturas/{userid}', '\App\Http\Controllers\API\AsignaturasController@index');