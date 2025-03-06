<?php

namespace App\Models;

use Database\Factories\WorkoutCategoryFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property-read Collection<int, Workout> $workouts
 * @property-read int|null $workouts_count
 * @method static WorkoutCategoryFactory factory($count = null, $state = [])
 * @method static Builder<static>|WorkoutCategory newModelQuery()
 * @method static Builder<static>|WorkoutCategory newQuery()
 * @method static Builder<static>|WorkoutCategory query()
 * @method static Builder<static>|WorkoutCategory whereId($value)
 * @method static Builder<static>|WorkoutCategory whereName($value)
 * @property-read \App\Models\TFactory|null $use_factory
 * @mixin Eloquent
 */
class WorkoutCategory extends Model
{
    /** @use HasFactory<WorkoutCategoryFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public $timestamps = false;

    public function workouts(): HasMany
    {
        return $this->hasMany(Workout::class);
    }
}
