<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateWorkoutExerciseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'workout_id' => ['sometimes', 'exists:App\Models\Workout,id'],
            'exercise_id' => ['sometimes', 'exists:App\Models\Exercise,id'],
            'order' => ['sometimes', 'integer']
        ];
    }
}