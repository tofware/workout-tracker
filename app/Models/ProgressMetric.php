<?php

namespace App\Models;

use Database\Factories\ProgressMetricFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $weight
 * @property int|null $body_fat_percentage
 * @property int|null $muscle_mass
 * @property string $notes
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $user
 * @method static ProgressMetricFactory factory($count = null, $state = [])
 * @method static Builder<static>|ProgressMetric newModelQuery()
 * @method static Builder<static>|ProgressMetric newQuery()
 * @method static Builder<static>|ProgressMetric query()
 * @method static Builder<static>|ProgressMetric whereBodyFatPercentage($value)
 * @method static Builder<static>|ProgressMetric whereCreatedAt($value)
 * @method static Builder<static>|ProgressMetric whereId($value)
 * @method static Builder<static>|ProgressMetric whereMuscleMass($value)
 * @method static Builder<static>|ProgressMetric whereNotes($value)
 * @method static Builder<static>|ProgressMetric whereUpdatedAt($value)
 * @method static Builder<static>|ProgressMetric whereUserId($value)
 * @method static Builder<static>|ProgressMetric whereWeight($value)
 * @property-read \App\Models\TFactory|null $use_factory
 * @mixin Eloquent
 */
class ProgressMetric extends Model
{
    /** @use HasFactory<ProgressMetricFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'weight',
        'body_fat_percentage',
        'muscle_mass',
        'notes',
    ];

    protected $casts = [
        'created_at' => 'datetime:D d M Y H:i:s',
        'updated_at' => 'datetime:D d M Y H:i:s',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
