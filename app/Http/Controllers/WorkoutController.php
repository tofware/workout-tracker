<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Workout;
use App\Models\Exercise;
use App\Models\WorkoutCategory;
use Illuminate\Support\Facades\Auth;
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
            'categories' => WorkoutCategory::all()
        ]);
    }

    public function store(StoreWorkoutRequest $request)
    {
        $validated = $request->validated();

        Workout::create([
            'name' => $validated['name'],
            'workout_category_id' => $validated['category'],
            'user_id' => Auth::id(),
        ]);

        return to_route('workouts.index');
    }

    public function show(Workout $workout)
    {
        return Inertia::render('Workout/Show', [
            'workout' => $workout,
            'exercises' => $workout->exercises
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

    public function getExercises(Workout $workout)
    {
        return Inertia::render('Workout/Exercises', [
            'workout' => $workout,
            'workoutExercises' => $workout->exercises()->with('equipment', 'category', 'muscleGroups')->get(),
            'exercises' => Exercise::all(),
        ]);
    }

    public function addExercise(Workout $workout, Exercise $exercise)
    {
        $nextOrder = $workout->exercises()->max('order') + 1;

        $workout->exercises()->attach($exercise->id, ['order' => $nextOrder]);

        return to_route('workouts.get-exercises', $workout);
    }

    public function removeExercise(Workout $workout, Exercise $exercise)
    {
        $workout->exercises()->detach($exercise->id);

        return to_route('workouts.get-exercises', $workout);
    }
}
