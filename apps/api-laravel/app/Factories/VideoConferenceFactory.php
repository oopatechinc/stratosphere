<?php

namespace App\Factories;

use App\Factories\VideoConferenceFactory\ZoomServiceManager;
use App\Models\Integration;

class VideoConferenceFactory
{
    private Integration $integration;

    public function __construct(Integration $integration)
    {
        $this->integration = $integration;
    }

    public function getInstance(string $type)
    {
        switch ($type) {
            case Integration::PLATFORM_TYPE_ZOOM:
                return new ZoomServiceManager($this->integration);
            default:
                throw new \Exception('Unknown integration platform type');
        }
    }
}
