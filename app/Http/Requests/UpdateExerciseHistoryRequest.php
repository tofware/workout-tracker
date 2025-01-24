<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateExerciseHistoryRequest extends FormRequest
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
            'user_id' => ['sometimes', 'exists:App\Models\User,id'],
            'exercise_id' => ['sometimes', 'exists:App\Models\Exercise,id'],
            'date' => ['sometimes', 'date'],
            'best_weight' => ['sometimes', 'integer', 'min:1', 'max:1000'],
            'best_repetitions' => ['sometimes', 'integer', 'min:1', 'max:1000'],
            'one_rep_max' => ['sometimes', 'integer', 'min:1', 'max:1000'],
            'notes' => ['nullable', 'string', 'min:1', 'max:1000']
        ];
    }
}
