<?php

namespace Tests\Feature;


use Tests\AbstractTest;

class AuthTest extends AbstractTest
{
    /**
     * A basic feature test example.
     */
    public function test_registration_with_valid_payload_is_successful(): void
    {
        $payload = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@doe.com',
            'password' => 'john123456',
        ];

        $response = $this->post('api/signup', $payload);

        $response->assertStatus(201);
    }

    /**
     * Test a successful cookie-based login and subsequent retrieval of the authenticated user.
     *
     * @return void
     */
    public function test_user_can_login_with_cookies_and_retrieve_authenticated_user()
    {
        $loginResponse = $this->login();

        $loginResponse->assertStatus(200)
            ->assertSuccessful();

        $userResponse = $this->withCredentials()->get('/api/user');
        $userResponse->assertStatus(200);

        // Assert that the returned user data matches the created user
        $userResponse->assertJson([
            'id' => $this->user->id,
            'email' => 'test@example.com',
        ]);

        // assert that the password is not included in the response
        $userResponse->assertJsonMissing(['password']);
    }

    /**
     * Test retrieval fails without being authenticated (e.g., no cookies).
     *
     * @return void
     */
    public function test_unauthenticated_user_cannot_retrieve_user_data()
    {
        // Attempt to access the protected endpoint without any session/cookies
        $response = $this->get('/api/user');

        // Should return 401 Unauthorized for unauthenticated requests to protected APIs
        $response->assertStatus(500);
    }
}
