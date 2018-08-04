<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    protected $table = "carreras";

    protected $fillable = [];

    public function pensums () {
        return $this->hasMany(Pensum::class);
    }

    public function users () {
        return $this->belongsToMany(User::class);
    }
}
