<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Pensum
 *
 * @property int $id
 * @property int $carrera_id
 * @property int $ciclo_tipo_id
 * @property string $descripcion
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Asignatura[] $asignaturas
 * @property-read \App\Carrera $carrera
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pensum whereCarreraId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pensum whereCicloTipoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pensum whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pensum whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pensum whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pensum whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Pensum extends Model
{
    protected $table = 'pensums';

    protected $fillable = ['carrera_id', 'descripcion', 'ciclo_tipo_id'];

    public function asignaturas()
    {
        return $this->belongsToMany(Asignatura::class, 'asignaturas_pensums');
    }

    public function carrera(){

        return $this->belongsTo(Carrera::class);
    }

    public function getUserPensum(){
        
    }
}
