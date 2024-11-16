<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExerciseResource;
use App\Models\Exercise;
use App\Http\Requests\StoreExerciseRequest;
use App\Http\Requests\UpdateExerciseRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return ExerciseResource::collection(Exercise::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreExerciseRequest $request
     * @return ExerciseResource
     */
    public function store(StoreExerciseRequest $request): ExerciseResource
    {
        $validated = $request->validated();

        $exercise = Exercise::create($validated);

        return new ExerciseResource($exercise);
    }

    /**
     * Display the specified resource.
     *
     * @param Exercise $exercise
     * @return ExerciseResource
     */
    public function show(Exercise $exercise): ExerciseResource
    {
        return new ExerciseResource($exercise);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateExerciseRequest $request
     * @param Exercise $exercise
     * @return ExerciseResource
     */
    public function update(UpdateExerciseRequest $request, Exercise $exercise): ExerciseResource
    {
        $validated = $request->validated();

        $exercise->update($validated);

        return new ExerciseResource($exercise);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Exercise $exercise
     * @return JsonResponse
     */
    public function destroy(Exercise $exercise): JsonResponse
    {
        $exercise->delete();

        return response()->json('Exercise deleted!');
    }
}
