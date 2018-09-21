<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\CicloTipo
 *
 * @property int $id
 * @property string $descripcion
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CicloTipo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CicloTipo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CicloTipo whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CicloTipo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CicloTipo whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CicloTipo extends Model
{
    const CUATRIMESTRAL = 1;

    const TRIMESTRAL = 2;

    public $table = 'ciclos_tipos';

    protected $fillable = ['descripcion'];
}
