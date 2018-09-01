<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InscripcionCiclo extends Model
{
    protected $table = 'inscripcion_ciclo';

    protected $fillable = ['nota','clave_ciclo','grupo_id','usuario_id'];

    public function grupo(){

        return $this->hasMany('App\Grupo','grupo_id');
    } 

    public function usuario(){
        return $this->hasMany('App\User','usuario_id');
    }

public function getNotasAttribute(){
    
    return $this->attributes['nota']; 
}

}
