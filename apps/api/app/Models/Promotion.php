<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    const PROMOTION_FREE_3_MONTHS  = 'BOOKISIA90';
    const PROMOTION_FREE_6_MONTHS  = 'BOOKISIA180';
    const PROMOTION_FREE_12_MONTHS = 'BOOKISIA365';

    const PROMOTION_FREE_3_MONTHS_QUANTITY  = 10;
    const PROMOTION_FREE_6_MONTHS_QUANTITY  = 5;
    const PROMOTION_FREE_12_MONTHS_QUANTITY = 5;

    const PROMOTION_FREE_3_MONTHS_TRIAL_DAYS  = 90;
    const PROMOTION_FREE_6_MONTHS_TRIAL_DAYS  = 180;
    const PROMOTION_FREE_12_MONTHS_TRIAL_DAYS = 365;

    const PROMOTIONS = [
      [
          'code' => self::PROMOTION_FREE_3_MONTHS,
          'quantity' => self::PROMOTION_FREE_3_MONTHS_QUANTITY,
          'description' => 'Free 3 months subscription'
      ],
      [
          'code' => self::PROMOTION_FREE_6_MONTHS,
          'quantity' => self::PROMOTION_FREE_6_MONTHS_QUANTITY,
          'description' => 'Free 6 months subscription'
      ],
      [
          'code' => self::PROMOTION_FREE_12_MONTHS,
          'quantity' => self::PROMOTION_FREE_12_MONTHS_QUANTITY,
          'description' => 'Free 12 months subscription'
      ],
    ];

    protected $fillable = [
      'code',
      'description',
      'quantity',
      'is_active'
    ];
}
