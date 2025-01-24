<?php

namespace App\Http\Controllers;

use App\Http\Resources\WorkoutSessionResource;
use App\Models\WorkoutSession;
use App\Http\Requests\StoreWorkoutSessionRequest;
use App\Http\Requests\UpdateWorkoutSessionRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class WorkoutSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return WorkoutSessionResource::collection(WorkoutSession::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreWorkoutSessionRequest $request
     * @return WorkoutSessionResource
     */
    public function store(StoreWorkoutSessionRequest $request): WorkoutSessionResource
    {
        $validated = $request->validated();

        $workoutSession = WorkoutSession::create($validated);

        return new WorkoutSessionResource($workoutSession);
    }

    /**
     * Display the specified resource.
     *
     * @param WorkoutSession $workoutSession
     * @return WorkoutSessionResource
     */
    public function show(WorkoutSession $workoutSession): WorkoutSessionResource
    {
        return new WorkoutSessionResource($workoutSession);
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
