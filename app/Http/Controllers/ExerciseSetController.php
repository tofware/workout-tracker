<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExerciseSetRequest;
use App\Http\Requests\UpdateExerciseSetRequest;
use App\Http\Resources\ExerciseSetResource;
use App\Models\ExerciseSet;
use Illuminate\Http\JsonResponse;

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

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateExerciseSetRequest $request
     * @param ExerciseSet $exerciseSet
     * @return ExerciseSetResource
     */
    public function update(UpdateExerciseSetRequest $request, ExerciseSet $exerciseSet): ExerciseSetResource
    {
        $validated = $request->validated();

        $exerciseSet->update($validated);

        return new ExerciseSetResource($exerciseSet);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ExerciseSet $exerciseSet
     * @return JsonResponse
     */
    public function destroy(ExerciseSet $exerciseSet): JsonResponse
    {
        $exerciseSet->delete();

        return response()->json('Exercise set deleted!');
    }
}
