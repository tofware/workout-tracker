<?php

namespace App\Models;

use Database\Factories\EquipmentFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 
 *
 * @method static EquipmentFactory factory($count = null, $state = [])
 * @method static Builder<static>|Equipment newModelQuery()
 * @method static Builder<static>|Equipment newQuery()
 * @method static Builder<static>|Equipment query()
 * @property int $id
 * @property string $name
 * @method static Builder<static>|Equipment whereId($value)
 * @method static Builder<static>|Equipment whereName($value)
 * @property-read Collection<int, Exercise> $exercises
 * @property-read int|null $exercises_count
 * @property-read \App\Models\TFactory|null $use_factory
 * @mixin Eloquent
 */
class Equipment extends Model
{
    /** @use HasFactory<EquipmentFactory> */
    use HasFactory;

    public $timestamps = false;

    protected $table = 'equipments';

    protected $fillable = [
        'name',
    ];

    public function exercises(): HasMany
    {
        return $this->hasMany(Exercise::class);
    }
}
