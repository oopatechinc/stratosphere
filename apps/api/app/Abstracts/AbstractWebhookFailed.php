<?php

namespace App\Abstracts;

use Exception;
use Spatie\WebhookClient\Models\WebhookCall;

class AbstractWebhookFailed extends Exception
{
    public static function signingSecretNotSet(): self
    {
        return new static('The webhook signing secret is not set. Make sure that the `signing_secret` config key is set to the correct value.');
    }

    public static function jobClassDoesNotExist(string $jobClass, WebhookCall $webhookCall): static
    {
        return new static("Could not process webhook id `{$webhookCall->id}` of type `{$webhookCall->type} because the configured jobclass `$jobClass` does not exist.");
    }

    public function render($request)
    {
        return response(['error' => $this->getMessage()], 400);
    }
}
