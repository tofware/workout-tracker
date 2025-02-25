<?php

namespace App\Models;

use Database\Factories\ExerciseSetFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * 
 *
 * @method static Builder<static>|ExerciseSet newModelQuery()
 * @method static Builder<static>|ExerciseSet newQuery()
 * @method static Builder<static>|ExerciseSet query()
 * @property-read Exercise|null $exercise
 * @property-read WorkoutSession|null $workoutSession
 * @method static ExerciseSetFactory factory($count = null, $state = [])
 * @property int $id
 * @property int $workout_session_id
 * @property int $exercise_id
 * @property string|null $set_number
 * @property int|null $repetitions
 * @property int|null $weight
 * @property string|null $notes
 * @property int|null $rest_time
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder<static>|ExerciseSet whereCreatedAt($value)
 * @method static Builder<static>|ExerciseSet whereExerciseId($value)
 * @method static Builder<static>|ExerciseSet whereId($value)
 * @method static Builder<static>|ExerciseSet whereNotes($value)
 * @method static Builder<static>|ExerciseSet whereRepetitions($value)
 * @method static Builder<static>|ExerciseSet whereRestTime($value)
 * @method static Builder<static>|ExerciseSet whereSetNumber($value)
 * @method static Builder<static>|ExerciseSet whereUpdatedAt($value)
 * @method static Builder<static>|ExerciseSet whereWeight($value)
 * @method static Builder<static>|ExerciseSet whereWorkoutSessionId($value)
 * @property-read \App\Models\TFactory|null $use_factory
 * @mixin Eloquent
 */
class ExerciseSet extends Model
{
    /** @use HasFactory<ExerciseSetFactory> */
    use HasFactory;

    protected $fillable = [
        'workout_session_id',
        'exercise_id',
        'set_number',
        'repetitions',
        'weight',
        'notes',
    ];

    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class);
    }

    public function workoutSession(): BelongsTo
    {
        return $this->belongsTo(WorkoutSession::class);
    }
}
