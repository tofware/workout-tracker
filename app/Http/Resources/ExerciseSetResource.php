<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExerciseSetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'workout_session' => new WorkoutSessionResource($this->workoutSession),
            'exercise' => new ExerciseResource($this->exercise),
            'set_number' => $this->set_number,
            'repetitions' => $this->repetitions,
            'weight' => $this->weight,
            'notes' => $this->notes,
            'rest_time' => $this->rest_time,
        ];
    }
}
