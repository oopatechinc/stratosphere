<?php

namespace Tests;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\TestResponse;

abstract class AbstractTest extends TestCase
{
    protected User $user;

    protected function login(): TestResponse
    {
        $password = 'secret-password';
        $this->user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make($password),
        ]);

        $this->withCredentials()->get('/sanctum/csrf-cookie');

        return $this->withCredentials()->post('/api/auth/login', [
            'email' => $this->user->email,
            'password' => $password,
        ]);
    }
}
