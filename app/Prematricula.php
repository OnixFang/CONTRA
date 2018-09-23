<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prematricula extends Model
{
    protected $table = 'prematriculas';

    protected $fillable = ['inscripcion_id', 'clave','grupo_id','usuario_id'];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class,'grupo_id');
    }

    public function usuario()
    {
        return $this->hasMany('App\User','usuario_id');
    }
}
