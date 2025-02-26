<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\ProgressMetric;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProgressMetricResource;
use App\Http\Requests\StoreProgressMetricRequest;
use App\Http\Requests\UpdateProgressMetricRequest;

class ProgressMetricController extends Controller
{
    public function index()
    {
        return Inertia::render('ProgressMetric/Index', [
            'metrics' => Auth::user()->progressMetrics,
        ]);
    }

    public function store(StoreProgressMetricRequest $request)
    {
        $validated = $request->validated();

        ProgressMetric::create([
            'user_id' => Auth::id(),
            'weight' => $validated['weight'],
            'body_fat_percentage' => $validated['body_fat_percentage'],
            'muscle_mass' => $validated['muscle_mass'],
            'notes' => $validated['notes']
        ]);

        return to_route('progress-metrics.index');
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

    public function destroy(ProgressMetric $progressMetric)
    {
        $progressMetric->delete();

        return to_route('progress-metrics.index');
    }
}
