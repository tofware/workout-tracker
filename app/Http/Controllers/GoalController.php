<?php

namespace App\Http\Controllers;

use App\Http\Resources\GoalResource;
use App\Models\Goal;
use App\Http\Requests\StoreGoalRequest;
use App\Http\Requests\UpdateGoalRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return GoalResource::collection(Goal::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreGoalRequest $request
     * @return GoalResource
     */
    public function store(StoreGoalRequest $request): GoalResource
    {
        $validated = $request->validated();

        $goal = Goal::create($validated);

        return new GoalResource($goal);
    }

    /**
     * Display the specified resource.
     *
     * @param Goal $goal
     * @return GoalResource
     */
    public function show(Goal $goal): GoalResource
    {
        return new GoalResource($goal);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateGoalRequest $request
     * @param Goal $goal
     * @return GoalResource
     */
    public function update(UpdateGoalRequest $request, Goal $goal): GoalResource
    {
        $validated = $request->validated();

        $goal->update($validated);

        return new GoalResource($goal);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Goal $goal
     * @return JsonResponse
     */
    public function destroy(Goal $goal): JsonResponse
    {
        $goal->delete();

        return response()->json('Goal deleted!');
    }
}
