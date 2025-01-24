<?php

namespace Tests\Feature\Goal;

use App\Enums\GoalStatus;
use App\Models\Exercise;
use App\Models\Goal;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class GoalTest extends TestCase
{
    use RefreshDatabase;

    public function test_logged_in_user_can_access_goals_index()
    {
        $this->authenticateUser();

        $response = $this->get('/api/goals');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'user',
                        'exercise',
                        'goal_type',
                        'target_value',
                        'deadline',
                        'status',
                        'notes'
                    ],
                ],
            ]);
    }
    public function test_logged_out_user_cannot_access_goals_index()
    {
        $response = $this->get('/api/goals');

        $response->assertStatus(401);
    }

    public function test_logged_in_user_can_create_goals()
    {
        $this->authenticateUser();

        $response = $this->post('/api/goals', [
            'user_id' => User::factory()->create()->id,
            'exercise_id' => Exercise::factory()->create()->id,
            'goal_type' => fake()->text(10),
            'target_value' => fake()->numberBetween(1, 100),
            'deadline' => fake()->date,
            'status' => fake()->randomElement(array_keys(GoalStatus::cases())),
            'notes' => 'test'
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'user',
                    'exercise',
                    'goal_type',
                    'target_value',
                    'deadline',
                    'status',
                    'notes'
                ],
            ]);

        $this->assertDatabaseHas('goals', [
            'notes' => 'test',
        ]);
    }
    public function test_logged_out_user_cannot_create_goals()
    {
        $response = $this->post('/api/goals', [
            'user_id' => User::factory()->create()->id,
            'exercise_id' => Exercise::factory()->create()->id,
            'goal_type' => fake()->text(10),
            'target_value' => fake()->numberBetween(1, 100),
            'deadline' => fake()->date,
            'status' => fake()->randomElement(array_keys(GoalStatus::cases())),
            'notes' => 'test'
        ]);

        $response->assertStatus(401);

        $this->assertDatabaseMissing('goals', [
            'notes' => 'test',
        ]);
    }
    public function test_logged_in_user_cannot_create_goals_with_missing_fields()
    {
        $this->authenticateUser();

        $response = $this->post('/api/goals');

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['goal_type']);
        $response->assertJsonValidationErrors(['user_id']);

        $this->assertDatabaseEmpty('goals');
    }

    public function test_logged_in_user_can_see_goals()
    {
        $this->authenticateUser();

        $goal = Goal::factory()->create();

        $response = $this->get('/api/goals/' . $goal->id);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'user',
                    'exercise',
                    'goal_type',
                    'target_value',
                    'deadline',
                    'status',
                    'notes'
                ],
            ]);
    }
    public function test_logged_out_user_cannot_see_goals()
    {
        $goal = Goal::factory()->create();

        $response = $this->get('/api/goals/' . $goal->id);

        $response->assertStatus(401);
    }

    public function test_logged_in_user_can_update_goals()
    {
        $this->authenticateUser();

        $goal = Goal::factory()->create();

        $response = $this->patch('/api/goals/' . $goal->id, [
            'notes' => 'test-update',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'user',
                    'exercise',
                    'goal_type',
                    'target_value',
                    'deadline',
                    'status',
                    'notes'
                ],
            ]);

        $this->assertDatabaseHas('goals', [
            'notes' => 'test-update'
        ]);
    }
    public function test_logged_out_user_cannot_update_goals()
    {
        $goal = Goal::factory()->create();

        $response = $this->patch('/api/goals/' . $goal->id, [
            'notes' => 'test-update',
        ]);

        $response->assertStatus(401);

        $this->assertDatabaseMissing('goals', [
            'notes' => 'test-update'
        ]);
    }

    public function test_logged_in_user_can_delete_goals()
    {
        $this->authenticateUser();

        $goal = Goal::factory()->create();

        $response = $this->delete('/api/goals/' . $goal->id);

        $response->assertStatus(200);

        $this->assertDatabaseEmpty('goals');
    }
    public function test_logged_out_user_cannot_delete_goals()
    {
        $goal = Goal::factory()->create();

        $response = $this->delete('/api/goals/' . $goal->id);

        $response->assertStatus(401);
    }

    private function authenticateUser(): void
    {
        Sanctum::actingAs(User::factory()->create());
    }
}
