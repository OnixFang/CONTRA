<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pensum extends Model
{
    protected $table = 'pensum';

    protected $fillable = ['descripcion'];

    public function asignatura(){

    	return $this->hasMany('App\Asignatura','id_pensum');
    }
    
}
