<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreExerciseHistoryRequest extends FormRequest
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
            'user_id' => ['required', 'exists:App\Models\User,id'],
            'exercise_id' => ['required', 'exists:App\Models\Exercise,id'],
            'date' => ['required', 'date'],
            'best_weight' => ['required', 'integer', 'min:1', 'max:1000'],
            'best_repetitions' => ['required', 'integer', 'min:1', 'max:1000'],
            'one_rep_max' => ['required', 'integer', 'min:1', 'max:1000'],
            'notes' => ['nullable', 'string', 'min:1', 'max:1000']
        ];
    }
}
