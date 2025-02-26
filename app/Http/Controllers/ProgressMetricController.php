<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\ProgressMetric;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProgressMetricRequest;

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

    public function destroy(ProgressMetric $progressMetric)
    {
        $progressMetric->delete();

        return to_route('progress-metrics.index');
    }
}
