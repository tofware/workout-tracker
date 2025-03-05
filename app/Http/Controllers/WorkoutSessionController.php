<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Workout;
use App\Models\WorkoutSession;
use App\Http\Requests\StoreWorkoutSessionRequest;
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
            'workoutSession' => $workoutSession,
            'exercises_count' => $workout->exercises()->count()
        ]);
    }

    public function start(WorkoutSession $workoutSession)
    {
        $workout = $workoutSession->workout;

        return Inertia::render('WorkoutSession/Start', [
            'workout' => $workout,
            'exercises' => $workout->exercises()->with('instructions', 'equipment')->get(),
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
}
