<?php

namespace Tests\Feature\WorkoutSession;

use App\Models\User;
use App\Models\Workout;
use App\Models\WorkoutSession;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class WorkoutSessionTest extends TestCase
{
    use RefreshDatabase;

    public function test_logged_in_user_can_access_workout_sessions_index()
    {
        $this->authenticateUser();

        $response = $this->get('/api/workout-sessions');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'workout',
                        'user',
                        'notes',
                        'duration',
                        'calories_burned',
                        'average_intensity'
                    ],
                ],
            ]);
    }
    public function test_logged_out_user_cannot_access_workout_sessions_index()
    {
        $response = $this->get('/api/workout-sessions');

        $response->assertStatus(401);
    }

    public function test_logged_in_user_can_create_workout_session()
    {
        $user = $this->authenticateUser();

        $response = $this->post('/api/workout-sessions', [
            'workout_id' => Workout::factory()->create()->id,
            'user_id' => $user->id,
            'notes' => 'test',
            'duration' => 25,
            'calories_burned' => 63,
            'average_intensity' => 34
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'workout',
                    'user',
                    'notes',
                    'duration',
                    'calories_burned',
                    'average_intensity'
                ],
            ]);

        $this->assertDatabaseHas('workout_sessions', [
            'notes' => 'test',
        ]);
    }
    public function test_logged_out_user_cannot_create_workout_session()
    {
        $response = $this->post('/api/workout-sessions', [
            'workout_id' => Workout::factory()->create()->id,
            'notes' => 'test',
            'duration' => 25,
            'calories_burned' => 63,
            'average_intensity' => 34
        ]);

        $response->assertStatus(401);

        $this->assertDatabaseMissing('workouts', [
            'notes' => 'test',
        ]);
    }

    public function test_logged_in_user_can_see_workout_session()
    {
        $this->authenticateUser();

        $workoutSession = WorkoutSession::factory()->create();

        $response = $this->get('/api/workout-sessions/' . $workoutSession->id);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'workout',
                    'user',
                    'notes',
                    'duration',
                    'calories_burned',
                    'average_intensity'
                ],
            ]);
    }
    public function test_logged_out_user_cannot_see_workout_workout_session()
    {
        $workoutSession = WorkoutSession::factory()->create();

        $response = $this->get('/api/workout-sessions/' . $workoutSession->id);

        $response->assertStatus(401);
    }

    public function test_logged_in_user_can_update_workout_session()
    {
        $this->authenticateUser();

        $workoutSession = WorkoutSession::factory()->create();

        $response = $this->patch('/api/workout-sessions/' . $workoutSession->id, [
            'notes' => 'test-update',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'workout',
                    'user',
                    'notes',
                    'duration',
                    'calories_burned',
                    'average_intensity'
                ],
            ]);

        $this->assertDatabaseHas('workout_sessions', [
            'notes' => 'test-update'
        ]);
    }
    public function test_logged_out_user_cannot_update_workout()
    {
        $workoutSession = WorkoutSession::factory()->create();

        $response = $this->patch('/api/workout-sessions/' . $workoutSession->id, [
            'notes' => 'test-update',
        ]);

        $response->assertStatus(401);

        $this->assertDatabaseMissing('workout_sessions', [
            'notes' => 'test-update'
        ]);
    }

    public function test_logged_in_user_can_delete_workout()
    {
        $this->authenticateUser();

        $workoutSession = WorkoutSession::factory()->create();

        $response = $this->delete('/api/workout-sessions/' . $workoutSession->id);

        $response->assertStatus(200);

        $this->assertDatabaseEmpty('workout_sessions');
    }
    public function test_logged_out_user_cannot_delete_workout()
    {
        $workoutSession = WorkoutSession::factory()->create();

        $response = $this->delete('/api/workout-sessions/' . $workoutSession->id);

        $response->assertStatus(401);
    }

    private function authenticateUser()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        return $user;
    }
}
