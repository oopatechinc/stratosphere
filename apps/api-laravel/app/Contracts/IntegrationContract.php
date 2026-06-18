<?php

namespace App\Contracts;

use App\Models\Integration;

interface IntegrationContract
{
    public function getOauthUrl(array $payload);
    public function store(array $payload);
    public function destroy(Integration $integration): void;
}
