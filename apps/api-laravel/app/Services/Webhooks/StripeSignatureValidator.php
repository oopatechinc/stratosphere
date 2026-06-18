<?php

namespace App\Services\Webhooks;

use App\Helpers\WriteLog;
use Exception;
use Illuminate\Http\Request;
use Spatie\WebhookClient\SignatureValidator\SignatureValidator;
use Spatie\WebhookClient\WebhookConfig;
use Stripe\Webhook;

class StripeSignatureValidator implements SignatureValidator
{
    public function isValid(Request $request, WebhookConfig $config): bool
    {
        $signature = $request->header($config->signatureHeaderName);
        $secret = $config->signingSecret;

        try {
            Webhook::constructEvent($request->getContent(), $signature, $secret);
        } catch (Exception $ex) {
            WriteLog::notice($ex->getMessage(), [ $signature ]);
            return false;
        }

        return true;
    }
}
