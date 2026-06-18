<?php

namespace Database\Seeders;

use App\Models\Plugin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PluginsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Plugin::PLUGINS as $plugin) {
            Plugin::query()->create(['name' => $plugin]);
        }
    }
}
