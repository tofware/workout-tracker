<?php

namespace App\Models;

use Database\Factories\ExerciseFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Carbon;

/**
 * 
 *
 * @property-read Equipment|null $equipment
 * @property-read MuscleGroup|null $muscleGroup
 * @method static ExerciseFactory factory($count = null, $state = [])
 * @method static Builder<static>|Exercise newModelQuery()
 * @method static Builder<static>|Exercise newQuery()
 * @method static Builder<static>|Exercise query()
 * @property int $id
 * @property string $name
 * @property array|null $instructions
 * @property string|null $difficulty
 * @property int $muscle_group_id
 * @property int $equipment_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, WorkoutExercise> $workoutExercises
 * @property-read int|null $workout_exercises_count
 * @property-read Collection<int, \App\Models\Workout> $workouts
 * @property-read int|null $workouts_count
 * @method static Builder<static>|Exercise whereCreatedAt($value)
 * @method static Builder<static>|Exercise whereDifficulty($value)
 * @method static Builder<static>|Exercise whereEquipmentId($value)
 * @method static Builder<static>|Exercise whereId($value)
 * @method static Builder<static>|Exercise whereInstructions($value)
 * @method static Builder<static>|Exercise whereMuscleGroupId($value)
 * @method static Builder<static>|Exercise whereName($value)
 * @method static Builder<static>|Exercise whereUpdatedAt($value)
 * @property-read Collection<int, \App\Models\ExerciseSet> $exerciseSets
 * @property-read int|null $exercise_sets_count
 * @property-read Collection<int, \App\Models\ExerciseHistory> $exerciseHistory
 * @property-read int|null $exercise_history_count
 * @property-read Collection<int, \App\Models\Goal> $goals
 * @property-read int|null $goals_count
 * @mixin Eloquent
 */
class Exercise extends Model
{
    /** @use HasFactory<ExerciseFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'difficulty',
        'instructions',
        'muscle_group_id',
        'equipment_id'
    ];

    protected $casts = [
        'instructions' => 'array',
    ];

    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipment::class);
    }

    public function muscleGroup(): BelongsTo
    {
        return $this->belongsTo(MuscleGroup::class);
    }

    public function workoutExercises(): HasMany
    {
        return $this->hasMany(WorkoutExercise::class);
    }

    public function workouts(): HasManyThrough
    {
        return $this->hasManyThrough(Workout::class, WorkoutExercise::class);
    }

    public function exerciseSets(): HasMany
    {
        return $this->hasMany(ExerciseSet::class);
    }

    public function exerciseHistory(): HasMany
    {
        return $this->hasMany(ExerciseHistory::class);
    }

    public function goals(): HasMany
    {
        return $this->hasMany(Goal::class);
    }
}
