<?php

namespace App\Models;

use Database\Factories\ExerciseCategoryFactory;
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
 * @method static ExerciseCategoryFactory factory($count = null, $state = [])
 * @method static Builder<static>|ExerciseCategory newModelQuery()
 * @method static Builder<static>|ExerciseCategory newQuery()
 * @method static Builder<static>|ExerciseCategory query()
 * @method static Builder<static>|ExerciseCategory whereId($value)
 * @method static Builder<static>|ExerciseCategory whereName($value)
 * @property-read Collection<int, \App\Models\Exercise> $exercises
 * @property-read int|null $exercises_count
 * @property-read \App\Models\TFactory|null $use_factory
 * @mixin Eloquent
 */
class ExerciseCategory extends Model
{
    /** @use HasFactory<ExerciseCategoryFactory> */
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;

    public function exercises(): HasMany
    {
        return $this->hasMany(Exercise::class);
    }
}
