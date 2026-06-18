<?php

namespace App\Traits;

use App\Models\Integration;
use Illuminate\Support\Carbon;
use Google\Exception;

trait HasCalendarEvent
{
    public function hasCalendar(): bool
    {
        return Integration::query()
            ->where('integrable_id', $this->id)
            ->where('integrable_type', $this->getMorphClass())
            ->where('platform', Integration::PLATFORM_TYPE_GOOGLE_CALENDAR)
            ->exists();
    }
    /**
     * @throws Exception
     */
    public function getCalendarEventsByDate(Carbon $date): array
    {
        $integration = Integration::query()
            ->where('integrable_id', $this->id)
            ->where('integrable_type', $this->getMorphClass())
            ->where('platform', Integration::PLATFORM_TYPE_GOOGLE_CALENDAR)
            ->with('entities')
            ->firstOrFail();

        $service = new \App\Services\GoogleCalendarService($integration);

        $events = [];
        foreach ($integration->entities as $entity) {
            $events[] = $service->listEvents($entity->entity_id, $date);
        }

        return $events;
    }
}
