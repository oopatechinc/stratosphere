<?php

namespace App\Services\Webhooks;

use App\Services\Webhooks\Exceptions\StripeWebhookFailed;
use Spatie\WebhookClient\Jobs\ProcessWebhookJob;

class ProcessStripeWebhookJob extends ProcessWebhookJob
{
    public function handle()
    {

        if (!isset($this->webhookCall->payload['type']) || $this->webhookCall->payload['type'] === '') {
            throw StripeWebhookFailed::missingType($this->webhookCall);
        }

        event("stripe-webhooks::{$this->webhookCall->payload['type']}", $this->webhookCall);

        $jobClass = $this->determineJobClass($this->webhookCall->payload['type']);

        if ($jobClass === '') {
            return;
        }

        if (!class_exists($jobClass)) {
            throw StripeWebhookFailed::jobClassDoesNotExist($jobClass, $this->webhookCall);
        }

        dispatch(new $jobClass($this->webhookCall));
    }

    protected function determineJobClass(string $eventType): string
    {
        $jobConfigKey = str_replace('.', '_', $eventType);

        // Check each webhook-client.config for any stripe configurations that may have the job
        foreach (config('webhook-client.configs') as $webhookConfig) {
            if ($webhookConfig['name'] === 'stripe') {
                $jobs = $webhookConfig['jobs'];
                if (in_array($jobConfigKey, array_keys($jobs))) {
                    return $webhookConfig['jobs'][$jobConfigKey];
                }
            }
        }

        // Return empty string if no jobs are found
        return '';
    }
}
