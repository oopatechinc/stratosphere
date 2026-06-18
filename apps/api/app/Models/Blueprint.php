<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Blueprint extends Model
{
    protected $connection = 'pgsql';

    protected $fillable = ['vertical', 'schema'];

    protected $casts = [
        'schema' => 'array',
    ];

    public function themes(): HasMany
    {
        return $this->hasMany(Theme::class);
    }

    public function websites()
    {
        // A central blueprint can be used by many tenant websites
        return $this->hasMany(Website::class, 'blueprint_id');
    }
}
