<?php

namespace Tests\Feature\Exercise;

use App\Models\Equipment;
use App\Models\Exercise;
use App\Models\MuscleGroup;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ExerciseTest extends TestCase
{
    use RefreshDatabase;

    public function test_logged_in_user_can_access_exercises_index(): void
    {
        $this->authenticateUser();

        $response = $this->get('/api/exercises');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'difficulty',
                        'instructions',
                        'equipment',
                        'muscle_group'
                    ]
                ]
            ]);
    }

    public function test_logged_out_user_cannot_access_exercises_index()
    {
        $response = $this->get('/api/exercises');

        $response->assertStatus(401);
    }

    public function test_logged_in_user_can_create_exercise()
    {
        $this->authenticateUser();

        $response = $this->post('/api/exercises', [
            'name' => 'test',
            'difficulty' => 'hard',
            'instructions' => ['test', 'test1'],
            'equipment_id' => Equipment::factory()->create()->id,
            'muscle_group_id' => MuscleGroup::factory()->create()->id
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'difficulty',
                    'instructions',
                    'equipment',
                    'muscle_group'
                ]
            ]);

        $this->assertDatabaseHas('exercises', [
            'name' => 'test',
        ]);
    }
    public function test_logged_out_user_cannot_create_exercise()
    {
        $response = $this->post('/api/exercises', [
            'name' => 'test',
            'difficulty' => 'hard',
            'instructions' => ['test', 'test1'],
            'equipment_id' => Equipment::factory()->create()->id,
            'muscle_group_id' => MuscleGroup::factory()->create()->id
        ]);

        $response->assertStatus(401);

        $this->assertDatabaseMissing('exercises', [
            'name' => 'test',
        ]);
    }
    public function test_logged_in_user_cannot_create_exercise_without_name()
    {
        $this->authenticateUser();

        $response = $this->post('/api/exercises');

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['name']);
        $response->assertJsonValidationErrors(['muscle_group_id']);
        $response->assertJsonValidationErrors(['equipment_id']);

        $this->assertDatabaseEmpty('exercises');
    }

    public function test_logged_in_user_can_see_exercise()
    {
        $this->authenticateUser();

        $exercise = Exercise::factory()->create();

        $response = $this->get('/api/exercises/' . $exercise->id);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'difficulty',
                    'instructions',
                    'muscle_group',
                    'equipment'
                ],
            ]);
    }
    public function test_logged_out_user_cannot_see_exercise()
    {
        $exercise = Exercise::factory()->create();

        $response = $this->get('/api/exercises/' . $exercise->id);

        $response->assertStatus(401);
    }

    public function test_logged_in_user_can_update_exercise()
    {
        $this->authenticateUser();

        $exercise = Exercise::factory()->create();

        $response = $this->patch('/api/exercises/' . $exercise->id, [
            'name' => 'test',
            'difficulty' => 'hard',
            'instructions' => ['test', 'test1'],
            'equipment_id' => Equipment::factory()->create()->id,
            'muscle_group_id' => MuscleGroup::factory()->create()->id
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'difficulty',
                    'instructions',
                    'equipment',
                    'muscle_group'
                ],
            ]);

        $this->assertDatabaseHas('exercises', [
            'name' => 'test'
        ]);
    }
    public function test_logged_out_user_cannot_update_exercise()
    {
        $exercise = Exercise::factory()->create();

        $response = $this->patch('/api/exercises/' . $exercise->id, [
            'name' => 'test',
            'difficulty' => 'hard',
            'instructions' => ['test', 'test1'],
            'equipment_id' => Equipment::factory()->create()->id,
            'muscle_group_id' => MuscleGroup::factory()->create()->id
        ]);

        $response->assertStatus(401);

        $this->assertDatabaseMissing('exercises', [
            'name' => 'test'
        ]);
    }

    public function test_logged_in_user_can_delete_exercise()
    {
        $this->authenticateUser();

        $exercise = Exercise::factory()->create();

        $response = $this->delete('/api/exercises/' . $exercise->id);

        $response->assertStatus(200);

        $this->assertDatabaseEmpty('exercises');
    }
    public function test_logged_out_user_cannot_delete_exercise()
    {
        $exercise = Exercise::factory()->create();

        $response = $this->delete('/api/exercises/' . $exercise->id);

        $response->assertStatus(401);
    }
    private function authenticateUser(): void
    {
        Sanctum::actingAs(User::factory()->create());
    }
}
