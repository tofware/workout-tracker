<?php

namespace App\Models;

use Database\Factories\ExerciseFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 *
 * @property-read Equipment|null $equipment
 * @property-read MuscleGroup|null $muscleGroup
 * @method static ExerciseFactory factory($count = null, $state = [])
 * @method static Builder<static>|Exercise newModelQuery()
 * @method static Builder<static>|Exercise newQuery()
 * @method static Builder<static>|Exercise query()
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
}
