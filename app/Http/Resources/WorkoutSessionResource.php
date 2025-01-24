<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkoutSessionResource extends JsonResource
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
            'workout' => new WorkoutResource($this->workout),
            'user' => new UserResource($this->user),
            'notes' => $this->notes,
            'duration' => $this->duration,
            'calories_burned' => $this->calories_burned,
            'average_intensity' => $this->average_intensity
        ];
    }
}
