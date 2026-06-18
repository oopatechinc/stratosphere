<?php

namespace App\Models;

use App\Services\AwsFileService;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'tenant_id',
        'name',
        'image_url'
    ];

    protected $appends = [
        'image_url'
    ];

    const ARRAY_VALIDATION_RULES = [
        'categories' => 'nullable|array',
        'categories.*.tenant_id' => 'required|integer|exists:tenants,id',
        'categories.*.name' => 'required|string|max:255'
    ];

    //attributes
    public function imageUrl(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                if (empty($attributes['image_url']))  return null;
                return (new AwsFileService())->getPreSignedUrl($attributes['image_url']);
            }
        );
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class)->withTimestamps();
    }
}
