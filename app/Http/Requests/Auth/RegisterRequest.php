<?php

namespace App\Http\Requests\Auth;

use App\Enums\ExperienceLevel;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'profile_picture' => ['nullable', 'string'],
            'goal' => ['nullable', 'string', 'max:40'],
            'experience_level' => ['required', Rule::enum(ExperienceLevel::class)],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }
}
