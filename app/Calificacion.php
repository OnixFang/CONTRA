<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    protected $table = "calificacion";

    protected $fillable=['id_grupo','calificacion'];

    public function grupo(){

    	return $this->belongsTo('App\Grupo','id_grupo');
    }
}
