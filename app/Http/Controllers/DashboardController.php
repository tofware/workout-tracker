<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cacheKey = "dashboard_stats_{$user->id}";

        $stats = Cache::get($cacheKey);

        if (!$stats) {
            $user->loadCount([
                'workoutSessions',
                'goals' => fn ($query) => $query->where('status', 1),
            ])->loadSum('workoutSessions', 'duration');

            $setsDone = $user->workoutSessions()->withCount('exerciseSets')->get()->sum('exercise_sets_count');

            $stats = [
                'workoutsCompleted' => $user->workout_sessions_count,
                'goalsAchieved' => $user->goals_count,
                'setsDone' => $setsDone,
                'timeWorkingOut' => $user->workout_sessions_sum_duration,
            ];

            Cache::put($cacheKey, $stats, now()->addMinutes(10));
        }

        return Inertia::render('Dashboard', $stats);
    }
}
