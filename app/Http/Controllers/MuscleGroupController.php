<?php

namespace App\Http\Controllers;

use App\Http\Resources\MuscleGroupResource;
use App\Models\MuscleGroup;
use App\Http\Requests\StoreMuscleGroupRequest;
use App\Http\Requests\UpdateMuscleGroupRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MuscleGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return MuscleGroupResource::collection(MuscleGroup::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMuscleGroupRequest $request
     * @return MuscleGroupResource
     */
    public function store(StoreMuscleGroupRequest $request): MuscleGroupResource
    {
        $validated = $request->validated();

        $muscleGroup = MuscleGroup::create($validated);

        return new MuscleGroupResource($muscleGroup);
    }

    /**
     * Display the specified resource.
     *
     * @param MuscleGroup $muscleGroup
     * @return MuscleGroupResource
     */
    public function show(MuscleGroup $muscleGroup): MuscleGroupResource
    {
        return new MuscleGroupResource($muscleGroup);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMuscleGroupRequest $request
     * @param MuscleGroup $muscleGroup
     * @return MuscleGroupResource
     */
    public function update(UpdateMuscleGroupRequest $request, MuscleGroup $muscleGroup): MuscleGroupResource
    {
        $validated = $request->validated();

        $muscleGroup->update($validated);

        return new MuscleGroupResource($muscleGroup);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param MuscleGroup $muscleGroup
     * @return JsonResponse
     */
    public function destroy(MuscleGroup $muscleGroup): JsonResponse
    {
        $muscleGroup->delete();

        return response()->json('Muscle Group deleted!');
    }
}
