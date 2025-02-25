<?php

namespace App\Models;

use Database\Factories\WorkoutExerciseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 *
 * @property int $id
 * @property int $workout_id
 * @property int $exercise_id
 * @property int $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Exercise $exercise
 * @property-read \App\Models\Workout $workout
 * @method static \Database\Factories\WorkoutExerciseFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutExercise newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutExercise newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutExercise query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutExercise whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutExercise whereExerciseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutExercise whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutExercise whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutExercise whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutExercise whereWorkoutId($value)
 * @property-read \App\Models\TFactory|null $use_factory
 * @mixin \Eloquent
 */
class WorkoutExercise extends Model
{
    /** @use HasFactory<WorkoutExerciseFactory> */
    use HasFactory;

    protected $fillable = [
        'order',
        'workout_id',
        'exercise_id'
    ];

    protected $casts = [
        'order' => 'integer'
    ];

    public function workout(): BelongsTo
    {
        return $this->belongsTo(Workout::class);
    }

    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class);
    }
}
