<?php

namespace App\Jobs\ZoomWebhooks;

use App\Helpers\WriteLog;
use App\Helpers\ZoomHelper;
use App\Models\Integration;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\WebhookClient\Models\WebhookCall;

class HandleAppDeauthorized implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /** @var \Spatie\WebhookClient\Models\WebhookCall */
    public $webhookCall;

    public function __construct(WebhookCall $webhookCall)
    {
        $this->webhookCall = $webhookCall;
    }

    public function handle()
    {
        try {
            $payload = $this->webhookCall->payload;

            // This Job can only handle account updates
            if ($payload['event'] !== ZoomHelper::ZOOM_EVENT_APP_DEAUTHORIZED) {
                WriteLog::critical('Invalid webhook endpoint reached for Zoom.', $this->webhookCall->toArray());
                return response()->json([
                    'Webhook failed'
                ],  500);
            }

            // implement logic for meeting started event
            Integration::query()->where('platform_account_id', $payload['payload']['account_id'])->firstOrFail()->delete();
        } catch (\Exception $ex) {
            WriteLog::error($ex->getMessage());
        }
    }
}
