<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExerciseResource extends JsonResource
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
            'name' => $this->name,
            'difficulty' => $this->difficulty,
            'instructions' => $this->instructions,
            'muscle_group' => new MuscleGroupResource($this->muscleGroup),
            'equipment' => new EquipmentResource($this->equipment)
        ];
    }
}
