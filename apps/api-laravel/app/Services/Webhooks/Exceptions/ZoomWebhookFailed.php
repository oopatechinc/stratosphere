<?php

namespace App\Services\Webhooks\Exceptions;

use App\Abstracts\AbstractWebhookFailed;
use Exception;
use Spatie\WebhookClient\Models\WebhookCall;

class ZoomWebhookFailed extends AbstractWebhookFailed
{
    /**
     * @return static
     */
    public static function missingTimestampHeader(): static
    {
        return new static("Zoom webhook request did not contain a timestamp header. Valid Zoom webhook calls should always contain a timestamp header.");
    }

    /**
     * @param WebhookCall $webhookCall
     * @return static
     */
    public static function missingPayload(WebhookCall $webhookCall)
    {
        return new static("Webhook call id `{$webhookCall->id}` did not contain a payload. Valid Zoom webhook calls should always contain a payload.");
    }

    /**
     * @param WebhookCall $webhookCall
     * @return static
     */
    public static function missingEvent(WebhookCall $webhookCall)
    {
        return new static("Webhook call id `{$webhookCall->id}` did not contain a payload event. Valid Zoom webhook calls should always contain a payload event.");
    }
}
