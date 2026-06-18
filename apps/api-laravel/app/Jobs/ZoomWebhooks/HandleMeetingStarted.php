<?php

namespace App\Jobs\ZoomWebhooks;

use App\Helpers\ZoomHelper;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Spatie\WebhookClient\Models\WebhookCall;

class HandleMeetingStarted implements ShouldQueue
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
        $payload = $this->webhookCall->payload;

        // This Job can only handle account updates
        if ($payload['event'] !== ZoomHelper::ZOOM_EVENT_MEETING_STARTED) {
            Log::critical('Invalid webhook endpoint reached for Zoom.', $this->webhookCall->toArray());
            return response()->json([
                'Webhook failed'
            ],  500);
        }

        // implement logic for meeting started event
    }
}
