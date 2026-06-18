<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Services\AuthService;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffAuthController
{
    public function __construct(protected AuthService $authService)
    {
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(AuthLoginRequest $request)
    {
        if (!$this->authService->login($request->validated())) {
            return response()->json(null, 401);
        }

        // successfully authenticated
        if (auth()->user()->type !== 'staff') {
            Auth::logout();
            return response()->json(['error' => 'Not a staff account'], 401);
        }

        $token = auth()->user()->createToken(config('app.name'))->plainTextToken;

        return response()->json(['token' => $token]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        auth::user()->tokens()->delete();
        return response()->json();
    }

    public function signup(AuthRegisterRequest $request)
    {
        $user = $this->authService->register($request->validated());
        return response()->json($user, 201);
    }
}
