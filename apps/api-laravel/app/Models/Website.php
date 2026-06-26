<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Website extends Model
{
    protected $fillable = [
        'template_id',
        'theme_id',
        'domain_id',
        'staff_id',
        'active_config'
    ];

    protected $casts = [
        'active_config' => 'array'
    ];


    protected $appends = [
        'config'
    ];

    public function config(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                $staff = $this->staff()->with('user')->first();
                $sections = json_decode($attributes['active_config'], true)['sections'];
                if (!$staff || count($sections) == 0) return null;

                $sections =  collect($sections)->map(function ($section) use ($staff) {
                    if ($section['id'] === 'hero') {
                        $section['fields']['name'] = $staff->user->full_name;
                        $section['fields']['phone_number'] = $staff->user->phone;
                        $section['fields']['image_url'] = $staff->image_url;
                        $section['fields']['email'] = $staff->user->email;
                    }
                    if ($section['id'] === 'about_me') {
                        $section['fields']['image_url'] = $staff->image_url;
                    }

                    return $section;
                });

                return ['sections' => $sections];
            }
        );
    }
    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }

    public function theme(): BelongsTo
    {
        return $this->belongsTo(Theme::class);
    }

    public function template(): BelongsTo
    {
        return $this->belongsTo(Template::class);
    }
}
