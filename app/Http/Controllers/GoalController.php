<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Inertia\Inertia;
use App\Models\Exercise;
use App\Http\Resources\GoalResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreGoalRequest;

class GoalController extends Controller
{

    public function index()
    {
        return Inertia::render('Goals/Index', [
            'goals' => Auth::user()->goals,
            'exercises' => Exercise::all()
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
            'notes' => $validated['notes']
        ]);

        return to_route('goals.index');
    }

    public function destroy(Goal $goal)
    {
        $goal->delete();

        return to_route('goals.index');
    }
}
