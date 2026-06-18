<?php

namespace Database\Seeders;

use App\Models\Blueprint;
use App\Models\Tenant;
use App\Models\Theme;
use App\Models\Website;
use Illuminate\Database\Seeder;

class BlueprintSeeder extends Seeder
{
    public function run(): void
    {
        $realEstateSchema = [
            'sections' => [
                [
                    'id' => 'app_bar',
                    'type' => 'RealEstateAppBar',
                    'label' => 'Navigation Bar',
                    'fields' => [
                        ['key' => 'logo_url', 'type' => 'image', 'label' => 'Logo'],
                    ],
                    'styles' => [
                        ['key' => 'bg_color', 'type' => 'color', 'label' => 'Background Color'],
                    ]
                ],
                [
                    'id' => 'hero',
                    'type' => 'RealEstateHeader',
                    'label' => 'Hero Section',
                    'fields' => [
                        ['key' => 'title', 'type' => 'text', 'label' => 'Hero Title'],
                        ['key' => 'image_url', 'type' => 'image', 'label' => 'Hero Image'],
                    ],
                    'styles' => [
                        ['key' => 'bg_color', 'type' => 'color', 'label' => 'Background Color'],
                    ]
                ],
                [
                    'id' => 'about_me',
                    'type' => 'RealEstateAboutMe',
                    'label' => 'About Me',
                    'fields' => [
                        ['key' => 'text', 'type' => 'textarea', 'label' => 'About Me Bio'],
                    ],
                    'styles' => [
                        ['key' => 'bg_color', 'type' => 'color', 'label' => 'Background Color'],
                        ['key' => 'text_color', 'type' => 'color', 'label' => 'Text Color'],
                    ]
                ],
                [
                    'id' => 'properties',
                    'type' => 'RealEstateProperties',
                    'label' => 'Properties Gallery',
                    'fields' => [
                        ['key' => 'title', 'type' => 'text', 'label' => 'Section Title'],
                        ['key' => 'items', 'type' => 'repeater', 'label' => 'Properties', 'schema' => [
                            ['key' => 'name', 'type' => 'text', 'label' => 'Property Name'],
                            ['key' => 'price', 'type' => 'text', 'label' => 'Price'],
                            ['key' => 'image', 'type' => 'image', 'label' => 'Image'],
                        ]],
                    ],
                    'styles' => [
                        ['key' => 'bg_color', 'type' => 'color', 'label' => 'Background Color'],
                        ['key' => 'text_color', 'type' => 'color', 'label' => 'Text Color'],
                    ]
                ],
                [
                    'id' => 'testimonials',
                    'type' => 'RealEstateTestimonials',
                    'label' => 'Client Testimonials',
                    'fields' => [
                        ['key' => 'items', 'type' => 'repeater', 'label' => 'Testimonials', 'schema' => [
                            ['key' => 'client_name', 'type' => 'text', 'label' => 'Client Name'],
                            ['key' => 'quote', 'type' => 'textarea', 'label' => 'Quote'],
                        ]],
                    ],
                    'styles' => [
                        ['key' => 'bg_color', 'type' => 'color', 'label' => 'Background Color'],
                        ['key' => 'text_color', 'type' => 'color', 'label' => 'Text Color'],
                    ]
                ],
                [
                    'id' => 'neighbourhoods',
                    'type' => 'RealEstateNeighbourhoods',
                    'label' => 'Neighbourhoods',
                    'fields' => [
                        ['key' => 'items', 'type' => 'repeater', 'label' => 'Areas', 'schema' => [
                            ['key' => 'name', 'type' => 'text', 'label' => 'Area Name'],
                            ['key' => 'image', 'type' => 'image', 'label' => 'Image'],
                            ['key' => 'count', 'type' => 'text', 'label' => 'Listing Count'],
                        ]],
                    ],
                    'styles' => [
                        ['key' => 'bg_color', 'type' => 'color', 'label' => 'Background Color'],
                        ['key' => 'text_color', 'type' => 'color', 'label' => 'Text Color'],
                    ]
                ],
                [
                    'id' => 'contact',
                    'type' => 'RealEstateContactMe',
                    'label' => 'Contact Section',
                    'fields' => [
                        ['key' => 'email', 'type' => 'text', 'label' => 'Email Address'],
                        ['key' => 'phone', 'type' => 'text', 'label' => 'Phone Number'],
                    ],
                    'styles' => [
                        ['key' => 'bg_color', 'type' => 'color', 'label' => 'Background Color'],
                        ['key' => 'text_color', 'type' => 'color', 'label' => 'Text Color'],
                    ]
                ]
            ]
        ];

        $blueprint = Blueprint::create([
            'vertical' => 'real_estate',
            'schema' => $realEstateSchema,
        ]);

        Theme::create([
            'blueprint_id' => $blueprint->id,
            'name' => 'Classic Modern',
            'config' => [
                'colors' => [
                    'primary' => '#f59e0b',
                    'secondary' => '#0f172a',
                ],
                'fonts' => [
                    'heading' => 'Outfit',
                    'body' => 'Inter',
                ]
            ]
        ]);
    }
}
