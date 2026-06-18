<?php

namespace App\Http\Controllers\Services;

use App\Contracts\ServiceContract;
use App\Http\Controllers\FetchManagers\AppointmentsFetchManager;
use App\Models\Address;
use App\Models\Appointment;
use App\Models\OpeningDay;
use App\Models\OpeningHour;
use App\Models\ServiceVariation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class AppointmentService implements ServiceContract
{
    public function index()
    {
        return (new AppointmentsFetchManager())->apply()->get();
    }

    public function show(Appointment $appointment)
    {
        return (new AppointmentsFetchManager($appointment->id))->apply()->get();
    }

    public function store(array $payload): Model
    {
        $payload['total'] = collect($payload['service_variations'])->reduce(function ($total, $serviceVariation) {
            $total += $serviceVariation['price'];
            return $total;
        }, 0);

        $appointment = Appointment::query()->create(Arr::only($payload, (new Appointment())->getFillable()));

        // store service variations
        $serviceVariationIds = Arr::pluck($payload['service_variations'], 'id');
        $appointment->serviceVariations()->sync($serviceVariationIds);

        return $appointment
            ->refresh()
            ->load(['serviceVariations']);
    }

    public function update(Model $model, array $payload): Model
    {
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
                $hour['opening_hour_able_id'] = $model->id;
                $hour['opening_hour_able_type'] = $model->getMorphClass();
                OpeningHour::query()->updateOrCreate(['opening_day_id' => $openingDay->id], $hour);
            }
        }

        // store services
        $serviceIds = Arr::pluck($payload['services'], 'id');
        $model->services()->sync($serviceIds);

        // store staff
        $staffIds = Arr::pluck($payload['staff'], 'id');
        $model->staff()->sync($staffIds);

        return $model
            ->refresh()
            ->load('address')
            ->load('openingDays.openingHours');
    }

    public function destroy(Model $model)
    {
        $model->delete();
    }

    private function getSubdomainFromUrl(string $url)
    {
        if (config('app.env') === 'local') {
            $subdomain = 'localhost:3000';
        } else {
            $scheme = config('app.env') === 'local' ? 'http' : 'https';
            $subdomain = explode('.', explode("$scheme://", $url)[1])[0];
        }

        return $subdomain;
    }
}
