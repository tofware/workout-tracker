<?php

namespace App\Http\Requests;

use App\Enums\GoalStatus;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGoalRequest extends FormRequest
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
            'goal_type' => ['sometimes', 'string', 'min:1', 'max:50'],
            'target_value' => ['sometimes', 'integer', 'min:1', 'max:1000'],
            'deadline' => ['sometimes', 'date'],
            'status' => ['sometimes', Rule::enum(GoalStatus::class)],
            'notes' => ['sometimes', 'string', 'min:1', 'max:100'],
        ];
    }
}
