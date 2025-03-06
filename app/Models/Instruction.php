<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $exercise_id
 * @property string $instruction
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instruction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instruction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instruction query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instruction whereExerciseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instruction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instruction whereInstruction($value)
 * @mixin \Eloquent
 */
class Instruction extends Model
{
    public $timestamps = false;
}
