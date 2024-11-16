<?php

namespace App\Models;

use Database\Factories\MuscleGroupFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @method static MuscleGroupFactory factory($count = null, $state = [])
 * @method static Builder<static>|MuscleGroup newModelQuery()
 * @method static Builder<static>|MuscleGroup newQuery()
 * @method static Builder<static>|MuscleGroup query()
 * @method static Builder<static>|MuscleGroup whereId($value)
 * @method static Builder<static>|MuscleGroup whereName($value)
 * @mixin Eloquent
 */
class MuscleGroup extends Model
{
    /** @use HasFactory<MuscleGroupFactory> */
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];
}
