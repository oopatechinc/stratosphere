<?php

namespace Feature;

use Database\Factories\UserFactory;
use Tests\AbstractTest;

class UserTest extends AbstractTest
{
    /**
     * A basic feature test example.
     */
    public function test_storing_user_with_valid_data_is_successful(): void
    {
        $payload = [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->email(),
            'password' => fake()->password(),
        ];

        // login first so request can pass sanctum check
        $this->login();

        $response = $this->withCredentials()->post('api/users', $payload);

        $response->assertStatus(201);
    }

    /**
     * A basic feature test example.
     */
    public function test_retrieving_users_is_successful(): void
    {
        // login first so request can pass sanctum check
        $this->login();

        $payload = [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->email(),
            'password' => fake()->password(),
        ];

        $response = $this->withCredentials()->post('api/users', $payload);
        $response->assertStatus(201);

        //password is not returned
        unset($payload['password']);

        $response = $this->withCredentials()->get('api/users');
        $response->assertStatus(200);
        $response->assertSee($payload);
    }

    /**
     * A basic feature test example.
     */
    public function test_updating_user_is_successful(): void
    {
        // login first so request can pass sanctum check
        $this->login();

        $user = UserFactory::new()->create();

        //update email
        $newFirstname = fake()->firstName();

        $response = $this->withCredentials()->patch('api/users/'. $user->id, [
            'first_name' => $newFirstname,
        ]);

        $response->assertStatus(200);
        $response->assertSee(['first_name' => $newFirstname]);
    }
}
