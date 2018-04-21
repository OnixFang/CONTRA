<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grupo;
use App\Asignatura;
use App\Ciclo;

class DashboardController extends Controller
{
    
    public function index(){

    	$asignaturas = Asignatura::all();
    	$ciclos = Ciclo::all();
    	$aprobadas = Asignatura::all()->where('aprovado',1);
    	$pendientes = Asignatura::all()->where('aprovado',0);
    	$id_cicloActual = Ciclo::where('cerrado',0)->first()->id;
    	$actuales= Grupo::where('id_ciclo',$id_cicloActual)->get(); 
    	return view('dashboard',compact('asignaturas','ciclos','aprobadas','pendientes','actuales'));

    }
}
