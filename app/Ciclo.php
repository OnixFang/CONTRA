<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciclo extends Model
{
    protected $table="ciclo";

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
