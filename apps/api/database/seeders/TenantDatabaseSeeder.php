<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantDatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(TenantCountriesTableSeeder::class);
        $this->call(TenantStatesTableSeeder::class);
        $this->call(TenantTimeBlockFrequenciesTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
    }
}
