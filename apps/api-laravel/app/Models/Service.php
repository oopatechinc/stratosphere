<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Services\AwsFileService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tenant_id',
        'name',
        'description',
        'image_url'
    ];

    protected $appends = [
        'image_url'
    ];

    const ARRAY_VALIDATION_RULES = [
        'services' => 'required|array',
        'services.*.id' => 'required|integer|exists:services,id',
        'services.*.tenant_id' => 'required|integer|exists:tenants,id',
        'services.*.name' => 'required|string|max:255',
        'services.*.description' => 'required|string',
    ];

    public function imageUrl(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                if (empty($attributes['image_url']))  return null;
                return (new AwsFileService())->getPreSignedUrl($attributes['image_url']);
            }
        );
    }

    /*********************
     * Relationships
     */
    public function variations(): HasMany
    {
        return $this->hasMany(ServiceVariation::class);
    }
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }
}
