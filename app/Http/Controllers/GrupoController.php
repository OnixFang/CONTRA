<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Grupo;
use App\Facilitador;
use App\Asignatura;
use App\Ciclo;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grupos = Grupo::all();
        $facilitadores = Facilitador::pluck('nombre','id');
        $asignaturas = Asignatura::pluck('descripcion','id');
        return view('grupos.addGrupos',compact('grupos','facilitadores','asignaturas'));
    }

    public function asignatura_api()
    {
        $asignatura = Asignatura::all();
        return $asignatura;
    }

    public function facilitador_api()
    {
        $facilitador = Facilitador::all();
        return $facilitador;
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

public function return_view(){
            

}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ciclo = Ciclo::create($request->all());
        $ciclo_id = $ciclo->id;
        $grupos = $request->grupos;
        //return response (count($grupos));
        //return response($grupos[0]['clave']);
        foreach ($grupos as $grupo)
        {
            Grupo::create([
                'clave' => $grupo['clave'],
                'id_asignatura' => $grupo['asignatura'],
                'bimestre' => $grupo['bimestre'],
                'id_facilitador' => $grupo['facilitador'],
                'horario' => $grupo['horario'],
                'id_ciclo' => $ciclo_id
                ]);
        }
        return Response (action('CicloController@actual'), 200);
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
