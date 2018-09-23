<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Ciclo
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Grupo[] $grupos
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ciclo cicloAbiertos()
 * @mixin \Eloquent
 */
class Ciclo extends Model
{
    protected $table="ciclos";

    protected $fillable =['clave','fecha'];

    public function grupos(){

        return $this->hasMany('App\Grupo','id_ciclo');
    }

    public function scopeCicloAbiertos($query)
    {
        return $query->where('cerrado', 0);
    }

//    public function ciclosAbiertos(){
//
//    	return Ciclo::all()->where('cerrado',0);
//    }


}
