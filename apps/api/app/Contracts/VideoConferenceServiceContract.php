<?php

namespace App\Contracts;

use GuzzleHttp\Exception\GuzzleException;

interface VideoConferenceServiceContract
{
    /**
     * Oauth Code
     * @param string $code
     * @return VideoConferenceServiceContract
     * @throws GuzzleException
     */
    public function getAccessToken(string $code);

    /**
     * @param string $refreshToken
     * @return VideoConferenceServiceContract
     * @throws GuzzleException
     */
    public function refreshToken(string $refreshToken);

    /**
     * @return VideoConferenceServiceContract
     * @throws GuzzleException
     */
    public function getUser();

    /**
     * @param string $topic
     * @param string $startTime
     * @param int $duration
     * @param string $password
     * @return VideoConferenceServiceContract
     */
    public function createMeeting(string $topic, string $startTime, int $duration, string $password);

    /**
     * @param string $meetingId
     * @param string $topic
     * @param string $startTime
     * @param int $duration
     * @return VideoConferenceServiceContract
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

    /**
     * @return VideoConferenceServiceContract
     */
    public function getResponse();

    /**
     * @return VideoConferenceServiceContract
     */
    public function getJsonEncodedResponse();
}
