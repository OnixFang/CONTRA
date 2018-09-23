<?php

namespace App\Http\Controllers\API;

use App\Asignatura;
use App\User;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\InscripcionCicloService;

class AsignaturasController extends Controller
{
    /**
     * Display a listing of the resource.
     * @var InscripcionCicloService
     * @param InscripcionCicloService $inscripcionCicloService
     * @return \Illuminate\Http\Response
     */

    public function __construct(InscripcionCicloService $inscripcionCicloService)
    {
        $this->inscripcionCicloService = $inscripcionCicloService;
    }

    public function index($userid)
    {
        $user = User::findOrFail($userid);
        return response()->json($this->inscripcionCicloService->getSubjectsApproved($user));
    }

    public function all($userid)
    {
        $user = User::findOrFail($userid);
        return response()->json($user->inscripcion()->pensum->asignaturas);
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
