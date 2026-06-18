<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    const LANGUAGES = [
        'English',
        'Française',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //load countries
        foreach (self::LANGUAGES  as $language) {
            Language::query()->create([
                'language' => $language,
            ]);
        }
    }
}
