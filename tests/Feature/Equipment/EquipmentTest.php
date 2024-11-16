<?php

namespace Tests\Feature\Equipment;

use App\Models\Equipment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class EquipmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_logged_in_user_can_access_equipments_index()
    {
        $this->authenticateUser();

        $response = $this->get('/api/equipments');

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
    public function test_logged_out_user_cannot_access_equipments_index()
    {
        $response = $this->get('/api/equipments');

        $response->assertStatus(401);
    }

    public function test_logged_in_user_can_create_equipment()
    {
        $this->authenticateUser();

        $response = $this->post('/api/equipments', [
            'name' => 'test'
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                ],
            ]);

        $this->assertDatabaseHas('equipments', [
            'name' => 'test',
        ]);
    }
    public function test_logged_out_user_cannot_create_equipment()
    {
        $response = $this->post('/api/equipments', [
            'name' => 'test'
        ]);

        $response->assertStatus(401);

        $this->assertDatabaseMissing('equipments', [
            'name' => 'test',
        ]);
    }
    public function test_logged_in_user_cannot_create_equipment_without_name()
    {
        $this->authenticateUser();

        $response = $this->post('/api/equipments');

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['name']);

        $this->assertDatabaseEmpty('equipments');
    }

    public function test_logged_in_user_can_see_equipment()
    {
        $this->authenticateUser();

        $equipment = Equipment::factory()->create();

        $response = $this->get('/api/equipments/' . $equipment->id);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                ],
            ]);
    }
    public function test_logged_out_user_cannot_see_equipment()
    {
        $equipment = Equipment::factory()->create();

        $response = $this->get('/api/equipments/' . $equipment->id);

        $response->assertStatus(401);
    }

    public function test_logged_in_user_can_update_equipment()
    {
        $this->authenticateUser();

        $equipment = Equipment::factory()->create();

        $response = $this->patch('/api/equipments/' . $equipment->id, [
            'name' => 'test-update'
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                ],
            ]);

        $this->assertDatabaseHas('equipments', [
            'name' => 'test-update'
        ]);
    }
    public function test_logged_out_user_cannot_update_equipment()
    {
        $equipment = Equipment::factory()->create();

        $response = $this->patch('/api/equipments/' . $equipment->id, [
            'name' => 'test-update'
        ]);

        $response->assertStatus(401);

        $this->assertDatabaseMissing('equipments', [
            'name' => 'test-update'
        ]);
    }

    public function test_logged_in_user_can_delete_equipment()
    {
        $this->authenticateUser();

        $equipment = Equipment::factory()->create();

        $response = $this->delete('/api/equipments/' . $equipment->id);

        $response->assertStatus(200);

        $this->assertDatabaseEmpty('equipments');
    }
    public function test_logged_out_user_cannot_delete_equipment()
    {
        $equipment = Equipment::factory()->create();

        $response = $this->delete('/api/equipments/' . $equipment->id);

        $response->assertStatus(401);
    }

    private function authenticateUser(): void
    {
        Sanctum::actingAs(User::factory()->create());
    }
}
