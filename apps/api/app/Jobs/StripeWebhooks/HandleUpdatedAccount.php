<?php

namespace App\Jobs\StripeWebhooks;

use App\Models\Integration;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Helpers\WriteLog;
use Spatie\WebhookClient\Models\WebhookCall;

class HandleUpdatedAccount implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public WebhookCall $webhookCall;

    public function __construct(WebhookCall $webhookCall)
    {
        $this->webhookCall = $webhookCall;
    }

    public function handle()
    {
        $payload = $this->webhookCall->payload;

        // This Job can only handle account updates
        if ($payload['type'] !== 'account.updated') {
            return $this->response();
        }

        // This Job can only handle connected accounts
        if (!$stripeAccountId = $payload['account']) {
            return $this->response();
        }

        $updatedAccount = $payload['data']['object'];

        // Handle the details_submitted handler
        if ($updatedAccount['details_submitted'] === true) {
            $this->updateAccountWithOnboarding($stripeAccountId);
        }

        return $this->response();
    }

    protected function response()
    {
        return response()->json([ 'message' => 'WebHook handled!' ], 200);
    }

    protected function updateAccountWithOnboarding(string $stripeAccountId)
    {
        // first check if it's a business merchant
        $integration = Integration::query()
            ->where('platform_account_id', $stripeAccountId)
            ->where('platform', Integration::PLATFORM_TYPE_STRIPE)
            ->first();

        if (!$integration) {
            WriteLog::error('Webhook handled! Account not found: ' . $stripeAccountId);
            return;
        }

        $integration->status = Integration::STATUS_ACTIVE;
        $integration->save();
    }
}
