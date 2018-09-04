<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\InscripcionCiclo
 *
 * @property int $id
 * @property int|null $nota
 * @property string $clave_ciclo
 * @property int $grupo_id
 * @property int $usuario_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read mixed $notas
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Grupo[] $grupo
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $usuario
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InscripcionCiclo whereClaveCiclo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InscripcionCiclo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InscripcionCiclo whereGrupoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InscripcionCiclo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InscripcionCiclo whereNota($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InscripcionCiclo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InscripcionCiclo whereUsuarioId($value)
 * @mixin \Eloquent
 */
class InscripcionCiclo extends Model
{
    protected $table = 'inscripcion_ciclo';

    protected $fillable = ['nota','clave_ciclo','grupo_id','usuario_id'];

    public function grupo(){

        return $this->hasMany('App\Grupo','grupo_id');
    } 

    public function usuario(){
        return $this->hasMany('App\User','usuario_id');
    }

public function getNotasAttribute(){
    
    return $this->attributes['nota']; 
}

}
