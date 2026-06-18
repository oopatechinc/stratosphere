<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $guarded = [];
    protected $appends = ['morph_class'];

    public function morphClass(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $this->getMorphClass()
        );
    }
}
