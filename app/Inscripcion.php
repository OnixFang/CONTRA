<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Inscripcion
 *
 * @mixin \Eloquent
 */
class Inscripcion extends Model
{
    public $table = 'inscripciones';

    protected $fillable = ['carrera_id', 'pensum_id'];
}
