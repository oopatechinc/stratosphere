<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Theme extends Model
{
    protected $connection = 'pgsql';
    protected $fillable = ['blueprint_id', 'name', 'config'];

    protected $casts = [
        'config' => 'array',
    ];

    public function blueprint(): BelongsTo
    {
        return $this->belongsTo(Blueprint::class);
    }

    public function websites(): HasMany
    {
        return $this->hasMany(Website::class);
    }
}
