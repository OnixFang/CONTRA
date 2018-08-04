<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asignatura;
use App\Pensum;
use App\Http\Requests\AsignaturaRequest;
use App\Services\AsignaturaService;

class AsignaturaController extends Controller
{
    //public $asignatura;

   // public function __construct(AsignaturaService $asignatura){
   //     $this->asignatura = $asignatura;
   // }
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
        return view('asignaturas.create',compact('pensum','prereq'));
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
        $asignaturas = $this->asignatura->asignaturas_pensum($id);
        $collection = $asignaturas;
        $pensum = Pensum::find($id);     
        //dd($asignaturas);
        return view('pensum.show',compact('asignaturas', 'collection','pensum'));
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
