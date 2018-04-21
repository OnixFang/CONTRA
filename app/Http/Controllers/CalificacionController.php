<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calificacion;
use App\Grupo;
use App\Asignatura;
use App\Ciclo;

class CalificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        $request->validate([
            'calificacion'=> 'required'
            ]);
        Calificacion::create($request->all()); //guardar las calificaciones
        
        if($request->calificacion > 69) { //poner la asignatura en aprovado
            Asignatura::where('id', $request->id_asignatura)->update(array('aprovado' => '1'));
        }


        $gruposdeCiclo = Grupo::all()->where('id_ciclo',$request->id_ciclo);
        $gruposCalificados = Calificacion::all();
        $gruposDeCicloCalificados=0;
        foreach($gruposCalificados as $grupoCalificado){

            foreach($gruposdeCiclo as $grupodeCiclo ) {
                if ($grupoCalificado->id_grupo == $grupodeCiclo->id){
                    ++$gruposDeCicloCalificados; 
                }
            }
        }
        if($gruposDeCicloCalificados == count($gruposdeCiclo)){

            //dd($request->id_ciclo);
            Ciclo::where('id',$request->id_ciclo)->update(array('cerrado'=>'1'));
        }
              return redirect()->action('CicloController@actual')->withMessage("La asignatura fue calificada exitosamente");
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $grupo = Grupo::find($id);
        return view('grupos.calificaciones',compact('grupo'));
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
