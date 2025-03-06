<?php

namespace Tests\Feature;

use App\Models\ProgressMetric;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class ProgressMetricsTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_see_progress_metrics()
    {
        $user = User::factory()->create();
        $metrics = ProgressMetric::factory(3)->create(['user_id' => $user->id]);

        $response = $this
            ->actingAs($user)
            ->get(route('progress-metrics.index'))
            ->assertInertia(fn (Assert $page) => $page
                ->component('ProgressMetric/Index')
                ->has('metrics', 3)
                ->where('metrics.0.weight', $metrics[0]->weight)
                ->where('metrics.1.muscle_mass', $metrics[1]->muscle_mass));

        $response->assertOk();
    }

    public function test_progress_metric_can_be_created(): void
    {
        $user = User::factory()->create();

        $progressMetricData = [
            'user_id' => $user->id,
            'weight' => fake()->numberBetween(10, 100),
            'body_fat_percentage' => fake()->numberBetween(1, 100),
            'muscle_mass' => fake()->numberBetween(1, 100),
            'notes' => fake()->text(30),
        ];

        $response = $this
            ->actingAs($user)
            ->post(route('progress-metrics.store', $progressMetricData));

        $response->assertSessionHasNoErrors();

        $response->assertRedirect(route('progress-metrics.index'));

        $this->assertDatabaseHas('progress_metrics', [
            'user_id' => $user->id,
            'weight' => $progressMetricData['weight'],
            'body_fat_percentage' => $progressMetricData['body_fat_percentage'],
            'muscle_mass' => $progressMetricData['muscle_mass'],
            'notes' => $progressMetricData['notes'],
        ]);
    }

    public function test_progress_metric_can_be_deleted(): void
    {
        $user = User::factory()->create();
        $metric = ProgressMetric::factory()->create(['user_id' => $user->id]);

        $response = $this
            ->actingAs($user)
            ->delete(route('progress-metrics.destroy', $metric->id));

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('progress-metrics.index'));

        $this->assertDatabaseMissing('progress_metrics', [
            'id' => $metric->id,
        ]);
    }
}
