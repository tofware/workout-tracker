<?php

namespace Tests\Feature\Workout;

use App\Models\Category;
use App\Models\User;
use App\Models\Workout;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class WorkoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_logged_in_user_can_access_workouts_index()
    {
        $this->authenticateUser();

        $response = $this->get('/api/workouts');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'category',
                        'user'
                    ],
                ],
            ]);
    }
    public function test_logged_out_user_cannot_access_workouts_index()
    {
        $response = $this->get('/api/workouts');

        $response->assertStatus(401);
    }

    public function test_logged_in_user_can_create_workout()
    {
        $this->authenticateUser();

        $response = $this->post('/api/workouts', [
            'name' => 'test',
            'category_id' => Category::factory()->create()->id,
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'category',
                    'user'
                ],
            ]);

        $this->assertDatabaseHas('workouts', [
            'name' => 'test',
        ]);
    }
    public function test_logged_out_user_cannot_create_workout()
    {
        $response = $this->post('/api/workouts', [
            'name' => 'test',
            'category_id' => Category::factory()->create()->id,
        ]);

        $response->assertStatus(401);

        $this->assertDatabaseMissing('workouts', [
            'name' => 'test',
        ]);
    }
    public function test_logged_in_user_cannot_create_workout_without_name()
    {
        $this->authenticateUser();

        $response = $this->post('/api/workouts');

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['name']);
        $response->assertJsonValidationErrors(['category_id']);

        $this->assertDatabaseEmpty('workouts');
    }

    public function test_logged_in_user_can_see_workout()
    {
        $this->authenticateUser();

        $workout = Workout::factory()->create();

        $response = $this->get('/api/workouts/' . $workout->id);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'category',
                    'user'
                ],
            ]);
    }
    public function test_logged_out_user_cannot_see_workout()
    {
        $workout = Workout::factory()->create();

        $response = $this->get('/api/workouts/' . $workout->id);

        $response->assertStatus(401);
    }

    public function test_logged_in_user_can_update_workout()
    {
        $this->authenticateUser();

        $workout = Workout::factory()->create();

        $response = $this->patch('/api/workouts/' . $workout->id, [
            'name' => 'test-update',
            'category_id' => 1
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'category',
                    'user'
                ],
            ]);

        $this->assertDatabaseHas('workouts', [
            'name' => 'test-update'
        ]);
    }
    public function test_logged_out_user_cannot_update_workout()
    {
        $workout = Workout::factory()->create();

        $response = $this->patch('/api/workouts/' . $workout->id, [
            'name' => 'test-update',
            'category' => 1
        ]);

        $response->assertStatus(401);

        $this->assertDatabaseMissing('workouts', [
            'name' => 'test-update'
        ]);
    }

    public function test_logged_in_user_can_delete_workout()
    {
        $this->authenticateUser();

        $workout = Workout::factory()->create();

        $response = $this->delete('/api/workouts/' . $workout->id);

        $response->assertStatus(200);

        $this->assertDatabaseEmpty('workouts');
    }
    public function test_logged_out_user_cannot_delete_workout()
    {
        $workout = Workout::factory()->create();

        $response = $this->delete('/api/workouts/' . $workout->id);

        $response->assertStatus(401);
    }

    private function authenticateUser(): void
    {
        Sanctum::actingAs(User::factory()->create());
    }
}
