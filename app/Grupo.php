<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Grupo
 *
 * @property int $id
 * @property string $seccion
 * @property string|null $horario
 * @property int|null $bimestre
 * @property int $asignatura_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Asignatura $asignatura
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Grupo whereAsignaturaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Grupo whereBimestre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Grupo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Grupo whereHorario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Grupo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Grupo whereSeccion($value)
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

}
