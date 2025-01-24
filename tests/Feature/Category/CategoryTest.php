<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_logged_in_user_can_view_categories(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/api/categories');

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'name'],
                ],
            ]);
    }

    public function test_guest_cannot_view_categories(): void
    {
        $response = $this->get('/api/categories');

        $response->assertUnauthorized();
    }

    public function test_logged_in_user_can_create_category(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/api/categories', ['name' => 'Test Category']);

        $response
            ->assertCreated()
            ->assertJsonStructure([
                'data' => ['id', 'name'],
            ]);

        $this->assertDatabaseHas('categories', ['name' => 'Test Category']);
    }

    public function test_guest_cannot_create_category(): void
    {
        $response = $this->post('/api/categories', ['name' => 'Test Category']);

        $response->assertUnauthorized();
        $this->assertDatabaseMissing('categories', ['name' => 'Test Category']);
    }

    public function test_category_creation_requires_name(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/api/categories');

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['name']);
    }

    public function test_logged_in_user_can_view_single_category(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get("/api/categories/{$category->id}");

        $response->assertOk()
            ->assertJsonStructure([
                'data' => ['id', 'name'],
            ]);
    }

    public function test_guest_cannot_view_single_category(): void
    {
        $category = Category::factory()->create();

        $response = $this->get("/api/categories/{$category->id}");

        $response->assertUnauthorized();
    }

    public function test_logged_in_user_can_update_category(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch("/api/categories/{$category->id}", ['name' => 'Updated Category']);

        $response->assertOk()
            ->assertJsonStructure([
                'data' => ['id', 'name'],
            ]);

        $this->assertDatabaseHas('categories', ['name' => 'Updated Category']);
    }

    public function test_guest_cannot_update_category(): void
    {
        $category = Category::factory()->create();

        $response = $this->patch("/api/categories/{$category->id}", ['name' => 'Updated Category']);

        $response->assertUnauthorized();
        $this->assertDatabaseMissing('categories', ['name' => 'Updated Category']);
    }

    public function test_category_update_requires_name(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch("/api/categories/{$category->id}", ['name' => null]);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['name']);
    }

    public function test_logged_in_user_can_delete_category(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $response = $this
            ->actingAs($user)
            ->delete("/api/categories/{$category->id}");

        $response->assertOk();
        $this->assertDatabaseEmpty('categories');
    }

    public function test_guest_cannot_delete_category(): void
    {
        $category = Category::factory()->create();

        $response = $this->delete("/api/categories/{$category->id}");

        $response->assertUnauthorized();
    }
}
