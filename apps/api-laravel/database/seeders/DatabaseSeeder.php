<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(TimezonesTableSeeder::class);
        $this->call(IndustriesTableSeeder::class);
        $this->call(BlueprintSeeder::class);
        $this->call(TemplatesTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(PayFacsTableSeeder::class);
        $this->call(PluginsTableSeeder::class);

        if (config('app.env') !== 'production') {
            $this->call(UsersTableSeeder::class);
            $this->call(PlansTableSeeder::class);
        }
    }
}
