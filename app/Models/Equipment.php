<?php

namespace App\Models;

use Database\Factories\EquipmentFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @method static EquipmentFactory factory($count = null, $state = [])
 * @method static Builder<static>|Equipment newModelQuery()
 * @method static Builder<static>|Equipment newQuery()
 * @method static Builder<static>|Equipment query()
 * @property int $id
 * @property string $name
 * @method static Builder<static>|Equipment whereId($value)
 * @method static Builder<static>|Equipment whereName($value)
 * @mixin Eloquent
 */
class Equipment extends Model
{
    /** @use HasFactory<EquipmentFactory> */
    use HasFactory;

    public $timestamps = false;

    protected $table = 'equipments';

    protected $fillable = [
        'name'
    ];
}
