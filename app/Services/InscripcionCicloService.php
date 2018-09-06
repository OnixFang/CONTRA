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
        $subjects->each(function ($subject) use($key, $user)
        {
            $subject_key = (format_subject_key($subject[1]));
            $subject_model = Asignatura::whereClave($subject_key)->first();
            if($subject_model !== null)
            {
                $group = Grupo::updateOrCreate(
                    ['seccion' => (string)$subject[3], 'asignatura_id' => $subject_model->id],
                    ['seccion' => (string)$subject[3], 'asignatura_id' => $subject_model->id]
                );

                $this->inscripcionCiclo->updateOrCreate(
                    ['grupo_id' => $group->id, 'usuario_id' => $user->id, 'clave' => $key,],
                    [
                        'grupo_id' => $group->id, 'usuario_id' => $user->id,
                        'clave' => $key, 'nota' => $subject[6], 'estado' => $subject[8]
                    ]
                );
            }
        });
    }
}