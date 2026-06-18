<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayFac extends Model
{
    const STRIPE = 'stripe';

    static function getStripe(): PayFac
    {
        return PayFac::query()->where('name', self::STRIPE)->firstOrFail();
    }
}
