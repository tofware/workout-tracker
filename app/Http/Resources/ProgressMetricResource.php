<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgressMetricResource extends JsonResource
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
            'weight' => $this->weight,
            'body_fat_percentage' => $this->body_fat_percentage,
            'muscle_mass' => $this->muscle_mass,
            'notes' => $this->notes
        ];
    }
}
