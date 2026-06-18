<?php

namespace App\Services;

use App\Models\Integration;
use Google\Client as GoogleClient;
use Google\Exception;
use Google\Service\Calendar\Event;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class GoogleCalendarService
{
    protected GoogleClient $googleClient;

    const GOOGLE_API_SCOPES   = 'https://www.googleapis.com/auth/calendar';


    /**
     * GoogleCalendarService constructor.
     * @param Integration $integration
     * @throws Exception
     */
    public function __construct(Integration $integration = null)
    {
        // create the client
        $this->googleClient = new GoogleClient();
        $this->googleClient->setApplicationName(config('services.google.admin.app_name'));
        $this->googleClient->setClientId(config('services.google.admin.client_id'));
        $this->googleClient->setClientSecret(config('services.google.admin.client_secret'));
        $this->googleClient->setScopes(self::GOOGLE_API_SCOPES);
        $this->googleClient->setPrompt('consent');
        $this->googleClient->setAccessType('offline');
        $this->googleClient->setRedirectUri(config('services.google.admin.redirect'));

        // set the access token and check if it's still valid
        if (!empty($integration->access_token)) {
            $expiresIn     = Carbon::create($integration->token_expires_in);
            $createdAt     = Carbon::create($integration->token_created_at);
            $diffInSeconds = $createdAt->diffInSeconds($expiresIn);
            $createdEpochTime = $createdAt->format('U');

            $token = [
                'access_token' => Crypt::decryptString($integration->access_token),
                'expires_in' => $diffInSeconds,
                'refresh_token' => Crypt::decryptString($integration->refresh_token),
                'token_type' => "Bearer",
                'created' => $createdEpochTime
            ];

            $this->googleClient->setAccessToken(json_encode($token));

            if ($this->googleClient->isAccessTokenExpired() && !empty($integration->refresh_token)) {
                $this->googleClient->refreshToken(Crypt::decryptString($integration->refresh_token));
                $newTokens = $this->googleClient->getAccessToken();

                $this->googleClient->setAccessToken($newTokens);

                // update model access token
                $integration->access_token = Crypt::encryptString($newTokens['access_token']);
                $integration->refresh_token = Crypt::encryptString($newTokens['refresh_token']);
                $integration->token_expires_in = Carbon::create(Carbon::now())->add('seconds', $newTokens['expires_in']);
                $integration->token_created_at = now();
                $integration->save();
            }
        }
    }

    public function createAuthUrl($state = '')
    {
        if ($state) {
            $this->googleClient->setState($state);
        }
        return $this->googleClient->createAuthUrl(self::GOOGLE_API_SCOPES);
    }

    public function getTokensWithAuthCode($authCode)
    {
        return $this->googleClient->fetchAccessTokenWithAuthCode($authCode);
    }

    /**
     * @param string $calendarName
     * @return mixed
     */
    public function createNewCalendar($calendarName = '')
    {
        $calendar = new \Google_Service_Calendar_Calendar();
        $calendar->setSummary($calendarName . ' Calendar');
        $calendar->setTimeZone(config('app.timezone'));

        $calendarService = new \Google_Service_Calendar($this->googleClient);
        $newCalendar     = $calendarService->calendars->insert($calendar);

        return $newCalendar->id;
    }

    /**
     * @return \Google_Service_Calendar_CalendarList
     */
    public function listCalendars()
    {
        $calendarService = new \Google_Service_Calendar($this->googleClient);
        return $calendarService->calendarList->listCalendarList();
    }

    /**
     * @param $calendarId
     * @param $title
     * @param $description
     * @param $startTime
     * @param $endTime
     * @throws \Google\Service\Exception
     */
    public function addEvent($calendarId, $title, $description, $startTime, $endTime): Event
    {
        //Set the Event data
        $event = new \Google_Service_Calendar_Event();
        $event->setSummary($title);
        $event->setDescription($description);

        $start = new \Google_Service_Calendar_EventDateTime();
        $start->setDateTime($startTime);
        $event->setStart($start);

        $end = new \Google_Service_Calendar_EventDateTime();
        $end->setDateTime($endTime);
        $event->setEnd($end);

        // set attendees


        // create google meet info
        $solutionKey = new \Google_Service_Calendar_ConferenceSolutionKey();
        $solutionKey->setType("hangoutsMeet");

        $conferenceRequest = new \Google_Service_Calendar_CreateConferenceRequest();
        $conferenceRequest->setRequestId(Str::random(10));
        $conferenceRequest->setConferenceSolutionKey($solutionKey);

        $conference = new \Google_Service_Calendar_ConferenceData();
        $conference->setCreateRequest($conferenceRequest);

        $event->setConferenceData($conference);

        $calendarService = new \Google_Service_Calendar($this->googleClient);
        return $calendarService->events->insert($calendarId, $event, ['conferenceDataVersion' => 1]);
    }

    /**
     * @throws \Google\Service\Exception
     */
    public function updateEvent($calendarId, $eventId, $title, $description, $startTime, $endTime): void
    {
        //Set the Event data
        $event = new \Google_Service_Calendar_Event();
        $event->setSummary($title);
        $event->setDescription($description);

        $start = new \Google_Service_Calendar_EventDateTime();
        $start->setDateTime($startTime);
        $event->setStart($start);

        $end = new \Google_Service_Calendar_EventDateTime();
        $end->setDateTime($endTime);
        $event->setEnd($end);

        $calendarService = new \Google_Service_Calendar($this->googleClient);
        $calendarService->events->update($calendarId, $eventId, $event);
    }

    /**
     * @return string
     * @throws \Google\Service\Exception
     */
    public function deleteEvent($calendarId, $eventId)
    {
        $calendarService = new \Google_Service_Calendar($this->googleClient);
        return $calendarService->events->delete($calendarId, $eventId);

    }

    /**
     * @param int $timestamp
     * @return false|string
     * @throws \Exception
     */
    public function googleDateConverter($timestamp) {
        return (new \DateTime($timestamp))->format(\DateTime::ISO8601);
    }

    public function listEvents($calendarId, Carbon $date)
    {
        $optionalParams = [
            'orderBy' => 'startTime',
            'singleEvents' => true,
            'timeMin' => $date->startOfDay()->format('c'),
            'timeMax' => $date->endOfDay()->format('c')
        ];

        $service = new \Google_Service_Calendar($this->googleClient);
        return $service->events->listEvents($calendarId, $optionalParams);
    }

    public function revokeToken(array $token)
    {
        $isRevoked = $this->googleClient->revokeToken($token);
        if (!$isRevoked) {
            throw new \Exception('Unable to revoke token');
        }
    }
}
