<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
