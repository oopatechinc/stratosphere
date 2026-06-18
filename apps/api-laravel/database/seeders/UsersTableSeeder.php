<?php

namespace Database\Seeders;

use App\Models\Template;
use App\Models\User;
use App\Models\Vertical;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@doe.com',
            'type' => 'staff',
            'password' => bcrypt('john123'),
        ]);
    }
}
