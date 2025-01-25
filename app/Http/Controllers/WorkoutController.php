<?php

namespace App\Http\Controllers;

use App\Http\Resources\WorkoutResource;
use App\Models\Workout;
use App\Http\Requests\StoreWorkoutRequest;
use App\Http\Requests\UpdateWorkoutRequest;
use Auth;
use Illuminate\Http\JsonResponse;
use Inertia\Inertia;

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
        return Inertia::render('Workout/Create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreWorkoutRequest $request
     * @return WorkoutResource
     */
    public function store(StoreWorkoutRequest $request): WorkoutResource
    {
        $validated = $request->validated();

        $workout = Workout::create([
            ...$validated,
            'user_id' => Auth::id(),
        ]);

        return new WorkoutResource($workout);
    }

    /**
     * Display the specified resource.
     *
     * @param Workout $workout
     * @return WorkoutResource
     */
    public function show(Workout $workout): WorkoutResource
    {
        return new WorkoutResource($workout);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateWorkoutRequest $request
     * @param Workout $workout
     * @return WorkoutResource
     */
    public function update(UpdateWorkoutRequest $request, Workout $workout): WorkoutResource
    {
        $validated = $request->validated();

        $workout->update($validated);

        return new WorkoutResource($workout);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Workout $workout
     * @return JsonResponse
     */
    public function destroy(Workout $workout): JsonResponse
    {
        $workout->delete();

        return response()->json('Workout deleted!');
    }
}
