<?php

namespace App\Http\Controllers\Services;

use App\Helpers\Money;
use App\Helpers\Logit;
use App\Models\PayFac;
use App\Models\PayFacCustomer;
use App\Models\Plan;
use App\Models\Subscription;
use App\Services\StripeService;

class StripeControllerService
{
    public function createSetupIntent(): string
    {
        $stripeService = new StripeService();
        $intentResponse = $stripeService->createSetupIntent($this->getCustomer()->token);
        return $intentResponse['client_secret'];
    }

    public function createPaymentIntent(int $amount)
    {
        $amount *= 100;

        $stripeService = new StripeService();
        $intentResponse = $stripeService->createPaymentIntent($amount);
        return $intentResponse['client_secret'];
    }

    public function createCheckoutSession(string $plan): string
    {
        $plan = Plan::query()->where('name', $plan)->with('prices')->firstOrFail();
        $price = $plan->prices()->where('nickname', $plan->name)->firstOrFail();
        $stripeService = new StripeService();
        $response = $stripeService->createCheckoutSession($price->pay_fac_price_id, $this->getCustomer()->token);

        // create initial subscription
        Subscription::query()->updateOrCreate(
            [
                'tenant_id' => auth()->user()->staff()->first()->tenant_id,
                'user_id' => auth()->id(),
                'payment_status' => $response->payment_status
            ],
            [
                'tenant_id' => auth()->user()->staff()->first()->tenant_id,
                'plan_id' => $plan->id,
                'user_id' => auth()->id(),
                'pay_fac_session_id' => $response->id,
                'payment_status' => $response->payment_status
            ]);

        return $response->client_secret;
    }

    public function createCustomer($userId, $email, $name, $paymentMethod = null): PayFacCustomer
    {
        $stripeService = new StripeService();
        $stripeCustomerResponse = $stripeService->createCustomer($email, $name, $paymentMethod);

        $payFac = PayFac::query()->where('name', PayFac::STRIPE)->firstOrFail();

        // create merchant customer
        return PayFacCustomer::query()->create([
            'pay_fac_id' => $payFac->id,
            'user_id' => $userId,
            'token' => $stripeCustomerResponse['id']
        ]);
    }

    private function getCustomer(): PayFacCustomer
    {
        $user = auth()->user();
        $payFacCustomer = PayfacCustomer::where('user_id', auth()->id())->first();
        if (!$payFacCustomer) {
            $payFacCustomer = $this->createCustomer($user->id, $user->email, $user->full_name);
        }

        return $payFacCustomer;
    }

    public function checkSubscriptionStatus($checkoutSessionId)
    {
        try {
            $response = (new StripeService())->retrieveCheckoutSession($checkoutSessionId);

            if ($response->payment_status === 'paid') {
                $subscription = Subscription::query()->where([
                    'pay_fac_session_id' => $response->id,
                ])->firstOrFail();

                $subscription->update([
                    'pay_fac_subscription_id' => $response->subscription,
                    'payment_status' => $response->payment_status,
                    'currency' => $response->currency,
                    'tax' => $response->total_details->amount_tax,
                    'total' => $response->amount_total
                ]);
            }
        } catch (\Exception $ex) {
            Logit::error('CheckPaymentStatus', $ex->getTrace());
        }
    }
}
