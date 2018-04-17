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
    	return view('dashboard',compact('asignaturas','ciclos'));

    }
}
