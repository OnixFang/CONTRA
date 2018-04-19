<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asignatura;
use App\Pensum;
use App\Http\Requests\AsignaturaRequest;

class AsignaturaController extends Controller
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
    public function create($id)
    {        
        $pensum = $id;
        $prereq = Asignatura::pluck('descripcion','id');
        return view('asignaturas.addsubject',compact('pensum','prereq'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AsignaturaRequest $request)
    {
        $id_pensum=$request->id_pensum;
        Asignatura::create($request->all());
        return redirect()->route('asignatura.show',['id'=>$id_pensum])->withId($id_pensum)->withMessage('La asignatura fue guardada exitosamente');

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $asignaturas = Asignatura::all()->where('id_pensum',$id)->sortBy('cuatrimestre')->groupBy('cuatrimestre');
        $collection = $asignaturas;
        $pensum = Pensum::find($id);     
        //dd($asignaturas);
        return view('pensum.pensumshow',compact('asignaturas', 'collection','pensum'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $asignatura= Asignatura::find($id);
        $prereq = Asignatura::pluck('descripcion','id');
        return view('asignaturas.updateSubject',compact('asignatura','prereq'));
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
        Asignatura::find($id)->update($request->all());
        $id_pensum = $request->id_pensum;
        return redirect()->route('asignatura.show',['id'=>$id_pensum])->withMessage("la Asignatura ".$request->descripcion." fue editada");;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Asignatura::destroy($id);
        return back()->withMessage("la asignatura fue borrada exitosamente");
    }
}
