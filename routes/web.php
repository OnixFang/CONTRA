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

Route::get('/', function () {
    return view('dashboard');
});

Route::get('asignatura.create/{id}', ['as' => 'asignatura.create', 'uses' => 'AsignaturaController@create']);//para poder recibir el id en el create() 
Route::resource('asignatura','AsignaturaController',['except'=>['create']]); 
Route::resource('pensum','PensumController');


