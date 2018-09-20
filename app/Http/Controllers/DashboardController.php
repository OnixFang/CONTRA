<?php namespace App\Http\Controllers;

use App\Services\InscripcionCicloService;
use Auth;

class DashboardController extends Controller
{

    /**
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
        $pensum = Auth::user()->pensum;
        $asignaturas = Auth::user()->inscripcion()->pensum->asignaturas;

        $ciclos = $this->inscripcionCicloService->getCyclesCompleted(Auth::user());
        $aprobadas = $this->inscripcionCicloService->getSubjectsApproved(Auth::user());

        $pendientes = collect([]);
        $asignaturas->map(function ($asignatura) use($aprobadas, &$pendientes) {
            $element = $aprobadas->where('clave', $asignatura->clave)->first();
            if($element == null)
                $pendientes->push($asignatura);
        });

        $ciclos = Auth::user()->inscripcionCiclo()->orderBy('clave', 'asc')->get();
        $collection = $ciclos->groupBy('clave');
        $cicloactual = $collection->last();

        return view('dashboard',compact('asignaturas','ciclos','aprobadas','pendientes','cicloactual'));

    }
}
