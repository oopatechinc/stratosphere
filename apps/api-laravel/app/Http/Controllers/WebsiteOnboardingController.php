<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use App\Models\Tenant;
use App\Models\Website;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebsiteOnboardingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'template_id' => 'required|integer',
            'theme_id' => 'required|integer',
            'domain' => 'required|string'
        ]);

        return DB::transaction(function () use ($request) {
            $theme = Theme::findOrFail($request->theme_id);

            $domain = Domain::query()->create([
                'tenant_id' => auth()->user()->tenant()->first()->id,
                'domain' => $request->domain,
            ]);

            $website = Website::create([
                'template_id' => $request->template_id,
                'theme_id' => $theme->id,
                'domain_id' => $domain->id,
                'active_config' => [
                    'sections' => [
                        ['id' => 'app_bar', 'fields' => ['logo_url' => 'https://picsum.photos/200/50'], 'styles' => ['bg_color' => '#000000']],
                        ['id' => 'hero', 'fields' => ['title' => 'Finding Your Dream Home', 'image_url' => 'https://picsum.photos/1920/1080'], 'styles' => ['bg_color' => '#000000']],
                        ['id' => 'about_me', 'fields' => ['text' => 'Experienced real estate agent with 10 years in the market.'], 'styles' => ['bg_color' => '#000000', 'text_color' => '#ffffff']],
                        ['id' => 'dynamic_properties', 'type' => 'CollectionGrid', 'fields' => [
                            'title' => 'Featured Properties',
                            'dataSource' => [
                                'type' => 'dynamic',
                                'endpoint' => '/collections/properties'
                            ],
                            'mappings' => [
                                'name' => 'name',
                                'price' => 'price',
                                'address' => 'address',
                                'beds' => 'beds',
                                'baths' => 'baths',
                                'rooms' => 'rooms',
                                'images' => 'images',
                            ]
                        ], 'styles' => ['bg_color' => '#ffffff', 'text_color' => '#000000']],
                        ['id' => 'testimonials', 'fields' => ['items' => [
                            ['client_name' => 'Jane Smith', 'quote' => 'John found us the perfect home in just a week!'],
                        ]], 'styles' => ['bg_color' => '#ffffff', 'text_color' => '#000000']],
                        ['id' => 'neighbourhoods', 'fields' => ['items' => [
                            ['name' => 'Beverly Hills', 'count' => '42', 'image' => 'https://images.unsplash.com/photo-1582650625119-3a31f8fa2699?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'],
                            ['name' => 'Bel Air', 'count' => '18', 'image' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'],
                            ['name' => 'Malibu', 'count' => '31', 'image' => 'https://images.unsplash.com/photo-1510798831971-661eb04b3739?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'],
                            ['name' => 'Hollywood Hills', 'count' => '25', 'image' => 'https://images.unsplash.com/photo-1513584684374-8bdb7489feef?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'],
                        ]], 'styles' => ['bg_color' => '#000000', 'text_color' => '#ffffff']],
                        ['id' => 'contact', 'fields' => ['email' => 'john@doe.com', 'phone' => '555-0123'], 'styles' => ['bg_color' => '#212121', 'text_color' => '#ffffff']],
                    ]
                ]
            ]);

            $domain->update(['website_id' => $website->id]);

            return $website;
        });
    }
}
