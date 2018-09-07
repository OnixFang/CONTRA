<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\InscripcionCiclo
 *
 * @property int $id
 * @property string $clave
 * @property int $inscripcion_id
 * @property int $grupo_id
 * @property int $usuario_id
 * @property int|null $nota
 * @property string $estado
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read mixed $notas
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Grupo[] $grupo
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $usuario
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InscripcionCiclo whereClave($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InscripcionCiclo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InscripcionCiclo whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InscripcionCiclo whereGrupoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InscripcionCiclo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InscripcionCiclo whereInscripcionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InscripcionCiclo whereNota($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InscripcionCiclo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InscripcionCiclo whereUsuarioId($value)
 * @mixin \Eloquent
 */
class InscripcionCiclo extends Model
{
    protected $table = 'inscripcion_ciclo';

    protected $fillable = ['inscripcion_id', 'nota','clave','grupo_id','usuario_id', 'estado'];

    public function grupo(){

        return $this->belongsTo(Grupo::class,'grupo_id');
    }

    public function usuario(){
        return $this->hasMany('App\User','usuario_id');
    }

    public function getNotasAttribute(){

        return $this->attributes['nota'];
    }

    
}
