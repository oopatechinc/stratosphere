<?php

namespace Feature;


use App\Models\Vertical;
use Tests\AbstractTest;

class TenantTest extends AbstractTest
{
    /**
     * A basic feature test example.
     */
    public function test_storing_tenant_with_valid_data_is_successful(): void
    {
        $vertical = Vertical::query()->first();

        $payload = [
            'name' => 'Tenant 1',
            'vertical_id' => $vertical->id
        ];

        // login first so request can pass sanctum check
        $this->login();

        $response = $this->withCredentials()->post('api/admin/tenants', $payload);

        $response->assertStatus(201);
    }

    /**
     * A basic feature test example.
     */
    public function test_retrieving_tenant_is_successful(): void
    {
        // login first so request can pass sanctum check
        $this->login();

        $vertical = Vertical::query()->first();

        $payload = [
            'name' => 'Tenant 1',
            'vertical_id' => $vertical->id
        ];

        $response = $this->withCredentials()->post('api/admin/tenants', $payload);

        $response->assertStatus(201);

        $response = $this->withCredentials()->get('api/admin/tenants');
        $response->assertStatus(200);
        $response->assertSee($payload);
    }
}
