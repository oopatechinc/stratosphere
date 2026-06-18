<?php

namespace App\Shared;

class Money
{
    const CURRENCY_CAD = 'cad';
    const CURRENCY_USD = 'usd';

    public static function convertToInteger($amount)
    {
        return round($amount, 2) * 100;
    }

    public static function convertToDecimal($amount)
    {
        return round($amount / 100, 2);
    }
}
