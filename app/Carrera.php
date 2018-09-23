<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Carrera
 *
 * @property int $id
 * @property string $descripcion
 * @property string|null $deleted_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Pensum[] $pensums
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Carrera whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Carrera whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Carrera whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Carrera whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Carrera whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Carrera extends Model
{
    protected $table = "carreras";

    protected $fillable = ['descripcion'];

    public function pensums ()
    {
        return $this->hasMany(Pensum::class);
    }

    public function users ()
    {
        return $this->belongsToMany(User::class);
    }
}
