<?php

namespace App\Models;

use Database\Factories\WorkoutSessionFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $workout_id
 * @property int $user_id
 * @property string|null $notes
 * @property int|null $duration
 * @property int|null $calories_burned
 * @property int|null $average_intensity
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $user
 * @property-read Workout $workout
 *
 * @method static WorkoutSessionFactory factory($count = null, $state = [])
 * @method static Builder<static>|WorkoutSession newModelQuery()
 * @method static Builder<static>|WorkoutSession newQuery()
 * @method static Builder<static>|WorkoutSession query()
 * @method static Builder<static>|WorkoutSession whereAverageIntensity($value)
 * @method static Builder<static>|WorkoutSession whereCaloriesBurned($value)
 * @method static Builder<static>|WorkoutSession whereCreatedAt($value)
 * @method static Builder<static>|WorkoutSession whereDuration($value)
 * @method static Builder<static>|WorkoutSession whereId($value)
 * @method static Builder<static>|WorkoutSession whereNotes($value)
 * @method static Builder<static>|WorkoutSession whereUpdatedAt($value)
 * @method static Builder<static>|WorkoutSession whereUserId($value)
 * @method static Builder<static>|WorkoutSession whereWorkoutId($value)
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ExerciseSet> $exerciseSets
 * @property-read int|null $exercise_sets_count
 * @property-read \App\Models\TFactory|null $use_factory
 *
 * @mixin Eloquent
 */
class WorkoutSession extends Model
{
    /** @use HasFactory<WorkoutSessionFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'workout_id',
        'user_id',
        'notes',
        'duration',
        'calories_burned',
        'average_intensity',
    ];

    protected $casts = [
        'created_at' => 'datetime:D d M Y H:i:s',
        'updated_at' => 'datetime:D d M Y H:i:s',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function workout(): BelongsTo
    {
        return $this->belongsTo(Workout::class);
    }

    public function exerciseSets(): HasMany
    {
        return $this->hasMany(ExerciseSet::class);
    }
}
