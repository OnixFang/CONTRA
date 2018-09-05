<?php
/**
 * Created by PhpStorm.
 * User: saurybravo
 * Date: 04/09/18
 * Time: 06:38 PM
 */

namespace App\Services;


use App\Asignatura;
use App\Grupo;
use App\InscripcionCiclo;
use Illuminate\Support\Collection;

class InscripcionCicloService
{
    /**
     * @var InscripcionCiclo
     */
    private $inscripcionCiclo;

    public function __construct(InscripcionCiclo $inscripcionCiclo)
    {
        $this->inscripcionCiclo = $inscripcionCiclo;
    }

    public function register($key, Collection $subjects)
    {
        $subjects->each(function ($subject) use($key) {
            $subject_key = (format_subject_key($subject[1]));
            $subject = Asignatura::whereClave($subject_key)->first();
            var_dump($subject->descripcion);
            //$group = Grupo::updateOrCreate(['asi'])
            //var_dump(['clave' => $key, 'grupo_id' => ])
        });
    }
}