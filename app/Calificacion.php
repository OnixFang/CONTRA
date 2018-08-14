<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Calificacion
 *
 * @property int $id
 * @property int $id_grupo
 * @property int $calificacion
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Grupo $grupo
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Calificacion whereCalificacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Calificacion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Calificacion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Calificacion whereIdGrupo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Calificacion whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Calificacion extends Model
{
    protected $table = "calificacion";

    protected $fillable=['id_grupo','calificacion'];

    public function grupo(){

    	return $this->belongsTo('App\Grupo','id_grupo');
    }
}
