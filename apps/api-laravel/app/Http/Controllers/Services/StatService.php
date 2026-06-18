<?php

namespace App\Http\Controllers\Services;

use App\Contracts\ServiceContract;
use App\Http\Controllers\FetchManagers\StaffFetchManager;
use App\Http\Controllers\Services\StatService\AppointmentIncomeService;
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

class StatService
{
    public function getStats($payload)
    {
        if ($payload['type'] == 'appointment-income') {
            if (empty($payload['start_date']) || empty($payload['end_date'])) {
                return null;
            }

            return AppointmentIncomeService::handle($payload['start_date'], $payload['end_date']);
        }
    }
}
