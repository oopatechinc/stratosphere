<?php

namespace App\Http\Controllers\Services;

use App\Contracts\ServiceContract;
use App\Http\Controllers\FetchManagers\StaffFetchManager;
use App\Http\Requests\SyncServicesStaffRequest;
use App\Models\Address;
use App\Models\Appointment;
use App\Models\Location;
use App\Models\Occupation;
use App\Models\OpeningDay;
use App\Models\OpeningDayStaff;
use App\Models\OpeningHour;
use App\Models\ServiceVariation;
use App\Models\Staff;
use App\Models\TimeBlock;
use App\Models\TimeBlockDate;
use App\Models\Timezone;
use App\Models\User;
use Carbon\CarbonInterval;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StaffService implements ServiceContract
{
    public function index()
    {
        return (new StaffFetchManager())->apply()->get();
    }

    public function store(array $payload): Model
    {
        // create user
        $user = User::query()->create($payload['user']);
        $staff = Staff::query()->create([
            'user_id' => $user->id,
            'tenant_id' => Auth::user()->staff()->first()->tenant_id,
            'status' => Staff::STATUS_INVITED
        ]);

        //attach occupation
        $occupationIds = array_map(function ($occupation) {
            return $occupation['id'];
        }, $payload['occupations']);

        $staff->occupations()->attach($occupationIds);

        //create address
        foreach ($payload['addresses'] as $address) {
            $address['addressable_id'] = $user->id;
            $address['addressable_type'] = User::class;

            Address::query()->create($address);
        }

        // update staff
        $staff->load('user.addresses');
        $staff->load('occupations');

        return $staff;
    }

    public function update(Model $model, array $payload): Model
    {
        /**@var Staff $model **/
        $model->update(Arr::only($payload, $model->getFillable()));

        // update user
        $model->user()->update(Arr::only($payload['user'], (new User())->getFillable()));

        //attach occupation
        $occupationIds = Arr::pluck($payload['occupations'], 'id');
        $model->occupations()->sync($occupationIds);

        //create address
        $payload['address']['addressable_id'] = $model->id;
        $payload['address']['addressable_type'] = Staff::class;
        Address::query()->updateOrCreate($payload['address']);

        //update services
        $model->services()->sync(Arr::pluck($payload['services'], 'id'));

        //update time blocks
        foreach($payload['time_blocks'] as $timeBlock) {
            $timeBlockFields = Arr::only($timeBlock, (new TimeBlock())->getFillable());
            $record = TimeBlock::query()->firstOrCreate($timeBlockFields);
            foreach($timeBlock['dates'] as $timeBlockDate) {
                TimeBlockDate::query()->firstOrCreate([
                    'time_block_id' => $record->id,
                    'date' => $timeBlockDate['date'],
                ]);
            }
        }

        return $model->refresh()
            ->with(['services', 'address', 'occupations', 'timeBlocks.dates'])
            ->first();
    }

    public function destroy($id)
    {
        return Staff::query()->find($id)->delete();
    }

    public function syncServices(Staff $staff, array $payload)
    {
        $staff->services()->sync(Arr::pluck($payload, 'id'));
        return (new StaffFetchManager($staff->id))->apply()->get();
    }

    public function getTimes(Staff $staff, array $payload)
    {
        $staffServiceVariations = ServiceVariation::query()
            ->whereIn('service_variations.id', explode(',', $payload['service_variation_ids']))
            ->join('service_staff', 'service_staff.service_id', '=', 'service_variations.service_id')
            ->where('service_staff.staff_id', '=', $staff->id)
            ->get();

        if ($staffServiceVariations->isEmpty()) {
            return [];
        }

        $location = Location::query()->findOrFail($payload['location_id']);

        $openingDay = OpeningDay::query()
            ->where('location_id', $payload['location_id'])
            ->where('day_of_week', Carbon::createFromDate($payload['date'])->dayOfWeek())
            ->where('is_active', true)
            ->with('openingHours')
            ->firstOrFail();

            $existingAppointments = Appointment::query()
                ->where('date', $payload['date'])
                ->where('staff_id', $staff->id)
                ->where('status', Appointment::STATUS_PENDING)
                ->get();

        $calendarEvents = [];
//            if ($tenant->canSyncCalendars()) {
//                if ($tenant->consultantCanUsePersonalCalendar() && $admin->hasCalendar()) {
//                    $calendarEvents = $admin->getCalendarEventsByDate(Carbon::createFromDate($payload['date']));
//                    $calendarEvents = $calendarEvents[0]['items'];
//                } else if($tenant->admins()->count() <= 1 && $tenant->hasCalendar()) {
//                    // if there are multiple admins for the tenant, then double booking on the tenant calendar will definitely happen
//                    // so no need to filter the times
//                    $calendarEvents = $tenant->getCalendarEventsByDate(Carbon::createFromDate($data['date']));
//                    $calendarEvents = $calendarEvents[0]['items'];
//                }
//            }

        // resolve timezones
        $locationTimezone = Timezone::query()->where('id', $location->timezone_id)->first();
        $customerTimezone = Timezone::query()->where('id', $payload['customer_timezone_id'])->first();

        return $this->calculateTimes(
            $locationTimezone->timezone,
            $openingDay,
            $existingAppointments,
            $staffServiceVariations,
            $calendarEvents,
            $customerTimezone->timezone,
            $payload['date']
        );
    }

    private function calculateTimes(
        string $locationTimezone,
        OpeningDay $openingDay,
        Collection $existingAppointments,
        Collection $staffServiceVariations,
        array $calendarEvents,
        string $customerTimezone,
        string $date
    ) {
        $totalLengthMinutes = $staffServiceVariations->reduce(
            function (int $total, ServiceVariation $variation) {
                $total += $variation->duration;
                return $total;
            }, 0);

        $openingHours = $openingDay->openingHours()->orderBy('opens_at')->get();

        $openingTime = $openingHours[0]->opens_at;
        $closingTime = $openingHours[count($openingHours)-1]->closes_at;

        $intervals = CarbonInterval::minutes($totalLengthMinutes)
            ->toPeriod($openingTime, $closingTime);

        $closingTimeInt = strtotime(Carbon::parse($closingTime)->format('H:i'));

        //todo::remove all time blocked days and times
//        $consultantBreakStartTimeInt = strtotime($openingDay->break_start_time);
//        $consultantBreakEndTimeInt   = strtotime($openingDay->break_end_time);
//        $consultantWorkEndTimeInt = strtotime($openingDay->work_end_time);

        $times = [];
        foreach ($intervals->toArray() as $interval) {
            $intervalStartInt = strtotime($interval->format('H:i'));
            $intervalEndInt   = strtotime( $interval->addMinutes($totalLengthMinutes)->format('H:i'));

            //check the endtime interval is less than the closes_at endtime
            //e.g. should skip if endtime interval is 5:30pm and location close time is 5pm.
            if ($intervalEndInt > $closingTimeInt) {
                continue;
            }

            // check if the last generated interval end time is greater
            // than the consultant's end time
//            if ($intervalEndInt > $consultantWorkEndTimeInt) {
//                continue;
//            }

            //check if time is past based on admin timezone for same day booking
            //if current time is 5pm and interval start time is 3:30, it will be skipped
            $currentTime = Carbon::now($locationTimezone);
            $localizedIntervalStartInt = strtotime($interval->shiftTimezone($locationTimezone)->format('H:i'));
            $isInThePast = strtotime($currentTime->format('H:i')) > $localizedIntervalStartInt;

            if ($currentTime->isSameDay($date) && $isInThePast) {
                continue;
            }

            // check if consultant has breaks
            // if yes, skip break times
//            if ($openingDay->has_breaks) {
//                $breakIsBetweenIntervals = $intervalStartInt <= $consultantBreakStartTimeInt
//                    &&  $intervalEndInt > $consultantBreakStartTimeInt;
//
//                $intervalEndsBeforeBreak = $intervalStartInt >= $consultantBreakStartTimeInt
//                    &&  $intervalStartInt < $consultantBreakEndTimeInt;
//
//
//                if ($breakIsBetweenIntervals || $intervalEndsBeforeBreak) {
//                    continue;
//                }
//            }

            // remove any times that would clash
            foreach ($existingAppointments as $existingAppointment) {
                $startTimeInt = strtotime($existingAppointment->start_time);
                $endTimeInt = strtotime($existingAppointment->end_time);

                if (($intervalStartInt <= $startTimeInt &&  $intervalEndInt > $startTimeInt)
                    || ($intervalStartInt >= $startTimeInt &&  $intervalStartInt < $endTimeInt)
                ) {
                    continue 2;
                }
            }

            // check for calendar events
            foreach ($calendarEvents as $event) {
                $calStartTimeInt = strtotime(Carbon::create($event->start->dateTime)->format('H:i'));
                $calEndTimeInt   = strtotime(Carbon::create($event->end->dateTime)->format('H:i'));
                if (($intervalStartInt <= $calStartTimeInt &&  $intervalEndInt > $calStartTimeInt)
                    || ($intervalStartInt >= $calStartTimeInt &&  $intervalStartInt < $calEndTimeInt)
                ) {
                    continue 2;
                }
            }

            // show time in client's timezone
            $times[] = [
                'start' => $interval->shiftTimezone($locationTimezone)
                    ->setTimezone($customerTimezone)
                    ->format('H:i'),
                'end' => $interval->shiftTimezone($locationTimezone)
                    ->setTimezone($customerTimezone)
                    ->addMinutes($totalLengthMinutes)
                    ->format('H:i')
            ];
        }

        return $times;
    }
}
