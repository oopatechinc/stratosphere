<?php

namespace App\Factories\IntegrationFactory;

use App\Contracts\IntegrationContract;
use App\Factories\VideoConferenceFactory\ZoomServiceManager;
use App\Models\Integration;
use App\Services\ZoomService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Carbon;

class ZoomIntegration implements IntegrationContract
{

    public function getOauthUrl(array $payload): string
    {
        $baseUrl = "https://zoom.us/oauth/authorize?response_type=code";
        $zoomClientId = config('services.zoom.client_id');
        $redirectUri = config('services.zoom.redirect_uri');
        $state = json_encode($payload);

        return "$baseUrl&client_id=$zoomClientId&redirect_uri=$redirectUri&state=$state";
    }

    /**
     * @param array $payload
     * @return Integration
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function store(array $payload): Integration
    {
        $tokenResponse = (new ZoomService())->getAccessToken($payload['code'])->getJsonEncodedResponse();

        /** @var Integration $integration */
        $integration = Integration::query()->updateOrCreate(
            [
                'integrable_id' => $payload['integrable_id'],
                'integrable_type' => $payload['integrable_type'],
                'platform' => Integration::PLATFORM_TYPE_ZOOM,
            ],
            [
                'platform_pretty_name' => Integration::PLATFORM_TYPE_ZOOM,
                'access_token' => $tokenResponse['access_token'],
                'refresh_token' => $tokenResponse['refresh_token'],
                'token_expires_in' => Carbon::create(Carbon::now())->add('seconds', $tokenResponse['expires_in'])
            ]
        );

        $userResponse = (new ZoomService($tokenResponse['access_token']))->getUser()->getJsonEncodedResponse();

        $integration->update([
            'platform_account_id' => $userResponse['account_id'],
            'platform_user_id' => $userResponse['id']
        ]);

        return $integration;
    }

    /**
     * @throws GuzzleException
     * @throws \Throwable
     */
    public function destroy(Integration $integration): void
    {
        // revoke oauth token
        $response = (new ZoomServiceManager($integration))->revokeAccessToken();
        if ($response['status'] !== 'success') {
            throw new \Exception('Unable to revoke access token!');
        }

        $integration->deleteOrFail();
    }
}
