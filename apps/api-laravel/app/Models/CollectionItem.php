<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CollectionItem extends Model
{
    protected $fillable = ['collection_type', 'content'];

    protected $casts = [
        'content' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();
        static::deleting(function (CollectionItem $model) {
            $model->images()->delete();
        });
    }

    public function images(): HasMany
    {
        return $this->hasMany(CollectionItemImage::class);
    }
}
