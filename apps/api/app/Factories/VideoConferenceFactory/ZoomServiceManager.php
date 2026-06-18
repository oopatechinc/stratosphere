<?php

namespace App\Factories\VideoConferenceFactory;

use App\Contracts\VideoConferenceServiceManagerContract;
use App\Models\Integration;
use App\Services\ZoomService;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class ZoomServiceManager implements VideoConferenceServiceManagerContract
{
    private Model $integration;

    public function __construct(Model $integration)
    {
        $this->integration = $integration;
    }


    /**
     * @param string $code
     * @return ZoomServiceManager
     * @throws GuzzleException
     */
    public function getAccessToken($code, int $integrableId, string $integrableType)
    {
        $response = (new ZoomService())->getAccessToken($code)->getJsonEncodedResponse();

        $this->integration = Integration::query()->create([
            'integrable_id' => $integrableId,
            'integrable_type' => $integrableType,
            'platform' => Integration::PLATFORM_TYPE_ZOOM,
            'access_token' => $response['access_token'],
            'refresh_token' => $response['refresh_token'],
            'token_expires_in' => Carbon::create(Carbon::now())->add('seconds', $response['expires_in'])
        ]);

        return $this;
    }

    /**
     * @param string $refreshToken
     * @return ZoomServiceManager
     * @throws GuzzleException
     */
    public function refreshToken(string $refreshToken)
    {
        $response = (new ZoomService())->refreshToken($refreshToken)->getJsonEncodedResponse();
        $this->integration->update(
            [
                'access_token' => $response['access_token'],
                'refresh_token' => $response['refresh_token'],
            ]
        );

        return $this;
    }

    /**
     * @throws GuzzleException
     */
    public function revokeAccessToken()
    {
        try {
            $zoomService = new ZoomService();
            return $zoomService
                ->revokeToken($this->integration->access_token)
                ->getJsonEncodedResponse();
        } catch (\Exception $ex) {
            if( 401 == $ex->getCode()) {
                $this->refreshToken($this->integration->refresh_token);
                return $this->revokeAccessToken();
            } else {
                throw $ex;
            }
        }
    }


    /**
     * @return ZoomServiceManager
     * @throws GuzzleException
     */
    public function getUser() {
       try {
          (new ZoomService($this->integration->access_token))->getUser()->getJsonEncodedResponse();
           return $this;
       } catch (Exception $ex) {
           throw $ex;
       }
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function createMeeting($topic, $startTime, $duration, $password, $eventableId, $eventableType)
    {
        try {
            $zoomService = new ZoomService($this->integration->access_token);
            return $zoomService
                ->createMeeting($topic, $startTime, $duration, $password)
                ->getJsonEncodedResponse();

        } catch (\Exception $ex) {
            if( 401 == $ex->getCode()) {
                $this->refreshToken($this->integration->refresh_token);
                return $this->createMeeting($topic, $startTime, $duration, $password, $eventableId, $eventableType);
            } else {
                throw $ex;
            }
        }
    }

    /**
     * @return ZoomServiceManager
     * @throws GuzzleException
     */
    public function updateMeeting($meetingId, $topic, $startTime, $duration)
    {
        try {
            $zoomService = new ZoomService($this->integration->access_token);
            $zoomService
                ->updateMeeting($meetingId, $topic, $startTime, $duration)
                ->getJsonEncodedResponse();

            return $this;
        } catch (\Exception $ex) {
            if( 401 == $ex->getCode()) {
                $this->refreshToken($this->integration->refresh_token);
                $this->updateMeeting($meetingId, $topic, $startTime, $duration);
            } else {
                throw $ex;
            }
        }
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function deleteMeeting(string $meetingId): void
    {
        try {
            $zoomService = new ZoomService($this->integration->access_token);
            $zoomService->deleteMeeting($meetingId);
        } catch (\Exception $ex) {
            if( 401 == $ex->getCode()) {
                $this->refreshToken($this->integration->refresh_token);
                $this->deleteMeeting($meetingId);
            } else {
                throw $ex;
            }
        }

    }

    public function listMeetings(string $nextPageToken = '')
    {
        $zoomService = new ZoomService($this->integration->access_token);
        $zoomService->listMeetings($nextPageToken);
    }

    public function getPastMeetingParticipants(string $meetingId)
    {
        $zoomService = new ZoomService($this->integration->access_token);
        $zoomService->getPastMeetingParticipants($meetingId);
    }
}
