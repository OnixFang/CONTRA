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
 * @property string|null $deleted_at
 * @property int $propedeutico
 * @property-read \App\Grupo $grupos
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Pensum[] $pensums
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Asignatura[] $requisitos
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asignatura whereClave($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asignatura whereCr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asignatura whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asignatura whereCuatrimestre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asignatura whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asignatura whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asignatura whereHp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asignatura whereHt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asignatura whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asignatura wherePropedeutico($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Asignatura whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Asignatura extends Model
{
    const KEY_LEN = 6;

    protected $table ="asignaturas";

    protected $fillable =['descripcion','clave','hp','ht','cr','cuatrimestre','id_pensum','pre_requisito1','pre_requisito2','propedeutico'];

    public function pensums()
    {
        return $this->belongsToMany(Pensum::class, 'asignaturas_pensums');
    }

    public function grupos()
    {
        return $this->belongsTo('App\Grupo','id_asignatura');
    }

    public function requisitos ()
    {
        return $this->belongsToMany(Asignatura::class, 'asignaturas_requisitos', 'asignatura_id', 'requisito_id');
    }

}
