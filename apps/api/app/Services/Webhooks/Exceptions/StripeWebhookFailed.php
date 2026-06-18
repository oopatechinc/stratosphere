<?php

namespace App\Services\Webhooks\Exceptions;

use App\Abstracts\AbstractWebhookFailed;
use Exception;
use Spatie\WebhookClient\Models\WebhookCall;

class StripeWebhookFailed extends AbstractWebhookFailed
{
    public static function missingType(WebhookCall $webhookCall)
    {
        return new static("Webhook call id `{$webhookCall->id}` did not contain a type. Valid Stripe webhook calls should always contain a type.");
    }
}
