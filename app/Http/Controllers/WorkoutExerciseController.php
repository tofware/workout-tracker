<?php

namespace App\Http\Controllers;

use App\Http\Resources\WorkoutExerciseResource;
use App\Models\WorkoutExercise;
use App\Http\Requests\StoreWorkoutExerciseRequest;
use App\Http\Requests\UpdateWorkoutExerciseRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class WorkoutExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return WorkoutExerciseResource::collection(WorkoutExercise::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreWorkoutExerciseRequest $request
     * @return WorkoutExerciseResource
     */
    public function store(StoreWorkoutExerciseRequest $request): WorkoutExerciseResource
    {
        $validated = $request->validated();

        $workoutExercise = WorkoutExercise::create($validated);

        return new WorkoutExerciseResource($workoutExercise);
    }

    /**
     * Display the specified resource.
     *
     * @param WorkoutExercise $workoutExercise
     * @return WorkoutExerciseResource
     */
    public function show(WorkoutExercise $workoutExercise): WorkoutExerciseResource
    {
        return new WorkoutExerciseResource($workoutExercise);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateWorkoutExerciseRequest $request
     * @param WorkoutExercise $workoutExercise
     * @return WorkoutExerciseResource
     */
    public function update(UpdateWorkoutExerciseRequest $request, WorkoutExercise $workoutExercise): WorkoutExerciseResource
    {
        $validated = $request->validated();

        $workoutExercise->update($validated);

        return new WorkoutExerciseResource($workoutExercise);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param WorkoutExercise $workoutExercise
     * @return JsonResponse
     */
    public function destroy(WorkoutExercise $workoutExercise): JsonResponse
    {
        $workoutExercise->delete();

        return response()->json('Workout exercise deleted!');
    }
}
