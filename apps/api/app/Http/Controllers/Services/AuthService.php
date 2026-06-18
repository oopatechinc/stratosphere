<?php

namespace App\Http\Controllers\Services;

use App\Jobs\SendVerificationCode;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthService
{
    public function login(Array $credentials)
    {
        return Auth::attempt($credentials);
    }

    public function logout()
    {
        Auth::logout();
    }

    public function register(Array $payload)
    {
        return User::query()->create($payload);
    }

    public function sendVerificationCode(array $payload)
    {
        $user = User::query()->where($payload['type'], $payload['payload'])->firstOrFail();
        $user->update(
            [
                'verification_code' => rand(100000, 999999),
                'is_verified' => false,
            ]);

        SendVerificationCode::dispatch($user, $payload['type'])->delay(2);
    }

    public function verifyCode(string $type, string $payload, int $code)
    {
        $user = User::query()->where($type, $payload)->firstOrFail();

        if ($user->is_verified) return true;

        if ((int)$user->verification_code === $code) {
            $user->update(['is_verified' => 1]);
            return $user;
        }

        return false;
    }

    public function updatePassword(string $email, string $password)
    {
        User::query()
            ->where('email', $email)
            ->firstOrFail()
            ->update(['password' => $password]);
    }
}
