<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProgressMetricResource;
use App\Models\ProgressMetric;
use App\Http\Requests\StoreProgressMetricRequest;
use App\Http\Requests\UpdateProgressMetricRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProgressMetricController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return ProgressMetricResource::collection(ProgressMetric::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProgressMetricRequest $request
     * @return ProgressMetricResource
     */
    public function store(StoreProgressMetricRequest $request): ProgressMetricResource
    {
        $validated = $request->validated();

        $progressMetric = ProgressMetric::create($validated);

        return new ProgressMetricResource($progressMetric);
    }

    /**
     * Display the specified resource.
     *
     * @param ProgressMetric $progressMetric
     * @return ProgressMetricResource
     */
    public function show(ProgressMetric $progressMetric): ProgressMetricResource
    {
        return new ProgressMetricResource($progressMetric);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProgressMetricRequest $request
     * @param ProgressMetric $progressMetric
     * @return ProgressMetricResource
     */
    public function update(UpdateProgressMetricRequest $request, ProgressMetric $progressMetric): ProgressMetricResource
    {
        $validated = $request->validated();

        $progressMetric->update($validated);

        return new ProgressMetricResource($progressMetric);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProgressMetric $progressMetric
     * @return JsonResponse
     */
    public function destroy(ProgressMetric $progressMetric): JsonResponse
    {
        $progressMetric->delete();

        return response()->json('Progress metrics deleted!');
    }
}
