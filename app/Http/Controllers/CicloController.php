<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InscripcionCiclo;
use App\Grupo;
use App\Asignatura;
use App\Facilitador;
use App\Calificacion;
use Auth;

class CicloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ciclos = Auth::user()->inscripcionCiclo;
        $collection = $ciclos->groupBy('clave');
        return view('ciclos.CiclosDashboard-old',compact('collection'));
    }

    public function actual()
    {
//        $cicloactual = new Ciclo;
//        $cicloactual = $cicloactual->ciclosabiertos()->last();

        $cicloactual = Ciclo::cicloAbiertos()->first();

        return view('ciclos.ciclo_actual', compact('cicloactual'));
    }

    public function ciclo_api()
    {
        $ciclos = Auth::user()->inscripcionCiclo()->groupBy('clave');

        // foreach($ciclos as $ciclo)
        // {
        //     $ciclo->grupos = Grupo::all()->where('id_ciclo', $ciclo->id);

        //     foreach($ciclo->grupos as $grupo)
        //     {
        //         $grupo->asignatura = Asignatura::where('id', $grupo->id_asignatura)->value('descripcion');
        //         $grupo->calificacion = Calificacion::where('id_grupo', $grupo->id)->value('calificacion');
        //         $grupo->facilitador = Facilitador::where('id', $grupo->id_facilitador)->value('nombre');
        //         $grupo->credito = Asignatura::where('id', $grupo->id_asignatura)->value('cr');
        //     }
        // }

        return $ciclos;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
