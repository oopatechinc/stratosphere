<?php

namespace App\Http\Controllers;

use App\Models\Integration;
use App\Services\GoogleCalendarService;
use Google\Exception;
use Illuminate\Http\JsonResponse;

class GoogleApiController extends Controller
{
    /**
     * @throws Exception
     */
    public function getCalendarsByIntegrationId($integrationId): JsonResponse
    {
        $integration = Integration::query()->findOrFail($integrationId);

        if ($integration->platform !== INTEGRATION::PLATFORM_TYPE_GOOGLE_CALENDAR) {
            return response()->json([
                'message' => 'Requested calendar is unknown'
            ]);
        }

        $googleCalendarService = new GoogleCalendarService($integration);
        $response = $googleCalendarService->listCalendars();

        return response()->json($response['items']);
    }
}
