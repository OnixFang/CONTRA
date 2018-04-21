<?php

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

Route::resource('/', 'DashboardController');

Route::get('asignatura.create/{id}', ['as' => 'asignatura.create', 'uses' => 'AsignaturaController@create']);//para poder recibir el id en el create() 
Route::resource('asignatura','AsignaturaController',['except'=>['create']]); 
Route::resource('pensum','PensumController');
Route::resource('facilitador','FacilitadorController');
Route::resource('grupo','GrupoController');
Route::resource('ciclo','CicloController');
Route::resource('calificacion','CalificacionController');
Route::get('cicloactual','CicloController@actual');

