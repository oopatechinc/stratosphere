<?php

namespace Database\Seeders;

use App\Models\Template;
use App\Models\Vertical;
use Illuminate\Database\Seeder;

class TemplatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Template::TEMPLATES as $t) {
            $template = Template::query()->create([
                'blueprint_id' => $t['blueprint_id'],
                'name'      => $t['name'],
                'image_url' => $t['image_url'],
                'is_active' => $t['is_active'],
            ]);

            //attach tags
            foreach ($t['verticals'] as $vTag) {
                $vertical = Vertical::query()->where('tag', $vTag)->first();
                $template->verticals()->attach($vertical);
            }
        }
    }
}
