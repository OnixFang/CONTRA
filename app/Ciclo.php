<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Ciclo
 *
 * @property int $id
 * @property string $clave
 * @property string $fecha
 * @property int|null $id_pensum
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int $cerrado
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Grupo[] $grupos
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ciclo cicloAbiertos()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ciclo whereCerrado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ciclo whereClave($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ciclo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ciclo whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ciclo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ciclo whereIdPensum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ciclo whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Ciclo extends Model
{
    protected $table="ciclo";

    protected $fillable =['clave','fecha'];

    public function grupos(){

        return $this->hasMany('App\Grupo','id_ciclo');
    }

    public function scopeCicloAbiertos($query)
    {
        return $query->where('cerrado', 0);
    }

//    public function ciclosAbiertos(){
//
//    	return Ciclo::all()->where('cerrado',0);
//    }


}
