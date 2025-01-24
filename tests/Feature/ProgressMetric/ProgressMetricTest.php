<?php

namespace Tests\Feature\ProgressMetric;

use App\Models\ProgressMetric;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProgressMetricTest extends TestCase
{
    use RefreshDatabase;

    public function test_logged_in_user_can_access_progress_metrics_index()
    {
        $this->authenticateUser();

        $response = $this->get('/api/progress-metrics');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'user',
                        'weight',
                        'body_fat_percentage',
                        'muscle_mass',
                        'notes'
                    ],
                ],
            ]);
    }
    public function test_logged_out_user_cannot_access_progress_metrics_index()
    {
        $response = $this->get('/api/progress-metrics');

        $response->assertStatus(401);
    }

    public function test_logged_in_user_can_create_progress_metrics()
    {
        $this->authenticateUser();

        $response = $this->post('/api/progress-metrics', [
            'user_id' => User::factory()->create()->id,
            'weight' => fake()->numberBetween(10, 100),
            'body_fat_percentage' => fake()->numberBetween(1, 100),
            'muscle_mass' => fake()->numberBetween(1, 100),
            'notes' => 'test',
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'user',
                    'weight',
                    'body_fat_percentage',
                    'muscle_mass',
                    'notes'
                ],
            ]);

        $this->assertDatabaseHas('progress_metrics', [
            'notes' => 'test',
        ]);
    }
    public function test_logged_out_user_cannot_create_progress_metrics()
    {
        $response = $this->post('/api/progress-metrics', [
            'user_id' => User::factory()->create(),
            'weight' => fake()->numberBetween(10, 200),
            'body_fat_percentage' => fake()->numberBetween(1, 100),
            'muscle_mass' => fake()->numberBetween(1, 100),
            'notes' => 'test',
        ]);

        $response->assertStatus(401);

        $this->assertDatabaseMissing('progress_metrics', [
            'notes' => 'test',
        ]);
    }
    public function test_logged_in_user_cannot_create_progress_metrics_with_missing_fields()
    {
        $this->authenticateUser();

        $response = $this->post('/api/progress-metrics');

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['weight']);
        $response->assertJsonValidationErrors(['user_id']);

        $this->assertDatabaseEmpty('progress_metrics');
    }

    public function test_logged_in_user_can_see_progress_metrics()
    {
        $this->authenticateUser();

        $progressMetrics = ProgressMetric::factory()->create();

        $response = $this->get('/api/progress-metrics/' . $progressMetrics->id);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'user',
                    'weight',
                    'body_fat_percentage',
                    'muscle_mass',
                    'notes'
                ],
            ]);
    }
    public function test_logged_out_user_cannot_see_progress_metrics()
    {
        $progressMetrics = ProgressMetric::factory()->create();

        $response = $this->get('/api/progress-metrics/' . $progressMetrics->id);

        $response->assertStatus(401);
    }

    public function test_logged_in_user_can_update_progress_metrics()
    {
        $this->authenticateUser();

        $progressMetrics = ProgressMetric::factory()->create();

        $response = $this->patch('/api/progress-metrics/' . $progressMetrics->id, [
            'notes' => 'test-update',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'user',
                    'weight',
                    'body_fat_percentage',
                    'muscle_mass',
                    'notes'
                ],
            ]);

        $this->assertDatabaseHas('progress_metrics', [
            'notes' => 'test-update'
        ]);
    }
    public function test_logged_out_user_cannot_update_progress_metrics()
    {
        $progressMetrics = ProgressMetric::factory()->create();

        $response = $this->patch('/api/progress-metrics/' . $progressMetrics->id, [
            'notes' => 'test-update',
        ]);

        $response->assertStatus(401);

        $this->assertDatabaseMissing('progress_metrics', [
            'notes' => 'test-update'
        ]);
    }

    public function test_logged_in_user_can_delete_progress_metrics()
    {
        $this->authenticateUser();

        $progressMetrics = ProgressMetric::factory()->create();

        $response = $this->delete('/api/progress-metrics/' . $progressMetrics->id);

        $response->assertStatus(200);

        $this->assertDatabaseEmpty('progress_metrics');
    }
    public function test_logged_out_user_cannot_delete_progress_metrics()
    {
        $progressMetrics = ProgressMetric::factory()->create();

        $response = $this->delete('/api/progress-metrics/' . $progressMetrics->id);

        $response->assertStatus(401);
    }

    private function authenticateUser(): void
    {
        Sanctum::actingAs(User::factory()->create());
    }
}
