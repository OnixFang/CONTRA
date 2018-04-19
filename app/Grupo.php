<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table = "grupo";

    protected $fillable = ['descripcion','clave','horario','bimestre','id_ciclo','id_asignatura','id_facilitador'];

    public function asignatura(){

    	return $this->belongsTo('App\Asignatura','id_asignatura');
    }

    public function facilitadores(){

    	return $this->belongsTo('App\facilitador','id_facilitador');
    }

    public function ciclo(){

    	return $this->belongsTo('App\Ciclo','id_ciclo');
    }

    public function calificacion(){

        return $this->hasOne('App\Calificacion','id_grupo');
    }

    
}
