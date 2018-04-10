<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facilitador extends Model
{
    protected $table="facilitador";

    protected $fillable = ['nombre','ciudad'];

}
