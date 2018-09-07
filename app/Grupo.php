<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Grupo
 *
 * @property int $id
 * @property string $clave
 * @property string $horario
 * @property int $bimestre
 * @property int $id_ciclo
 * @property int $id_asignatura
 * @property int $id_facilitador
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Asignatura $asignatura
 * @property-read \App\Calificacion $calificacion
 * @property-read \App\Ciclo $ciclo
 * @property-read \App\Facilitador $facilitadores
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Grupo whereBimestre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Grupo whereClave($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Grupo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Grupo whereHorario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Grupo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Grupo whereIdAsignatura($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Grupo whereIdCiclo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Grupo whereIdFacilitador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Grupo whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Grupo extends Model
{
    protected $table = "grupos";

    protected $fillable = ['seccion', 'horario', 'bimestre', 'asignatura_id'];

    public function asignatura(){

        return $this->belongsTo('App\Asignatura','asignatura_id');
    }

//    public function facilitadores(){
//
//        return $this->belongsTo('App\Facilitador','id_facilitador');
//    }
//
//    public function ciclo(){
//
//        return $this->belongsTo('App\Ciclo','id_ciclo');
//    }

    public function calificacion(){

        return $this->hasOne('App\Calificacion','id_grupo');
    }


}
