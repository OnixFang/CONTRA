<?php

namespace App\Http\Controllers\API;

use App\Asignatura;
use App\Grupo;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

class GruposController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index($userid)
    {
        $user = User::findOrFail($userid);

        $asignaturas = $user->inscripcion()->pensum->asignaturas;

        $grupos = collect([]);

        if($asignaturas instanceof Collection)
            $asignaturas->each(function (Asignatura $asignatura) use(&$grupos)
            {
                $asignatura->grupos()->where('cerrado', 0)->get()->each(function (Grupo $grupo) use(&$grupos, $asignatura)
                {
                    $prerequisitos = $asignatura->requisitos;
                    $aprobado = $grupo->inscripcionCiclo()->where('aprobado', true)->exists();

                    $grupos->push([
                        "id" => $grupo->asignatura->id,
                        "clave" => $grupo->asignatura->clave,
                        "descripcion" => $grupo->asignatura->descripcion,
                        "cr" => $grupo->asignatura->cr,
                        "propedeutico" => (bool) $grupo->asignatura->propedeutico,
                        "pre_requisito1" => $prerequisitos->first(),
                        "pre_requisito2" => $prerequisitos->last(),
                        "seccion" => $grupo->seccion,
                        "bimestre" => $grupo->bimestre,
                        "horario" => $grupo->horario,
                        "aprovado" => $aprobado,
                    ]);
                });
            });

        return response()->json($grupos);
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
