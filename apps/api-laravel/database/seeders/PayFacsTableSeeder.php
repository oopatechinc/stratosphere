<?php

namespace Database\Seeders;

use App\Models\PayFac;
use Illuminate\Database\Seeder;

class PayFacsTableSeeder extends Seeder
{
    const PaymentFacilitators = [
        PayFac::STRIPE
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        foreach (self::PaymentFacilitators as $payFac) {
            PayFac::query()->create(['name' => $payFac]);
        }
    }
}
