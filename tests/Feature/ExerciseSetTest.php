<?php

namespace Tests\Feature;

use App\Models\Exercise;
use Tests\TestCase;
use App\Models\User;
use App\Models\Workout;
use App\Models\WorkoutSession;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExerciseSetTest extends TestCase
{
    use RefreshDatabase;

    public function test_exercise_set_can_be_added_to_workout_session()
    {
        $user = User::factory()->create();
        $workout = Workout::factory()->create();
        $workoutSession = WorkoutSession::factory()->create([
            'user_id' => $user->id,
            'workout_id' => $workout->id
        ]);
        $exercise = Exercise::factory()->create();

        $set = [
            'workout_session_id' => $workoutSession->id,
            'exercise_id' => $exercise->id,
            'sets' => [
                [
                    'reps' => 12,
                    'weight' => 25,
                    'notes' => 'test' ?? null
                ],
                [
                    'reps' => 12,
                    'weight' => 25,
                    'notes' => 'test' ?? null
                ],
            ],
        ];

        $response = $this
            ->actingAs($user)
            ->post(route('exercise-sets.store', $set));

        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('exercise_sets', [
            'workout_session_id' => $workoutSession->id,
            'exercise_id' => $exercise->id,
        ]);
    }
}
