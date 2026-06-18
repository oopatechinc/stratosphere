<?php

namespace Database\Seeders;

use App\Helpers\Logit;
use App\Models\PayFac;
use App\Models\Plan;
use App\Models\PlanPrice;
use App\Services\StripeService;
use App\Helpers\Money;
use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        try {
            foreach (config('bookisia.plans') as $name => $price) {
                $stripeProductResponse = (new StripeService())->createProduct($name);

                //create stripe price for product
                $stripePriceResponse = (new StripeService())->createPrice(
                    $price,
                    $stripeProductResponse['id'],
                    'Default Price for product ' . $name
                );

                //create plans and prices
                $plan = Plan::query()->create([
                    'name' => $name,
                    'price' => Money::convertToDecimal($price),
                    'pay_fac_id' => PayFac::getStripe()->id,
                    'pay_fac_product_id' => $stripeProductResponse['id'],
                ]);


                if (empty($stripePriceResponse['id'])) {
                    continue;
                }

                PlanPrice::query()->create([
                    'plan_id' => $plan->id,
                    'pay_fac_price_id' => $stripePriceResponse['id'],
                    'nickname' => $name,
                    'price' => Money::convertToDecimal($price)
                ]);
            }
        } catch (\Exception $ex) {
            Logit::error('An error occurred while seeding the products table', $ex->getTrace());
            throw $ex;
        }
    }
}
