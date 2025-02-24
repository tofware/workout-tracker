<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Workout;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\WorkoutResource;
use App\Http\Requests\StoreWorkoutRequest;
use App\Http\Requests\UpdateWorkoutRequest;

class WorkoutController extends Controller
{
    public function index()
    {
        return Inertia::render('Workout/Index', [
            'workouts' => Workout::with('category')->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('Workout/Create', [
            'categories' => Category::all()
        ]);
    }

    public function store(StoreWorkoutRequest $request)
    {
        $validated = $request->validated();

        $workout = Workout::create([
            'name' => $validated['name'],
            'category_id' => $validated['category'],
            'user_id' => Auth::id(),
        ]);

        return to_route('workouts.index');
    }

    public function show(Workout $workout)
    {
        return Inertia::render('Workout/Show', [
            'workout' => $workout,
            'workoutExercises' => $workout->workoutExercises,
            'exercises' => $workout->exercises
        ]);
    }

    public function edit(Workout $workout)
    {
        return Inertia::render('Workout/Edit', [
            'workout' => $workout
        ]);
    }

    public function update(UpdateWorkoutRequest $request, Workout $workout)
    {
        $validated = $request->validated();

        $workout->update($validated);

        return to_route('workouts.edit');
    }

    public function destroy(Workout $workout)
    {
        $workout->delete();

        return to_route('workouts.index');
    }

    public function start(Workout $workout)
    {
        return Inertia::render('Workout/Start', [
            'workout' => $workout,
            'workoutExercises' => $workout->workoutExercises,
            'exercises' => $workout->exercises
        ]);
    }
}
