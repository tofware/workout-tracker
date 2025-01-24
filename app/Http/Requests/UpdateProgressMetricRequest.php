<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProgressMetricRequest extends FormRequest
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
            'weight' => ['nullable', 'integer', 'min:1', 'max:100'],
            'body_fat_percentage' => ['nullable', 'integer', 'min:1', 'max:100'],
            'muscle_mass' => ['nullable', 'integer', 'min:1', 'max:100'],
            'notes' => ['nullable', 'string', 'min:1', 'max:100']
        ];
    }
}
