<?php

namespace Feature;

use App\Models\Staff;
use App\Models\Tenant;
use App\Models\Service;
use Database\Factories\AdminFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Tests\AbstractTest;
use Tests\TestCase;

class CategoryTest extends AbstractTest
{
    /**
     * A basic feature test example.
     */
    public function test_storing_category_with_valid_data_is_successful(): void
    {
        $tenant = Tenant::factory()->create();

        $payload = [
            'tenant_id' => $tenant->id,
            'name' => 'Category 1',

        ];

        // login first so request can pass sanctum check
        $this->login();

        $response = $this->withCredentials()->post('api/admin/categories', $payload);

        $response->assertStatus(201);
    }

    /**
     * A basic feature test example.
     */
    public function test_retrieving_categories_is_successful(): void
    {
        // login first so request can pass sanctum check
        $this->login();

        $tenant = Tenant::factory()->create();

        $payload = [
            'tenant_id' => $tenant->id,
            'name' => 'Category 1',

        ];

        $response = $this->withCredentials()->post('api/admin/categories', $payload);

        $response->assertStatus(201);

        $response = $this->withCredentials()->get('api/admin/categories');
        $response->assertStatus(200);
        $response->assertSee($payload);
    }
}
