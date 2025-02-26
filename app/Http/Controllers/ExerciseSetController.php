<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExerciseSetRequest;
use App\Models\ExerciseSet;

class ExerciseSetController extends Controller
{

    public function store(StoreExerciseSetRequest $request)
    {
        $validated = $request->validated();
        $setNumber = 1;

        foreach ($validated['sets'] as $set) {
            ExerciseSet::create([
                'workout_session_id' => $validated['workout_session_id'],
                'exercise_id' => $validated['exercise_id'],
                'set_number' => $setNumber,
                'repetitions' => $set['reps'],
                'weight' => $set['weight'],
                'notes' => $set['notes'] ?? null
            ]);

            $setNumber++;
        }

        return back()->with('success', 'Exercise data saved.');
    }
}
