<?php

namespace App\Http\Controllers\Services;

use App\Contracts\ServiceContract;
use App\Events\LocationCreated;
use App\Events\LocationSubdomainUpdated;
use App\Http\Controllers\FetchManagers\LocationsFetchManager;
use App\Models\Address;
use App\Models\Location;
use App\Models\OpeningDay;
use App\Models\OpeningHour;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class LocationService implements ServiceContract
{
    public function index()
    {
        return (new LocationsFetchManager())->apply()->get();
    }

    public function show(Location $location)
    {
        return (new LocationsFetchManager($location->id))->apply()->get();
    }

    public function showBySubdomain(string $subdomain)
    {
        $location = Location::query()->where('subdomain', $subdomain)->firstOrFail();
        return (new LocationsFetchManager($location->id))->apply()->get();
    }

    public function store(array $payload): Model
    {
        $location = Location::query()->create(Arr::only($payload, (new Location())->getFillable()));

        // store address
        $payload['address']['addressable_id'] = $location->id;
        $payload['address']['addressable_type'] = $location->getMorphClass();
        Address::query()->create(Arr::only($payload['address'], (new Address())->getFillable()));

        // store opening days
        foreach ($payload['opening_days'] as $day) {
            $day['location_id'] = $location->id;

            $openingDay = OpeningDay::query()
                ->create(Arr::only($day, (new OpeningDay())
                    ->getFillable()));

            // store the opening hours
            foreach ($day['opening_hours'] as $hour) {
                $hour['opening_day_id'] = $openingDay->id;
                OpeningHour::query()->create($hour);
            }
        }

        // sync services
        $location->services()->sync(Arr::pluck($payload['services'], 'id'));

        //sync staff
        $location->staff()->sync(Arr::pluck($payload['staff'], 'id'));

        //call location created event
        event(new LocationCreated($location));

        return $location
            ->refresh()
            ->load(['address', 'openingDays.openingHours', 'services']);
    }

    public function update(Model $model, array $payload): Model
    {
        $subdomainUpdated = $model->subdomain !== $payload['subdomain'];

        /**@var Location $model **/
        $model->update(Arr::only($payload, $model->getFillable()));

        // update address
        $payload['address']['addressable_id'] = $model->id;
        $payload['address']['addressable_type'] = $model->getMorphClass();
        Address::query()->updateOrCreate(Arr::only($payload['address'], (new Address())->getFillable()));

        // store opening days
        foreach ($payload['opening_days'] as $day) {
            $day['location_id'] = $model->id;

            $attributes = [
                'location_id' => $day['location_id'],
                'day_of_week' => $day['day_of_week'],
            ];

            $openingDay = OpeningDay::query()
                ->updateOrCreate($attributes, Arr::only($day, (new OpeningDay())
                    ->getFillable()));

            // store the opening hours
            foreach ($day['opening_hours'] as $hour) {
                $hour['opening_day_id'] = $openingDay->id;
                OpeningHour::query()->updateOrCreate(
                    [
                        'opening_day_id' => $openingDay->id,
                        'opens_at' => $hour['opens_at'],
                        'closes_at' => $hour['closes_at'],
                    ],
                    $hour
                );
            }
        }

        // store services
        $serviceIds = Arr::pluck($payload['services'], 'id');
        $model->services()->sync($serviceIds);

        // store staff
        $staffIds = Arr::pluck($payload['staff'], 'id');
        $model->staff()->sync($staffIds);

        if ($subdomainUpdated) {
            event(new LocationSubdomainUpdated($model));
        }

        return $model
            ->refresh()
            ->load('address')
            ->load('openingDays.openingHours');
    }

    public function destroy(Model $model)
    {
        $model->delete();
    }
}
