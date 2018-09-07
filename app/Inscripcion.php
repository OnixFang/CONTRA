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

    protected $fillable = ['user_id','carrera_id', 'pensum_id'];

    public function user(){

        return $this->hasMany(Users::class)->whereNull('deleted_at');
    }

    public function pensum(){

        return $this->belongsTo(Pensum::class);
    }
}
