<?php

namespace App\Factories;

use App\Contracts\IntegrationContract;
use App\Factories\IntegrationFactory\GoogleCalendarIntegration;
use App\Factories\IntegrationFactory\StripeIntegration;
use App\Factories\IntegrationFactory\ZoomIntegration;
use App\Models\Integration;

class IntegrationFactory
{
    /**
     * @param string $platform
     * @return IntegrationContract
     * @throws \Exception
     */
    public function getInstance(string $platform): IntegrationContract
    {
        return match ($platform) {
            Integration::PLATFORM_TYPE_ZOOM => new ZoomIntegration(),
            Integration::PLATFORM_TYPE_GOOGLE_MEET,
            Integration::PLATFORM_TYPE_GOOGLE_CALENDAR => new GoogleCalendarIntegration(),
            Integration::PLATFORM_TYPE_STRIPE => new StripeIntegration(),
            default => throw new \Exception('Unknown integration platform'),
        };
    }
}
