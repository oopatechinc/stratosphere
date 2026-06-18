<?php

namespace App\Listeners;

use App\Events\LocationCreated;
use App\Events\LocationSubdomainUpdated;
use App\Services\AwsService;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpsertAwsRoute53Record implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(LocationCreated|LocationSubdomainUpdated $event): void
    {
        if (config('app.env') === 'local' || empty(config('bookisia.site_domain'))) return;
        (new AwsService())->upsertRoute53Record($event->location->subdomain);
    }
}
