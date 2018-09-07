<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Inscripcion
 *
 * @property int $id
 * @property int $user_id
 * @property int $carrera_id
 * @property int $pensum_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Inscripcion whereCarreraId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Inscripcion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Inscripcion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Inscripcion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Inscripcion wherePensumId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Inscripcion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Inscripcion whereUserId($value)
 * @mixin \Eloquent
 */
class Inscripcion extends Model
{
    use SoftDeletes;

    public $table = 'inscripciones';

    protected $fillable = ['carrera_id', 'pensum_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'carrera_id');
    }

    public function pensum()
    {
        return $this->belongsTo(Pensum::class, 'pensum_id');
    }
}
