<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Workout;
use App\Models\WorkoutSession;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\WorkoutSessionResource;
use App\Http\Requests\StoreWorkoutSessionRequest;
use App\Http\Requests\UpdateWorkoutSessionRequest;
use Illuminate\Support\Facades\Auth;

class WorkoutSessionController extends Controller
{
    public function create()
    {
        return Inertia::render('WorkoutSession/Create', [
            'workouts' => Workout::all()
        ]);
    }

    public function store(StoreWorkoutSessionRequest $request)
    {
        $validated = $request->validated();

        $workout = Workout::with('exercises')->find($validated['workout']);

        $workoutSession = WorkoutSession::create([
            'workout_id' => $validated['workout'],
            'user_id' => Auth::user()->id
        ]);

        return Inertia::render('WorkoutSession/Overview', [
            'workout' => $workout,
            'exercises' => $workout->exercises,
            'workoutSession' => $workoutSession
        ]);
    }

    public function start(WorkoutSession $workoutSession)
    {
        $workout = $workoutSession->workout;

        return Inertia::render('WorkoutSession/Start', [
            'workout' => $workout,
            'exercises' => $workout->exercises,
            'workoutSession' => $workoutSession
        ]);
    }

    public function finish(WorkoutSession $workoutSession)
    {
        $workout = $workoutSession->workout;

        return Inertia::render('WorkoutSession/Finish', [
            'workout' => $workout,
            'exercises' => $workout->exercises,
            'workoutSession' => $workoutSession
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateWorkoutSessionRequest $request
     * @param WorkoutSession $workoutSession
     * @return WorkoutSessionResource
     */
    public function update(UpdateWorkoutSessionRequest $request, WorkoutSession $workoutSession): WorkoutSessionResource
    {
        $validated = $request->validated();

        $workoutSession->update($validated);

        return new WorkoutSessionResource($workoutSession);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param WorkoutSession $workoutSession
     * @return JsonResponse
     */
    public function destroy(WorkoutSession $workoutSession): JsonResponse
    {
        $workoutSession->delete();

        return response()->json('Workout session deleted!');
    }
}
