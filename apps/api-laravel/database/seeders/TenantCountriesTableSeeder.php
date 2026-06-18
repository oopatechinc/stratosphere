<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class TenantCountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $activeCountries = config('bookisia.active_countries_iso');
        //load countries
        foreach (Country::COUNTRIES  as $iso => $country) {
            Country::query()->create([
                'iso' => $iso,
                'name' => $country['name'],
                "geographical_unit_name" => $country['geographical_unit_name'],
                'is_active' => in_array($iso, $activeCountries)
            ]);
        }
    }
}
