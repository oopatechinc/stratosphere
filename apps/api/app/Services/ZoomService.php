<?php

namespace App\Services;

use App\Abstracts\AbstractVideoConferenceService;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class ZoomService extends AbstractVideoConferenceService
{
    public function __construct(string $accessToken = '')
    {
        parent::__construct(
            $this->getHeaders($accessToken),
            new Client(['base_uri' => config('services.zoom.base_uri')])
        );
    }

    /**
     * Headers: "Authorization" => "Basic"
     *
     * @param string $code
     * @return AbstractVideoConferenceService
     * @throws GuzzleException
     */
    public function getAccessToken(string $code): AbstractVideoConferenceService
    {
        $this->response = $this->client->request('POST', '/oauth/token', array_merge(
            $this->headers,
            [
                'form_params' => [
                    "grant_type" => "authorization_code",
                    "code" => $code,
                    "redirect_uri" => config('services.zoom.redirect_uri')
                ],
            ]
        ));

        return $this;
    }

    /**
     * Headers: "Authorization" => "Basic"
     *
     * @param string $refreshToken
     * @return AbstractVideoConferenceService
     * @throws GuzzleException
     */
    public function refreshToken(string $refreshToken): AbstractVideoConferenceService
    {
        $this->response = $this->client->request('POST', '/oauth/token', array_merge(
            $this->headers,
            [
                'form_params' => [
                    "grant_type" => "refresh_token",
                    "refresh_token" => $refreshToken
                ],
            ]
        ));

        return $this;
    }

    /**
     * @throws GuzzleException
     */
    public function revokeToken($accessToken): AbstractVideoConferenceService
    {
        $this->response = $this->client->request('POST', '/oauth/revoke?token='. $accessToken, $this->headers);
        return $this;
    }

    /**
     * Headers: "Authorization" => "Bearer <Access Token>."
     *
     * @return AbstractVideoConferenceService
     * @throws GuzzleException
     */
    public function getUser(): AbstractVideoConferenceService
    {
        $this->response = $this->client->request('GET', '/v2/users/me', $this->headers);
        return $this;
    }

    /**
     * @param string $topic
     * @param string $startTime
     * @param int $duration
     * @param string $password
     * @return AbstractVideoConferenceService
     * @throws GuzzleException
     */
    public function createMeeting(
        string $topic,
        string $startTime,
        int $duration,
        string $password
    ): AbstractVideoConferenceService {
        $this->response = $this->client->request('POST', '/v2/users/me/meetings', array_merge(
            $this->headers,
            [
                'json' => [
                    "topic" => $topic,
                    "type" => 2,
                    "start_time" => $startTime,
                    "duration" => $duration,
                    "password" => $password
                ],
            ]
        ));

        return $this;
    }

    /**
     * @param string $meetingId
     * @param string $topic
     * @param string $startTime
     * @param int $duration
     * @return AbstractVideoConferenceService
     * @throws GuzzleException
     */
    public function updateMeeting(
        string $meetingId,
        string $topic,
        string $startTime,
        int $duration,
    ): AbstractVideoConferenceService
    {
        $this->response = $this->client->request('PATCH', '/v2/meetings/' . $meetingId, array_merge(
            $this->headers,
            [
                'json' => [
                    "topic" => $topic,
                    "type" => 2,
                    "start_time" => $startTime,
                    "duration" => $duration,
                ],
            ]
        ));

        return $this;
    }

    /**
     * Headers: "Authorization" => "Bearer"
     *
     *
     * @param string $meetingId
     * @return AbstractVideoConferenceService
     * @throws GuzzleException
     */
    public function deleteMeeting(string $meetingId): AbstractVideoConferenceService
    {
        $this->response = $this->client->request('DELETE', '/v2/meetings/' . $meetingId, $this->headers);
        return $this;
    }

    /**
     * Headers: "Authorization" => "Bearer"
     *
     * @param string $nextPageToken
     * @return AbstractVideoConferenceService
     * @throws GuzzleException
     */
    public function listMeetings(string $nextPageToken = ''): AbstractVideoConferenceService
    {
        if (!empty($nextPageToken)) {
            $this->headers['query'] = ["next_page_token" => $nextPageToken];
        }

        $this->response = $this->client->request('GET', '/v2/users/me/meetings', $this->headers);

        return $this;
    }

    /**
     * Headers: "Authorization" => "Bearer"
     * $response->participants (Array)
     *
     * @param string $meetingId
     * @return AbstractVideoConferenceService
     * @throws GuzzleException
     */
    public function getPastMeetingParticipants(string $meetingId): AbstractVideoConferenceService
    {
        $this->response = $this->client->request('GET', "/v2/past_meetings/$meetingId/participants", $this->headers);
        return $this;
    }

    /**
     * @param string $accessToken
     * @return \string[][]
     */
    private function getHeaders(string $accessToken = ''): array
    {
        if ($accessToken != '') {
            return [
                'headers' => [
                    "Authorization" => "Bearer " . $accessToken
                ]
            ];
        }

        return [
            'headers' => [
                "Authorization" => "Basic " . base64_encode(
                        config('services.zoom.client_id') . ':' . config('services.zoom.client_secret')
                    ),
                "Content-Type" => "application/x-www-form-urlencoded"
            ]
        ];
    }
}
