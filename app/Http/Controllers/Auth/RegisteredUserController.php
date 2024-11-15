<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * @param RegisterRequest $request
     * @return Response
     */
    public function store(RegisterRequest $request): Response
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'experience_level' => $validated['experience_level'],
            'goal' => $validated['goal'] ?? null,
            'profile_picture' => $validated['profile_picture'] ?? null,
            'password' => Hash::make($validated['password']),
        ]);

        event(new Registered($user));

        return response()->noContent();
    }
}
