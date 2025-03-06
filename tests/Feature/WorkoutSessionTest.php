<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Workout;
use App\Models\WorkoutSession;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;

class WorkoutSessionTest extends TestCase
{
    use RefreshDatabase;

    public function test_workout_sessions_page_is_displayed(): void
    {
        $user = User::factory()->create();
        $workout = Workout::factory()->create();
        $workoutSession = WorkoutSession::factory()->create([
            'user_id' => $user->id,
            'workout_id' => $workout->id
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('workout-sessions.index'))
            ->assertInertia(
                fn(Assert $page) => $page
                    ->component('WorkoutSession/Index')
                    ->has('sessions', 1)
            );

        $response->assertOk();
    }

    public function test_workout_session_can_be_created(): void
    {
        $user = User::factory()->create();
        $workout = Workout::factory()->create();

        $workoutSessionData = [
            'workout' => $workout->id,
            'user_id' => $user->id,
            'notes' => fake()->text(30),
            'duration' => fake()->numberBetween(10, 200),
            'calories_burned' => fake()->numberBetween(10, 500),
            'average_intensity' => fake()->numberBetween(10, 500),
        ];

        $response = $this
            ->actingAs($user)
            ->post(route('workout-sessions.store', $workoutSessionData));

        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('workout_sessions', [
            'workout_id' => $workout->id,
            'user_id' => $user->id,
        ]);
    }
}
