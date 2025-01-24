<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GoalResource extends JsonResource
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
            'user' => $this->user,
            'exercise' => $this->exercise,
            'goal_type' => $this->goal_type,
            'target_value' => $this->target_value,
            'deadline' => $this->deadline,
            'status' => $this->status,
            'notes' => $this->notes
        ];
    }
}
