<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateExerciseRequest extends FormRequest
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
            'name' => ['sometimes', 'min:1', 'max:100'],
            'difficulty' => ['sometimes', 'min:1', 'max:50'],
            'instructions' => ['sometimes', 'array', 'nullable'],
            'equipment_id' => ['sometimes', 'exists:App\Models\Equipment,id'],
            'muscle_group_id' => ['sometimes', 'exists:App\Models\MuscleGroup,id'],
        ];
    }
}
