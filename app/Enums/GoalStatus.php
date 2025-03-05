<?php

namespace App\Enums;

enum GoalStatus: int
{
    case IN_PROGRESS = 0;
    case ACHIEVED = 1;
    case FAILED = 2;

    public function label(): string
    {
        return match ($this) {
            self::IN_PROGRESS => 'In Progress',
            self::ACHIEVED => 'Achieved',
            self::FAILED => 'Failed',
        };
    }
}
