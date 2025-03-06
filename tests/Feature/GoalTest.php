<?php

namespace Tests\Feature;

use App\Enums\GoalStatus;
use App\Models\Exercise;
use App\Models\Goal;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class GoalTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_see_goals()
    {
        $user = User::factory()->create();
        $exercise = Exercise::factory()->create();
        $goals = Goal::factory(3)->create([
            'user_id' => $user->id,
            'exercise_id' => $exercise->id,
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('goals.index'))
            ->assertInertia(fn (Assert $page) => $page
                ->component('Goals/Index')
                ->has('goals', 3)
                ->where('goals.0.goal_type', $goals[0]->goal_type)
                ->where('goals.1.deadline', $goals[1]->deadline));

        $response->assertOk();
    }

    public function test_goal_can_be_created(): void
    {
        $user = User::factory()->create();
        $exercise = Exercise::factory()->create();

        $goalData = [
            'user_id' => $user->id,
            'exercise' => $exercise->id,
            'goal_type' => fake()->text(10),
            'target_value' => fake()->numberBetween(1, 100),
            'deadline' => fake()->date,
            'status' => fake()->randomElement(array_keys(GoalStatus::cases())),
            'notes' => fake()->text(30),
        ];

        $response = $this
            ->actingAs($user)
            ->post(route('goals.store', $goalData));

        $response->assertSessionHasNoErrors();

        $response->assertRedirect(route('goals.index'));

        $this->assertDatabaseHas('goals', [
            'user_id' => $user->id,
            'exercise_id' => $exercise->id,
            'goal_type' => $goalData['goal_type'],
            'target_value' => $goalData['target_value'],
        ]);
    }

    public function test_goal_can_be_deleted(): void
    {
        $user = User::factory()->create();
        $exercise = Exercise::factory()->create();
        $goal = Goal::factory()->create([
            'user_id' => $user->id,
            'exercise_id' => $exercise->id,
        ]);

        $response = $this
            ->actingAs($user)
            ->delete(route('goals.destroy', $goal->id));

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('goals.index'));

        $this->assertDatabaseMissing('goals', [
            'id' => $goal->id,
        ]);
    }
}
