<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    public function verticals()
    {
        return $this->hasMany(Vertical::class);
    }
}
