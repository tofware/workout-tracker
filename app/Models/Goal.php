<?php

namespace App\Models;

use App\Enums\GoalStatus;
use Database\Factories\GoalFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 
 *
 * @property GoalStatus $experience_level
 * @property-read \App\Models\Exercise|null $exercise
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\GoalFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Goal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Goal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Goal query()
 * @mixin \Eloquent
 */
class Goal extends Model
{
    /** @use HasFactory<GoalFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'exercise_id',
        'goal_type',
        'target_value',
        'deadline',
        'status',
        'notes'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'experience_level' => GoalStatus::class
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class);
    }
}
