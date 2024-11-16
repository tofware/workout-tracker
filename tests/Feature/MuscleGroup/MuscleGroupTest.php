<?php

namespace Tests\Feature\MuscleGroup;

use App\Models\MuscleGroup;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class MuscleGroupTest extends TestCase
{
    use RefreshDatabase;

    public function test_logged_in_user_can_access_muscle_groups_index()
    {
        $this->authenticateUser();

        $response = $this->get('/api/muscle-groups');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                    ],
                ],
            ]);
    }
    public function test_logged_out_user_cannot_access_muscle_groups_index()
    {
        $response = $this->get('/api/muscle-groups');

        $response->assertStatus(401);
    }

    public function test_logged_in_user_can_create_muscle_group()
    {
        $this->authenticateUser();

        $response = $this->post('/api/muscle-groups', [
            'name' => 'test'
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                ],
            ]);

        $this->assertDatabaseHas('muscle_groups', [
            'name' => 'test',
        ]);
    }
    public function test_logged_out_user_cannot_create_muscle_group()
    {
        $response = $this->post('/api/muscle-groups', [
            'name' => 'test'
        ]);

        $response->assertStatus(401);

        $this->assertDatabaseMissing('muscle_groups', [
            'name' => 'test',
        ]);
    }
    public function test_logged_in_user_cannot_create_muscle_group_without_name()
    {
        $this->authenticateUser();

        $response = $this->post('/api/muscle-groups');

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['name']);

        $this->assertDatabaseEmpty('muscle_groups');
    }

    public function test_logged_in_user_can_see_muscle_group()
    {
        $this->authenticateUser();

        $muscleGroup = MuscleGroup::factory()->create();

        $response = $this->get('/api/muscle-groups/' . $muscleGroup->id);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                ],
            ]);
    }
    public function test_logged_out_user_cannot_see_muscle_group()
    {
        $muscleGroup = MuscleGroup::factory()->create();

        $response = $this->get('/api/muscle-groups/' . $muscleGroup->id);

        $response->assertStatus(401);
    }

    public function test_logged_in_user_can_update_muscle_group()
    {
        $this->authenticateUser();

        $muscleGroup = MuscleGroup::factory()->create();

        $response = $this->patch('/api/muscle-groups/' . $muscleGroup->id, [
            'name' => 'test-update'
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                ],
            ]);

        $this->assertDatabaseHas('muscle_groups', [
            'name' => 'test-update'
        ]);
    }
    public function test_logged_out_user_cannot_update_muscle_group()
    {
        $muscleGroup = MuscleGroup::factory()->create();

        $response = $this->patch('/api/muscle-groups/' . $muscleGroup->id, [
            'name' => 'test-update'
        ]);

        $response->assertStatus(401);

        $this->assertDatabaseMissing('muscle_groups', [
            'name' => 'test-update'
        ]);
    }
    public function test_logged_in_user_cannot_update_muscle_group_with_empty_name()
    {
        $this->authenticateUser();

        $muscleGroup = MuscleGroup::factory()->create();

        $response = $this->patch('/api/muscle-groups/' . $muscleGroup->id, [
            'name' => null
        ]);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['name']);

        $this->assertDatabaseHas('muscle_groups', [
            'name' => $muscleGroup->name
        ]);
    }

    public function test_logged_in_user_can_delete_muscle_group()
    {
        $this->authenticateUser();

        $muscleGroup = MuscleGroup::factory()->create();

        $response = $this->delete('/api/muscle-groups/' . $muscleGroup->id);

        $response->assertStatus(200);

        $this->assertDatabaseEmpty('muscle_groups');
    }
    public function test_logged_out_user_cannot_delete_muscle_group()
    {
        $muscleGroup = MuscleGroup::factory()->create();

        $response = $this->delete('/api/muscle-groups/' . $muscleGroup->id);

        $response->assertStatus(401);
    }

    private function authenticateUser(): void
    {
        Sanctum::actingAs(User::factory()->create());
    }
}
