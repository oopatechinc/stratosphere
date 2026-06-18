<?php

namespace App\Services\Webhooks;

use App\Helpers\ZoomHelper;
use App\Services\Webhooks\Exceptions\ZoomWebhookFailed;
use Spatie\WebhookClient\Jobs\ProcessWebhookJob;

class ProcessZoomWebhookJob extends ProcessWebhookJob
{
    public function handle()
    {
        if (!isset($this->webhookCall->payload['event']) || $this->webhookCall->payload['event'] === '') {
            throw ZoomWebhookFailed::missingEvent($this->webhookCall);
        }

        event("zoom-webhooks::{$this->webhookCall->payload['event']}", $this->webhookCall);

        // return immediately if validation from zoom
        if ( $this->webhookCall->payload['event'] === ZoomHelper::ZOOM_EVENT_ENDPOINT_URL_VALIDATION) {
            return;
        }

        $jobClass = $this->determineJobClass($this->webhookCall->payload['event']);


        if ($jobClass === '') {
            return;
        }

        if (!class_exists($jobClass)) {
            throw ZoomWebhookFailed::jobClassDoesNotExist($jobClass, $this->webhookCall);
        }

        dispatch(new $jobClass($this->webhookCall));
    }

    protected function determineJobClass(string $eventType): string
    {
        $jobConfigKey = str_replace('.', '_', $eventType);

        // Check each webhook-client.config for any stripe configurations that may have the job
        foreach (config('webhook-client.configs') as $webhookConfig) {
            if ($webhookConfig['name'] === 'zoom') {

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
