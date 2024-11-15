<?php

namespace Tests\Feature\Category;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_logged_in_user_can_access_categories_index()
    {
        $this->authenticateUser();

        $response = $this->get('/api/categories');

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
    public function test_logged_out_user_cannot_access_categories_index()
    {
        $response = $this->get('/api/categories');

        $response->assertStatus(401);
    }

    public function test_logged_in_user_can_create_category()
    {
        $this->authenticateUser();

        $response = $this->post('/api/categories', [
            'name' => 'test'
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                ],
            ]);

        $this->assertDatabaseHas('categories', [
            'name' => 'test',
        ]);
    }
    public function test_logged_out_user_cannot_create_category()
    {
        $response = $this->post('/api/categories', [
            'name' => 'test'
        ]);

        $response->assertStatus(401);

        $this->assertDatabaseMissing('categories', [
            'name' => 'test',
        ]);
    }
    public function test_logged_in_user_cannot_create_category_without_name()
    {
        $this->authenticateUser();

        $response = $this->post('/api/categories');

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['name']);

        $this->assertDatabaseEmpty('categories');
    }

    public function test_logged_in_user_can_see_category()
    {
        $this->authenticateUser();

        $category = Category::factory()->create();

        $response = $this->get('/api/categories/' . $category->id);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                ],
            ]);
    }
    public function test_logged_in_user_cannot_see_missing_category()
    {
        $this->authenticateUser();

        $response = $this->get('/api/categories/2');

        $response->assertStatus(404);
    }
    public function test_logged_out_user_cannot_see_category()
    {
        $category = Category::factory()->create();

        $response = $this->get('/api/categories/' . $category->id);

        $response->assertStatus(401);
    }

    public function test_logged_in_user_can_update_category()
    {
        $this->authenticateUser();

        $category = Category::factory()->create();

        $response = $this->patch('/api/categories/' . $category->id, [
            'name' => 'test-update'
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                ],
            ]);

        $this->assertDatabaseHas('categories', [
            'name' => 'test-update'
        ]);
    }
    public function test_logged_in_user_cannot_update_missing_category()
    {
        $this->authenticateUser();

        $response = $this->patch('/api/categories/2');

        $response->assertStatus(404);
    }
    public function test_logged_out_user_cannot_update_category()
    {
        $category = Category::factory()->create();

        $response = $this->patch('/api/categories/' . $category->id, [
            'name' => 'test-update'
        ]);

        $response->assertStatus(401);

        $this->assertDatabaseMissing('categories', [
            'name' => 'test-update'
        ]);
    }
    public function test_logged_in_user_cannot_update_category_with_empty_name()
    {
        $this->authenticateUser();

        $category = Category::factory()->create();

        $response = $this->patch('/api/categories/' . $category->id, [
            'name' => null
        ]);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['name']);

        $this->assertDatabaseHas('categories', [
            'name' => $category->name
        ]);
    }

    public function test_logged_in_user_can_delete_category()
    {
        $this->authenticateUser();

        $category = Category::factory()->create();

        $response = $this->delete('/api/categories/' . $category->id);

        $response->assertStatus(200);

        $this->assertDatabaseEmpty('categories');
    }
    public function test_logged_in_user_cannot_delete_missing_category()
    {
        $this->authenticateUser();

        $response = $this->delete('/api/categories/2');

        $response->assertStatus(404);
    }
    public function test_logged_out_user_cannot_delete_category()
    {
        $category = Category::factory()->create();

        $response = $this->delete('/api/categories/' . $category->id);

        $response->assertStatus(401);
    }

    private function authenticateUser(): void
    {
        Sanctum::actingAs(User::factory()->create());
    }
}
