<?php

namespace Feature;

use App\Models\Tenant;
use Tests\AbstractTest;

class ServiceTest extends AbstractTest
{
    /**
     * A basic feature test example.
     */
    public function test_storing_service_with_valid_data_is_successful(): void
    {
        $tenant = Tenant::factory()->create();

        $payload = [
            'tenant_id' => $tenant->id,
            'name' => 'Service',
            'price' => 400,
            'duration' => 30,
            'description' => 'A test service'

        ];

        // login first so request can pass sanctum check
        $this->login();

        $response = $this->withCredentials()->post('api/admin/services', $payload);

        $response->assertStatus(201);
    }

    /**
     * A basic feature test example.
     */
    public function test_retrieving_services_is_successful(): void
    {
        // login first so request can pass sanctum check
        $this->login();

        $tenant = Tenant::factory()->create();

        $payload = [
            'tenant_id' => $tenant->id,
            'name' => 'Service',
            'price' => 400,
            'duration' => 30,
            'description' => 'A test service'

        ];

        $response = $this->withCredentials()->post('api/admin/services', $payload);

        $response->assertStatus(201);

        $response = $this->withCredentials()->get('api/admin/services');
        $response->assertStatus(200);
        $response->assertSee($payload);
    }
}
