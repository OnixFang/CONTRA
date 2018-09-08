<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Grupo;
use App\Asignatura;
use App\Ciclo;
use App\InscripcionCiclo;
use Auth;

class DashboardController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(){
        
        //dd($this->userService->countPendingSubject());
        $pensum = Auth::user()->pensum;
        $asignaturas = Asignatura::all();
         $ciclos = InscripcionCiclo::all();
         $aprobadas = Asignatura::all()->where('aprovado',1);
        $pendientes = Asignatura::all()->where('aprovado',0);
        
        $actuales = new InscripcionCiclo;
        // $actuales = $actuales->cicloAbiertos()->get();
        // $actualess= Grupo::where('id_ciclo',$actuales);
        return view('dashboard',compact('asignaturas','ciclos','aprobadas','pendientes'));

    }
}
