<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExerciseSetRequest;
use App\Http\Requests\UpdateExerciseSetRequest;
use App\Http\Resources\ExerciseSetResource;
use App\Models\ExerciseSet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ExerciseSetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return ExerciseSetResource::collection(ExerciseSet::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreExerciseSetRequest $request
     * @return ExerciseSetResource
     */
    public function store(StoreExerciseSetRequest $request): ExerciseSetResource
    {
        $validated = $request->validated();

        $exerciseSet = ExerciseSet::create($validated);

        return new ExerciseSetResource($exerciseSet);
    }

    /**
     * Display the specified resource.
     *
     * @param ExerciseSet $exerciseSet
     * @return ExerciseSetResource
     */
    public function show(ExerciseSet $exerciseSet): ExerciseSetResource
    {
        return new ExerciseSetResource($exerciseSet);
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
