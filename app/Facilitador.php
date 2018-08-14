<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Facilitador
 *
 * @property int $id
 * @property string $nombre
 * @property string $ciudad
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Facilitador whereCiudad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Facilitador whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Facilitador whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Facilitador whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Facilitador whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Facilitador extends Model
{
    protected $table="facilitador";

    protected $fillable = ['nombre','ciudad'];

}
