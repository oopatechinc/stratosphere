<?php

namespace Database\Seeders;

use App\Models\TimeBlockFrequency;
use Illuminate\Database\Seeder;

class TenantTimeBlockFrequenciesTableSeeder extends Seeder
{
    const FREQUENCIES = ['No repeat', 'Weekly', 'Bi-Weekly', 'Monthly'];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::FREQUENCIES as $frequency) {
            TimeBlockFrequency::query()->create(['frequency' => $frequency]);
        }
    }
}
