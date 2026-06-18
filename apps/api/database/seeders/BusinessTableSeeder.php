<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\Staff;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class BusinessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = UserFactory::new()->create();
        $business = Tenant::factory()->create();
        $staff = Staff::factory()->create(['tenant_id' => $business->id]);
    }
}
