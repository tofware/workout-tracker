<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateExerciseSetRequest extends FormRequest
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
            'workout_session_id' => ['sometimes', 'exists:App\Models\WorkoutSession,id'],
            'exercise_id' => ['sometimes', 'exists:App\Models\Exercise,id'],
            'set_number' => ['sometimes', 'integer', 'min:1', 'max:50'],
            'repetitions' => ['sometimes', 'integer', 'min:1', 'max:50'],
            'weight' => ['nullable', 'integer', 'min:1', 'max:1000'],
            'notes' => ['nullable', 'string', 'min:1', 'max:50'],
            'rest_time' => ['nullable', 'integer', 'min:1', 'max:50'],
        ];
    }
}
