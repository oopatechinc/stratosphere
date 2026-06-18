<?php

return [
    'configs' => [
        [
            /*
             * This package supports multiple webhook receiving endpoints. If you only have
             * one endpoint receiving webhooks, you can use 'default'.
             */
            'name' => 'stripe',

            /*
             * We expect that every webhook call will be signed using a secret. This secret
             * is used to verify that the payload has not been tampered with.
             */
            'signing_secret' => env('STRIPE_WEBHOOK_SECRET'),

            /*
             * The name of the header containing the signature.
             */
            'signature_header_name' => 'Stripe-Signature',

            /*
             *  This class will verify that the content of the signature header is valid.
             *
             * It should implement \Spatie\WebhookClient\SignatureValidator\SignatureValidator
             */
            'signature_validator' => \App\Services\Webhooks\StripeSignatureValidator::class,

            /*
             * This class determines if the webhook call should be stored and processed.
             */
            'webhook_profile' => \Spatie\WebhookClient\WebhookProfile\ProcessEverythingWebhookProfile::class,

            /*
             * This class determines the response on a valid webhook call.
             */
            'webhook_response' => \Spatie\WebhookClient\WebhookResponse\DefaultRespondsTo::class,

            /*
             * The classname of the model to be used to store call. The class should be equal
             * or extend Spatie\WebhookClient\Models\WebhookCall.
             */
            'webhook_model' => \Spatie\WebhookClient\Models\WebhookCall::class,

            /*
             * The class name of the job that will process the webhook request.
             *
             * This should be set to a class that extends \Spatie\WebhookClient\ProcessWebhookJob.
             */
            'process_webhook_job' => \App\Services\Webhooks\ProcessStripeWebhookJob::class,

            /**
             * Handle different Stripe events here
             */
            'jobs' => [
                'account_updated' => \App\Jobs\StripeWebhooks\HandleUpdatedAccount::class,
            ]
        ],
        [
            /*
             * This package supports multiple webhook receiving endpoints. If you only have
             * one endpoint receiving webhooks, you can use 'default'.
             */
            'name' => 'zoom',

            /*
             * We expect that every webhook call will be signed using a secret. This secret
             * is used to verify that the payload has not been tampered with.
             */
            'signing_secret' => env('ZOOM_WEBHOOK_SECRET'),

            /*
             * The name of the header containing the signature.
             */
            'signature_header_name' => 'x-zm-signature',

            /*
             *  This class will verify that the content of the signature header is valid.
             *
             * It should implement \Spatie\WebhookClient\SignatureValidator\SignatureValidator
             */
            'signature_validator' => \App\Services\Webhooks\ZoomSignatureValidator::class,

            /*
             * This class determines if the webhook call should be stored and processed.
             */
            'webhook_profile' => \Spatie\WebhookClient\WebhookProfile\ProcessEverythingWebhookProfile::class,

            /*
             * This class determines the response on a valid webhook call.
             */
            'webhook_response' => \App\Services\Webhooks\RespondsToZoomWebhook::class,

            /*
             * The classname of the model to be used to store call. The class should be equal
             * or extend Spatie\WebhookClient\Models\WebhookCall.
             */
            'webhook_model' => \Spatie\WebhookClient\Models\WebhookCall::class,

            /*
             * The class name of the job that will process the webhook request.
             *
             * This should be set to a class that extends \Spatie\WebhookClient\ProcessWebhookJob.
             */
            'process_webhook_job' => \App\Services\Webhooks\ProcessZoomWebhookJob::class,

            /**
             * Handle different Zoom events here
             */
            'jobs' => [
                'meeting_started' => \App\Jobs\ZoomWebhooks\HandleMeetingStarted::class,
                'app_deauthorized' => \App\Jobs\ZoomWebhooks\HandleAppDeauthorized::class,
            ],
        ],
    ],
];
