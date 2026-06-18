<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CollectionItem extends Model
{
    protected $fillable = ['collection_type', 'content'];

    protected $casts = [
        'content' => 'array',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(CollectionItemImage::class);
    }
}
