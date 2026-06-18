<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Website extends Model
{
    protected $fillable = [
        'template_id',
        'theme_id',
        'domain_id',
        'active_config'
    ];

    protected $casts = [
        'active_config' => 'array',
    ];
    public function theme(): BelongsTo
    {
        return $this->belongsTo(Theme::class);
    }

    public function template(): BelongsTo
    {
        return $this->belongsTo(Template::class);
    }
}
