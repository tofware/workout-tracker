<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExerciseHistoryResource;
use App\Models\ExerciseHistory;
use App\Http\Requests\StoreExerciseHistoryRequest;
use App\Http\Requests\UpdateExerciseHistoryRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ExerciseHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return ExerciseHistoryResource::collection(ExerciseHistory::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreExerciseHistoryRequest $request
     * @return ExerciseHistoryResource
     */
    public function store(StoreExerciseHistoryRequest $request): ExerciseHistoryResource
    {
        $validated = $request->validated();

        $exerciseHistory = ExerciseHistory::create($validated);

        return new ExerciseHistoryResource($exerciseHistory);
    }

    /**
     * Display the specified resource.
     *
     * @param ExerciseHistory $exerciseHistory
     * @return ExerciseHistoryResource
     */
    public function show(ExerciseHistory $exerciseHistory): ExerciseHistoryResource
    {
        return new ExerciseHistoryResource($exerciseHistory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateExerciseHistoryRequest $request
     * @param ExerciseHistory $exerciseHistory
     * @return ExerciseHistoryResource
     */
    public function update(UpdateExerciseHistoryRequest $request, ExerciseHistory $exerciseHistory): ExerciseHistoryResource
    {
        $validated = $request->validated();

        $exerciseHistory->update($validated);

        return new ExerciseHistoryResource($exerciseHistory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ExerciseHistory $exerciseHistory
     * @return JsonResponse
     */
    public function destroy(ExerciseHistory $exerciseHistory): JsonResponse
    {
        $exerciseHistory->delete();

        return response()->json('Exercise history deleted!');
    }
}
