<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Asignatura
 *
 * @property int $id
 * @property string $descripcion
 * @property string $clave
 * @property int $hp
 * @property int $ht
 * @property int $cr
 * @property int $cuatrimestre
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int $id_pensum
 * @property int|null $pre_requisito1
 * @property int|null $pre_requisito2
 * @property int $aprovado
 * @property int $propedeutico
 * @property-read \App\Grupo $grupos
 * @property-read \App\Pensum $pensum
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asignatura whereAprovado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asignatura whereClave($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asignatura whereCr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asignatura whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asignatura whereCuatrimestre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asignatura whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asignatura whereHp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asignatura whereHt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asignatura whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asignatura whereIdPensum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asignatura wherePreRequisito1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asignatura wherePreRequisito2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asignatura wherePropedeutico($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asignatura whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Asignatura extends Model
{
    protected $table ="asignatura";

    protected $fillable =['descripcion','clave','hp','ht','cr','cuatrimestre','id_pensum','pre_requisito1','pre_requisito2','propedeutico'];

    public function pensum(){

    	return $this->belongsTo('App\Pensum','id_pensum');
    }

    public function grupos(){

    	return $this->belongsTo('App\Grupo','id_asignatura');
    }

    
}
