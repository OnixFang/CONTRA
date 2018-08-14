<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CicloTipo extends Model
{
    const CUATRIMESTRAL = 1;

    const TRIMESTRAL = 2;

    public $table = 'ciclos_tipos';

    protected $fillable = ['descripcion'];
}
