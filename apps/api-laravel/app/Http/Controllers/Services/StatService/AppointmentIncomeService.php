<?php

namespace App\Http\Controllers\Services\StatService;

use App\Models\Appointment;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

class AppointmentIncomeService
{
    public static function handle($startDate, $endDate)
    {
        $days = [
            ['day' => 'Monday', 'amount' => 0],
            ['day' => 'Tuesday', 'amount' => 0],
            ['day' => 'Wednesday', 'amount' => 0],
            ['day' => 'Thursday', 'amount' => 0],
            ['day' => 'Friday', 'amount' => 0],
            ['day' => 'Saturday', 'amount' => 0],
            ['day' => 'Sunday', 'amount' => 0]
        ];
        Appointment::query()
            ->wherebetween('date', [Carbon::parse($startDate), Carbon::parse($endDate)])
            ->each(function (Appointment $appointment) use (&$days) {
                $day = Arr::pluck($days, function ($day) use ($appointment) {
                    return $day['day'] === Carbon::parse($appointment->date)->day;
                });
                $day['amount'] += $appointment->total;
            });

        return $days;
    }
}
