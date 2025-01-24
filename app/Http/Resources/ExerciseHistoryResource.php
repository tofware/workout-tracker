<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExerciseHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user' => $this->user,
            'exercise' => $this->exercise,
            'date' => $this->date,
            'best_weight' => $this->best_weight,
            'best_repetitions' => $this->best_repetitions,
            'one_rep_max' => $this->one_rep_max,
            'notes' => $this->notes
        ];
    }
}
