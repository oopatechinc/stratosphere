<?php

namespace App\Services\Webhooks;

use App\Helpers\ZoomHelper;
use Illuminate\Http\Request;
use Spatie\WebhookClient\WebhookConfig;
use Symfony\Component\HttpFoundation\Response;

class RespondsToZoomWebhook implements \Spatie\WebhookClient\WebhookResponse\RespondsToWebhook
{

    public function respondToValidWebhook(Request $request, WebhookConfig $config): Response
    {
        $event = $request->get('event');

        if ($event === ZoomHelper::ZOOM_EVENT_ENDPOINT_URL_VALIDATION) {
            $plainToken = $request->get('payload')['plainToken'];
            return response()->json([
                'plainToken' => $plainToken,
                'encryptedToken' => hash_hmac('sha256', $plainToken, config('services.zoom.webhook_secret'))
            ]);
        }

        return response('');
    }
}
