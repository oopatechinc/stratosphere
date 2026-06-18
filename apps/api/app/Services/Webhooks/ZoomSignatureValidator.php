<?php

namespace App\Services\Webhooks;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\Webhooks\Exceptions\ZoomWebhookFailed;
use Spatie\WebhookClient\SignatureValidator\SignatureValidator;
use Spatie\WebhookClient\WebhookConfig;

class ZoomSignatureValidator implements SignatureValidator
{
    private string $timestampHeaderName = 'x-zm-request-timestamp';
    private string $prefix = 'v0';
    public function isValid(Request $request, WebhookConfig $config): bool
    {
        $signature = $request->header($config->signatureHeaderName);

        if (! $signature) {
            return false;
        }

        $signingSecret = $config->signingSecret;

        if (empty($signingSecret)) {
            throw ZoomWebhookFailed::signingSecretNotSet();
        }

        $timestamp =  $request->header($this->timestampHeaderName);

        if (empty($timestamp)) {
            throw ZoomWebhookFailed::missingTimestampHeader();
        }

        $payload = $request->getContent();

        $content = "$this->prefix:$timestamp:$payload";

        $computedSignature = "$this->prefix=" . hash_hmac('sha256', $content, $signingSecret);

        return hash_equals($signature, $computedSignature);
    }
}
