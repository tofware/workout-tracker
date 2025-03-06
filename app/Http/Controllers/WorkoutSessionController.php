<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkoutSessionRequest;
use App\Http\Requests\UpdateWorkoutSessionRequest;
use App\Models\Workout;
use App\Models\WorkoutSession;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class WorkoutSessionController extends Controller
{
    public function index()
    {
        return Inertia::render('WorkoutSession/Index', [
            'sessions' => WorkoutSession::whereNotNull('duration')->where('user_id', Auth::id())->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('WorkoutSession/Create', [
            'workouts' => Workout::where('user_id', Auth::id())->get(),
        ]);
    }

    public function store(StoreWorkoutSessionRequest $request)
    {
        $validated = $request->validated();

        $workout = Workout::with('exercises')
        ->where('user_id', Auth::id())
        ->find($validated['workout']);

        $workoutSession = WorkoutSession::create([
            'workout_id' => $validated['workout'],
            'user_id' => Auth::user()->id,
        ]);

        return Inertia::render('WorkoutSession/Overview', [
            'workout' => $workout,
            'exercises' => $workout->exercises,
            'workoutSession' => $workoutSession,
            'exercises_count' => $workout->exercises()->count(),
        ]);
    }

    public function start(WorkoutSession $workoutSession)
    {
        $workout = $workoutSession->workout;

        return Inertia::render('WorkoutSession/Start', [
            'workout' => $workout,
            'exercises' => $workout->exercises()->with('instructions', 'equipment')->get(),
            'workoutSession' => $workoutSession,
        ]);
    }

    public function finish(WorkoutSession $workoutSession, UpdateWorkoutSessionRequest $request)
    {
        $validated = $request->validated();

        $workoutSession->update([
            'duration' => $validated['duration'],
            'notes' => $validated['notes'],
            'calories_burned' => $validated['calories_burned'],
            'average_intensity' => $validated['average_intensity'],
        ]);

        return to_route('workout-sessions.index');
    }
}
