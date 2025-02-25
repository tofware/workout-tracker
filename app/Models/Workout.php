<?php

namespace App\Models;

use Eloquent;
use Illuminate\Support\Carbon;
use Database\Factories\WorkoutFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 *
 *
 * @property int $id
 * @property int $user_id
 * @property int $category_id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read WorkoutCategory $category
 * @property-read User $user
 * @method static WorkoutFactory factory($count = null, $state = [])
 * @method static Builder<static>|Workout newModelQuery()
 * @method static Builder<static>|Workout newQuery()
 * @method static Builder<static>|Workout query()
 * @method static Builder<static>|Workout whereCategoryId($value)
 * @method static Builder<static>|Workout whereCreatedAt($value)
 * @method static Builder<static>|Workout whereId($value)
 * @method static Builder<static>|Workout whereName($value)
 * @method static Builder<static>|Workout whereUpdatedAt($value)
 * @method static Builder<static>|Workout whereUserId($value)
 * @property-read Collection<int, Exercise> $exercises
 * @property-read int|null $exercises_count
 * @property-read Collection<int, WorkoutExercise> $workoutExercises
 * @property-read int|null $workout_exercises_count
 * @property-read Collection<int, \App\Models\WorkoutSession> $workoutSessions
 * @property-read int|null $workout_sessions_count
 * @property int $workout_category_id
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static Builder<static>|Workout whereWorkoutCategoryId($value)
 * @mixin Eloquent
 */
class Workout extends Model
{
    /** @use HasFactory<WorkoutFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'user_id'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(WorkoutCategory::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function exercises(): BelongsToMany
    {
        return $this->belongsToMany(Exercise::class, 'workout_exercises')
            ->withPivot('order')
            ->orderBy('order');
    }

    public function workoutSessions(): HasMany
    {
        return $this->hasMany(WorkoutSession::class);
    }
}
