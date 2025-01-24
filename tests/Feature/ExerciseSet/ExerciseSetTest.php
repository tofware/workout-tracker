<?php

namespace Tests\Feature\ExerciseSet;

use App\Models\Exercise;
use App\Models\ExerciseSet;
use App\Models\User;
use App\Models\WorkoutSession;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ExerciseSetTest extends TestCase
{
    use RefreshDatabase;

    public function test_logged_in_user_can_access_exercise_sets_index(): void
    {
        $this->authenticateUser();

        $response = $this->get('/api/exercise-sets');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'workout_session',
                        'exercise',
                        'set_number',
                        'repetitions',
                        'weight',
                        'notes',
                        'rest_time',
                    ]
                ]
            ]);
    }

    public function test_logged_out_user_cannot_access_exercise_sets_index()
    {
        $response = $this->get('/api/exercise-sets');

        $response->assertStatus(401);
    }

    public function test_logged_in_user_can_create_exercise_set()
    {
        $this->authenticateUser();

        $response = $this->post('/api/exercise-sets', [
            'workout_session_id' => WorkoutSession::factory()->create()->id,
            'exercise_id' => Exercise::factory()->create()->id,
            'set_number' => fake()->numberBetween(1, 5),
            'repetitions' => fake()->numberBetween(1, 50),
            'weight' => fake()->numberBetween(1, 500),
            'notes' => 'test',
            'rest_time' => fake()->numberBetween(1, 25),
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'workout_session',
                    'exercise',
                    'set_number',
                    'repetitions',
                    'weight',
                    'notes',
                    'rest_time',
                ]
            ]);

        $this->assertDatabaseHas('exercise_sets', [
            'notes' => 'test',
        ]);
    }

    public function test_logged_out_user_cannot_create_exercise_set()
    {
        $response = $this->post('/api/exercise-sets', [
            'workout_session_id' => WorkoutSession::factory()->create()->id,
            'exercise_id' => Exercise::factory()->create()->id,
            'set_number' => fake()->numberBetween(1, 5),
            'repetitions' => fake()->numberBetween(1, 50),
            'weight' => fake()->numberBetween(1, 500),
            'notes' => 'test',
            'rest_time' => fake()->numberBetween(1, 25),
        ]);

        $response->assertStatus(401);

        $this->assertDatabaseMissing('exercise_sets', [
            'notes' => 'test',
        ]);
    }

    public function test_logged_in_user_cannot_create_exercise_set_without_required_fields()
    {
        $this->authenticateUser();

        $response = $this->post('/api/exercise-sets');

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['set_number']);
        $response->assertJsonValidationErrors(['repetitions']);
        $response->assertJsonValidationErrors(['workout_session_id']);

        $this->assertDatabaseEmpty('exercise_sets');
    }

    public function test_logged_in_user_can_see_exercise_set()
    {
        $this->authenticateUser();

        $exerciseSet = ExerciseSet::factory()->create();

        $response = $this->get('/api/exercise-sets/' . $exerciseSet->id);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'workout_session',
                    'exercise',
                    'set_number',
                    'repetitions',
                    'weight',
                    'notes',
                    'rest_time',
                ],
            ]);
    }
    public function test_logged_out_user_cannot_see_exercise()
    {
        $exerciseSet = ExerciseSet::factory()->create();

        $response = $this->get('/api/exercise-sets/' . $exerciseSet->id);

        $response->assertStatus(401);
    }

    public function test_logged_in_user_can_update_exercise_set()
    {
        $this->authenticateUser();

        $exerciseSet = ExerciseSet::factory()->create();

        $response = $this->patch('/api/exercise-sets/' . $exerciseSet->id, [
            'workout_session_id' => WorkoutSession::factory()->create()->id,
            'exercise_id' => Exercise::factory()->create()->id,
            'set_number' => fake()->numberBetween(1, 5),
            'repetitions' => fake()->numberBetween(1, 50),
            'weight' => fake()->numberBetween(1, 500),
            'notes' => 'test-update',
            'rest_time' => fake()->numberBetween(1, 25),
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'workout_session',
                    'exercise',
                    'set_number',
                    'repetitions',
                    'weight',
                    'notes',
                    'rest_time',
                ],
            ]);

        $this->assertDatabaseHas('exercise_sets', [
            'notes' => 'test-update'
        ]);
    }
    public function test_logged_out_user_cannot_update_exercise_set()
    {
        $exerciseSet = ExerciseSet::factory()->create();

        $response = $this->patch('/api/exercise-sets/' . $exerciseSet->id, [
            'workout_session_id' => WorkoutSession::factory()->create(),
            'exercise_id' => Exercise::factory()->create(),
            'set_number' => fake()->numberBetween(1, 5),
            'repetitions' => fake()->numberBetween(1, 50),
            'weight' => fake()->numberBetween(1, 500),
            'notes' => 'test-update',
            'rest_time' => fake()->numberBetween(1, 25),
        ]);

        $response->assertStatus(401);

        $this->assertDatabaseMissing('exercise_sets', [
            'notes' => 'test-update'
        ]);
    }

    public function test_logged_in_user_can_delete_exercise_set()
    {
        $this->authenticateUser();

        $exerciseSet = ExerciseSet::factory()->create();

        $response = $this->delete('/api/exercise-sets/' . $exerciseSet->id);

        $response->assertStatus(200);

        $this->assertDatabaseEmpty('exercise_sets');
    }
    public function test_logged_out_user_cannot_delete_exercise_set()
    {
        $exerciseSet = ExerciseSet::factory()->create();

        $response = $this->delete('/api/exercise-sets/' . $exerciseSet->id);

        $response->assertStatus(401);
    }
    private function authenticateUser(): void
    {
        Sanctum::actingAs(User::factory()->create());
    }
}
