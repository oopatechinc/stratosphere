<?php

namespace App\Models;

use App\Services\AwsFileService;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Template extends Model
{
    protected $connection = 'pgsql';
    protected $appends = [
        'image_url'
    ];

    protected $fillable = [
        'blueprint_id',
        'image_url',
        'is_active',
    ];


    const TEMPLATES = [
        [
            'blueprint_id' => 1,
            'name' => 'Zeus',
            'image_url' => '/templates/1/preview.png',
            'is_active' => 0,
            'verticals' => Vertical::GENERAL_VERTICALS
        ],
        [
            'blueprint_id' => 1,
            'name' => 'Kratos',
            'image_url' => '/templates/2/preview.png',
            'is_active' => 0,
            'verticals' => Vertical::GENERAL_VERTICALS
        ],
        [
            'blueprint_id' => 1,
            'name' => 'Apollo',
            'image_url' => '/templates/3/preview.png',
            'is_active' => 0,
            'verticals' => Vertical::GENERAL_VERTICALS
        ],
        [
            'blueprint_id' => 1,
            'name' => 'Hercules',
            'image_url' => '/templates/4/preview.png',
            'is_active' => 1,
            'verticals' => Vertical::REAL_ESTATE_VERTICALS
        ]
    ];

    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                if (empty($attributes['image_url'])) return null;
                return (new AwsFileService(config('services.aws.private_filesystem_disk')))
                    ->getPreSignedUrl($attributes['image_url']);
            }
        );
    }

    // Relationships
    public function blueprint(): BelongsTo
    {
        return $this->belongsTo(Blueprint::class);
    }

    public function verticals(): BelongsToMany
    {
        return $this->belongsToMany(Vertical::class)->withTimestamps();
    }
}
