<?php

namespace App\Http\Controllers;

use App\Pensum;
use App\Services\InscripcionCicloService;
use Auth;
use Illuminate\Http\Request;

class PensumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @var InscripcionCicloService
     */
    private $inscripcionCicloService;
    /**
     * DashboardController constructor.
     * @param InscripcionCicloService $inscripcionCicloService
     */

    public function __construct(InscripcionCicloService $inscripcionCicloService)
    {
        $this->inscripcionCicloService = $inscripcionCicloService;

    }
    public function index()
    {
        $inscripcion = Auth::user()->inscripciones()->first();
        $pensum = $inscripcion->pensum;
        $asignaturas = $pensum->asignaturas->groupBy('cuatrimestre');
        $collection = $asignaturas;
        return view('pensum.show', compact('asignaturas', 'collection', 'pensum'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function aprobadas()
    {
        $inscripcion = Auth::user()->inscripciones()->first();
        $pensum = $inscripcion->pensum;
        $user = Auth::user();
        $asignaturas = $this->inscripcionCicloService->getSubjectsApproved($user);
        $collection = $asignaturas->groupBy('cuatrimestre');
        //dd($collection);
        return view('pensum.aprobadas', compact('asignaturas', 'pensum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pensum.CreatePensum');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Pensum::create([
            'descripcion' => $request->descripcion,
        ]);
        return redirect()->route('pensum.index')->withMessage("El pensum fue creado exitosamente");
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
        $pensum = Pensum::find($id);
        return view('pensum.updatepensum')->withPensum($pensum);
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
        Pensum::find($id)->update($request->all());

        return redirect()->route('pensum.index')->withMessage("pensum Editado");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pensum::destroy($id);
        return redirect()->route('pensum.index')->withMessage('El pensum ha sido borrado correctamente');

    }
}
