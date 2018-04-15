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
}
