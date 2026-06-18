<?php

namespace App\Services;

use App\Models\User;
use App\Shared\Money;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Eloquent\Model;
use Stripe;

class StripeService
{
    protected string $stripeAccountId;
    protected array $stripeAccount = [];
    protected $stripeClient;

    const FEE_TYPE_STRIPE_FEE = 'stripe_fee';
    const FEE_TYPE_APPLICATION_FEE = 'application_fee';

    /**
     * StripeService constructor.
     * @param string $stripeAccountId
     */
    public function __construct(string $stripeAccountId = '')
    {
        Stripe\Stripe::setApiKey(config('services.stripe.secret_key'));
        $this->stripeClient = new Stripe\StripeClient(config('services.stripe.secret_key'));

        if (!empty($stripeAccountId)) {
            $this->stripeAccount = ['stripe_account' => $stripeAccountId];
            $this->stripeAccountId = $stripeAccountId;
        }
    }

    /**
     * @param Model $customer
     * @param string|null $paymentMethod
     * @return Stripe\Customer
     * @throws Stripe\Exception\ApiErrorException
     */
    public function createCustomer($email, string $name = '', string $paymentMethod = null)
    {
        return Stripe\Customer::create(
            [
                'email' => $email,
                'name' => $name,
                'payment_method' => $paymentMethod
            ],
            $this->stripeAccount
        );
    }

    /**
     * @param MerchantCustomers $merchantCustomer
     * @param User $user
     * @param string $token
     * @return mixed
     */
    public function updateCustomer(MerchantCustomers $merchantCustomer, $user, $token)
    {
        return Stripe\Customer::update(
            $merchantCustomer->token,
            [
                'email' => $user->email,
                'source' => $token,
                'description' => 'Customer for ' . $user->email,
            ],
            $this->stripeAccount
        );
    }

    /**
     * @param string $customerToken
     * @param string $amount
     * @param string $currency
     * @param int $applicationFee
     * @return mixed
     */
    public function charge($customerToken, $amount, $currency, $applicationFee = 0)
    {
        return Stripe\Charge::create(
            [
                'customer' => $customerToken,
                'currency' => $currency,
                'amount' => $amount,
                'application_fee_amount' => $applicationFee
            ],
            $this->stripeAccount
        );
    }

    /**
     * @param string $chargeId
     * @param string $refundAmount
     * @param bool $refundApplicationFee
     * @return Stripe\ApiResource
     */
    public function refund($chargeId, $refundAmount = null, $refundApplicationFee = false)
    {
        $refund = ['charge' => $chargeId];

        if ($refundAmount) {
            array_merge($refund, ['amount' => $refundAmount]);
        }
        if ($refundApplicationFee) {
            array_merge($refund, ['refund_application_fee' => $refundApplicationFee]);
        }

        return Stripe\Refund::create(
            $refund,
            $this->stripeAccount
        );
    }

    /**
     * @param string $customerToken
     * @param string $cardToken
     * @return mixed
     */
    public function createCard($customerToken, $cardToken)
    {
        return Stripe\Customer::createSource(
            $customerToken, [
                'source' => $cardToken,
            ],
            $this->stripeAccount
        );
    }

    /**
     * @param $transactionId
     * @return Stripe\BalanceTransaction
     */
    public function getBalanceTransaction($transactionId)
    {
        return Stripe\BalanceTransaction::retrieve(
            $transactionId
        );
    }

