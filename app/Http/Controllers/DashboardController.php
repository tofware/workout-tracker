<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return Inertia::render('Dashboard', [
            'workoutsCompleted' => $user->workoutSessions->count(),
            'goalsAchieved' => $user->goals->where('status', 1)->count(),
            'setsDone' => $user->workoutSessions()->withCount('exerciseSets')->get()->sum('exercise_sets_count'),
            'timeWorkingOut' => $user->workoutSessions->sum('duration'),
        ]);
    }
}
