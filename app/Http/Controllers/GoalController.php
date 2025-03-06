<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Inertia\Inertia;
use App\Models\Exercise;
use App\Enums\GoalStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\StoreGoalRequest;

class GoalController extends Controller
{
    public function index()
    {
        $goals = Auth::user()->goals->map(function ($goal) {
            $goal->status_label = GoalStatus::from($goal->status)->label();

            return $goal;
        });

        $exercises = Cache::remember('exercises', 60 * 60 * 24, function() {
            return Exercise::select('id', 'name')->get();
        });

        return Inertia::render('Goals/Index', [
            'goals' => $goals,
            'exercises' => $exercises,
        ]);
    }

    public function store(StoreGoalRequest $request)
    {
        $validated = $request->validated();

        Goal::create([
            'user_id' => Auth::id(),
            'exercise_id' => Exercise::find($validated['exercise'])->first()->id,
            'goal_type' => $validated['goal_type'],
            'target_value' => $validated['target_value'],
            'deadline' => $validated['deadline'],
            'status' => 0,
            'notes' => $validated['notes'],
        ]);

        return to_route('goals.index');
    }

    public function destroy(Goal $goal)
    {
        $goal->delete();

        return to_route('goals.index');
    }
}
