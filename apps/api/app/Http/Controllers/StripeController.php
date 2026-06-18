<?php

namespace App\Http\Controllers;


use App\Helpers\Logit;
use App\Http\Controllers\Services\StripeControllerService;
use App\Http\Requests\CheckSubscriptionStatusStripeRequest;
use App\Http\Requests\CreateCheckoutStripeRequest;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function __construct(protected StripeControllerService $service)
    {
    }

    public function createCheckoutSession(CreateCheckoutStripeRequest $request)
    {
        return $this->service->createCheckoutSession($request->validated('plan'));
    }

    public function checkSubscriptionStatus(CheckSubscriptionStatusStripeRequest $request)
    {
        $this->service->checkSubscriptionStatus($request->validated('checkout_session_id'));
    }
}
