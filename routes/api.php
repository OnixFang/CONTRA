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

Route::get('asignaturas/{userId}','\App\Http\Controllers\API\AsignaturasController@all');
Route::get('grupo_api','GrupoController@grupo_api');
Route::post('ciclo_api','GrupoController@store');
Route::get('ciclo_api/{userId}','CicloController@ciclo_api');
Route::get('grupos/{userid}', '\App\Http\Controllers\API\GruposController@index');
Route::get('aprobadas/{userid}', '\App\Http\Controllers\API\AsignaturasController@index');
Route::post('prematricula', 'PrematriculasApi@store');
