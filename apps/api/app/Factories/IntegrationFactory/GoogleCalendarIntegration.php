<?php

namespace App\Factories\IntegrationFactory;

use App\Contracts\IntegrationContract;
use App\Models\Integration;
use App\Models\IntegrationResource;
use App\Services\GoogleCalendarService;
use Google\Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;

class GoogleCalendarIntegration implements IntegrationContract
{
    public function getOauthUrl(array $payload): string
    {
        $state = ['state' => json_encode($payload)];
        $googleCalendarService = new GoogleCalendarService();
        return $googleCalendarService->createAuthUrl($state);
    }

    /**
     * @param array $payload
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function store(array $payload): Collection
    {
        $tokenResponse = (new GoogleCalendarService())->getTokensWithAuthCode($payload['code']);

        // create integration for Google calendar
        /** @var Integration $integration */
        $googleCalendarIntegration = Integration::query()->updateOrCreate(
            [
                'integrable_id' => $payload['integrable_id'],
                'integrable_type' => $payload['integrable_type'],
                'platform' => Integration::PLATFORM_TYPE_GOOGLE_CALENDAR,
            ],
            [
                'platform_pretty_name' => Integration::PLATFORM_GOOGLE_CALENDAR_NAME,
                'access_token' => Crypt::encryptString($tokenResponse['access_token']),
                'refresh_token' => Crypt::encryptString($tokenResponse['refresh_token']),
                'token_expires_in' => Carbon::create(Carbon::now())->add('seconds', $tokenResponse['expires_in']),
                'token_created_at' => Carbon::now(),
            ]
        );

        // create integration for Google meet
        /** @var Integration $integration */
        $googleMeetIntegration = Integration::query()->create(
            [
                'integrable_id' => $payload['integrable_id'],
                'integrable_type' => $payload['integrable_type'],
                'platform' => Integration::PLATFORM_TYPE_GOOGLE_MEET,
                'platform_pretty_name' => INTEGRATION::PLATFORM_GOOGLE_MEET_NAME,
            ]
        );

        // store the default calendar
        $calendars = (new GoogleCalendarService($googleCalendarIntegration))->listCalendars();

        foreach ($calendars as $calendar) {
            if (!$calendar['primary']) {
                continue;
            }

            $googleCalendarIntegration->update(['primary_resource_id' => $calendar['id']]);
            $googleMeetIntegration->update(['primary_resource_id' => $calendar['id']]);

            IntegrationResource::query()->create(
                [
                    'integration_id' => $googleCalendarIntegration->id,
                    'resource_type' => Integration::PLATFORM_GOOGLE_CALENDAR_NAME,
                    'is_primary' => $calendar['primary'] ?: false,
                    'resource_id' => $calendar['id']
                ]
            );
        }


        return collect([$googleCalendarIntegration, $googleMeetIntegration]);
    }

    /**
     * @throws Exception
     */
    public function destroy(Integration $integration): void
    {
        $calendarService = new GoogleCalendarService($integration);

        // refreshing here as the tokens might have been updated by the GoogleCalendarService constructor
        $integration->refresh();
        $calendarService->revokeToken(['refresh_token' => Crypt::decryptString($integration->refresh_token)]);

        Integration::query()
            ->where('integrable_id', $integration->integrable_id)
            ->where('integrable_type', $integration->integrable_type)
            ->whereIn('platform', Integration::PLATFORM_TYPES_GOOGLE_MAPPINGS)
            ->delete();
    }
}
