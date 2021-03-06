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
    const SOC500 = "SOC-500";
    const SOC600 = "SOC-600";

    protected $table = "asignaturas";

    protected $fillable = ['descripcion', 'clave', 'hp', 'ht', 'cr', 'cuatrimestre', 'propedeutico'];

    public function pensums()
    {
        return $this->belongsToMany(Pensum::class, 'asignaturas_pensums', 'asignatura_id', 'pensum_id');
    }

    public function grupos()
    {
        return $this->hasMany('App\Grupo', 'asignatura_id');
    }

    public function requisitos()
    {
        return $this->belongsToMany(Asignatura::class, 'asignaturas_requisitos', 'asignatura_id', 'requisito_id')->withPivot(['requisito_id']);
    }

    public function inscripcion_ciclo()
    {
        return $this->hasMany(InscripcionCiclo::class);
    }
}
