<?php

namespace App\Enums;

enum GoalStatus: int
{
    case IN_PROGRESS = 0;
    case ACHIEVED = 1;
    case FAILED = 2;
}
