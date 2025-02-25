<?php

namespace App\Models;

use Database\Factories\ExerciseHistoryFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * 
 *
 * @property-read Exercise|null $exercise
 * @property-read User|null $user
 * @method static ExerciseHistoryFactory factory($count = null, $state = [])
 * @method static Builder<static>|ExerciseHistory newModelQuery()
 * @method static Builder<static>|ExerciseHistory newQuery()
 * @method static Builder<static>|ExerciseHistory query()
 * @property int $id
 * @property int $user_id
 * @property int $exercise_id
 * @property string $date
 * @property int $best_weight
 * @property int $best_repetitions
 * @property int $one_rep_max
 * @property string|null $notes
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder<static>|ExerciseHistory whereBestRepetitions($value)
 * @method static Builder<static>|ExerciseHistory whereBestWeight($value)
 * @method static Builder<static>|ExerciseHistory whereCreatedAt($value)
 * @method static Builder<static>|ExerciseHistory whereDate($value)
 * @method static Builder<static>|ExerciseHistory whereExerciseId($value)
 * @method static Builder<static>|ExerciseHistory whereId($value)
 * @method static Builder<static>|ExerciseHistory whereNotes($value)
 * @method static Builder<static>|ExerciseHistory whereOneRepMax($value)
 * @method static Builder<static>|ExerciseHistory whereUpdatedAt($value)
 * @method static Builder<static>|ExerciseHistory whereUserId($value)
 * @property-read \App\Models\TFactory|null $use_factory
 * @mixin Eloquent
 */
class ExerciseHistory extends Model
{
    /** @use HasFactory<ExerciseHistoryFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'exercise_id',
        'date',
        'best_weight',
        'best_repetitions',
        'one_rep_max',
        'notes'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class);
    }
}