    /**
     * @param $stripeAuthCode
     * @return mixed
     * @throws GuzzleException
     */
    public function retrieveUserId($stripeAuthCode)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://connect.stripe.com/oauth/token', [
            'form_params' => [
                'client_secret' => env('STRIPE_SECRET_KEY'),
                'code'          => $stripeAuthCode,
                'grant_type'    => 'authorization_code',
            ]
        ]);

        $result = json_decode($response->getBody());
        return $result->stripe_user_id;
    }

    public function createSetupIntent($customerToken='')
    {
        $content = [];
        if ($customerToken) {
            $content = [
                'customer' => $customerToken,
                'payment_method_types' => ['card'],
            ];
        }

        return Stripe\SetupIntent::create($content, $this->stripeAccount);
    }

    public function retrieveSetupIntent($setupIntentId)
    {
        return Stripe\SetupIntent::retrieve($setupIntentId, $this->stripeAccount);
    }

    public function createPaymentIntent($amount, $currency = 'CAD')
    {
        $payload = [
            'payment_method_types' => ['card'],
            'amount' => $amount,
            'currency' => $currency
        ];

        if (!empty($this->stripeAccountId)) {
            $payload['transfer_data'] = [ 'destination' => $this->stripeAccountId ];
        }

        return Stripe\PaymentIntent::create($payload);
    }

    public function createPaymentIntentWithApplicationFee(
        $amount,
        $customerToken,
        $paymentMethodId,
        $destination,
        $applicationFee,
        $currency = Money::CURRENCY_CAD,
    )
    {
        $payload = [
            'amount' => $amount,
            'currency' => $currency,
            'customer' => $customerToken,
            'payment_method' => $paymentMethodId,
            'application_fee_amount' => $applicationFee,
            'off_session' => true,
            'confirm' => true,
            'transfer_data' => [
                'destination' => $destination
            ],
        ];

        return Stripe\PaymentIntent::create($payload);
    }

    public function createPaymentIntentWithTransfer(
        $amount,
        $customerToken,
        $paymentMethodId,
        $destination,
        $transferAmount,
        $currency = Money::CURRENCY_CAD,
    )
    {
        $payload = [
            'amount' => $amount,
            'currency' => $currency,
            'customer' => $customerToken,
            'payment_method' => $paymentMethodId,
            'transfer_data' => [
                'destination' => $destination,
                'amount' => $transferAmount
            ],
            'off_session' => true,
            'confirm' => true
        ];

        return Stripe\PaymentIntent::create($payload, $this->stripeAccount);
    }

    /**
     * @param String $email
     * @return Stripe\Account
     * @throws Stripe\Exception\ApiErrorException
     */
    public function createAccount($email = '')
    {
        return Stripe\Account::create([
            'type' => 'standard',
            'country' => 'CA',
            'email' => $email,
            'default_currency' => 'CAD'
        ]);
    }

    /**
     * @param String $stripeAccountId
     * @return Stripe\Account
     * @throws Stripe\Exception\ApiErrorException
     */
    public function retrieveAccount(String $stripeAccountId)
    {
        return Stripe\Account::retrieve($stripeAccountId);
    }

    public function createAccountLink()
    {
        $redirectUri = config('services.stripe.redirect_uri');
        return Stripe\AccountLink::create([
            'account' => $this->stripeAccountId,
            'refresh_url' => $redirectUri,
            'return_url' => $redirectUri,
            'type' => 'account_onboarding'
        ]);
    }

    public function createPayout(int $amount)
    {
        return Stripe\Payout::create([
            'amount' => $amount,
            'currency' => 'usd',
            'description' => 'EDUrent PAYOUT'
        ], $this->stripeAccount);
    }

    public function createProduct(string $name)
    {
        return Stripe\Product::create([
            'name' => $name,
        ], $this->stripeAccount);
    }

    public function createPrice(string $amount, $product, $nickname, $currency = Money::CURRENCY_CAD)
    {
        return Stripe\Price::create([
            'unit_amount' => $amount,
            'currency' => $currency,
            'nickname' => $nickname,
            'recurring' => ['interval' => 'month'],
            'product' => $product,
        ], $this->stripeAccount);
    }

    public function createSubscription($customerId, $priceId, $trialPeriodDays)
    {
        return Stripe\Subscription::create([
            'customer' => $customerId,
            'items' => [[
                'price' => $priceId,
            ]],
            'trial_period_days' => $trialPeriodDays,
        ], $this->stripeAccount);
    }

    /**
     * @param string $subscriptionId
     * @return Stripe\Subscription
     * @throws Stripe\Exception\ApiErrorException
     */
    public function retrieveSubscription(string $subscriptionId)
    {
        return Stripe\Subscription::retrieve($subscriptionId, $this->stripeAccount);
    }

    /**
     * @param string $paymentMethodId
     * @return Stripe\PaymentMethod
     * @throws Stripe\Exception\ApiErrorException
     */
    public function retrievePaymentMethod(string $paymentMethodId)
    {
        return Stripe\PaymentMethod::retrieve($paymentMethodId, $this->stripeAccount);
    }

    /**
     * @param string $paymentMethodId
     * @return Stripe\PaymentMethod
     * @throws Stripe\Exception\ApiErrorException
     */
    public function detachPaymentMethod(string $paymentMethodId)
    {
        return $this->stripeClient->paymentMethods->detach($paymentMethodId);
    }

    public function transfer($amount, $transferAccount, $currency = 'CAD')
    {
        return Stripe\Transfer::create([
            'amount' => $amount,
            'currency' => $currency,
            'destination' => $transferAccount
        ]);
    }

    public function createCheckoutSession($priceId, string $customerAccount)
    {
        $state = json_encode(['action' => 'stripe_checkout_session']);
        return $this->stripeClient->checkout->sessions->create([
            'ui_mode' => 'elements',
            'customer_account' => $customerAccount,
            'mode' => 'subscription',
            'line_items' => [
                [
                    'price' => $priceId,
                    'quantity' => 1,
                ],
            ],
            'return_url' => config('bookisia.admin_url') . "/redirect?state=$state&session_id={CHECKOUT_SESSION_ID}",
        ]);
    }

    public function retrieveCheckoutSession(string $sessionId)
    {
        return $this->stripeClient->checkout->sessions->retrieve($sessionId);
    }
}
