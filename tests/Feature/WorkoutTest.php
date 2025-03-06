<?php

namespace Tests\Feature;

use App\Models\Exercise;
use App\Models\User;
use App\Models\Workout;
use App\Models\WorkoutCategory;
use App\Models\WorkoutExercise;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class WorkoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_workouts_page_is_displayed(): void
    {
        $user = User::factory()->create();
        $workouts = Workout::factory(3)->create();

        $response = $this
            ->actingAs($user)
            ->get(route('workouts.index'))
            ->assertInertia(
                fn (Assert $page) => $page
                    ->component('Workout/Index')
                    ->has('workouts', 3)
                    ->where('workouts.0.name', $workouts[0]->name)
                    ->where('workouts.1.category.name', $workouts[1]->category->name)
            );

        $response->assertOk();
    }

    public function test_workouts_create_form_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('workouts.create'))
            ->assertInertia(
                fn (Assert $page) => $page
                    ->component('Workout/Create')
            );

        $response->assertOk();
    }

    public function test_workout_can_be_created(): void
    {
        $user = User::factory()->create();
        $workoutCategory = WorkoutCategory::factory()->create();

        $workoutData = [
            'name' => fake()->name,
            'category' => $workoutCategory->id,
            'user_id' => $user->id,
        ];

        $response = $this
            ->actingAs($user)
            ->post(route('workouts.store', $workoutData));

        $response->assertSessionHasNoErrors();

        $response->assertRedirect(route('workouts.index'));

        $this->assertDatabaseHas('workouts', [
            'name' => $workoutData['name'],
            'workout_category_id' => $workoutCategory->id,
            'user_id' => $user->id,
        ]);
    }

    public function test_workout_can_be_deleted(): void
    {
        $user = User::factory()->create();
        $workout = Workout::factory()->create();

        $response = $this
            ->actingAs($user)
            ->delete(route('workouts.destroy', $workout->id));

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('workouts.index'));

        $this->assertDatabaseMissing('workouts', [
            'id' => $workout->id,
        ]);
    }

    public function test_workout_exercises_are_displayed(): void
    {
        $user = User::factory()->create();
        $workout = Workout::factory()->create();
        $exercises = Exercise::factory(5)->create();

        foreach ($exercises as $index => $exercise) {
            WorkoutExercise::create([
                'workout_id' => $workout->id,
                'exercise_id' => $exercise->id,
                'order' => $index + 1,
            ]);
        }

        $response = $this
            ->actingAs($user)
            ->get(route('workouts.get-exercises', $workout->id));

        $response->assertInertia(
            fn (Assert $page) => $page
                ->component('Workout/Exercises')
                ->has('exercises', 5)
        );

        $response->assertOk();
    }

    public function test_user_can_add_and_remove_exercises_to_and_from_workout(): void
    {
        $user = User::factory()->create();
        $workout = Workout::factory()->create();
        $exercise = Exercise::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('workouts.add-exercises', ['workout' => $workout->id, 'exercise' => $exercise->id]));

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('workouts.get-exercises', $workout));

        $this->assertDatabaseHas('workout_exercises', [
            'exercise_id' => $exercise->id,
        ]);

        $response = $this
            ->actingAs($user)
            ->delete(route('workouts.remove-exercises', ['workout' => $workout->id, 'exercise' => $exercise->id]));

        $this->assertDatabaseMissing('workout_exercises', [
            'exercise_id' => $exercise->id,
        ]);
    }
}
