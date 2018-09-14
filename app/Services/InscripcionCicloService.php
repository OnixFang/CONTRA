<?php
/**
 * Created by PhpStorm.
 * User: saurybravo
 * Date: 04/09/18
 * Time: 06:38 PM
 */

namespace App\Services;

use App\Asignatura;
use App\AsignaturaCondicion;
use App\Grupo;
use App\InscripcionCiclo;
use App\User;
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

    public function register(User $user, $key, Collection $subjects)
    {
        $subjects->each(function ($subject) use ($key, $user) {
            $subject_key = (format_subject_key($subject[1]));
            $subject_descripcion = (preg_replace('/\s+/', ' ', (mb_strtolower(trim($subject[2])))));
            $subject_model = $user->inscripcion()->pensum->asignaturas()->where('clave', $subject_key)->orWhereRaw("LOWER(descripcion) = '{$subject_descripcion}'")->first();

            if($subject_model == null && $subject[4]!== null)
            {
                $pensum = $user->inscripcion()->pensum;

                $subject_model = Asignatura::create(
                    ['descripcion'=>ucwords($subject_descripcion),
                        'clave'=>$subject_key,
                        'hp'=>0,
                        'ht'=>0,
                        'cr'=>$subject[4],
                        'cuatrimestre'=>9,
                    ]);

                $pensum->asignaturas()->attach($subject_model);
            }


            $inscripcion = $user->inscripcion();

            if ($subject_model !== null and  $inscripcion !== null) {
                $group = Grupo::updateOrCreate(
                    ['seccion' => (string) $subject[3], 'asignatura_id' => $subject_model->id],
                    ['seccion' => (string) $subject[3], 'asignatura_id' => $subject_model->id]
                );

                $this->inscripcionCiclo->updateOrCreate(
                    ['inscripcion_id' => $inscripcion->id, 'grupo_id' => $group->id, 'usuario_id' => $user->id, 'clave' => $key],
                    [
                        'inscripcion_id' => $inscripcion->id,
                        'grupo_id' => $group->id, 'usuario_id' => $user->id,
                        'clave' => $key, 'nota' => $subject[6],
                        'estado' => $subject[8],
                        'literal' => $subject[7],
                        'aprobado' => $this->isApproved($subject),
                    ]
                );
            }
        });
    }

    private function isApproved($subject)
    {
        $approved = false;

        if($subject[8] == AsignaturaCondicion::COVALIDADA and (integer)$subject[6] == 0)
            $approved = true;

        if($subject[8] == AsignaturaCondicion::EXONERADO and (integer)$subject[6] == 0)
            $approved = true;

        if($subject[8] == AsignaturaCondicion::NORMAL and (integer)$subject[6] >= 70)
            $approved = true;

        return $approved;
    }

    public function getSubjectsApproved(User $user)
    {
        return $user->inscripcionCiclo()->select('asignaturas.*')
            ->join('grupos', 'inscripcion_ciclo.grupo_id', '=', 'grupos.id')
            ->join('asignaturas', 'grupos.asignatura_id', '=', 'asignaturas.id')
            ->where('inscripcion_ciclo.aprobado', true)->get();
    }

    public function checkIfApproved(User $user,  $asignaturaId){

        $subjectsApproved = $this->getSubjectsApproved($user);
        foreach ($subjectsApproved as $subject)
        {
            if($subject->clave == $asignaturaId){
                return true;
            }
        }
    }

    public function getCyclesCompleted(User $user)
    {
        return $user->inscripcionCiclo()->select('clave')->groupBy('clave')->get();
    }
}
