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
    	$actuales = new Ciclo;
    	$actuales = $actuales->cicloAbiertos()->get();
    	$actualess= Grupo::where('id_ciclo',$actuales);
    	return view('dashboard',compact('asignaturas','ciclos','aprobadas','pendientes','actuales'));

    }
}
