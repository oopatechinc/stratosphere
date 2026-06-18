<?php

namespace App\Contracts;

use GuzzleHttp\Exception\GuzzleException;

interface VideoConferenceServiceManagerContract
{
    /**
     * Oauth Code
     * @param string $code
     * @return mixed
     * @throws GuzzleException
     */
    public function getAccessToken(string $code, int $integrableId, string $integrableType);

    /**
     * @param string $refreshToken
     * @return mixed
     * @throws GuzzleException
     */
    public function refreshToken(string $refreshToken);

    public function createMeeting(string $topic, string $startTime, int $duration, string $password, int $eventableId, string $eventableType);

    /**
     * @param string $meetingId
     * @param string $topic
     * @param string $startTime
     * @param int $duration
     * @param int $appointmentId
     * @return mixed
     */
    public function updateMeeting(string $meetingId, string $topic, string $startTime, int $duration);

    /**
     * @param string $meetingId
     */
    public function deleteMeeting( string $meetingId);

    /**
     * @param string $nextPageToken
     */
    public function listMeetings(string $nextPageToken = '');

    /**
     * @param string $meetingId
     */
    public function getPastMeetingParticipants(string $meetingId);
}
