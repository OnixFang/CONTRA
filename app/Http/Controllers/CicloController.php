<?php namespace App\Http\Controllers;

use App\Facilitador;
use App\Calificacion;
use Auth;
use App\InscripcionCiclo;
use App\User;
use Illuminate\Http\Request;

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
        return view('ciclos.CiclosDashboard', compact('collection'));
    }

    public function actual()
    {
        $ciclos = Auth::user()->inscripcionCiclo;

        $collection = $ciclos->groupBy('clave');

        $cicloactual = $collection->last();

        return view('ciclos.ciclo_actual', compact('cicloactual'));
    }

    public function ciclo_api($userId)
    {
        $ciclos = User::find($userId)->inscripcionCiclo->map(function (InscripcionCiclo $ciclo) {
            return
                [
                    'claveCiclo' => $ciclo->clave,
                    'claveAsignatura' => $ciclo->grupo->asignatura->clave,
                    'nombreAsignatura' => $ciclo->grupo->asignatura->descripcion,
                    'seccionGrupo' => $ciclo->grupo->seccion,
                    'creditoAsignatura' => $ciclo->grupo->asignatura->cr,
                    'nota' => $ciclo->nota,
                    'estado' => $ciclo->estado,
                    'literal' => $ciclo->literal
                ];
        });

        $collection = $ciclos->groupBy('claveCiclo');

        return $collection;
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
